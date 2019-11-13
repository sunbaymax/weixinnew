<?php
header("Content-type:text/html;charset=uft-8");
date_default_timezone_set('PRC'); //设置中国时区 
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
            }else if($keyword=="说明书"||$keyword=="产品说明书"||$keyword=="监控仪"||$keyword=="设备"){
                $msgType = "news";
                $title="温湿度监控智能终端使用说明书（20TP与20DP）";
                $Description="温湿度监控智能终端使用说明书（20TP与20DP）";
                $PicUrl="http://www.ccsc58.cc/weixinnew/img/shumingshu_tuisong.png";
                $Url="http://mp.weixin.qq.com/s/a-7N3QysT4Bmn3eNGPldOw";
                $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,$title,$Description,$PicUrl,$Url);
                echo $resultStr;
            }else if($keyword=="CRM"||$keyword=="crm"||$keyword=="客户管理"||strstr($keyword, "销售")){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/CRM/login.html\">CRM销售管理系统</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="RFID"||$keyword=="rfid"){
                $msgType = "text";
                $contentStr = "<a href=\"http://jd.ccsc58.cc/index_RFID.php?t=RFID_20170830\">RFID</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="打印"||$keyword=="照片打印"){
                $msgType = "text";
                $contentStr = "<a href=\"http://gfd178.com/design/FnMZrNVz\">照片打印</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="运单温度"||$keyword=="温度详情"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/WaybillTemp.php\">运单温度数据详情</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="冷库控制"||$keyword=="冷机控制"||strstr($keyword, "冷库")||strstr($keyword, "冷机")){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/lengku-control/Checkpostion.php\">冷机温度控制</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="问题"||$keyword=="问题反馈"||$keyword=="疑难问题"||$keyword=="意见"||strstr($keyword, "反馈")){
                $msgType = "text";
                $contentStr = "请点击：➼"."<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_Suggs.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">意见回馈 </a>	/:coffee	/:coffee\n备注:如果您在使用的过程中遇到疑问，或者有任何的意见或者建议，欢迎随时想我们反馈，我们会尽快回复您的反馈，中集冷云正在为医药行业客户提供科技冷链运输一体化综合解决方案。";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="oms"||$keyword=="OMS"){
                $msgType = "text";
                $contentStr = "您好,请通过链接进行用户名绑定："."<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_omsbanding.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">ttps://open.weixin.qq.com/connect/oauth2/authorize/oms</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="下单"||strstr($keyword, "下单")){
                $msgType = "text";
                $contentStr = "请点击：➼"."<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">微信下单 </a>	/:coffee	/:coffee\n备注:如果您在使用的过程中遇到疑问，请联系北京中集智冷科技工作人员83613710。";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="问卷"||$keyword=="调研"){
                $msgType = "text";
                $contentStr = "请点击：➼"."<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_wechatquestion.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">参与调研 </a>	/:coffee	/:coffee\n备注:如果您在使用的过程中遇到疑问，请联系北京中集智冷科技工作人员83613710。";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="签到"){
                $msgType = "text";
                $contentStr = "请点击：➼"."<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_sign.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">签到 </a>	/:coffee	/:coffee\n备注:如果您在使用的过程中遇到疑问，请联系北京中集智冷科技工作人员83613710。";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="tms"||$keyword=="TMS"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/tms/itms/select\">TMS</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="绑定"||$keyword=="手机号"||$keyword=="手机号码绑定"||$keyword=="关联"){          
                $msgType = "text";
                $contentStr = "<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth_3.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">微信绑定</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="二维码"||$keyword=="app二维码"){
                $msgType = "news";
                $title="";
                $Description="中集冷云温湿度监控app二维码";
                $PicUrl="http://www.ccsc58.cc/weixinnew/img/Ewm_android.jpg";
                $Url="http://fusion.qq.com/cgi-bin/qzapps/unified_jump?appid=42375908&isTimeline=false&actionFlag=0&params=pname%3Dcom.ccsc.coldcloud%26versioncode%3D1%26channelid%3D%26actionflag%3D0&from=singlemessage&isappinstalled=1";
                $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,$title,$Description,$PicUrl,$Url);
                echo $resultStr;
            }else if($keyword=="网址"||$keyword=="官网"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.cccc58.com\">中集冷云（北京）供应链管理有限公司</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="我要抽奖"){
                $msgType = "text";
                $contentStr = "	/:8-)<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_Choujiang.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">参与抽奖</a>\n备注：请本人如实填写个人信息成功参与抽奖，代抽一律作废处理，感谢您的参与与配合!本次活动最终解释权归中集冷云所有";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="游戏"){
                $msgType = "text";
                $contentStr = "	/:8-)<a href=\"https://hd.faisco.cn/15084413/8-OFLzYSb5eN1Upv-D1mtg/load.html?style=16\">成功参与游戏</a>\n备注：请本人如实填写个人信息成功，代抽一律作废处理，感谢您的参与与配合!本次活动最终解释权归中集冷云所有";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="评价"){
                $msgType = "text";
                $contentStr = "您好，请您留下<a href=\"http://www.ccsc58.cc/IceKnight/evaluate/index.html\"> 宝贵意见</a>，我们将为您提供更优质冷链运输服务/:rose/:rose";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="RFID"||$keyword=="rfid"||$keyword=="Rfid"){
                $msgType = "text";
                $contentStr = "<a href=\"http://jd.ccsc58.cc/index_RFID.php?t=RFID_20170830\">RFID</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="下载"||$keyword=="app"||$keyword=="APP"||$keyword=="App"||$keyword=="安卓"||$keyword=="ios"||$keyword=="IOS"||$keyword=="应用"||$keyword=="苹果"){
                $msgType = "text";
                $contentStr = "<a href=\"http://fusion.qq.com/cgi-bin/qzapps/unified_jump?appid=42375908&isTimeline=false&actionFlag=0&params=pname%3Dcom.ccsc.coldcloud%26versioncode%3D1%26channelid%3D%26actionflag%3D0&from=singlemessage&isappinstalled=1\">中集冷云(安卓)</a>\n\n<a href=\"https://itunes.apple.com/us/app/zhong-ji-leng-yun-wen-shi/id1173609882?mt=8\">中集冷云(苹果)</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="客服"){
                $msgType = "text";
                $contentStr = "客服电话:400-6507-168";
                //$contentStr = "客服电话:400-6507-168"."\nOpenID：".$fromUsername ."\n中集冷云";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="?"||$keyword=="？"||$keyword=="时间"||$keyword=="当前时间"){
            	$msgType = "text";
                $contentStr = date("Y-m-d H:i:s",time());
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="绑定TMS"||$keyword=="绑定tms"){
            	$msgType = "text";
                 $contentStr = "<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauthnewTms.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">手机号绑定操作</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="科兴"||$keyword=="科兴PDF"||$keyword=="科兴报告"||$keyword=="科兴运单"){
            	$msgType = "text";
                 $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/select_PDF.php\">运单温度查询</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if($keyword=="报警"||$keyword=="异常"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/html/warning_rukou.html\">设备报警列表</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if(is_numeric($keyword)&&strlen($keyword)>=5&&strlen($keyword)<=8){
                $msgType = "text";
                //$contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/details_rukou.html?num_m=".$keyword."\">".$keyword."</a>";
                $contentStr = "<a href=\"http://www.ccsc58.com/index_data_for_weinxin_2.php?id=".$keyword."\">".$keyword."</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if(is_numeric($keyword)&&strlen($keyword)==12){
            	$result=receiveYDinfo($postObj);
//              $msgType = "text";
//              $contentStr = "<a href=\"http://www.cccc58.com\">运单单号:".$keyword."</a>";
//              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//              echo $resultStr;
            }
            else if($keyword=="我要红包"){
            	$result=getHongbao($postObj);
            }else if($keyword=="订单"||$keyword=="我的订单"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/html/dingdan_rukou.html\">我的订单</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if($keyword=="运单"||$keyword=="运单查询"||$keyword=="单号查询"||$keyword=="单号"){
                $msgType = "text";
                $contentStr = "<a href=\"http://www.ccsc58.cc/weixinnew/ITMS/logistics/logistics.php/\">运单详情</a>";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
            else if(strstr($keyword, "YD")){
                    if($keyword=="YD"){             
                    $msgType = "text";
                    $contentStr = "请输入YD+运单号\n如YD000000001234";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    }else if(strstr($keyword, "YD")){
                        if($keyword=="YD"){             
                            $msgType = "text";
                            $contentStr = "请输入YD+运单号\n如YD000000001234";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr;
                            }else{
                                $phone =str_replace('YD', '', $keyword);
                                if(is_numeric($phone)&&strlen($phone)==12){
                                    $result=receiveYDText($postObj);
                                }
                            }
                    
                    }
            }

            else if($keyword=="抽奖"||$keyword=="奖"||$keyword=="抽"||$keyword=="转盘抽奖"||$keyword=="choujiang"){
                $msgType = "text";             
                $contentStr = "	/:8-)<a href=\"https://hd.faisco.cn/15084413/8-OFLzYSb5c2nuX0bs7I9w/load.html?style=0\">参与抽奖</a>\n备注：请本人如实填写个人信息成功参与抽奖，代抽一律作废处理，感谢您的参与与配合!本次活动最终解释权归中集冷云所有";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                $sql="UPDATE tb_weixin_lengyunuser SET effective = '1' WHERE openid='$fromUsername'";
                $link=connect_mysql();
			    mysqli_query($link,$sql);
	            mysqli_close($link);
            }else if(strstr($keyword, "天气")){
	             	if($keyword=="天气"){
	             	$msgType = "text";
	                $contentStr = "请输入城市+天气\n如北京天气";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	             	}else{
	             		$result=receiveText($postObj);
	             	}	            	
	        }else if(strstr($keyword, "BD")){
	            if($keyword=="BD"){	           	
	             	$msgType = "text";
	                $contentStr = "请输入BD+手机号\n如BD188 1111 0000";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	            }else{
	             	$phone = str_replace('BD', '', $keyword);
	             	if(is_numeric($phone)&&strlen($phone)==11){
	             		$result=receiveBDText($postObj);
	             	}else if (is_numeric($phone)&&strlen($phone)<=11){
	             	$msgType = "text";
	                $contentStr = "手机号输入不正确 位输入位数不够长";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	             	}else if (is_numeric($phone)&&strlen($phone)>=11){
	             	$msgType = "text";
	                $contentStr = "手机号输入不正确 位输入总位数过长";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	             	}else{
	             	$msgType = "text";
	                $contentStr = "手机号输入不正确";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	             	}		
	            }
	            	
	        }else if(strstr($keyword, "+")){
                if ($keyword=="+") {
                    $msgType = "text";
                    $contentStr = "请输入设备号+运单号\n如100579+17002193201711070931098191";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }else{
                    $keyword=trim($keyword);
                    $shebeihao=trim(cut_str($keyword,'+',0));
                    $yundanhao=trim(cut_str($keyword,'+',1));

                if (is_numeric($shebeihao)&&strlen($shebeihao)==6&&is_numeric($yundanhao)&&strlen($yundanhao)==26){
                        $result=shebeihao_pdf($postObj,$shebeihao,$yundanhao);
                        
                    }else if (is_numeric($shebeihao)&&strlen($shebeihao)!=6) {
                        $msgType = "text";
                        $contentStr = "设备号输入不正确";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }else if (is_numeric($yundanhao)&&strlen($yundanhao)!=26) {
                        $msgType = "text";
                        $contentStr = "运单号输入不正确";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }
                    
                }
            }else if($keyword=="JdbJ"||$keyword=="京东报警"){
	                $msgType = "text";
	                $contentStr = "<a href=\"http://www.ccsc58.com/warning/\">京东报警</a>";
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
	        }else{
                $msgType = "text";
                $contentStr = "您好！您可以回复以下内容：\n\n☞【下载】:<a href=\"http://www.ccsc58.cc/weixinnew/bangding/download.html\">下载APP</a>\n\n☞【下单】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_wechatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">我要下单</a>\n\n☞【说明书】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">说明书</a>\n\n☞【设备号】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">设备详情</a>\n\n☞【意见/反馈】:<a href=\"http://www.cccc58.com\">意见反馈</a>\n\n☞【报警/异常】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">报警设备</a>\n\n☞【绑定/设备】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">绑定账号</a>\n\n☞【订单/我的订单】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">我的订单</a>\n\n客服电话:400-6507-168";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            };
        }else{
            echo "Input something...";
        };
    } 
    echo $result;
};
$link='';
function connect_mysql(){
	$link = mysqli_connect("www.ccsc58.cc","test01","Pzg790915");
	mysqli_set_charset($link,'utf8');
		if (!$link)
		  {
		 // die('Could not connect: ' . mysql_error());
		   echo '连接失败';
		   die;
		  }
		  mysqli_select_db($link,"wechat");
		  return $link;
		 }

