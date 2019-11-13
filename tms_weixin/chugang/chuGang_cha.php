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
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/chuGang.css" />
</head>

<body>
	<div class="header">
		<img class="back_list" src="../img/back.png" />
		<span>
			<a href="chugang.html">出港</a>
		</span> 
		出港查询
	</div>
	<form class="chuGangCha_content">
		<input type="text" placeholder="请输入或扫描运单号" />
		<img src="../img/saoyisao.png" />
		<div>查询</div>
	</form>
	<script src="../js/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js" charset="utf-8"></script>
	<script src="../js/chuGang.js" type="text/javascript" charset="utf-8"></script>
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
		$(".chuGangCha_content img").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$(".chuGangCha_content input").val(result.replace("CODE_128,", ""));
				}
			});
		});
	</script>
</body>

</html>