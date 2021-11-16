<?php
header("Access-Control-Allow-Origin: *");

$postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");



//{{first.DATA}}
//设备号：{{keyword1.DATA}}
//告警时间：{{keyword2.DATA}}
//告警级别：{{keyword3.DATA}}
//告警模块：{{keyword4.DATA}}
//事件描述：{{keyword5.DATA}}
//{{remark.DATA}}
//--------温度报警消息推送----------------//
function Tui_song($first,$keyword1,$keyword2,$keyword3,$keyword4,$keyword5,$remark,$openId,$app_key,$keyword6)
{
    //$keyword5='\n'.$keyword5.'\n';
    $first=$first.'\n\n设备编号：'.$keyword1;
    $keyword2=$keyword2.'\n详情描述：'.$keyword5;
    $remark='\n'.$remark;
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"$openId",
            'template_id'=>"SiyIucG59C-fdnAR5n6WhszwXjZTsPjpZOqFuKzo--w",
//          'url'=>"http://www.ccsc58.cc/weixinnew/html/warning_list.html,
            'url'=>"http://www.ccsc58.cc/weixinnew/html/warning_tui_rukou.html?num_m=".$keyword6."&",
            'topcolor'=>"#7B68EE",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword3),'color'=>"#ff0000",),
                'keyword2'=>array('value'=>urlencode($keyword4),'color'=>"#000",),
                'keyword3'=>array('value'=>urlencode($keyword2),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000"),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        //var_dump($result);
    }
}
//-----------运单温度报警通知-------------//

function TempAnomaly($first,$keyword1,$keyword2,$keyword3,$keyword4,$keyword5,$remark,$openId,$app_key)
{
	
	$remark='\n'.$remark;
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>$openId,
            'template_id'=>"ZbCcSEE1WbzW0Vmm6kfjkH-1-svEQmwoXjOb7otdEAw",
            //'url'=>"http://www.ccsc58.cc/weixinnew/tms_weixin/AlarmMess/tempalarm.html",
            'url'=>"http://www.ccsc58.cc/weixinnew/tms_weixin/AlarmMess/tempalarm.html?danhao=".$keyword1."&shebeihao=".$keyword3."&time="."2018-03-31"."&postion=".$keyword4."&leixing=".$keyword5."&baojing=".$remark."",
            // 'url'=>"http://www.ccsc58.cc/weixinnew/tms_weixin/AlarmMess/tempalarm.html?danhao=".$keyword1."&time=".$keyword5."&leixing=".$keyword2."&shebeihao=".$keyword3."&postion=".$keyword4",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#0000FF",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#743A3A",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#008000",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#FF0000",),
                'keyword4'=>array('value'=>urlencode($keyword4),'color'=>"#008000",),
                'keyword5'=>array('value'=>urlencode($keyword5),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
         var_dump($result);
    }
}

function zhongjiang($first,$keyword1,$keyword2,$keyword3,$remark,$openId,$app_key)
{
	$remark='\n'.$remark;
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>$openId,
            'template_id'=>"45wHwYBBxE6rdHR82IGE3T1tGT9FqBdU-FnMuOn82p8",
            'url'=>"",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode('恭喜'.$first.'您，中奖了！'),'color'=>"#0000FF",),
                'keyword1'=>array('value'=>urlencode('中集冷云展会抽奖现场'),'color'=>"#743A3A",),
                'keyword2'=>array('value'=>urlencode('20180228期'),'color'=>"#008000",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#FF0000",),
                'remark'=>array('value'=>urlencode('再次感谢您对中集冷云公司的支持，本消息仅为中奖凭证,工作人员会耐心核实,希望中奖者耐心等待奖品。  特此通知！'),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
         var_dump($result);
    }
}
function xiafa_yzm($first,$keyword1,$keyword2,$remark,$openId,$app_key)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>$openId,
            'template_id'=>"O26GudtU0nMa2o5rMZ1aS51G27F_AWkoUD6pw7gajBo",
            'url'=>"http://hr.ccsc58.cc",
            'topcolor'=>"#7B68EE",
            'data'=>array('first'=>array('value'=>urlencode('你好，欢迎登陆中集冷云冷链物流系统管理平台'),'color'=>"#743A3A",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#FF0000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000FF",),
                'remark'=>array('value'=>urlencode('请于1分钟内正确输入 ，若非本人操作，请忽略！'),'color'=>"#008000"),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        echo $result;
    }
}
function Pay_money($first,$keyword1,$keyword2,$keyword3,$keyword4,$remark,$openId,$app_key)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>$openId,
            'template_id'=>"0P_Gawko7wU3H2uJFHWBbbVYxsKmnZj4fFJ6mS5nBLI",
            'url'=>"http://www.ccsc58.cc/weixinnew/pay_list.html",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000ff",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
                'keyword4'=>array('value'=>urlencode($keyword4),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        header('location:../weixin/image_test.html');
    }
}
function draw($first,$keyword1,$keyword2,$keyword3,$remark,$openId)
{
        $template=array(
            'touser'=>$openId,
            'template_id'=>'iKFnIzm2aWXCMSAHL-p8hCKxt8Qs0_P31_nXRZnIl0w',
            'url'=>"",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000ff",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        echo($result);
    
}
function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
	$arr = array();
	foreach($_POST as $v)
	{
	    $arr[] = $v;
	}
	if(count($arr)==10){
		Tui_song($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9]);
	}elseif(count($arr)==9){
		 TempAnomaly($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8]);
	}elseif(count($arr)==8){
		 Pay_money($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7]);
	}else if(count($arr)==7){
		 zhongjiang($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6]);
	}else if(count($arr)==6){
		if($arr[5]=='261AFF68C0E9F076420D083D66222824'){
		 xiafa_yzm($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
		}else{
		 draw($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
		}
	}else{
		 var_dump("aa");
	}

function getAccessToken(){
    $url = "http://www.zjcoldcloud.com/weixin/get_token_zjly.php";
    $access_token=file_get_contents($url);
    return $access_token;
}

function get_php_file($filename) {
    return trim(substr(file_get_contents($filename), 15));
}

function set_php_file($filename, $content) {
    $fp = fopen($filename, "w");
    fwrite($fp, "<?php exit();?>
" . $content);
fclose($fp);
}
