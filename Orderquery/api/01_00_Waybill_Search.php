<?php
header("Content-type: text/html;charset=GBK");
header("Access-Control-Allow-Origin: *");//解决跨域问题
date_default_timezone_set("PRC");
include('01_00_Waybill_common.php');
$common = new Common;
$CiChenDa = []; //默认该数组为空  次晨达的节点
$link = $common->link_sqlserver("rm-2zet8l11r91d5tfbp9o.sqlserver.rds.aliyuncs.com:3433",'ds','SJN~!20090827','COO');
if (empty($_POST['billnumber'])) {echo json_encode(array('code' => '400','data' => array('result' => '请输入运单号')));die;}
$billnumber = $_POST['billnumber'];
$Account = $common->mssql_select($link,'COO.dbo.Sends','top 1 CYCompany,CYNumber',"BillNumber = '$billnumber'",'ID desc',MSSQL_ASSOC);
if (!$Account) {
    echo json_encode(array('code' => '400','data' => array('result' => '该订单不存在')));die;
}
if (substr_count($Account['0']['CYCompany'],'次晨达') >= '1') {
    $url = 'https://www.bcsyt.cn/Accept.aspx';
    $arr = [
        'Request' => ['OpenID'=>'CCCC58','WorkCode'=>$Account['0']['CYNumber']],
        "Signed" => "UIOIE-KEIUE-OPAW3-LOEJE-8934J",
        "Action" => "NosignDetails"
    ];
    $str = json_encode($arr);
    $data = ['json'=> $str];
    $return = json_decode(requestCurl($url,"POST",$data),true);
    //判断是否有信息
    if ($return['Rtn_Code'] == '0') {
        krsort($return['List1']);
        $CiChenDa = array_merge($return['List1']);
        foreach ($CiChenDa as $k => $v) {
            $CiChenDa[$k]['LinkTime'] = date('Y-m-d H:i:s',strtotime($v['LinkTime']));
        }
    }
}

//抓取次晨达物流信息
//echo "<pre>";
//print_r($return);//die();
function requestCurl($url, $method = "POST", $data = array(), $setcookie = false, $cookie_file = false)
{
    //限制内存占用
    ini_set('memory_limit', '10M');

    $ch = curl_init();//1.初始化
    curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式

    //4.参数如下禁止服务器端的验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    //伪装请求来源，绕过防盗
    curl_setopt($ch,CURLOPT_REFERER,"http://wthrcdn.etouch.cn/");
    //配置curl解压缩方式（默认的压缩方式）
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    //指明以哪种方式进行访问,利用$_SERVER['HTTP_USER_AGENT'],可以获取
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0); //TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header
    if ($method == "POST") {//5.post方式的时候添加数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $tmpInfo = curl_exec($ch);//获取html内容
    if (curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $tmpInfo;
}

//抓取物流信息详情
function request_post($url = '', $param = '') {
    if (empty($url) || empty($param)) {
        return false;
    }
    $postUrl = $url;
    $curlPost = $param;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 0);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    //var_dump(curl_error($ch));
    return $data;
}

$url = 'http://59.110.61.154/api/searchbill/' . $billnumber;
$post_data['danhao'] = $billnumber;
$info = json_decode(request_post($url,$post_data),true);
if (empty($info['StartCity']) || empty($info['EndCity'])) {echo json_encode(array('code' => '400','data' => array('result' => '该订单不存在')));die;}
//下面将数据转换一下输出给客户
$StartCity = $info['StartCity'];
$EndCity = $info['EndCity'];
//判断是否有节点信息
if (empty($info['result'])) {echo json_encode(array('code' => '300','data' => array('result' => '该订单暂无节点信息')));die;}
//转换格式
/**
 * @获取到所有的信息  result数组
 * @将节点信息全部取出 存放字符串或者数组  去查看是否有签收的节点  然后再进行下面的判断
 * @查看物流节点是否有签收字样
 * @如果有的话 将物流节点对应的时间取出来  这里要处理一下时间的字符串  因为他的年月日 时分秒之间加了一个 T  作为分隔
 * @查看一下是否有在签收事件后的操作  有的话就把对应的节点信息删除掉
 * @按时间顺序将所有的节点升序排列  （可以用冒泡排序算法）
 */
foreach ($info['result'] as $key => $value) {
    $msg[] = $value['BillNote'];
}
$str = implode(',',$msg);//将节点信息转换为字符串
//判断节点中是否签收信息
if (strpos($str,'签收')) {
    //将签收对应的时间取出来
    foreach ($info['result'] as $key => $value) {
        if ($value['BillNote'] == '签收') {
            $time = strtotime(str_replace('T',' ',$value['Indate']));
        }
    }
    foreach ($info['result'] as $key => &$value) {
        $value['Indate'] = strtotime(str_replace('T',' ',$value['Indate']));      //将格式转换为时间戳
        if ($value['Indate'] <= $time && $value['BillNote'] != 'DE') {   //不知道DE代表什么
            //重新定义一个节点数组
            $jiedian[$value['Indate']] = $value['city'] . $value['BillNote'];
        }
    }
    //将图片信息带出
//    $picture = file_get_contents("http://59.110.61.154/ftp/$billnumber.jpg");
    $picture = "http://59.110.61.154/ftp/$billnumber.jpg";
} else {
    foreach ($info['result'] as $key => &$value) {
        $value['Indate'] = strtotime(str_replace('T',' ',$value['Indate']));      //将格式转换为时间戳
        //重新定义一个节点数组
        if ($value['BillNote'] != 'DE') {
            $jiedian[$value['Indate']] = $value['city'] . $value['BillNote'];
        }
    }
    //定义图片信息暂无
    $picture = '暂无图片信息';
}
//按键名将数组升序排序
ksort($jiedian);
//将时间格式 转换为Y-m-d H:i:s格式
foreach ($jiedian as $k => $v) {
    $city = substr($v,0,-6);
    $BillNote = substr($v,-6);
    $message[] = array('Indate' => date('Y-m-d H:i:s',$k),'city' => $city,'BillNote' => $BillNote);
}
//将节点信息输出
echo json_encode(array('code' => '200','City' => $StartCity,'GetCity' => $EndCity,'result' => $message,'picture' => $picture,'CiChenDa' => $CiChenDa));