function receiveEvent($object)
{
    $content = "";
    switch($object->Event)
    {
        case "subscribe":
            $content = "您好，欢迎关注中集冷云公众平台！/微笑\n\n请点击下方“中集冷云”按钮进行账号绑定\n请点击“关于我们”按钮下载相关APP\n\n您可以回复以下内容：\n\n☞【下载】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">下载APP</a>\n\n☞【绑定】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth_3.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">微信绑定</a>\n\n☞【说明书】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">说明书</a>\n\n☞【设备号】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">设备详情</a>\n\n☞【意见/反馈】:<a href=\"http://www.cccc58.com\">意见反馈</a>\n\n☞【报警/异常】:<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\">报警设备</a>";
            $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".getAccessToken()."&openid=".$object->FromUserName."&lang=zh_CN";
			$userInfo=json_decode(https_request($url),true);
			var_dump($userInfo);
			$openid = $userInfo['openid'];
			$nickname = $userInfo['nickname'];
			$sex = $userInfo['sex']=='1'?"男":"女";
			$country = $userInfo['country'];
			$province = $userInfo['province'];
			$city = $userInfo['city'];
			$headimgurl = $userInfo['headimgurl'];
			$subscribe = $userInfo['subscribe'];
			$subscribe_time = $userInfo['subscribe_time'];
			$link = connect_mysql();
			$sql="select * from tb_weixin_lengyunuser where openid='".$object->FromUserName."'";
			$res=mysqli_query($link,$sql);
			$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
			if($row){
				$sql_Update="UPDATE tb_weixin_lengyunuser SET nickname='$nickname',sex='$sex',country='$country',province='$province',city='$city',headimgurl='$headimgurl',subscribe='$subscribe',subscribe_time='$subscribe_time' WHERE openid='$object->FromUserName'";
				file_put_contents('./sql.txt',date("Y-m-d H:i:s").':'.$sql_Update.PHP_EOL,FILE_APPEND);
				print_r($sql_Update);
				mysqli_query($link,$sql_Update);
		        mysqli_close($link);
			}
			else{
				$sql_Insert="INSERT INTO tb_weixin_lengyunuser (openid,nickname,sex,country,province,city,headimgurl,subscribe,subscribe_time) values('$openid','$nickname','$sex','$country','$province','$city','$headimgurl','$subscribe','$subscribe_time')";
		        print_r($sql_Insert);
		        file_put_contents('./sql.txt',date("Y-m-d H:i:s").':'.$sql_Insert.PHP_EOL,FILE_APPEND);
		        mysqli_query($link,$sql_Insert);
		        mysqli_close($link);
			}
            break;
        case "unsubscribe":
            $content = "取消成功,欢迎下次关注！";
//          $sql="DELETE FROM tb_weixin_lengyunuser WHERE openid='$object->FromUserName'";
            $sql="UPDATE tb_weixin_lengyunuser SET subscribe='0',subscribe_time='' WHERE openid='".$object->FromUserName."'";
            file_put_contents('./sql.txt',date("Y-m-d H:i:s").':'.$sql.PHP_EOL,FILE_APPEND);
            var_dump($sql);
            $link = connect_mysql();
			mysqli_query($link,$sql);
            mysqli_close($link);
            break;
		case "CLICK":
		    switch ($object->EventKey)
		    {
		        case "shuomingshu":
		             $content = array(array("title" =>"温湿度监控智能终端使用说明书（20TP与20DP）", 
		    		 "Description" =>"温湿度监控智能终端使用说明书（20TP与20DP）", 
		             "PicUrl" =>"http://www.ccsc58.cc/weixinnew/img/shumingshu_tuisong.png", 
		             "Url" =>"http://mp.weixin.qq.com/s/a-7N3QysT4Bmn3eNGPldOw"));
		             break;
		        case "tel":
		            $content = "客服电话：400-6507-168";
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
			        $item_str .= sprintf($itemTpl, $item['title'], $item['Description'], $item['PicUrl'], $item['Url']);
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
        $url="http://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        //var_dump($result);
    }
}

//{{first.DATA}}
//设备号：{{keyword1.DATA}}
//告警时间：{{keyword2.DATA}}
//告警级别：{{keyword3.DATA}}
//告警模块：{{keyword4.DATA}}
//事件描述：{{keyword5.DATA}}
//{{remark.DATA}}
function shebei_pdf($first,$keyword1,$remark,$openId,$app_key)
{
    //$keyword5='\n'.$keyword5.'\n';
    $first=$first.'\n\n设备编号：'.$keyword1;
    $remark='\n'.$remark;
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>"$openId",
            'template_id'=>"SiyIucG59C-fdnAR5n6WhszwXjZTsPjpZOqFuKzo--w",
            'url'=>"http://www.ccsc58.cc/weixinnew/html/shebei_pdf.html?num_m=".$keyword1."&",
            'topcolor'=>"#7B68EE",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#000",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#ff0000",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#000"),
            )
        );
        $url="http://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        //var_dump($result);
    }
}

