jQuery(document).ready(function($) {

	//弹出框函数
	$("#success_mao .success_box form input").on("click", function() {
		$("#success_mao").css({
			display: "none"
		});
		$("#success_mao .success_box").css({
			display: "none"
		});
	})

	function myPlay(play) {
		if(play != "") {
			$("#success_mao .success_box .success_information").html(play);
			$("#success_mao").css({
				display: "block"
			});
			$("#success_mao .success_box").show(500);
		}
	}
	//myPlay(1)
	/*
	 * 登录页面函数；
	 * 2017/7/18
	 * 毛人杰；
	 * */

	$(".cd-form input[type=button]").on("click", function() {
		var _user = $("#signin-username").val();
		var _passWord = $("#signin-password").val();
		if(_user == "" || _passWord == "") {
			myPlay("用户名或密码不能为空")
		} else {
			$.ajax({
				type: "post",
				url: "http://www.ccsc58.cc/tms/interface.php/home/index/login",
				data: {
					username: _user,
					password: _passWord
				},
				success: function(data) {
					if(data.msg=="success"){
						window.localStorage.setItem("LYtoken",data.result.token);
						window.localStorage.setItem("LYuser",data.result.username)
						window.location.href="index.html";
						//myPlay("登录成功");
					}else{
						myPlay("用户名或密码错误");
					}
				}
			});
		}
	});
});