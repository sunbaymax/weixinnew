<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>微信下单平台</title>
		<link rel="stylesheet" href="css/index.css" type="text/css">
		<link rel="stylesheet" href="css/toastr.min.css">
		<link rel="stylesheet" href="css/iconfont/iconfont.css" />
	</head>

	<body>

          <div style="display:none">
			<?php
			require_once('../Suggestions/weixin_class.php');
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
	       
	       
		<nav>
			<div>
				< 我的订单</div>
					<div>下单</div>
					<div></div>
					<div></div>
		</nav>
		<div>
			<img src="../img/tms_order.png" style="width: 100vw;height: auto;" />
		</div>
		<div style="display: none;">
			<img  class="touxiangur" id="touxiang" style="" src="<?php echo str_replace("/0","/46",$userinfo["headimgurl"]);?>"/>
			<input type="text" id="openid"  value="<?php echo $userinfo["openid"];?>" />
			<input type="text" style="" class="wechat_name_hiden" name="wechatname"  id="wechatname" value="<?php echo $userinfo["nickname"];?>"/> 
		</div>
		<!--内容部分-->
		<main>

			<ul class="contant">
				<li>
					<span class="icon iconfont icon-zhanghao">&nbsp;客户账号</span>
					<div style="border: none;">
						<input type="text" placeholder="请输入客户账号" class="accept">
					</div>
				</li>
			</ul>
			<ul class="contant">
				<li>
					<span class="icon iconfont icon-shoujihao">&nbsp;手机号码</span>
					<div>
						<input type="text" placeholder="请输入手机号码" class="phone">
					</div>
				</li>
				<li>
					<span class="icon iconfont icon-yanzhengma">&nbsp;动态验证</span>
					<div style="border: none;">
						<input type="text" placeholder="请输入验证码" class="lkj">
						<span class="yanzheng" id="fasas">发送</span>
					</div>
				</li>
			</ul>
			<p style="color: cornflowerblue;text-align: right;margin: 0 0.15rem 0 0;font-size: 14px;">
				<span class="zhuce" style="color: #757575;">没有客户账号？</span><span class="zhuce" id="here">点击这里</span>
			</p>
		</main>
		<div style="position: fixed;right: 10px;bottom: 20px;">
			<img src="img/clear.png" id="clearStorage" style="width: 20px;height: 20px;" alt="清除缓存" />
		</div>
		<!--按钮  下一步-->
		<footer>
			<span>登录</span>
		</footer>

	</body>
	<script src="js/rem.js" type="text/javascript"></script>
	<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
	<script src="js/toastr.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function() {
			
			window.localStorage.clear();
			let check=true;
			$("#clearStorage").on("click",function(){
				
				if(check){
					clearSto()
					check=false;
					console.log(check);
				}else{
					check=false;
					setTimeout(function() {
						check = true
					}, 4000)
						
				}
				
				function clearSto(){
					window.localStorage.clear();
					toastr.success("清除成功");
				}	
			})
			
			function UrlSearch() 
			{
			var name,value; 
			var str=location.href; //取得整个地址栏
			var num=str.indexOf("?") 
			str=str.substr(num+1); //取得所有参数 stringvar.substr(start [, length ]
			 
			var arr=str.split("&"); //各个参数放到数组里
			for(var i=0;i < arr.length;i++){ 
			num=arr[i].indexOf("="); 
			if(num>0){ 
			name=arr[i].substring(0,num);
			value=arr[i].substr(num+1);
			this[name]=value;
			} 
			} 
			} 
			var Request=new UrlSearch(); //实例化
			//alert(Request.openid);
			var _openId=Request.openid;
			var _wechatname= $("#wechatname").val();
			window.localStorage.setItem("openid",_openId);
			window.localStorage.setItem("wechatname",_wechatname);
			$("input").focus(function() {
				$(this).css("background-color", "#D6D6FF");
			});
			$("input").blur(function() {
				$(this).css("background-color", "#FFFFFF");
			});
			$("main input, main select").val('');
			toastr.options = {
				timeOut: "3000",
				positionClass: "toast-center-center"
			};
			var reg = /^1[34578]\d{9}$/;
			var isPhone = true;
			$(".lkj").focus(function() {
				if(isPhone) {
					if(!reg.test($(".phone").val())) {
						isPhone = false;
						setTimeout(function() {
							isPhone = true
						}, 3000)
						toastr.error("请输入正确的手机号");
						$(".lkj").focus();
					}
				}
			});
			var boo = true;
			$(".yanzheng").on('click', function() {
				if(boo == false) {
					return
				} else {
					if(!reg.test($(".phone").val())) {
						boo = false;
						setTimeout(function() {
							boo = true
						}, 3000);
						toastr.error("请输入手机号");
					} else {
						if(boo){
							yanz();
						}
						
					}
				}
			});

			function yanz() {
				if(boo == true) {
					var num = 60;
					var id = setInterval(function() {
						boo = false;
						num = num - 1;
						$(".yanzheng").html(num).css("color", "#000000").css("background", "#ccc");
						if(num == 0) {
							$(".yanzheng").html("重新发送").css("color", "#ffffff").css("background", "#009dd9");
							boo = true;
							window.clearInterval(id);
						}
					}, 1000);
					$.ajax({
						url: 'http://www.ccsc58.com/SMS/SMS-telephone.php?telephone=' + $('.phone').val() +
							'&action=call&admin_permit=zjly8888',
						type: 'post',
						dataType: 'JSON',
						success: function(res) {
							console.log(res);
						},
						error: function(err) {
							console.log(err);
						}
					})
				}

			}

			$('.zhuce').on('click', function() {
				window.location.href = "components/zhuce.html"
			})
			let isOrder = true;
			$('footer span').on("click", function() {
				if(isOrder) {
					asdfsdf();
				}

			})
			var asdfsdf = function() {
				if($(".accept").val() == "" || $(".phone").val() == "" || $(".lkj").val() == "") {
					if($(".accept").val() == "") {
						isOrder = false;
						setTimeout(function() {
							isOrder = true
						}, 3000);
						toastr.error("请输入客户账号");
					} else if($(".phone").val() == "") {
						isOrder = false;
						setTimeout(function() {
							isOrder = true
						}, 3000);
						toastr.error("请输入手机号");
					} else if($(".lkj").val() == "") {
						isOrder = false;
						setTimeout(function() {
							isOrder = true
						}, 3000);
						toastr.error("请输入验证码");
					}
				} else {
					$.ajax({
						url: "http://www.ccsc58.com/SMS/SMS-telephone.php?telephone=" + $(".phone").val() +
							"&action=bijiao&admin_permit=zjly8888&yanzhengmas=" + $(".lkj").val(),
						type: "get",
						dataType: "JSON",
						success: function(res) {
							if(res.result == "success") {
								qingqiu();
							} else if(res.result == "fail") {
								toastr.error("请输入正确的验证码");
							}
						}
					})
				}
			}

			function qingqiu() {
				$.ajax({
					url: "http://www.ccsc58.cc/zjlytms/api.php/Order/ajax",
					type: "post",
					data: {
						merber_id: $(".accept").val(),
						state: 1
					},
					dataType: "JSON",
					success: function(res) {
						if(res.status == "0") {
							toastr.error(res.info);
						} else {
							localStorage.setItem('myNum', $(".accept").val());
							localStorage.setItem('phone', $(".phone").val());
							window.location.href = "components/tempature.html";
						}
					},
					error: function(err) {
						console.log(err);
					}
				})
			}
		})
	</script>

</html>