<div style="display:none">
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
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>中集冷云（北京）冷链科技有限公司</title>
		<link rel="stylesheet" type="text/css" href="../css/index.css"/>
		<link rel="stylesheet" type="text/css" href="../css/zhuanDan.css"/>
	</head>
	<body>
		<div class="header">
			<img class="back_list" src="../img/back.png" />
			<span>
				<a href="../index.html">首页</a>
			</span>
			转单
		</div>
		<div class="zhuanDan_tong_content zhuanDan_tong_xiangcontent">
			<p>运单号码：<input type="text" placeholder="请输入"/></p>
			<p>车牌号码：<input type="text" placeholder="请输入"/></p>
			<p>司机：<input type="text" placeholder="请输入"/></p>
			<div class="zhuanDan">
				确认转单
			</div>
			<img src="../img/saoyisao.png"/>
		</div>
		<script src="../js/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/zhuanDan.js" type="text/javascript" charset="utf-8"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: '<?php echo $signPackage["timestamp"];?>',
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'chooseImage',
				'scanQRCode'
			]
		});
		$(".zhuanDan_tong_xiangcontent img").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$(".zhuanDan_tong_xiangcontent p:nth-of-type(1) input").val(result.replace("CODE_128,", ""));
				}
			});
		});
		</script>
	</body>
</html>