//微信推送报警函数
//{{first.DATA}}
//起始时间：{{keyword1.DATA}}
//截止时间：{{keyword2.DATA}}
//监控结果：{{keyword3.DATA}}
//{{remark.DATA}}
function jiankong($first,$keyword1,$keyword2,$keyword3,$remark,$openId,$app_key)
{
    //$keyword5='\n'.$keyword5.'\n';
//  $first=$first.'\n\n设备编号：'.$keyword1;
//  $keyword2=$keyword2.'\n详情描述：'.$keyword3;oTarnv1Yl1Mk81Qb2Gm9G3gyar90
    $remark='\n'.$remark;
    
    if($app_key== "261AFF68C0E9F076420D083D66222824"){
        $template=array(
            'touser'=>$openId,
            'template_id'=>"gZHz3q-PQrZOhRd-TU_6QvmKDqfrdrvOtTi_74H-Zk4",
            'url'=>"http://www.ccsc58.com/warning",
            'topcolor'=>"#7B68EE",
            'data'=>array('first'=>array('value'=>urlencode($first),'color'=>"#7B68EE",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#FF0000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#C4C400",),
                'keyword3'=>array('value'=>urlencode($keyword3),'color'=>"#0000ff",),
                'remark'=>array('value'=>urlencode($remark),'color'=>"#008000"),
            )
        );
        $url="http://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
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
            'data'=>array('first'=>array('value'=>urlencode('【中集冷云】你好，欢迎登录恒瑞医药平台'),'color'=>"#743A3A",),
                'keyword1'=>array('value'=>urlencode($keyword1),'color'=>"#FF0000",),
                'keyword2'=>array('value'=>urlencode($keyword2),'color'=>"#0000FF",),
                'remark'=>array('value'=>urlencode('请于30分钟内正确输入 ，若非本人操作，请忽略！'),'color'=>"#008000"),
            )
        );
        $url="http://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        return $result;
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
        $url="http://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getAccessToken();
        $result=https_request($url,urldecode(json_encode($template)));
        header('location:../weixin/image_test.html');
    }
}
//function SendWeiXin33($zhanghao,$shebeibianhao,$baojingshijian,$baojingjibie,$baojingmokuai,$baojingleixing,$openID,$gongsimingcheng,$shebeibianhao_number){
//	 $url = 'http://www.ccsc58.cc/weixinnew/last.php';   //服务接口地址
//	 $post_data['zhanghao']=$zhanghao;   //账号
//	 $post_data['shebeibianhao']=$shebeibianhao;   //设备编号
//	 $post_data['baojingshijian']=$baojingshijian;   //报警时间
//	 $post_data['baojingjibie']=$baojingjibie;   //报警级别
//	 $post_data['baojingmokuai']=$baojingmokuai;   //报警模块
//	 $post_data['baojingleixing']=$baojingleixing;   //报警类型
//	 $post_data['gongsimingcheng']=$gongsimingcheng;   //公司名称
//	 $post_data['openID']=$openID;   //openID
//	 $post_data['app_key'] = '261AFF68C0E9F076420D083D66222824'; //与京东不同，对京东发的编码进行了个别数字修改，以防止泄露
//	 $post_data['shebeibianhao_number']=$shebeibianhao_number;   //shebeibianhao_number单独的设备编号！	 	 
//	 
//	 $o = "";
//      foreach ( $post_data as $k => $v ) 
//      { 
//          $o.= "$k=" . urlencode( $v ). "&" ;
//      }
//      $post_data = substr($o,0,-1);
//      $res = request_post($url, $post_data);       
//      return $res;
//  }

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
	}elseif(count($arr)==8){
		 Pay_money($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7]);
	}else if(count($arr)==7){
		jiankong($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6]);
	}else if(count($arr)==6){
		 xiafa_yzm($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
	}else if(count($arr)==5){
         shebei_pdf($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
    }else{
		 var_dump("null");
	};


//用户关注后向客户推送；
/*function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(get_php_file("access_token.php"));
    if ($data->expire_time < time()) {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx82dbac04fa8fd8ef&secret=98ecda31265ffc327d59adc969089650";
        $res = json_decode(https_request($url));
        $access_token = $res->access_token;
        if ($access_token) {
            $data->expire_time = time() + 7000;
            $data->access_token = $access_token;
            set_php_file("access_token.php", json_encode($data));
        }
    } else {
        $access_token = $data->access_token;
    }
    return $access_token;
}*/

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
    
    //微信红包
    
     function getHongbao($object)
    {
        $keyword = trim($object->Content);
		$hongbao = trim($keyword);
		$openId=$object->FromUserName;
		include("hongbao.php");			
		$content = Hongbao($hongbao,$openId);
		
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
    
     function receiveYDinfo($object)
    {
        $keyword = trim($object->Content);
            $danhao = trim($keyword);
            $openId=$object->FromUserName; 
            include("YDinfo.php");   
            $content = getInfo($danhao,$openId);
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