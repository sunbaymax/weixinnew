<div style="display:none">
	<?php
		require_once "../jssdk.php";
		$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
		$signPackage = $jssdk->GetSignPackage();
	?>
</div>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>北京中集智冷科技有限公司</title>
</head>

<body>
	<div class="search_dingdan">
		<img src="../img/saoyisao.png" />
	</div>
	<script src="../js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
	<script type="text/javascript">
		wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: '<?php echo $signPackage["timestamp"];?>',
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'chooseImage',
				'scanQRCode',
				'getLocation',
				'openLocation',
				'startSearchBeacons'
			]
		});
		/*wx.startSearchBeacons({
			ticket:"CMCC",  //摇周边的业务ticket, 系统自动添加在摇出来的页面链接后面
			complete:function(argv){
				document.write(arvg);//开启查找完成后的回调函数
			}
		});*/
		$(".search_dingdan img").on("click", function() {
				wx.scanQRCode({
					needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
					scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
					success: function(res) {
						var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
						wx.getLocation({
							type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
							success: function(res) {
								var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
								var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
								var speed = res.speed; // 速度，以米/每秒计
								var accuracy = res.accuracy; // 位置精度
								alert(JSON.stringify(res)); 
								wx.openLocation({
   									latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
								    longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
								    name: '你好', // 位置名
								    address: '你好', // 地址详情说明
								    scale: 12, // 地图缩放级别,整形值,范围从1~28。默认为最大
								    infoUrl: 'http://www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转
								});
							}
						});
					}
				});				
			})
			/*var _dog="CODE_39,12 3456789";
			console.log(_dog.match(/\,.+/)[0].replace(",",""));*/
	</script>
</body>

</html>