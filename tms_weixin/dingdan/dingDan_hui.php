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
	<link rel="stylesheet" type="text/css" href="../css/dingdan.css" />
</head>

<body>
	<div class="header">
		<img class="back_list" src="../img/back.png" />
		<span>
				<a class="dingDan_back" href="javascript:void(0)">订单详情</a>
			</span> 订单回复
	</div>
	<div class="dingDan_content">
		<div class="hui_box">
			<p>产品信息<span></span></p>
			<p>运单号码：<input type="text" placeholder="请输入或扫码" /><img src="../img/saoyisao.png" /></p>
			<p>温度要求：<input type="text" placeholder="请输入温度要求" /></p>
			<p>温度计编号：<input type="text" placeholder="请输入或扫码" /><img src="../img/saoyisao.png" /></p>
		</div>
		<div class="special_yao">
			<p>备注：</p>
			<div class="special_content" contenteditable="true">
				限150字以内~~
			</div>
			<div class="huiFu_baocun">
				保存
			</div>
		</div>
	</div>
	<script src="../js/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/dingdan.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js" charset="utf-8"></script>
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
				"getLocalImgData"
			]
		});
		var _x = "";
		$(".hui_box p:nth-of-type(2) img").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$(".hui_box p:nth-of-type(2) input").val(result.replace("CODE_128,", ""));
				}
			});
		});
		$(".hui_box p:nth-of-type(4) img").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$(".hui_box p:nth-of-type(4) input").val(result.replace("CODE_128,", ""));
				}
			});
		});
	</script>
</body>

</html>