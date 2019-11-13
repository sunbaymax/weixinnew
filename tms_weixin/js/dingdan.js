/*$("body").on("click", ".dingDan_list", function() {
	window.location.href = "dingDan_xiang.html?weiTuo=" + $(this).find("p:nth-of-type(1) span").html();
});*/
var _token = window.localStorage.getItem("LYtoken");
var _user = window.localStorage.getItem("LYuser");
var _url = window.location.href;
//console.log(_url.indexOf("?"));
if(_url.indexOf("?") == -1) {
	/*订单*/
	$.ajax({
		type: "get",
		url: "http://www.ccsc58.cc/tms/interface.php/home/order/index",
		data: {
			token: _token,
			username: _user
		},
		success: function(data) {
			if(data.msg == "success" && data.result != "") {
				for(var i = 0; i < data.result.length; i++) {
					var _dem = $(".dingDan_list").eq(0).clone().removeClass("hidden").appendTo(".dingDan_content");
					_dem.find("p:nth-of-type(1) span").html(data.result[i].id);
					_dem.find("p:nth-of-type(2) span").html(data.result[i].accountnumber);
					_dem.find("p:nth-of-type(3) span").html(data.result[i].company);
					_dem.find("p:nth-of-type(4) span").html(data.result[i].ordertime);
				}
				$(".dingDan_list").on("click",function(){
					window.location.href = "dingDan_xiang.html?weiTuo=" + $(this).find("p:nth-of-type(1) span").html();
				});
			} else {
				$(".dingDan_content").html("暂无数据").css({
					color: "red",
					fontSize: "1.5rem",
					textAlign: "center",
					lineHeight: "3rem"
				});
			}
		},
		error: function() {
			alert("网络错误，请刷新页面");
		}
	});
	/*订单查询*/
	$("form input[type='button']").on("click", function() {
		//console.log(1);
		var _userZhanghao = $(this).prev().prev().prev().prev().val();
		var _muDi_city = $(this).prev().prev().val();
		var _yuanBox = $(".dingDan_list").eq(0).clone();
		var _warning_cha_ding=$(".warning_cha_ding").clone();
		/*console.log(_userZhanghao);
		console.log(_muDi_city);*/
		if(_userZhanghao==""&&_muDi_city==""){
			$(".dingDan_cha").html(" ");
			_yuanBox.appendTo(".dingDan_cha");
			_warning_cha_ding.appendTo(".dingDan_cha");
			$(".warning_cha_ding").removeClass("hidden").html("请至少填写一个查询条件").css({
				fontSize:"1.5rem",
				color:"red",
				lineHeight:"3rem",
				textAlign:"center"
			});
		}else{
			$.ajax({
			type: "get",
			url: "http://www.ccsc58.cc/tms/interface.php/home/order/select_bill",
			data: {
				token: _token,
				username: _user,
				accountnumber: _userZhanghao,
				getcity: _muDi_city
			},
			success: function(data) {
				//console.log(data);
				$(".dingDan_cha").html(" ");
				_yuanBox.appendTo(".dingDan_cha");
				_warning_cha_ding.appendTo(".dingDan_cha");
				if(data.msg == "暂无数据") {
					$(".warning_cha_ding").removeClass("hidden").html("未查到您需要的订单").css({
						fontSize:"1.5rem",
						color:"red",
						lineHeight:"3rem",
						textAlign:"center"
					});
				} else {
					$(".warning_cha_ding").addClass("hidden")
					for(var i = 0; i < data.result.length; i++) {
						var _dem = $(".dingDan_list").eq(0).clone().removeClass("hidden").appendTo(".dingDan_cha");
						_dem.find("p:nth-of-type(1) span").html(data.result[i].id);
						_dem.find("p:nth-of-type(2) span").html(data.result[i].accountnumber);
						_dem.find("p:nth-of-type(3) span").html(data.result[i].company);
						_dem.find("p:nth-of-type(4) span").html(data.result[i].ordertime);
					}
					$(".dingDan_list").on("click",function(){
						window.location.href = "dingDan_xiang.html?weiTuo=" + $(this).find("p:nth-of-type(1) span").html();
					});
				}
			},
			error:function(){
				alert("网络错误，请刷新页面")
			}
		});
		}
		
	});
	
} else {
	var _weiTuo = _url.match(/\?weiTuo=\S+/)[0].replace("?weiTuo=", "");
	//console.log(_weiTuo);
	$(".dingDan_back").on("click",function(){
		window.location.href="dingDan_xiang.html?weiTuo="+_weiTuo;
	});
	$(".huiFu").on("click",function(){
		window.location.href="dingDan_hui.php?weiTuo="+_weiTuo;
	})
	$.ajax({
		type:"get",
		url:"http://www.ccsc58.cc/tms/interface.php/home/order/order_detail",
		data:{
			token:_token,
			username:_user,
			id:_weiTuo
		},
		success:function(data){
			console.log(data);
			if(data.msg=="success"){
				$(".xiang_top p:nth-of-type(1) span").html(data.result.id);
				$(".xiang_top p:nth-of-type(2) span").html(_user);
				/*发件*/
				$(".faJian p:nth-of-type(1) span").html(data.result.entrydate);
				$(".faJian p:nth-of-type(2) span").html(data.result.ordertime);
				$(".faJian p:nth-of-type(3) span").html(data.result.entryname);
				$(".faJian p:nth-of-type(4) span").html(data.result.limittime);
				$(".faJian p:nth-of-type(5) span").html(data.result.manager);
				$(".faJian p:nth-of-type(6) span").html(data.result.department);
				$(".faJian p:nth-of-type(7) span").html(data.result.telephone);
				$(".faJian p:nth-of-type(8) span").html(data.result.company);
				$(".faJian p:nth-of-type(9) span").html(data.result.address);
				$(".faJian p:nth-of-type(10) span").html(data.result.cargoname);
				$(".faJian p:nth-of-type(11) span").html(data.result.jian+"件");
				/*收件*/
				$(".shouJian p:nth-of-type(1) span").html(data.result.getdepart);
				$(".shouJian p:nth-of-type(2) span").html(data.result.getcity);
				$(".shouJian p:nth-of-type(3) span").html(data.result.getarea);
				$(".shouJian p:nth-of-type(4) span").html(data.result.getcompany);
				$(".shouJian p:nth-of-type(5) span").html(data.result.getname);
				$(".shouJian p:nth-of-type(6) span").html("空");
				$(".shouJian p:nth-of-type(7) span").html(data.result.payway);
				$(".shouJian p:nth-of-type(8) span").html(data.result.takesname);
				$(".shouJian p:nth-of-type(9) span").html(data.result.issuingtime);
			}
		},
		error:function(){
			alert("网络错误，请刷新页面")
		}
	})
	$.ajax({
		type:"get",
		url:"http://www.ccsc58.cc/tms/interface.php/home/order/order_huifu",
		data:{
			token:_token,
			username:_user,
			id:_weiTuo
		},
		success:function(data){	
			console.log(data);
			if(data.msg=="success"){
				$(".hui_box p:nth-of-type(3) input").val(data.result.wdqj);
				$(".special_content").html(data.result.note1);
				$(".huiFu_baocun").on("click",function(){
					$.ajax({
						type:"post",
						url:"http://www.ccsc58.cc/tms/interface.php/home/order/order_reply",
						data:{
							token:_token,
							username:_user,
							id:_weiTuo,
							accountnumber:data.result.accountnumber,
							endcity:data.result.getcity,
							cargoname:data.result.cargoname,
							wdqj:data.result.wdqj,
							billnumber:$(".hui_box p:nth-of-type(2) input").val(),
							wendujibanhao:$(".hui_box p:nth-of-type(4) input").val(),
							a1:data.result.a1,
							a2:data.result.a2,
							a3:data.result.a3,
							b1:data.result.b1,
							b2:data.result.b2,
							b3:data.result.b3,
							note1:$(".special_content").html()
						},
						success:function(data1){
							if(data1.code=="10000"){
								alert("回复成功！");
								window.location.href="../index.html";
							}else{
								alert(data1.msg);
							};
						}
					})
				});
			}else if(data.code=="20001"){
				alert("此单已回复！");
				window.location.href="dingDan.html";
			}
		},
		error:function(){
			alert("网络错误，请刷新页面！")
		}
	});
};