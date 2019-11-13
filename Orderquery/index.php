<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>中集冷云冷链监控服务商</title>
		<link href="css/initialize.css" type="text/css" />
		<link rel="stylesheet" href="css/index.css" type="text/css" />
	</head>
	<body>
		<div style="display:none">
			<?php
				require_once "../jssdk.php";
				$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
				$signPackage = $jssdk->GetSignPackage();
			?>
		</div>
		<div class="Whole">
			<div class="titleTop">
				<span class="postionimg"></span>
				<a class="chinese" href="tel:400-6507168"></a>
			</div>
			<div class="title">
				<img src="img/logo.png" alt="logo" />
				<p class="logodesc">中集冷云冷链监控服务商</p>
			</div>
			<div class="content">
				<div class="centect_input">
				<span class="search"></span>
				<input class="danhao" type="text" placeholder="输入运输单号" />
				</div>
				<div class="fenge">
					<div>
						<span class="left"></span>
				  		<span class="or">或</span>
				  		<span class="left"></span>
					</div>
				  
				</div>
			    <div class="centect_circle">
			    	<div class="circle">
			    		<div class="circle_baise">
			    			<img src="img/saoyisao.png" class="saoyisao" />
			    			<span class="saoyisao sm">扫一扫</span>
			    		</div>
			    	</div>
			    </div>
				
			</div>
			<div class="footer">
					© Copyright 2018.中集冷云（北京）供应链管理有限公司
				</div>
		</div>
		<script src="../js/jquery-1.11.0.js"></script>
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
						'scanQRCode'
					]
				});
				$(".saoyisao").on("click", function() {
					wx.scanQRCode({
						needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
						scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
						success: function(res) {
							var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
							 if(result.includes(',')){
		                      result = result.split(',')[1];        
		                     }
							$(".danhao").val(result);
							$(".danhao").prev().css({
			  	             "background-image":"url(img/query.png)",
			  	              "left":"75vw"
			              });
			            window.localStorage.clear();
						var _yundanhao=$(".danhao").val();
						localStorage.setItem("yundanhao",_yundanhao);
						window.setTimeout("window.location.href='logistics.html'",2000); 
						}
					});
					
					
				});
				
				</script>
		    <script>
			$(".danhao").change(function(){
				var _yundanhao=$(".danhao").val();
				localStorage.setItem("yundanhao",_yundanhao);
//			  $(this).css("background-color","#FFFFCC");
			  $(this).prev().css({
			  	"background-image":"url(img/query.png)",
			  	"left":"75vw"
			  });
			  
			  window.setTimeout("window.location.href='logistics.html'",5000);
			    
			});
			
			$(".search").on("click",function(){
				window.localStorage.clear();
				var _yundanhao=$(".danhao").val();
				localStorage.setItem("yundanhao",_yundanhao);
				window.location.href="logistics.html"
			})
		</script>
	</body>

</html>