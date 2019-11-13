<div style="display: none;">
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
	<title>拜访记录</title>
	<link rel="stylesheet" href="../css/index.css" type="text/css">
	<link rel="stylesheet" href="../css/shijian.css" type="text/css">
	<link rel="stylesheet" href="../css/visit.css" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
</head>
<style>
	ul li div:last-child .visit_address {
    width: 80%;
}
.visit_address{
	background: #FFFFFF;
}
* {
	touch-action: pan-y;
}
		
</style>

<body>
	<div class="content">
		<div class="content_body">
			<!--<div class="title">
				<a href="Person.html" class="return"><img src="../img/return.png" class="return_img" alt="返回上一页" /></a>
				<span>拜访记录</span>
				<a href="VisitHistory.html" class="history"><img src="../img/histroylist.png" class="history_img" /> </a>
			</div>-->
			<div class="visit-top">
				<ul>
					<li>
						<div class="click_visitobj">
							<img src="../img/important.png" />
							<span>拜访对象</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<input type="text" placeholder="请选择" class="visit_obj" readonly="readonly"/>
							<!--<img src="../img/delete.png" class="resert_input" />-->
						</div>
					</li>
					<li class="hide">
						<div class="click_type">
							<img src="../img/important.png" />
							<span>拜访方式</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<input type="text" value="当面拜访" class="choose_visit_obj" readonly="readonly"/>
						</div>
					</li>
					<li>
						<div class="click_time">
							<img src="../img/get_limit_time.jpg" />
							<span>拜访时间</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<input type="text" placeholder="请输入" class="visit_time dsa" />
						</div>
					</li>
				</ul>
				<ul>
					<li>
						<div class="click_linkman">
							<img src="../img/user.png" />
							<span>联系人</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<input type="text" placeholder="请选择" readonly="readonly" class="link_user" />
							<!--<img src="../img/delete.png" class="resert_input" />-->
						</div>
					</li>
					<li>
						<div class="click_linktel">
							<img src="../img/telphone.png" />
							<span>联系电话</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<input type="text" placeholder="请点击联系人进行选择" class="visit_tel" readonly="readonly" />
						</div>
					</li>
					<li>
						<div class="click_address">
							<img src="../img/address.png" />
							<span>所在位置</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<select class="visit_address">
							<option>请点击右侧图标获取</option>
							</select>
							<!--<input type="text" placeholder="请输入" class="visit_address" />-->
							
							<img src="../img/postion.jpg" class="postion" id="get_postion"/>
						</div>
					</li>
				</ul>
				<div class="backup">
					<li>
						<div class="click_desc">
							<img src="../img/Explain.png" />
							<span>拜访说明</span>
							<img src="../img/click_right.png" class="right" />
						</div>
						<div class="hide">
							<textarea placeholder="请输入" class="Explain" style="font-size: 1.6rem;"></textarea>
						</div>
					</li>
				</div>
				<div class="footer">
					<button class="submit_ok">提交</button>
				</div>
			</div>
		</div>
	</div>
	<div id="success_mao">
			<div class="success_box" style="display:block;">
				<div class="register_right">
					<img src="../img/ku.png" />
				</div>
				<div class="success_information">请使用6-20位字母及数字组合作为用户名</div>
				<form action="">
					<input type="button" value="确定" />
				</form>
			</div>
		</div>
	<script src="../js/jquery-1.11.0.js" type="text/javascript"></script>
	<script src="../js/toastr.min.js" type="text/javascript"></script>
	<script src="../js/index.js" type="text/javascript"></script>
	<script src="../js/jquer_shijian.js?ver=1" type="text/javascript" charset="utf-8"></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<!--调用JSSDK-->
	<script>
		//JSSDK配置参数 通过config接口注入权限验证配置
		wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: '<?php echo $signPackage["timestamp"];?>',
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'getLocation'
			]
		});
	</script>

	<script>
		$(document).ready(function() {
			if(JSON.parse(localStorage.getItem('choose_company'))) {
				var _choose_company = JSON.parse(localStorage.getItem('choose_company'));
				 $('.visit_obj').val(_choose_company.company);
				 $('.click_visitobj').next().show();
				 $('.click_visitobj img').eq(1).addClass('change').removeClass('right');
				 if(localStorage.getItem('lishicompany')!=_choose_company.company){
    			    localStorage.setItem('lishicompany',_choose_company.company);
				    localStorage.removeItem('choose_person')
				 }
			} 
			else {
				$('.visit_obj').val('');
				$('.link_user').val("");
				$('.visit_tel').val("");
			}
			if(JSON.parse(localStorage.getItem('choose_person'))) {
				var _choose_person = JSON.parse(localStorage.getItem('choose_person'));
				$('.link_user').val(_choose_person.user);
				$('.visit_tel').val(_choose_person.phone);
				$('.click_linkman').next().show();
				$('.click_linktel').next().show();
				$('.click_linkman img').eq(1).addClass('change').removeClass('right');
				$('.click_linktel img').eq(1).addClass('change').removeClass('right');
			} else {
				$('.link_user').val('');
				$('.visit_tel').val('');

			}
//			if(localStorage.getItem('_choose_visit_obj')) {
//				var _choose_visit_obj = localStorage.getItem('_choose_visit_obj');
//				$(".choose_visit_obj").val(_choose_visit_obj);
////				$('.click_type').next().hide();
////				$('.click_type img').eq(1).addClass('right').removeClass('change');
//				
//			} else {
//				
//
//			}
			if(localStorage.getItem('_choose_visit_time')) {
				var _choose_visit_time = localStorage.getItem('_choose_visit_time');
				$(".visit_time").val(_choose_visit_time);
				$('.click_time').next().show();
				$('.click_time img').eq(1).addClass('change').removeClass('right');
				
			} else {
				

			}
            //点击拜访对象切换
			$(".visit-top li:first-child .visit_obj").on("click", function() {
				var lishi=$(this).val();
				localStorage.setItem('lishicompany',lishi);
				location.href = "VisitObj.html";
			})
			$(".visit-top li .click_visitobj").on("click", function() {
				if($(this).children('img:last()').attr('class') == 'change') {
					$(this).children('img:last()').attr('class', 'right');
				} else {
					$(this).children('img:last()').attr("class", 'change');
				}
				$(this).next().toggle();
			})

            //点击拜访方式切换
			$(".visit-top li .click_type").on("click", function() {
				if($(this).children("img").last().attr('class') == 'change') {
					$(this).children("img").attr('class', 'right');
				} else {
					$(this).children("img").last().attr("class", 'change');
				}
				$(this).next().toggle();
			})
			$(".visit-top li .click_time").on("click", function() {
				if($(this).children("img").last().attr('class') == 'change') {
					$(this).children("img").attr('class', 'right');
				} else {
					$(this).children("img").last().attr("class", 'change');
				}
				$(this).next().toggle();
			})
			//清空当前录入的文本
//			$('.resert_input').on("click",function(){
//				$(this).prev().val("");
//			})
			//点击拜访联系人
			$(".visit-top ul:nth-child(2) li:first-child .link_user").on("click", function() {
				var _choose_visit_obj=$('.choose_visit_obj').val();
				var _choose_visit_time=$('.visit_time').val();
				localStorage.setItem('_choose_visit_obj',_choose_visit_obj);
				localStorage.setItem('_choose_visit_time',_choose_visit_time);
				location.href = "VisitMan.html";
				
			})
			$(".visit-top ul:nth-child(2) li:nth-child(2) .visit_tel").on("click", function() {
				location.href = "VisitMan.html";
			})
			$(".visit-top li .click_linkman").on("click", function() {
				if($(this).children("img:last()").attr('class') == 'change') {
					$(this).children("img:last()").attr('class', 'right');
				} else {
					$(this).children("img:last()").attr("class", 'change');
				}
				$(this).next().toggle();
			})
			$(".visit-top li .click_linktel").on("click", function() {
				if($(this).children("img:last()").attr('class') == 'change') {
					$(this).children("img:last()").attr('class', 'right');
				} else {
					$(this).children("img:last()").attr("class", 'change');
				}
				$(this).next().toggle();
			})
			
			$(".dsa").shijian(); // 调时间接口
			$(".dsa").on("click",function(){
				$('body,html').animate({
					scrollTop: 0
				}, 1000);
			}); // 调时间接口
			$("#get_postion").on("click",function(){
				$(".visit_address").empty();
				wx.getLocation({
					success: function(res) {
						var latitude = res.latitude; //纬度
						var longitude = res.longitude; //经度
						var locationStr = "latitude：" + latitude + "，" + "longitude：" + longitude;
						var locationStrdan = latitude + "," + longitude;
						$(".visit_address").attr('latitude',latitude);
						$(".visit_address").attr('longitude',longitude);
                        $.ajax({
                        	type:"post",
                        	url:"http://out.ccsc58.cc/DATA_PUBLIC/lat_lng_change.php",
                        	async:true,
                        	data:{
                        		lat:latitude,
                        		lng:longitude
                        	},
                        	dataType:"JSON",
                        	success:function(res){
                        		$.each(res.data, function(index,val) {
                        			let str=`<option value='${val}'>${val}</option>`;
                        			$(".visit_address").append(str);
                        		});
                        	},
                        	error:function(err){
                        		myPlay('获取地理位置失败！！！');
                        	}
                        });

					},
					cancel: function(res) {
						myPlay('用户拒绝授权获取地理位置');
					},
					fail: function(res) {
						console.log(JSON.stringify(res));
					}
				});
			})
//			$(".visit-top ul:nth-child(2) li:last-child .visit_address").on("click", function() {
//
//			})
            $(".visit-top li .click_address").on("click", function() {
            	if($(this).children("img:last()").attr('class') == 'change') {
					$(this).children("img:last()").attr('class', 'right');
				} else {
					$(this).children("img:last()").attr("class", 'change');
				}
				$(this).next().toggle();
            	})

			$(".visit-top li .click_desc").on("click", function() {
				if($(this).children("img:last()").attr('class') == 'change') {
					$(this).children("img:last()").attr('class', 'right');
				} else {
					$(this).children("img:last()").attr("class", 'change');
				}
				$(this).next().toggle();
			})
			$(".Explain").blur(function(){
			  $('body,html').animate({scrollTop: 0}, 1000);
			});
			$('.submit_ok').click(function() {
				var _knight=localStorage.getItem('Knight');
				var _chooseobj=JSON.parse(localStorage.getItem('choose_company'));
				var _chooseperson=JSON.parse(localStorage.getItem('choose_person'));
				$('body,html').animate({scrollTop: 0}, 1000);
				var _Visitobj=$(".visit_obj").val();
				var _Visittype=$(".choose_visit_obj").val();
				var _Visitlkuser=$(".link_user").val();
				var _Visitlktel=$(".visit_tel").val();
				var _Visitlkaddress=$(".visit_address").val();
				var _VisitExplain=$(".Explain").val();
				var _VisitTime=$(".visit_time").val();
				var _lat=$(".visit_address").attr('latitude');
				var _lng=$(".visit_address").attr('longitude');
				//var thetime = $(".dsa").val();
				var d = new Date(Date.parse(_VisitTime.replace(/-/g, "/")));
				var curDate = new Date();
				
				if(_Visitobj==''||_Visitobj==null){
					myPlay("拜访对象不能为空");
					return false;
				}else if(_Visittype==''||_Visittype=="请选择"){
					myPlay("请选择拜访方式");
					return false;
				}else if(_VisitTime==''||_VisitTime==null){
					myPlay("拜访时间不能为空");
					return false;
				}else if(d >= curDate) {
					myPlay("拜访时间大于当前时间");
					return false;
				}else if(_Visitlkuser==''||_Visitlkuser==null){
					myPlay("拜访联系人不能为空");
					return false;
				}else if(_Visitlktel==''||_Visitlktel==null){
					myPlay("拜访联系电话不能为空");
					return false;
				}
				else if(_Visitlkaddress==''||_Visitlkaddress=='请点击右侧图标获取'||_Visitlkaddress=='请进行地理位置选择'){
					myPlay("请选择所在地址");
					return false;
				}
				else if(_VisitExplain==''||_VisitExplain==null){
					myPlay("请录入拜访说明");
					return false;
				}else{
			
					var _data='';
					var _url='';
					if(_chooseobj.CustomerType=="AccountCustomer"){
						 _data={
							Name:_Visitlkuser,
							Telephone:_Visitlktel,
							Knight:_knight,
							DepartMent:_chooseperson.DepartMent,
							ZW:_chooseperson.zhiwei,
							Company:_Visitobj,
							Account:_chooseobj.InfoId,
							StartTime:_VisitTime,
							ID:_chooseobj.Id,
							OrderNote:_Visittype,
							Condition:_VisitExplain,
							WZMS:_Visitlkaddress,
							lat:_lat,
							lng:_lng
					    };
					    _url='http://out.ccsc58.cc/DATA_PORT_CRM_1.01/Visiting_Account_record.php';
					}else{
						_data={
							Name:_Visitlkuser,
							Telephone:_Visitlktel,
							Knight:_knight,
							DepartMent:_chooseperson.DepartMent,
							ZW:_chooseperson.zhiwei,
							Company:_Visitobj,
							ID1:_chooseobj.InfoId,
							StartTime:_VisitTime,
							ID2:_chooseobj.Id,
							OrderNote:_Visittype,
							Condition:_VisitExplain,
							WZMS:_Visitlkaddress,
							lat:_lat,
							lng:_lng
					   };
					   _url='http://out.ccsc58.cc/DATA_PORT_CRM_1.01/Visiting_record.php';
					}
				
                    $.ajax({
						url:_url,
						type:"POST",
						data:_data,
						dataType:"JSON",
						success:function(res){
							console.log(res);
							if(res.code=="200"&&res.msg=='success'){
								myPlay("提交成功");
								localStorage.removeItem("choose_company");
								localStorage.removeItem("choose_person");
								localStorage.removeItem("lishicompany");
							}else{
								myPlay(res.msg);
								return false;
							}
						},
						error:function(err){
							console.log(err);
						}
						
					})
					$(this).attr('disabled',true);
					$(this).css("background-color","#cccccc");
					function myrefresh()
					{
						window.location.reload();
					}
					setTimeout('myrefresh()',5000); //指定5秒刷新一次
					
				}
				
				
			})
	
			
			


		})
	</script>
</body>

</html>