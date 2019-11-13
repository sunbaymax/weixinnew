var _token = window.localStorage.getItem("LYtoken");
var _user = window.localStorage.getItem("LYuser");
var _url = window.location.href;
/*调整查看运单状态下拉框*/
$(".yunDan_zhuangtai p").on("click", function() {
	if($(this).next().height() == 0) {
		$(this).next().css({
			height: "27rem"
		});
		$(this).find("img").attr("src", "../img/shang.png")
	} else {
		$(this).next().css({
			height: "0rem"
		});
		$(this).find("img").attr("src", "../img/xia.png")
	}
});
/*运单列表*/
if(_url.indexOf("?") == -1) {
	var _zhuangTai = $(".yunDan_zhuangtai p span").html().replace("状态：", "");
	my_yunDan(_zhuangTai);

	function my_yunDan(a) {
		$(".warning_yunDan").addClass("hidden");
		var _yuan = $(".yunDan_list").eq(0).clone();
		$(".yunDan_list").remove();
		_yuan.appendTo(".yunDan_content");
		$.ajax({
			type: "get",
			url: "http://www.ccsc58.cc/tms/interface.php/home/Transport/index",
			data: {
				token: _token,
				username: _user,
				condition: a
			},
			success: function(data) {
				if(data.msg == "success" && data.result != "") {
					for(var i = 0; i < data.result.length; i++) {
						var _dem = $(".yunDan_list").eq(0).clone().removeClass("hidden").appendTo(".yunDan_content");
						_dem.find("p:nth-of-type(1) span").html(data.result[i].billnumber);
						_dem.find("p:nth-of-type(2) span").html(data.result[i].accountnumber);
						_dem.find("p:nth-of-type(3) span").html(data.result[i].sendsname);
						_dem.find("p:nth-of-type(4) span").html(data.result[i].indate);
					}
				} else {
					$(".warning_yunDan").html("未发现" + a + "的运单");
					$(".warning_yunDan").removeClass("hidden");
				};
				$(".yunDan_list").on("click", function() {
					window.location.href = "yunDan_xiang.html?yunDan=" + $(this).find("p:nth-of-type(1) span").html();
				});
			},
			error: function() {
				alert("网络错误，刷新网页重试")
			}
		})
	}

	$(".yunDan_zhuangtai ul li").on("click", function() {
		$(".yunDan_zhuangtai p span").html("状态：" + $(this).html());
		$(this).parent().css({
			height: "0rem"
		});
		$(".yunDan_zhuangtai p img").attr("src", "../img/xia.png");
		my_yunDan($(this).html());
	});
} else {
	var _yunDan, _keHuZhangHao;
	if(_url.indexOf("&") == -1) {
		_yunDan = _url.match(/\?yunDan=\S+/)[0].replace("?yunDan=", "");
	} else {
		_keHuZhangHao = _url.match(/\&keHuZhangHao=\S+/)[0].replace("&keHuZhangHao=", "");
		_yunDan = _url.match(/\?yunDan=\S+\&/)[0].replace("?yunDan=", "").replace("&", "");
		/*入库返回运单详情*/
		$(".ruKu_back").on("click", function() {
			window.location.href = "yunDan_xiang.html?yunDan=" + _yunDan;
		});
		/*入库信息*/
		$(".ruKu_BaoCun").on("click", function() {
			$.ajax({
				type: "post",
				url: "http://www.ccsc58.cc/tms/interface.php/home/Transport/select_ruku",
				data: {
					token: _token,
					username: _user,
					billnumber: _yunDan,
					thcar: $(".ruKu_xiangcontent p:nth-of-type(2) input").val(),
					thname: $(".ruKu_xiangcontent p:nth-of-type(3) input").val()
				},
				success: function(data) {
					console.log(data);
				}
			});
		})
	}

	/*入库代码(弹窗)*/
	$(".ruKu").on("click", function() {
		$(".yunDan_tanChuang").removeClass("hidden");
	});
	$(".tanChuang_bottom div:nth-of-type(1)").on("click", function() {
		$(".yunDan_tanChuang").addClass("hidden");
	});
	$(".tanChuang_bottom div:nth-of-type(2)").on("click", function() {
		$(".yunDan_tanChuang").addClass("hidden");
		window.location.href = "ruKu.html?yunDan=" + _yunDan + "&keHuZhangHao=" + $(".yunDan_xiangcontent p:nth-of-type(6) input").val();
	});
	$(".ruKu_xiangcontent p:nth-of-type(1) input").val(_yunDan);

	/*补录页面入口*/
	$(".buLu").on("click", function() {
		window.location.href = "yunDan_BuLu.html?yunDan=" + _yunDan;
	});
	//运单详情接口；
	$.ajax({
		type: "get",
		url: "http://www.ccsc58.cc/tms/interface.php/home/Transport/select_bill",
		data: {
			token: _token,
			username: _user,
			billnumber: _yunDan
		},
		success: function(data) {
			$(".yunDan_xiangcontent p:nth-of-type(1) input").val(data.result.id);
			$(".yunDan_xiangcontent p:nth-of-type(2) input").val(data.result.condition);
			//console.log(data.result.condition);
			if(data.result.condition == "进港通知完成" || data.result.condition == "订单补录完成") {
				$(".ruKu").removeClass("hidden");
			} else {
				$(".ruKu").addClass("hidden");
			}
			$(".yunDan_xiangcontent p:nth-of-type(3) input").val(data.result.cynumber);
			$(".yunDan_xiangcontent p:nth-of-type(4) input").val(data.result.cyno);
			$(".yunDan_xiangcontent p:nth-of-type(5) input").val(_yunDan);
			$(".yunDan_xiangcontent p:nth-of-type(6) input").val(data.result.accountnumber);
			$(".yunDan_xiangcontent p:nth-of-type(7) input").val(data.result.wayout);
			$(".yunDan_xiangcontent p:nth-of-type(8) input").val(data.result.cycompany);
			$(".yunDan_xiangcontent p:nth-of-type(9) input").val(data.result.entrytime);
			$(".yunDan_xiangcontent p:nth-of-type(10) input").val(data.result.entryname);
		},
		error: function() {
			alert("网络错误，请刷新网络");
		}
	});
	/*运单补录接口*/
	$.ajax({
		type: "get",
		url: "http://www.ccsc58.cc/tms/interface.php/home/Transport/index_up",
		data: {
			token: _token,
			username: _user,
			billnumber: _yunDan
		},
		success: function(data) {
			/*账单信息*/
			$(".yunDanBuLu .zhangDan p:nth-of-type(1) input").val(_yunDan);
			$(".yunDanBuLu .zhangDan p:nth-of-type(2) input").val(data.result.accountnumber);
			$(".yunDanBuLu .zhangDan p:nth-of-type(3) input").val(data.result.limittimes);
			$(".yunDanBuLu .zhangDan p:nth-of-type(4) input").val(data.result.taketime);
			/*发件信息*/
			$(".yunDanBuLu .faJian p:nth-of-type(1) input").val(data.result.sendsname);
			$(".yunDanBuLu .faJian p:nth-of-type(2) input").val(data.result.sendstelephone);
			$(".yunDanBuLu .faJian p:nth-of-type(3) input").val(data.result.sendscompany);
			$(".yunDanBuLu .faJian p:nth-of-type(4) input").val(data.result.sendsdepart);
			$(".yunDanBuLu .faJian p:nth-of-type(5) input").val(data.result.sendscity);
			$(".yunDanBuLu .faJian p:nth-of-type(6) input").val(data.result.sendsarea);
			$(".yunDanBuLu .faJian p:nth-of-type(7) input").val(data.result.sendsroule);
			$(".yunDanBuLu .faJian p:nth-of-type(8) input").val(data.result.sendsaddress);
			/*收件信息*/
			$(".yunDanBuLu .shouJian p:nth-of-type(1) input").val(data.result.getname);
			$(".yunDanBuLu .shouJian p:nth-of-type(2) input").val(data.result.gettelephone);
			$(".yunDanBuLu .shouJian p:nth-of-type(3) input").val(data.result.getcompany);
			$(".yunDanBuLu .shouJian p:nth-of-type(4) input").val(data.result.getdepart);
			$(".yunDanBuLu .shouJian p:nth-of-type(5) input").val(data.result.getcity);
			$(".yunDanBuLu .shouJian p:nth-of-type(6) input").val(data.result.getarea);
			$(".yunDanBuLu .shouJian p:nth-of-type(7) input").val(data.result.getroule);
			$(".buLu_Bao").on("click", function() {
				$.ajax({
					type: "post",
					url: "http://www.ccsc58.cc/tms/interface.php/home/Transport/makeup",
					data: {
						Token: _token,
						username: _user,
						takenote: _yunDan,
						accountnumber: data.result.accountnumber,
						limittime: $(".yunDanBuLu .zhangDan p:nth-of-type(3) input").val(),
						taketime: $(".yunDanBuLu .zhangDan p:nth-of-type(4) input").val(),
						sendsname: $(".yunDanBuLu .faJian p:nth-of-type(1) input").val(),
						sendstelephone: $(".yunDanBuLu .faJian p:nth-of-type(2) input").val(),
						sendscompany: $(".yunDanBuLu .faJian p:nth-of-type(3) input").val(),
						sendsdepart: $(".yunDanBuLu .faJian p:nth-of-type(4) input").val(),
						sendscity: $(".yunDanBuLu .faJian p:nth-of-type(5) input").val(),
						sendsarea: $(".yunDanBuLu .faJian p:nth-of-type(6) input").val(),
						sendroule: $(".yunDanBuLu .faJian p:nth-of-type(7) input").val(),
						sendsaddress: $(".yunDanBuLu .faJian p:nth-of-type(8) input").val(),
						getname: $(".yunDanBuLu .shouJian p:nth-of-type(1) input").val(),
						gettelephone: $(".yunDanBuLu .shouJian p:nth-of-type(2) input").val(),
						getcompany: $(".yunDanBuLu .shouJian p:nth-of-type(3) input").val(),
						getdepart: $(".yunDanBuLu .shouJian p:nth-of-type(4) input").val(),
						getcity: $(".yunDanBuLu .shouJian p:nth-of-type(5) input").val(),
						getarea: $(".yunDanBuLu .shouJian p:nth-of-type(6) input").val(),
						getroule: $(".yunDanBuLu .shouJian p:nth-of-type(7) input").val(),
						getaddress: $(".yunDanBuLu .shouJian p:nth-of-type(8) input").val(),
						/*是否投保: safeitem:,
						投保金额: safemoney:,
						包装前件数: number:,
						重要描述: attention
						温度编号：wendubianhao
						实际重量：aweight*/
					},
					success: function(data01) {
						console.log(data01);
					}
				});
			})
		},
		error: function() {
			alert("网络错误，请刷新网页");
		}
	});
	$(".buLu_back").on("click", function() {
		window.location.href = "yunDan_xiang.html?yunDan=" + _yunDan;
	});
}