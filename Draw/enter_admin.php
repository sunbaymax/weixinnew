<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="js/jquery-1.11.0.js"></script>
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		
		<title>管理员入场后台界面</title>
	</head>
	<style>
		ul li div {
			height: 3rem;
			line-height: 3rem;
			display: flex;
			position: relative;
		}
		
		.touxiang {
			height: 3rem;
			width: 3rem;
			max-width: 10%;
			border-radius: 50%;
			/*position: absolute;*/
			vertical-align: middle;
		}


		.dropdown-menu li a{
			text-align: center;
		}
		
		.saoyisao{
			width: 3rem;
			height: 3rem;
			position: absolute;
			top: 0.5rem;
			right: 15px;
		}
		.search{
			margin-top: 5px;
		}
		.content{
			height: auto;
			width: 100%;
			margin-top: 5px;
			padding: 0 15px;
			box-sizing: border-box;
		}

		.content div{
			height: 12rem;
			width: 100%;
		}
		.content div p{
			margin-bottom: 0px;
			display: block;
			height: 3rem;
			line-height: 3rem;
			width: 100%;
			border-bottom: 1px solid #007DF6;
		}
		span{
			margin-right: 15px;
			font-size:1.4rem ;
		}
		.content div p{
			height: 4rem;
			line-height: 4rem;
			font-family: "楷体";
		}
		.hiden{
			display: none;
		}
		.show{
			display: block;
		}
		
	</style>

	<body>
		<div style="display:none">
			<?php
				require_once "../jssdk.php";
				$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
				$signPackage = $jssdk->GetSignPackage();
			?>
		</div>
		<header>管理员入场后台界面 <img src="img/saoyisao.png"  class="saoyisao"/> </header>
		<div class="search">
			<form class="bs-example bs-example-form" role="form">
				<div class="row" style="padding: 0;margin: 0;">
				 <div class="col-lg-12">
					<div class="input-group">
						<input type="text" class="form-control txt" placeholder="请录入邀请码或用户姓名">
						<span class="input-group-btn">
							<button class="btn btn-default search_btn" type="button">
								查询
							</button>
						</span>
					</div>
				   </div><!-- /input-group -->
				</div><!-- /.row -->
			</form>
		</div>
		<div class="content">
		    <div class="data_ok hiden">
		    	<p class="frist">
		    	<span class="id hiden" ></span>
				<img class="touxiang" src="" />
				<span style="margin-left:15px ;">昵称:</span><span class="nickname"></span>
				<span>姓名:</span><span class="name"></span>
		    	</p>
				<p>
					<span>手机号:</span><span class="tel"></span>
					<span>岗位:</span><span class="gangwei"></span>
					
				</p>
				<p>
					<span>公司名称:</span><span class="company"></span>
					<button type="button" class="btn btn-success Dtype enter_btn">入场</button>
				</p>
			</div>
			<div class="hiden nodata">
				<span>没查询到信息</span>
			</div>
		</div>
		<footer>中集冷云（北京）供应链管理有限公司</footer>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
		<script>
			    $(function() {// 初始化内容
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
								var code=result.replace("CODE_128,", "");
								$.ajax({
									type:"post",
						    		url:"http://www.zjcoldcloud.com/weixin_lucky/admin_select.php",
						    		data:{
						    			id:code
						    		},
						    		dataType:"JSON",
						    		success:function(res){
						    			console.log(res);
						    			
						    			if(res.code=='0'){
						    				$('.data_ok').show();
						    			    $('.id').text(res.data.id);
						    			    $('.touxiang').attr("src", res.data.headimgurl);
						    			    $('.nickname').text(res.data.nickname);
						    			    $('.name').text(res.data.username);
						    			    $('.tel').text(res.data.telphone);
						    			    $('.company').text(res.data.company);
						    			    $('.gangwei').text(res.data.job);
						    			}else{
						    				$(".nodata").show();
						    			}
						    		},
						    		error:function(err){
						    			console.log(err);
						    		}
								})
								
								
							}
						});
				   });
				   //查询
					$('.search_btn').on("click",function(){
						var value=$('.txt').val();
						$.ajax({
			    		type:"post",
			    		url:"http://www.zjcoldcloud.com/weixin_lucky/admin_select.php",
			    		data:{
			    			id:value
			    		},
			    		dataType:"JSON",
			    		success:function(res){
			    			if(res.code=="0"){
			    				$('.data_ok').show();
			    			    $('.id').text(res.data.id);
			    			    $('.touxiang').attr("src", res.data.headimgurl);
			    			    $('.nickname').text(res.data.nickname);
			    			    $('.name').text(res.data.username);
			    			    $('.tel').text(res.data.telphone);
			    			    $('.company').text(res.data.company);
			    			    $('.gangwei').text(res.data.job);
			    			}else{
			    				$(".nodata").show();
			    			}
					    },
			    		error:function(err){
			    			console.log(err);
			    		}
					})
			    	    
			    }); 
			    //入场
			    $(".enter_btn").on("click",function(){
			    	var enterid=$('.id').text();
			    	$.ajax({
			    		type:"post",
			    		url:"http://www.zjcoldcloud.com/weixin_lucky/user_entry.php",
			    		data:{
			    			id:enterid,
			    			is_entrance:"1"
			    		},
			    		dataType:"JSON",
			    		success:function(res){
			    			console.log(res);
			    			if(res.code=="0"){
			    				alert("入场成功！");
			    				window.location.reload();
			    			}else{
			    				alert("入场成功！");
			    				window.location.reload();
			    			}
			    		},
			    		error:function(err){
			    			console.log(err)
			    		}
			    	});
			    })
			});  
		</script>
	</body>

</html>