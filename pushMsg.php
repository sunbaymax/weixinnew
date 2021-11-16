<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set("Asia/Shanghai");
$postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
//物流状态提醒
//{{first.DATA}}
//物流单号：{{keyword1.DATA}}
//货物信息：{{keyword2.DATA}}
//物流状态：{{keyword3.DATA}}
//时间：{{keyword4.DATA}}
//委托公司：{{keyword5.DATA}}
//{{remark.DATA}}
function LogisticMsg($Company,$StartCity,$EndCity,$CargoName,$WDQJ,$CarName,$BillNumber,$OpenId,$State,$Telephone)
{
	
	if($State=='QJ'){
		$first='您的物品已经取件正在派送，请耐心等待';
		$assess='请您对本次取件服务，进行中肯的评价';
	}else{
		$first='您的物品已经签收啦！';
		$assess='请您对本次签收服务，进行中肯的评价';
	}
    $keyword1=$BillNumber;
    $keyword2=$CargoName.' '.$WDQJ;
    $keyword3=$StartCity.'->'.$EndCity.$State=='QJ'?'已取件':'已签收';
    $keyword4=date('Y-m-d h:i:s', time());
    $keyword5=$Company;
    $remark='送货司机及电话'.$CarName.' '.$Telephone.'\n'.$assess;
    $template=array(
        'touser'=>"$OpenId",
        'template_id'=>"9thAvTJincE-nvO6izS7jhNRZBAka3uzxvTdoB09Qp8",
        'url'=>"http://www.ccsc58.cc/weixinnew/lengyun-evaluate/index.html?WDQJ=".$WDQJ."&CarName=".$CarName."&BillNumber=".$BillNumber."&State=".$State."&Telephone=".$Telephone."",
        'topcolor'=>"#7B68EE",
        'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
            'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#ff0000",),
            'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#000",),
            'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
            'keyword4'=>array('value'=>urlencode($keyword4),'color'=>"#000",),
            'keyword5'=>array('value'=>urlencode($keyword5),'color'=>"#000",),
            'remark'=>array('value'=>urlencode($remark),'color'=>"#000"),
        )
    );
    $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
    $result=https_request($url,urldecode(json_encode($template)));
    echo $result;
    
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
		LogisticMsg($_POST['Company'],$_POST['StartCity'],$_POST['EndCity'],$_POST['CargoName'
		],$_POST['WDQJ'],$_POST['CarName'],$_POST['BillNumber'],$_POST['OpenId'],$_POST['State'],$_POST['Telephone']);
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
