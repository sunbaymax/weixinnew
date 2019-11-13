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
	<link rel="stylesheet" type="text/css" href="../css/paiSong.css" />
</head>

<body>
	<div class="header">
		<img class="back_list" src="../img/back.png" />
		<span>
			<a href="paiSong.html">派送</a>
		</span> 
		派送详情
	</div>
	<div class="paiSong_content paiSong_xiangcontent">
		<p>运单号：<input type="text" placeholder="请输入" /></p>
		<p>收件地址：<input type="text" placeholder="请输入" /></p>
		<p>收件电话：<input type="text" placeholder="请输入" /></p>
		<p>客户账号：<input type="text" placeholder="请输入" /></p>
		<p>件数：<input type="text" placeholder="请输入" /></p>
		<p>重量：<input type="text" placeholder="请输入" /></p>
		<div class="img_test">
			<img src="../img/tianJia_img.png"/>
		</div>
		<div class="paiSong">
			上传
		</div>
	</div>
	<script src="../js/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/paiSong.js" type="text/javascript" charset="utf-8"></script>
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
		var _x="";
		$(".img_test").on("click",function(){
			wx.chooseImage({
				count: 1, // 默认9
				sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
				sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
				success: function(res) {
					var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片;
					$(".img_test img").attr("src",localIds[0]);
					_x=localIds[0]
				}
			});
		});
		$(".paisong").on("click",function(){
			wx.getLocalImgData({
    			localId: _x, // 图片的localID
    			success: function (res) {
      			 	var localData = res.localData; // localData是图片的base64数据，可以用img标签显示l;
      			 	alert(1);
      			 	alert(localData);
		  		}
			});
		})
		
	</script>
</body>

</html>