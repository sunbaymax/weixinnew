<?php
require_once('weixin_class.php');
$weixin = new class_weixin();

if (!isset($_GET["code"])){
  $redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
  Header("Location: $jumpurl");
}else{
  $access_token_oauth2 = $weixin->oauth2_access_token($_GET["code"]);
  $userinfo = $weixin->oauth2_get_user_info($access_token_oauth2['access_token'], $access_token_oauth2['openid']); 
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>个人信息</title>
        <link rel="stylesheet" href="css/weui.min.css">
        <link rel="stylesheet" href="css/example.css">
    </head>
   
    
    
    <body ontouchstart="">
        <div class="container js_container">
            <div class="page cell">
                <div class="hd">
                    <h1 class="page_title" style="color: #000000;">我的信息</h1>
                    <p class="page_desc" style="font-size: 14px;color:#0F0F0F;font-weight: bold;"><a href="../bangding/bangding.html?openId=<?php echo $userinfo['openid'];?>" style="text-decoration:underline">绑定手机</a></p>
                </div>
                <div class="bd">
                    <div class="weui_cells_title">个人信息</div>
                    <div class="weui_cells">
                        <!--<div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>OpenID</p>
                            </div>
                            <div class="weui_cell_ft"><?php echo $userinfo["openid"];?></div>
                        </div>-->
                        <input type="hidden" id="openid" value="<?php echo $userinfo["openid"];?>" />
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>昵称</p>
                            </div>
                            <div class="weui_cell_ft"><?php echo $userinfo["nickname"];?></div>
                        </div>
                        <div class="weui_cell ">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>头像</p>
                            </div>
                            <div class="weui_cell_ft"><img src="<?php echo str_replace("/0","/46",$userinfo["headimgurl"]);?>" style="width: 3rem;height: 3rem;"></div>
                        </div>
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>性别</p>
                            </div>
                            <div class="weui_cell_ft"><?php echo (($userinfo["sex"] == 0)?"未知":(($userinfo["sex"] == 1)?"男":"女"));?></div>
                        </div>
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>地区</p>
                            </div>
                            <div class="weui_cell_ft"><?php echo $userinfo["country"];?> <?php echo $userinfo["province"];?> <?php echo $userinfo["city"];?></div>
                        </div>
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>语言</p>
                            </div>
                            <div class="weui_cell_ft"><?php echo $userinfo["language"];?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="js/jquery-2.1.4.js"></script>
         <script>
        $(document).ready(function() {
		        	var _openid = $("#openid").val();
		          	$.ajax({
								type: "post",
								url: "http://www.ccsc58.cc/weixinnew/Wechat/query_tel.php",
								dataType:"json",
								data: {
									openid: _openid
								},
								success: function(data) {
									console.log(data.mobile);
									if(data.mobile){
										$('.page_desc').html(data.mobile)
									}else{
										console.log("没值");
									}
								},
								error: function() {
									alert("请求失败");
								}
							});
						});
				</script>
    </body>
</html>