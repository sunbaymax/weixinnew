<div style="display:none">
	<?php
		require_once "jssdk.php";
		$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
		$signPackage = $jssdk->GetSignPackage();
	?>
</div>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<title>中集冷云（北京）冷链科技有限公司</title>
		<link rel="stylesheet" href="css/index.css" />
		<link rel="stylesheet" href="css/index01.css" />
		<link rel="stylesheet" href="JD_select/css/change_users.css" />
		<link rel="stylesheet" type="text/css" href="css/changeM.css"/>
		<link rel="stylesheet" href="JD_select/css/iconfont.css" />
		<link rel="stylesheet" href="css/iconfont.css" />
	</head>
	<body>
		<div class="header">
			<img class="back_list_user" src="img/back.png"/>
			温度计与箱子编号查询
		</div>
		<div class="content">
			<div class="user_top">
				<div>
				</div>
				<div>
					冷云科技制作
				</div>
			</div>
			<div class="user_bottom">
			<form action="jiekou_doBox.php" method="post">
				<ul>	
					<li><i class="icon iconfont icon-xiangzi"></i><span>箱子码：</span><input type="text" name="yewubianhao" id="xm" placeholder="请输入箱码" value="<?php echo @$_GET['yewubianhao']; ?>"/><img id="saoyisao1" class="saoma1" src="img/saoyisao.png" alt="" style="display:inline-block; width: 20px;height: 20px; float: right; margin-top: 10px;margin-right: 20px;"></li>
					<li><i class="icon iconfont icon-shoujihaoma"></i><span>设备号：</span><input type="text" name="shebeibianhao" id="sbh" placeholder="请输入设备号" value="<?php echo @$_GET['shebeibianhao']; ?>"/><img id="saoyisao2" class="saoma2" src="img/saoyisao.png" alt=""style="display:inline-block; width: 20px;height: 20px; float: right;margin-top: 10px;margin-right: 20px;"></li>	
				</ul>
				<p style="color:red;"><?php echo @$_GET['err']; ?></p>
					<button style="display: inline-block; margin-top:20px;width: 70%;height: 3rem;line-height: 3rem;text-align: center;
                    font-size: 1.5rem;background: #3299fe;border: none;box-shadow: 1px 1px 2px 2px #ccc;color: #fefefe;border-radius: 1rem;">查询</button>
			</form>
			</div>
		</div>
		<script src="js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="JD_select/js/change_users.js" type="text/javascript" charset="utf-8"></script>-->
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
        <!--<script>
        	var xiangma=document.getElementById('xm');
        	var shebeihaoma=document.getElementById('sbh');
        	if (xiangma.length !=14) {
        		alert(请确实您录入的箱码);
        	}
        	if (_shebeibianhao.length !=6) {
        		alert(请确实您录入的设备号);
        	}
        	if (_shebeibianhao.substring(0) ==0) {
        		alert(首位不要输入0);
        	}
        	
        </script>-->
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
		$(".saoma1").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$("#xm").val(result.replace("CODE_128,", ""));
				}
			});
			
		});
		$(".saoma2").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					$("#sbh").val(result.replace("CODE_128,0", ""));
				}
			});
			
		});
		
		
		</script>
	</body>
</html>
