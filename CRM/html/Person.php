<div style="display: none;">
<?php
	require_once "../../jssdk.php";
	$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
	$signPackage = $jssdk->GetSignPackage();
?>
</div>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>首页</title>
		<link rel="stylesheet" href="../css/index.css" type="text/css">
		<link rel="stylesheet" href="../css/Person.css" type="text/css">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	</head>
	<style>

	</style>

	<body>
		<div class="content">
			<div class="content_body">
				<div class="title">
					<a href="../login.html" class="return"><img src="../img/return.png" class="return_img" alt="返回上一页" /></a>
					<span>冷云CRM</span>
				</div>
				<div class="bg">

				</div>
				<div class="block_center">
					<p><img src="../img/touxiang.jpg" alt="头像" /> </p>
					<p class="username">李二二</p>
					<p><span>职位：</span><span class="job">销售经理</span></p>
				</div>
				<div class="caozuo">
					<p>外部合作</p>
					<div class="first_line">
						<img src="../img/historylist.png" />
						<span>拜访记录</span>
						<img src="../img/click_right.png" />
					</div>
				</div>
			</div>
		</div>
		<script src="../js/jquery-1.11.0.js" type="text/javascript"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<!--调用JSSDK-->
		<script>
			//JSSDK配置参数 通过config接口注入权限验证配置
			wx.config({
				debug: false,
				appId: '<?php echo $signPackage["appId"];?>',
				timestamp: '<?php echo $signPackage["timestamp"];?>',
				nonceStr: '<?php echo $signPackage["nonceStr"];?>',
				signature: '<?php echo $signPackage["signature"];?>',
				jsApiList: [
					'getLocation'
				]
			});

		</script>
		<script>
			$(document).ready(function() {
				if(JSON.parse(localStorage.getItem("userInfo")) == '' || JSON.parse(localStorage.getItem("userInfo")) == null) {
					location.href = "../login.html";
				} else {
					var _userinfo = JSON.parse(localStorage.getItem("userInfo"));
					console.log(_userinfo)
					$(".username").text(_userinfo.TrueName);
					$(".job").text(_userinfo.Operate);
				}

				$('.caozuo .first_line').on("click", function() {
						wx.getLocation({
							success: function(res) {
								var latitude = res.latitude; //纬度
								var longitude = res.longitude; //经度
								var locationStr = "latitude：" + latitude + "，" + "longitude：" + longitude;
								var locationStrdan = latitude + "," + longitude;
								$.ajax({
									type: "post",
									dataType: "jsonp",
									url: "http://api.map.baidu.com/geocoder/v2/?ak=XP1alssWsEscC3NfYAhj6YfqKvgQgUXF&output=json&pois=0&coordtype=bd09ll",
									data: {
										location: locationStrdan,
									},
									success: function(data) {
										console.log(data.result.formatted_address)
										if(data.result.formatted_address == "" || data.status != 0) {
											alert("未发现位置信息");
										} else {
										    localStorage.getItem('formatted_address',data.result.formatted_address);
											location.href = "VisitRecord.html";
										}
									},
									error: function() {
										$(".visit_address").addClass("hidden");
										alert("网络错误，请重新进入");
									}
								})

							},
							cancel: function(res) {
								alert('用户拒绝授权获取地理位置');
							},
							fail: function(res) {
								console.log(JSON.stringify(res));
							}
						});

					//location.href = "VisitRecord.html";
				})
			})
		</script>
	</body>

</html>