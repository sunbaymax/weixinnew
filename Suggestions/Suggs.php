<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<title>意见反馈</title>
		<link type="text/css" rel="stylesheet" href="css/body.css" />
		<link type="text/css" rel="stylesheet" href="css/sugg.css" />
	</head>
	<style>
		.centent{
			background: #FFFFFF;
		}
	</style>
	<body>
		<div style="display:none">
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
	       </div>
		<!--<div class="title">
			<a href="#" ><img src="img/back.png" alt="返回" /></a>
			<h3 class="title_h">意见反馈</h3>
		</div>-->
		<div class="centent">
			<img  class="touxiangurl" src=""/>
			<img  class="touxiangur" style="display: none;" src="<?php echo str_replace("/0","/46",$userinfo["headimgurl"]);?>"/>
			<input type="hidden" id="openid" value="<?php echo $userinfo["openid"];?>" />
			<span>昵称</span>
			<input type="text" style="display: none;" class="wechat_name_hiden" name="wechatname" value="<?php echo $userinfo["nickname"];?>"/>
			<input type="text"  class="wechat_name" name="wechatname" value=""/>
		</div>
		<div class="centent_p">
			<p class="ti_p">请在下方输入联系人信息</p>
		</div>
		<div class="data_center">
			<form>
				<p class="form_centect">
					<img class="t1" src="img/lianxiren.png" />
					<input class="input_data" type="text" placeholder="请输入联系人" id="lxr" value="">
					<span class="lianxiren_info"></span>	 
				</p>
				<p class="form_centect">
					<img class="t1" src="img/danwei.png" />
					<input class="input_data" type="text" id="company" placeholder="请输入联系人所属单位"/>
					 <span class="company_info"></span>
			    </p>
				<p class="form_centect">
					<img class="t1" src="img/tel.png" />
					<input class="input_data" id="telphone" type="text" placeholder="请输入联系人电话号码"  />
					<span class="tel_info">
				</p>
			</form>
			
		</div>
		 <br clear="both" />
		<div class="btn next"><button id="btn_next" onclick="tiaozhuan1()">下一步</button></div>
		<script src="../js/jquery-1.11.0.js"></script>
		
		<script>
			$(document).ready(function () {
			var _touxiang = $(".touxiangur").attr('src');
			var _nicheng= $(".wechat_name_hiden").val();
			var myopenid = $("#openid").val();
			window.localStorage.setItem("touxiang",_touxiang);
		    window.localStorage.setItem("nicheng",_nicheng);
		    window.localStorage.setItem("openid",myopenid);
		    var _touxiangS = window.localStorage.getItem("touxiang");
	        var _nichengS = window.localStorage.getItem("nicheng");
		    $(".wechat_name").val(_nichengS);
		    $(".touxiangurl").attr("src",_touxiangS);
		    
		    }); 
			
			 $("#lxr").blur(function() {
		        var name = $(this).val().replace(/^\s*|\s*$/g, "");
		        if (name == "") {
		            $(".lianxiren_info").html("<span style='color: red;'>请输入用户姓名</span>");
		            return false;
		        } else if (!/^[\u4e00-\u9fa5]+$/.test(name)) {
		            $(".lianxiren_info").html("<span>请输入汉字！</span>");
		            return false;
		        } 
		        else 
		        {
		            $(".lianxiren_info").html("<span style='color:#3739BC'>√</span>");
		        }
		    });
     
		    $("#company").blur(function() {
		        var number_name = $(this).val().replace(/^\s*|\s*$/g, "");
		        if (number_name == "") {
		            $(".company_info").html("<span style='color: red;'>请输入公司名称！</span>");
		            return false;
		        } 
//		        else if (!/^[\w\.\/]+$/.test(number_name)) {
//		            $(".company_info").html("<span>请输入字母、数字及下划线！(可包括./)</span>");
//		        }
		         else {
		            $(".company_info").html("<span style='color:#3739BC'>√</span>");
		        }
		    });
	
		 $("#telphone").blur(function() {
		        var tel = $(this).val().replace(/^\s*|\s*$/g, "");
		        if (tel == "") {
		            $(".tel_info").html("<span style='color: red;'>请输入手机号！</span>");
		            return false;
		        } else if (tel.length!=11) {
		            $(".tel_info").html("<span>请输入准确的手机号</span>");return false;
		        } else {
		            $(".tel_info").html("<span style='color:#3739BC'>√</span>");
		        }
		    });
		
			$('#btn_next').on("click",function(){
				var _lianxiren= $("#lxr").val();
				var _company= $("#company").val();
				var _telphone= $("#telphone").val();
				if(_lianxiren == "" || _company == "" || _telphone==""){
					alert("请输入完整信息");
					return false;
				}else{
					window.localStorage.setItem("company", _company);
					window.localStorage.setItem("telphone", _telphone);
					window.localStorage.setItem("lianxiren", _lianxiren);
					window.location.href="Suggs_products.html";
				}
			});
		</script>
	</body>
	
</html>
