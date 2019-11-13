<!DOCTYPE HTML>
<html lang="en-US">

	<head>
		<meta charset="UTF-8">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<title>中集冷云市场问卷调查</title>
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/toup.css" />
		<link rel="stylesheet" href="swiper/swiper.min.css">
		<script src="js/jquery-1.11.3.js"></script>
		<script src="js/fontSize.js"></script>
		<link rel="stylesheet" href="../css/iconfont.css" />
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
		<section class="toup" id="t1">
			<div class="logo">
				<img src="images/zjly_logo.png" />
			</div>
			<div class="swipers">
				<div class="con">
					<h1>中集冷云市场问卷调查</h1>
					<p>中集冷云（北京）供应链管理有限公司，是“中集集团”旗下一家集冷链设备研发生产、销售租赁与冷链运输为一体的综合服务型企业。</p>
					<p>在北京、杭州、成都、青岛设有4个温控产品生产基地。全国35个省会及枢纽城市均建有分公司，
					配送范围辐射全国1000多个城市，在北京、上海、广州、杭州、成都、石家庄、武汉等20余个枢纽城市建有专业冷库，使用空间达25000多立方米。</p>
					<p>中集冷云坚持“创•造•新价值”的企业宗旨，为客户提供最优质省心的一体化冷链运输服务。</p>
				</div>
				<a href="javascript:;" class="jion">参加本调查</a>
				<!--<button>进入抽奖</button>-->
				<p class="footer-p"><span class="hide">请保证信息真实性，以免影响奖品兑换！</span><button class="intoDraw hide">进入抽奖</button></p>
				<div style="display: none;">
					<img  class="touxiangur" id="touxiang" style="" src="<?php echo str_replace("/0","/46",$userinfo["headimgurl"]);?>"/>
					<input type="text" id="openid"  value="<?php echo $userinfo["openid"];?>" />
					<input type="text" style="" class="wechat_name_hiden" name="wechatname"  id="wechatname" value="<?php echo $userinfo["nickname"];?>"/> 
				</div>
			</div>
		</section>
		<section class="toup" id="t2">
			<div class="logo">
				<img src="images/zjly_logo.png" />
			</div>
			<div class="swipers">
				<!-- 上下 -->
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="scores">
								<!--<h3>?</h3>-->
								<div class="f"><span>1</span>您来自以下哪个行业？</div>
								<div class="choose">
									<div class="input"><input type="radio" name="score" id="1" value="CRO" /><label for="1">CRO  </label></div>
									<div class="input"><input type="radio" name="score" id="2" value="实验室" /><label for="2">实验室  </label></div>
									<div class="input"><input type="radio" name="score" id="3" value="医院" /><label for="3">医院  </label></div>
									<div class="input"><input type="radio" name="score" id="4" value="科研单位" /><label for="4">科研单位  </label></div>
									<div class="input"><input type="radio" name="score" id="5" value="制药企业" /><label for="5">制药企业  </label></div>
									<div class="input"><input type="radio" name="score" id="6" value="SMO" /><label for="6">SMO  </label></div>
									<div class="input"><input type="radio" name="score" id="7" value="其它" /><label for="7">其它  </label></div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="scores">
								<!--<h3></h3>-->
								<div class="f"><span>2</span>您从事的职业？</div>
								<div class="choose">
									<div class="input"><input type="radio" name="score1" id="8" value="企业高管" /><label for="8">企业高管  </label></div>
									<div class="input"><input type="radio" name="score1" id="9" value="BD" /><label for="9">BD  </label></div>
									<div class="input"><input type="radio" name="score1" id="10" value="PM" /><label for="10">PM  </label></div>
									<div class="input"><input type="radio" name="score1" id="11" value="科研人员" /><label for="11">科研人员  </label></div>
									<div class="input"><input type="radio" name="score1" id="12" value="CRA" /><label for="12">CRA  </label></div>
									<div class="input"><input type="radio" name="score1" id="13" value="CRC" /><label for="13">CRC  </label></div>
									<div class="input"><input type="radio" name="score1" id="115" value="医生" /><label for="115">医生  </label></div>
									<div class="input"><input type="radio" name="score1" id="14" value="其它" /><label for="14">其它  </label></div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="scores">
								<!--<h3></h3>-->
								<div class="f"><span>3</span>您的企业是否有冷链需求？</div>
								<div class="choose">
									<div class="input"><input type="radio" name="score3" id="19" value="需要，已有合作客户" /><label for="19">需要，已有合作客户  </label></div>
									<div class="input"><input type="radio" name="score3" id="20" value="需要，正在寻找" /><label for="20">需要，正在寻找  </label></div>
									<div class="input"><input type="radio" name="score3" id="21" value="暂时不需要，今后可能有需求" /><label for="21">暂时不需要，今后可能有需求  </label></div>
									<div class="input"><input type="radio" name="score3" id="22" value="完全不需要，没有冷链需求产品" /><label for="22">完全不需要，没有冷链需求产品</label></div>
								</div>
							</div>
						</div>
						<div class="swiper-slide swiper-slide1">
							<div class="scores">
								<!--<h3></h3>-->
								<div class="f"><span>4</span>中集冷云可以做的业务包括(多选)？</div>
								<div class="choose">
									<div class="input"><input type="checkbox" name="score2" id="15" value="临床样本/医药运输" /><label for="15">临床样本/医药运输</label></div>
									<div class="input"><input type="checkbox" name="score2" id="16" value="保温箱销售" /><label for="16">保温箱销售</label></div>
									<div class="input"><input type="checkbox" name="score2" id="17" value="温度计销售" /><label for="17">温度计销售</label></div>
									<div class="input"><input type="checkbox" name="score2" id="18" value="样本存储" /><label for="18">样本存储</label></div>
								</div>
							</div>
						</div>
						
						
					</div>

					<div class="preNexts">
						<div class="swiper-button-prev">
							<div class="pre"></div>上一题</div>
						<div class="swiper-button-next">
							<div class="next"></div>下一题</div>
					</div>
				</div>
				<!-- 上下end -->
			</div>
		</section>
		<section class="toup" id="t3">
			<div class="logo">
				<img src="images/zjly_logo.png" />
			</div>
			<div class="swipers">
				<div class="con con1">
					<p style="position: relative;"><span class="icon iconfont icon-zhenshixingming sp1"></span><input type="text" name="" class="name" placeholder="姓名" /></p>
					<p style="position: relative;"><span class="icon iconfont icon-shoujihaoma sp1"></span><input type="number" name="" class="phone" placeholder="手机号" /></p>
					<p style="position: relative;"><span class="icon iconfont icon-gongsimingcheng sp1"></span><input type="text" name="" class="company" placeholder="公司名称" /></p>
					<p style="position: relative;"><span class="icon iconfont icon-dizhi sp1"></span><input type="text" name="" class="address" placeholder="所在城市" /></p>
					<!--<p class="myluru">
						您所了解的有<span style="color: #FF0000;">疫苗冷链运输</span>需求的医药企业(除个别知名企业)<input type="text" class="f1zmqy" /> <input type="text" class="f2zmqy" /><input type="text" class="f3zmqy" /> <span style="color: #FF0000;">(2项必填)</span>
					</p>-->
					<div class="smile">
						<p>非常感谢您的配合!</p>
						<p>填写好您的信息，将可以抽奖有希望获得精美礼品，谢谢参与！!</p>
					</div>

				</div>
				<a href="javascript:;" class="tijiao">提交调查</a>
				
		</section>
		<script src="swiper/swiper.min.js"></script>
		<script type="text/javascript">
		    $(document).ready(function(){  
		    	var _openid = $("#openid").val();
				var _wechatname = $("#wechatname").val();
				window.localStorage.setItem("openid",_openid);
				window.localStorage.setItem("wechatname",_wechatname);
				$.ajax({
					type:"post",
					url:"http://www.ccsc58.com/json/weixin/03_00_check_user.php",
					async:true,
					data:{
						admin_permit:'zjly8888',
						openid:_openid
					},
					dataType:"JSON",
					success:function(res){
						if(res.code==20000){
							$('.footer-p span').show();
							$('.footer-p button').hide();
						}else if(res.code==10000){
							$('.footer-p span').hide();
							$('.footer-p button').show();
						}else{
							$('.footer-p span').show();
							$('.footer-p button').hide();
						}
					},
					error:function(err){
						
					}
				});
		    });  
		</script>
		<script>
			var mySwiper = new Swiper('.swiper-container', {
				pagination: '.swiper-pagination',
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				slidesPerView: 1,
				paginationClickable: true,
				spaceBetween: 30,
				loop: true,
				onReachEnd: function(swiper) {
					$("#t2").hide();
					$("#t3").show();
				}
			});
			$("#t2,#t3").hide();
			$("a.jion").on("click", function() {
				$("#t1").hide();
				$("#t2").show();
			});
			$('.intoDraw').on("click",function(){
				location.href='https://hd.faisco.cn/15084413/8-OFLzYSb5dgxUJLG8UHEQ/load.html?style=0';
			})
			$(".swiper-container input,.swiper-container label").click(function() {
				var this_active = $(this).parents(".swiper-slide").index();
				
				var a = $(this).attr('id');
				if(this_active==0){
					this_active==4
				}
				console.log(this_active)
				if(a==15||a==16||a==17||a==18){
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 1000)
					}, 1000000);

				}else if(a >=19){
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 1000)
					}, 1000000);
				}
				else{
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 1000)
					}, 1000000);
				}

			});

			$('.swiper-button-next').click(function() {
				
				if(mySwiper.isEnd) {
					$("#t2").hide();
					$("#t3").show();
				}
			})
