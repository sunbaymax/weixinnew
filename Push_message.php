<?php
header("Access-Control-Allow-Origin: *");	
/**
 * wechat php test
 */
//define your token
//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
$postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
//get post data, May be due to the different environments

//file_put_contents("./data.txt",$postStr);
//die();
//extract post data
if (!empty($postStr)){
    //libxml_disable_entity_loader(true);
    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    $fromUsername = $postObj->FromUserName;
    $toUsername = $postObj->ToUserName;
    $RX_TYPE=trim($postObj->MsgType);

    $keyword = trim($postObj->Content);
    $time = time();

    $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
    $imageTpl=	"<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Image>
							<MediaId><![CDATA[%s]]></MediaId>
							</Image>
							</xml>";
    $newsTpl=	"<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>
							</Articles>
						</xml>";
    if($RX_TYPE=="event")
    {
        $result=receiveEvent($postObj);
    }else{
        if(!empty( $keyword ))
        {
           if($keyword=="设备"||$keyword=="查询"||$keyword=="冷链"||$keyword=="监控"||$keyword=="我的设备"||$keyword=="中集冷云"){
                $msgType = "text";
                $contentStr = "<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">我的设备</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
           else{
                $msgType = "text";
                $contentStr = "您好！您可以回复以下内容：\n\n☞【下载】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">下载APP</a>\n\n☞【客服】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">客服电话</a>\n\n☞【说明书】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">说明书</a>\n\n☞【设备号】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">设备详情</a>\n\n☞【意见/反馈】:<a href=\"http://www.cccc58.com\">意见反馈</a>\n\n☞【报警/异常】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">报警设备</a>\n\n☞【绑定/设备】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">绑定账号</a>\n\n☞【订单/我的订单】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">我的订单</a>\n\n客服电话:400-6507-168";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            };
        }else{
            echo "Input something...";
        };
    } 
    echo $result;
};
function receiveEvent($object)
{
    $content = "";
    switch($object->Event)
    {
        case "subscribe":
            $content = "您好，欢迎关注中集冷云公众平台！/微笑\n\n请点击下方“中集冷云”按钮进行账号绑定\n请点击“关于我们”按钮下载相关APP\n\n您可以回复以下内容：\n\n☞【下载】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">下载APP</a>\n\n☞【绑定】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth_3.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">微信绑定</a>\n\n☞【说明书】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">说明书</a>\n\n☞【设备号】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">设备详情</a>\n\n☞【意见/反馈】:<a href=\"http://www.cccc58.com\">意见反馈</a>\n\n☞【报警/异常】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">报警设备</a>\n\n☞【绑定/设备】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">绑定账号</a>\n\n☞【订单/我的订单】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">我的订单</a>";
            break;
        case "unsubscribe":
            $content = "取消成功,欢迎下次关注！";
            break;
		case "CLICK":
		    switch ($object->EventKey)
		    {
		        case "shuomingshu":
		             $content[] = array("Title" =>"温湿度监控智能终端使用说明书（20TP与20DP）", 
		    		 "Description" =>"温湿度监控智能终端使用说明书（20TP与20DP）", 
		             "PicUrl" =>"http://www.ccsc58.cc/weixinnew/img/shumingshu_tuisong.png", 
		             "Url" =>"http://mp.weixin.qq.com/s/a-7N3QysT4Bmn3eNGPldOw");
		             break;
		        case "tel":
		            $content = "客服电话：400-6507-168";
		            break;
		            default:
		            $content[] = array("Title" =>"冷云冷链", 
		            "Description" =>"您正在使用冷云冷链公众平台", 
		            "PicUrl" =>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", 
		            "Url" =>"weixin://addfriend/pondbaystudio");
		            break;
	            case "app":
                	$content = "请点击左下角，回复内容“下载”进行APP下载";//点击公众下面的菜单想用户推送的内容匹配；
                    break;
		    }
            break;
            default:
            break;  
    }
	if (is_array($content))
	{
        $result = transmitNews($object, $content);
    }else{
        $result = transmitText($object, $content);
    }
    //$result = transmitText($object,$content);
    return $result;
};
function transmitText($object,$content)
{
    $tuiTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
    $fromUsername = $object->FromUserName;
    $toUsername = $object->ToUserName;
    $time = time();
    $result = sprintf($tuiTpl,$fromUsername,$toUsername,$time,$content);
    return $result;
};
function transmitNews($object, $arr_item, $funcFlag = 0)
			    {
			        //首条标题28字，其他标题39字
			        if(!is_array($arr_item))
			            return;
			
			        $itemTpl = "<item>
						        <Title><![CDATA[%s]]></Title>
						        <Description><![CDATA[%s]]></Description>
						        <PicUrl><![CDATA[%s]]></PicUrl>
						        <Url><![CDATA[%s]]></Url>
						    	</item>";
			        $item_str = "";
			        foreach ($arr_item as $item)
			        $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
			        $newsTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>
								<Content><![CDATA[]]></Content>
								<ArticleCount>%s</ArticleCount>
								<Articles>
								$item_str</Articles>
								<FuncFlag>%s</FuncFlag>
								</xml>";
			        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
			        return $resultStr;
			    }
//{{first.DATA}}
//设备号：{{keyword1.DATA}}
//告警时间：{{keyword2.DATA}}
//告警级别：{{keyword3.DATA}}
//告警模块：{{keyword4.DATA}}
//事件描述：{{keyword5.DATA}}
//{{remark.DATA}}
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

//意见反馈推送接口
function Feedbackreminding($first,$keyword1,$keyword2,$keyword3,$keyword4,$remark,$openId,$app_key)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"oTarnv5aWyxLcCENYrs5UOR3FqvQ",
            'template_id'=>"gDgp7f5VJrnpiV6piZIYPbMntHzVmR_nbKabYXv5xPg",
            'url'=>"http://www.ccsc58.cc/weixinnew/Suggestions/Suggselt_list.html",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode('您好，'.$first.'，您收到一个售后工单，请及时响应'),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode('lengyun001'.'时间:'.$keyword1),'color'=>"#000",),
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
//中集冷云微信调查问卷推送接口
function question($first,$keyword1,$keyword2,$remark,$openId,$app_key)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"$openId",
            'template_id'=>"J_RwqOlWzzoWn52E8jgIeLi5UmRUfng4xODKvM7ZizA",
            'url'=>"http://www.ccsc58.cc/weixinnew/Questionnaire/selectQues.html",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000ff",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        header('location:../weixin/image_test.html');
    }
}
//中集冷云微信下单接口通知
function orderMess($first,$keyword1,$keyword2,$keyword3,$keyword4,$keyword5,$remark,$openId,$app_key)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"$openId",
            'template_id'=>"vycBEiJO0tmZuR3cuwCKeXxz1HDfwM2Iv2XfvQcTu0E",
            'url'=>"",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000ff",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
                'keyword4'=>array('value'=>urlencode($keyword4),'color'=>"#000",),
                'keyword5'=>array('value'=>urlencode($keyword5),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
    }
}
function Reply($first,$keyword1,$keyword2,$keyword3,$remark,$openId,$app_key,$id,$id1,$id2,$id3)
{
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"$openId",
            'template_id'=>"oZ8FAS7lKOkvl8JcNXS3I4gupYb9i2xqWPDdfzV0Ncg",
            'url'=>"http://www.ccsc58.cc/weixinnew/Suggestions/Suggs_result.html?id=".$id."",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode('您的反馈已经由管理人员处理！'),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode('已回复'),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000ff",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
                'remark'=>array('value'=>urlencode('感谢您的反馈，希望我们的回复能解决您的问题！'),'color'=>"#000",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        header('location:../weixin/image_test.html');
    }
}
function download($first,$keyword1,$keyword2,$keyword3,$remark,$openId,$url)
{
        $template=array(
            'touser'=>$openId,
            'template_id'=>"324xrKCskqZRV7AGjiM4LnjZwwZtRW9CquMmsqETJMg",
            'url'=>$url,
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
        var_dump($result);
}
function invite($first,$keyword1,$keyword2,$keyword3,$remark,$openId)
{
        $template=array(
            'touser'=>$openId,
            'template_id'=>"czTRF0y3sg_VkNCmG_V-Iw_0pYiznX1-Q5aulDutyWU",
            'url'=>"http://www.ccsc58.cc/weixinnew/Draw/enter/index.php?openid=".$openId."",
            'topcolor'=>"#000000",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#000",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000ff",),
            )
        );
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        var_dump($result);
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
		 orderMess($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8]);
	}elseif(count($arr)==8){
		 Feedbackreminding($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7]);
	}elseif(count($arr)==11){
		 Reply($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9],$arr[10]);
	}elseif(count($arr)==6){
		if($arr[5]=='261AFF68C0E9F076420D083D66222824'){
			question($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
		}else{
			invite($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
		}
		 
		  
	}elseif(count($arr)==7){
		 download($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6]);
	}else{
		var_dump(count($arr));
		 var_dump("null");
	};



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

function receiveText($object)
    {
        $keyword = trim($object->Content);
		if (strstr($keyword, "天气")){
			$city = str_replace('天气', '', $keyword);
			include("weather2.php");
			$content = getWeatherInfo($city);
		//判断笑话
		}
        $result = transmitNews($object, $content);
        return $result;
    }
    function receiveBDText($object)
    {
        $keyword = trim($object->Content);
		if (strstr($keyword, "BD")){
			$phone = str_replace('BD', '', $keyword);
			$openId=$object->FromUserName;
			var_dump($openId);
			include("BDtel.php");			
			$content = getBDInfo($phone,$openId);
		}
        $result = transmitText($object, $content);
        return $result;
    }

    function receiveYDText($object)
    {
        $keyword = trim($object->Content);
        if (strstr($keyword, "YD")){
            $danhao = trim(str_replace('YD', '', $keyword));
            $openId=$object->FromUserName; 
            include("YDtel.php");   
           // $content="1111";        
            $content = getInfo($danhao,$openId);
        }
        $result = transmitText($object, $content);
        return $result;
    }
    


    function shebeihao_pdf($object,$shebeihao,$yundanhao)
    {
        $shebeihao = trim($shebeihao);
        $yundanhao = trim($yundanhao);
        $openId=$object->FromUserName;
        include("shebeihao_pdf.php");
        $content=geturl($openId,$shebeihao,$yundanhao);
        $result = transmitText($object, $content);
        return $result;
    }    


    /**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}