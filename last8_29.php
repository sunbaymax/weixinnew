<?php
header("Access-Control-Allow-Origin: *");

$postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
//高价值物品消息模板
function Highvaluegoodmess($first,$keyword1,$keyword2,$keyword3,$remark,$openId)
{
	
	$remark='\n'.$remark;
    $template=array(
            'touser'=>$openId,
            'template_id'=>"8LMnJ7I7wjSUPgaf9wCEQ0VUFw3YrscHAMNJoaOwM8g",
            'url'=>"",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#0000FF",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#743A3A",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#008000",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#FF0000",),
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
	if(count($arr)==6){
		Highvaluegoodmess($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
	}
	else{
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
