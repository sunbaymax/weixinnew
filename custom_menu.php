<?php	
header("Content-type: text/html; charset=utf-8");
$url = "http://ccsc58.com/crontab/alarmDeal/getTokenLy.php";
$access_token=file_get_contents($url);
define("ACCESS_TOKEN", $access_token);

//创建菜单
function createMenu($data){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".ACCESS_TOKEN);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tmpInfo = curl_exec($ch);
if (curl_errno($ch)) {
  return curl_error($ch);
}

curl_close($ch);
return $tmpInfo;

}

//获取菜单
function getMenu(){
return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".ACCESS_TOKEN);
}

//删除菜单
function deleteMenu(){
return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".ACCESS_TOKEN);
}





$data = '{
	"button": [
		{
			"name": "🔥我要下单",
			"sub_button": [
		         {
					"type": "view",
					"name": "🏨临床",
					"url": "http://www.ccsc58.cc/weixinnew/ZdtqWxorder/login.html",
					"sub_button": []
				},{
					"type": "view",
					"name": "💊药品",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "📦普货",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "💉试剂",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🚑器械",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}
			]
		}, {
			"name": "🔍查询",
			"sub_button": [
			    {
					"type": "view",
					"name": "📝客服下单",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_wechatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, 
		
				{
					"type": "view",
					"name": "🚇单号查询",
					"url": "http://www.ccsc58.cc/weixinnew/Orderquery/index.php",
					"sub_button": []
				},
				{
					"type": "view",
					"name": "🌀温控平台",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				},
				{
					"type": "view",
					"name": "🏦资产管理",
					"url": "http://ams.cccc58.com/wxlogin/login",
					"sub_button": []
				}
			]
		}, {
			"name": "☁中集冷云",
			"sub_button": [
				{
					"type": "view",
					"name": "🏢公司官网",
					"url": "http://www.cccc58.com",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🎯企业宣传",
					"url": "https://mp.weixin.qq.com/mp/homepage?__biz=MzIxOTYzMDY2OQ==&hid=1&sn=69bbaa00ff62d1ab98e79442506850c4",
					"sub_button": []
				}, {
					"type": "click",
					"name": "☎联系客服",
					"key": "tel",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🔚消息推送",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth_3.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🏁意见反馈",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_Suggs.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}
			]
		}
	]
}';




echo createMenu($data);//http://www.ccsc58.cc/weixinnew/custom_menu.php
//echo getMenu();
//echo deleteMenu();