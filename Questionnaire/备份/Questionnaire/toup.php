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
					<p>感谢光临中集冷云体验中心！</p>
					<p>中集冷云（北京）供应链管理有限公司，是“中集集团”旗下一家提供冷链设备销售、租赁以及供应链综合解决方案的服务型企业。</p>
					<p>中集冷云抱着让客户使用“低成本”享受到“高品质”的“优服务”的理念，专注于做中国最优的相变储能材料、温度记录仪和保温箱技术。具有丰富的医药冷链一体化物流服务经验，拥有国内领先的技术研发团队；管理人员均在冷链行业从业5-10年以上。在北京、杭州、成都、青岛设有4个温控产品生产基地。在全国34个省会城市设有自营网点，配送范围辐射全国1000多个城。</p>
					<p>坐下来，品一杯凉饮，细细地想一想，您与中集冷云是怎样结缘的呢？？</p>
				</div>
				<a href="javascript:;" class="jion">参加本调查</a>
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
								<h3>您来自以下哪个行业?</h3>
								<div class="f"><span>1</span>行业分类</div>
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
								<h3>您从事的职业？</h3>
								<div class="f"><span>2</span>职业选择</div>
								<div class="choose">
									<div class="input"><input type="radio" name="score1" id="8" value="企业高管" /><label for="8">企业高管  </label></div>
									<div class="input"><input type="radio" name="score1" id="9" value="BD" /><label for="9">BD  </label></div>
									<div class="input"><input type="radio" name="score1" id="10" value="PM" /><label for="10">PM  </label></div>
									<div class="input"><input type="radio" name="score1" id="11" value="科研人员" /><label for="11">科研人员  </label></div>
									<div class="input"><input type="radio" name="score1" id="12" value="CRA" /><label for="12">CRA  </label></div>
									<div class="input"><input type="radio" name="score1" id="13" value="CRC" /><label for="13">CRC  </label></div>
									<div class="input"><input type="radio" name="score1" id="14" value="其它" /><label for="14">其它  </label></div>
								</div>
							</div>
						</div>
						<div class="swiper-slide swiper-slide1">
							<div class="scores">
								<h3>您对我公司感兴趣的业务为？</h3>
								<div class="f"><span>3</span>明确需求</div>
								<div class="choose">
									<div class="input"><input type="checkbox" name="score2" id="15" value="临床样本/医药运输" /><label for="15">临床样本/医药运输</label></div>
									<div class="input"><input type="checkbox" name="score2" id="16" value="保温箱购买" /><label for="16">保温箱购买</label></div>
									<div class="input"><input type="checkbox" name="score2" id="17" value="温度计购买" /><label for="17">温度计购买</label></div>
									<div class="input"><input type="checkbox" name="score2" id="18" value="样本存储" /><label for="18">样本存储</label></div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="scores">
								<h3>您所在的城市区域？</h3>
								<div class="f"><span>4</span>城市服务</div>
								<div class="choose">
									<div class="input"><input type="radio" name="score3" id="19" value="东北" /><label for="19">东北（黑、吉、辽）  </label></div>
									<div class="input"><input type="radio" name="score3" id="20" value="华东" /><label for="20">华东（沪、苏、浙、皖、闽、赣、鲁、台）  </label></div>
									<div class="input"><input type="radio" name="score3" id="21" value="华北" /><label for="21">华北（京、津、冀、晋、蒙）；  </label></div>
									<div class="input"><input type="radio" name="score3" id="22" value="华中" /><label for="22">华中（豫、鄂、湘）</label></div>
									<div class="input"><input type="radio" name="score3" id="23" value="华南" /><label for="23">华南（粤、桂、琼、港、澳）</label></div>
									<div class="input"><input type="radio" name="score3" id="24" value="西南" /><label for="24">西南（蜀、黔、滇、渝、藏）；</label></div>
									<div class="input"><input type="radio" name="score3" id="25" value="华南" /><label for="25">华南（粤、桂、琼、港、澳）</label></div>
									<div class="input"><input type="radio" name="score3" id="26" value="西北" /><label for="26">西北（秦、甘、青、宁、新）</label></div>
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
					<p style="position: relative;"><span class="icon iconfont icon-yonghuming sp1"></span><input type="text" name="" class="name" placeholder="您的姓名" /></p>
					<p style="position: relative;"><span class="icon iconfont icon-shoujihaoma sp1"></span><input type="number" name="" class="phone" placeholder="手机号码" /></p>
					<p style="position: relative;"><span class="icon iconfont icon-gongsimingcheng sp1"></span><input type="text" name="" class="company" placeholder="公司名称" /></p>
					<div class="smile">
						<p>非常感谢您的配合!</p>
						<p>请填写您的联系方式，我们将赠送您精美礼品，谢谢参与！!</p>
					</div>

				</div>
				<a href="javascript:;" class="tijiao">提交调查</a>
			</div>
		</section>
		<script src="swiper/swiper.min.js"></script>
		<script type="text/javascript">
		    $(document).ready(function(){  
		    	var _openid = $("#openid").val();
				var _wechatname = $("#wechatname").val();
				window.localStorage.setItem("openid",_openid);
				window.localStorage.setItem("wechatname",_wechatname);
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
			
			$(".swiper-container label,.swiper-container input").click(function() {
				var this_active = $(this).parents(".swiper-slide").index();
				var a = $(this).attr('id');
				if(a == 15||a==16||a==17||a==18){
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 1000)
					}, 3000);

				}else if(a >=19){
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 2000)
					}, 500);
				}
				else{
					setTimeout(function() {
					mySwiper.slideTo(this_active + 1, 1000)
					}, 500);
				}

			});

			$('.swiper-button-next').click(function() {
				if(mySwiper.isEnd) {
					$("#t2").hide();
					$("#t3").show();
				}
			})

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
				} else {
					if(typeof(_second) == "undefined") {
						alert("第二道题没有选择");
					} else {
						if(typeof(_third) == "undefined") {
							alert("第三道题没有选择");
						} else {
							if(typeof(_fourth) == "undefined") {
								alert("第四道题没有选择");
							} else {
								if(_name==''||_name==null){
									alert("用户名不能为空");
								}else{
									if(_tel==''||_tel==null){
									  alert("手机号不能为空");
								     }else{
									  if(_tel.length<11){
									    alert("手机号格式不正确");
								      }else{
								      	if(_company==''){
								      		alert("公司名称不能为空");
								      	}
								      	else{
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
													wechatname:localStorage.getItem("wechatname")
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
																	WeixinJSBridge.call("closeWindow");
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
													alert("反馈失败,有需要请联系中集智冷人员电话：83613710");	
													}
													
												},
												error: function(err) {
													console.log(err);
												}
											})
	                                        

							
								      	}
								      }
								    }
								}
							}
						}
					}
				}

			})
		</script>
	</body>

</html>
	