//          $(".f2zmqy").blur(function(){
//          	$('body,html').animate({
//						scrollTop: 0
//					}, 0);
//          })
			$('.tijiao').click(function() {
				var _frist = $("input[name='score']:checked").val();
				var _second = $("input[name='score1']:checked").val();
				var _third = "";
				$("input[name='score2']").each(function() {
					if($(this).is(":checked")) {
						_third += $(this).val()+"@";
					}
				});
				var _fourth = $("input[name='score3']:checked").val();
				var _name = $(".name").val();
				var _tel = $(".phone").val();
				var _company = $(".company").val();
				var _city=$(".address").val();
//				var _mzcs1=$('.f1zmqy').val();
//				var _mzcs2=$('.f2zmqy').val();
				//获取当前时间
				function getNowFormatDate() {
					var date = new Date();
					var seperator1 = "-";
					var seperator2 = ":";
					var month = date.getMonth() + 1;
					var strDate = date.getDate();
					if(month >= 1 && month <= 9) {
						month = "0" + month;
					}
					if(strDate >= 0 && strDate <= 9) {
						strDate = "0" + strDate;
					}
					var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate +
						" " + date.getHours() + seperator2 + date.getMinutes() +
						seperator2 + date.getSeconds();
					return currentdate;
				}

				var nowtime = getNowFormatDate();
				if(typeof(_frist) == "undefined") {
					alert("第一道题没有选择");				
				}else if(typeof(_second) == "undefined") {
					alert("第二道题没有选择");
				
				}else if(typeof(_third) == "undefined") {
					alert("第三道题没有选择");
				}else if(typeof(_fourth) == "undefined") {
					alert("第四道题没有选择");
				}else if(_name==''||_name==null){
					alert("用户名不能为空");
					$('.name').focus();
				}else if(_tel==''||_tel==null){
					alert("手机号不能为空");
					$('.phone').focus();
				}else if(_tel.length<11){
					alert("手机号格式不正确");
					$('.phone').focus();
				}else if(_company==''){
					alert("公司名称不能为空");
					$('.company').focus();
				}else if(_city==''){
					alert("您所在的城市不能为空");
					$('.address').focus();
				}
//				else if(_mzcs1==''){
//					alert("知名企业是必填项");
//					$('.f1zmqy').focus();
//				}else if(_mzcs2==''){
//					alert("知名企业是必填项");
//					$('.f2zmqy').focus();
//				}
				else{
//				   var zhiming=$('.f1zmqy').val()+','+$('.f2zmqy').val();

                   $.ajax({
						url: "http://www.ccsc58.com/json/weixin/03_00_question_post.php",
						type: 'post',
						dataType: 'JSON',
						data:{
							admin_permit:'zjly8888',
							first:_frist,
							second:_second,
							third:_third,
							fourth:_fourth,
							name:_name,
							tel:_tel,
							company:_company,
							openid:localStorage.getItem("openid"),
							wechatname:localStorage.getItem("wechatname"),
							city:_city,
							famous_company:"未知"
						},
						success: function(res) {
							if(res.code==10000){ 
								del();
							    function del() { 
								 var msg = "您的反馈已经提交成功!\n\n请确认是否退出?"; 
								 if (confirm(msg)==true){ 
								 	 window.localStorage.clear();
								 	 var _openId=["oTarnv-rUHZhhNjCHdkmuq40w1Ow","oTarnv5aWyxLcCENYrs5UOR3FqvQ","oTarnv1Yl1Mk81Qb2Gm9G3gyar90"];
								 	 for(var i=0;i<_openId.length;i++){
								 	 var _remark="第一题:"+_frist+", 第二题:"+_second+","+"第三题:"+_third+" ,第四题："+_fourth;
								 	 $.ajax({
										type: "post",
										url: "http://www.ccsc58.cc/weixinnew/Push_message.php",
										data: {
											first: "问卷调查反馈提醒",
											keyword1: _name,
											keyword2: nowtime,
											remark: _remark,
											openId: _openId[i],
											app_key: "261AFF68C0E9F076420D083D66222824"
										},
										success: function(data) {
											location.href="questionok.html";
//																	console.log('推送成功');
					
										},
										error: function() {
											//alert("推送失败！");
											//WeixinJSBridge.call("closeWindow");
										}
									});
									 
								 }
								 return true; 
								}
								 else{
								 	 window.localStorage.clear(); 
								 	 window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx82dbac04fa8fd8ef&redirect_uri=http://www.ccsc58.cc/weixinnew/oauth2_wechatquestion.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
								     return false; 
								 } 
								} 	
							}else if(res.code==30000){
							  alert("反馈失败");
							}else{
							alert("反馈失败,有需要请联系中集冷云客服人员电话：400-6507168");	
							}
							
						},
						error: function(err) {
							console.log(err);
						}
					})
				
				}

			})
		</script>
	</body>

</html>
	