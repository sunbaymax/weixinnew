<?php	
header("Content-type: text/html; charset=utf-8");
$url = "http://www.zjcoldcloud.com/weixin/get_token_zjly.php";
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
			"name": "🌀市场资讯",
			"sub_button": [
		        {
					"type": "view",
					"name": "🍭 活动抽奖",
					"url": "https://hd.faisco.cn/15084413/8-OFLzYSb5dBIDtNERAyOw/load.html?style=0",
					"sub_button": []
				}, {
					"type": "view",
					"name": "📥 行业资讯",
					"url": "http://mp.weixin.qq.com/mp/homepage?__biz=MzI4MDk2OTA4Mg==&hid=1&sn=d19fefbee62b7c81415945dc2ab26b8f#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🎯 DIA中集印象",
					"url": "https://gallery.vphotos.cn/vphotosgallery/index.html?vphotowechatid=8397422F182B3C5D615ECF75F9C420B6",
					"sub_button": []
				}, {
					"type": "view",
					"name": "❄智能冷链前线",
					"url": "http://mp.weixin.qq.com/mp/homepage?__biz=MzIxNzU1MzIyNA==&hid=1&sn=dcf2df0452631e6d69908350d4f53ae6#wechat_redirect",
					"sub_button": []
				}
			]
		}, {
			"name": "🚑产品中心",
			"sub_button": [
			    {
					"type": "view",
					"name": "✏预约下单",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_newwxchatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, 
		
				{
					"type": "view",
					"name": "📝客服下单",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_wechatorder.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				},
				{
					"type": "view",
					"name": "🏢公司首页",
					"url": "http://www.cccc58.com/",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🌀温控平台",
					"url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect",
					"sub_button": []
				}, {
					"type": "view",
					"name": "📱 APP下载",
					"url": "http://www.ccsc58.cc/weixinnew/bangding/download.html",
					"sub_button": []
				}
			]
		}, {
			"name": "🎓关于我们",
			"sub_button": [
				{
					"type": "view",
					"name": "📹企业宣传片",
					"url": "https://v.qq.com/x/page/c0765vakuki.html?pcsharecode=igLt5dxn&sf=uri",
					"sub_button": []
				}, {
					"type": "view",
					"name": "🚇单号查询",
					"url": "http://www.ccsc58.cc/weixinnew/Orderquery/index.php",
					"sub_button": []
				}, {
					"type": "click",
					"name": "☎ 联系客服",
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