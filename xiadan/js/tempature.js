$(function() {
	var frame = true;
	toastr.options = {
		timeOut: "3000",
		positionClass: "toast-center-center"
	};
	init_wdqj();
	var wdqjstr = '';

	function unScroll() {
		var top = $(document).scrollTop();
		$(document).on('scroll.unable', function(e) {
			$(document).scrollTop(top);
		})
	}
	$(".zibeixiang").on("click", function() {
		var wen = JSON.parse(localStorage.getItem('wen'))||'';
		var arr = JSON.parse(localStorage.getItem("wenArr"));
		if(wen.wdqj){
			delete wen.wdqj //true
		}
		localStorage.setItem("wen", JSON.stringify(wen));
		//		wen.delete(wdqj)
		//		console.log(wen);
		window.localStorage.removeItem('wenArr');
		window.localStorage.setItem('IsZJ', 0);
		window.location.href = "provided_box.html";
	})

	function init_wdqj() {
		$.ajax({
			url: "http://out.ccsc58.cc/DATA_PORT_WEIXIN_1.01/Wdqj.php",
			type: 'post',
			data: {
				state: "wdqj"
			},
			dataType: "json",
			success: function(res) {
				$.each(res.data, function(i, item) {
					wdqjstr = `<p>${item.WDQJ}</p>`;
					$('.wenTan .wdqj').append(wdqjstr);
				});

			}

		})
	}

	// window.onload = function(){
	if(JSON.parse(localStorage.getItem("wen"))) {
		var wen = JSON.parse(localStorage.getItem('wen'));
		var arr = JSON.parse(localStorage.getItem("wenArr"));
		var li = arr;
		if(arr == null) {
			//data为空数组时，要执行的代码
			$(".wenduValue").next().hide();
			$(".wenqj").next().show();
			$(".jiantou").show();
			$(".wenqj").val(wen.wdqj).css("text-align", "right"); // 温度区间
			// $(".huan").html(wen.bchj); // 保存环境
			$(".ming").val(wen.cargoname); // 货物名称
			$("#beizh").val(wen.note); // 备注
			$(".countnum").val(wen.Acount); // 账号
			//var span2 = `<li style='height:auto;'><span>箱子容积</span><span>件数</span></li>`;
			//			for(let i = 0; i < li.length; i++) { // 所需容积
			//				var span = $(
			//					`<li style='height:auto;'><span class='rongji' >${li[i].PackageName}</span><span class='shuli'>${li[i].Num}</span></li>`
			//				);
			//				$(".ewrq").append(span);
			//			}
			//不使用温度计
			if(wen.iswdj == "不使用") {
				$('#checkbox_c1').attr("checked", false);
			} else {
				$('#checkbox_c1').attr("checked", true);

			}
		} else {
			$(".wenduValue").next().hide();
			$(".wenqj").next().hide();
			$(".jiantou").hide();
			$(".wenqj").val(wen.wdqj).css("text-align", "right"); // 温度区间
			// $(".huan").html(wen.bchj); // 保存环境
			$(".ming").val(wen.cargoname); // 货物名称
			$("#beizh").val(wen.note); // 备注
			$(".countnum").val(wen.Acount); // 账号
			var span2 = `<li style='height:auto;'><span>箱子容积</span><span>件数</span></li>`;
			for(let i = 0; i < li.length; i++) { // 所需容积
				var span = $(
					`<li style='height:auto;'><span class='rongji' >${li[i].PackageName}</span><span class='shuli'>${li[i].Num}</span></li>`
				);
				$(".ewrq").append(span);
			}
			//不使用温度计
			if(wen.iswdj == "不使用") {
				$('#checkbox_c1').attr("checked", false);
			} else {
				$('#checkbox_c1').attr("checked", true);

			}
		}

		//				$.ajax({
		//					url: "http://www.ccsc58.cc/zjlytms/api.php/Order/ajax",
		//					type: "post",
		//					data: {
		//						wdqj: $(".wenqj").val(),
		//						state: 2
		//					},
		//					dataType: "JSON",
		//					success: function(res) {
		//						var dataArr = [];
		//						res.forEach(item => {
		//							dataArr.push(
		//								'<span class="ni" id="' + item.id + '">', item.bcname,
		//								'</span>'
		//							)
		//						});
		//						$(".fasf").html(dataArr.join(''));
		//					},
		//					error: function(err) {
		//						console.log(失败);
		//					}
		//				})
	}
	//		        else {}
	// }

	//点击上一步
	//	$("nav .return").on('click', function() {
	//		window.location.href = "../login.html";
	//		//				window.history.go(-1);
	//	})
	$(document).on('click', '.return', function() {
		window.location.href = "../login.html";
	});
	//        点击温度要求
	$(".wendu").on('click', function() {
		$(".wenTan").show();
	})
	//  点击温度区间
	var top = $(document).scrollTop();
	$('.wenTan').blur(function() {
		$(document).unbind("scroll.unable");
	});
	$("body").on('click', ".wenTan .wdqj p", function() {
		//				unScroll();
		$(".wenTan").hide();
		$(".jiantou").show();
		var wdqj = $(this).html();
		$(".Children .ewrq").html("");
		//				$(this).parents('li').css("heigth":"45px")
		$.ajax({
			url: "http://out.ccsc58.cc/DATA_PORT_WEIXIN_1.01/Wdqj.php",
			type: "post",
			data: {
				WDQJ: wdqj,
				state: "box"
			},
			dataType: "JSON",
			success: function(res) {
				var dataArr = [];
				var huanjing = {
					"0℃~30℃": "常温",
					"15℃~25℃": "阴凉",
					"-25℃~-15℃": "低温",
					"2℃~8℃": "冷藏",
					"-78℃~-20℃": "干冰"
				};
				$(".huan").html(huanjing[wdqj]);
				$('.wenqj').val(wdqj).css("text-align", "right");
				$(".wenqj").next().hide();
				res.data.forEach(item => {
					dataArr.push(
						'<span class="ni" >', item.PackageType,
						'</span>'
					)
				});
				$(".fasf").html(dataArr.join(''));

			},
			error: function(err) {
				console.log(失败);
			}
		})
	})
	// 点击所需容积
	var isRongji = true;

	function rongji() {
		var wen = $(".wenqj").val();
		if(wen == "") {
			isRongji = false;
			toastr.error("请选择温度要求");
			window.setTimeout(function() {
				isRongji = true
			}, 3000);
		} else {
			$(".rongjiTan").show();
			$(".rongj").show();
			$(".fdasfs").hide();
			$(".fasf span").attr("class", "ni");
		}
	}
	$(".rongji").on('click', function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
		if(isRongji) {
			rongji();
		}
	})

	// 点击容积
	$("body").on("click", ".fasf span", function() {
		if($(this).attr("class") == "ni") {
			$(this).attr("class", "spanActive");
		} else if($(this).attr("class") == "spanActive") {
			$(this).attr("class", "ni");
		}
	})
	// 点击所需容积中的下一步
	function rongNext() {
		var dataSpan = $(".fasf span[class=spanActive]");
		if(dataSpan.length == 0) {
			isRongji = false;
			window.setTimeout(() => {
				isRongji = true
			}, 3000);
			toastr.error("请选择箱子容积");
		} else if(dataSpan.length > 3) {
			isRongji = false;
			window.setTimeout(() => {
				isRongji = true
			}, 3000);
			toastr.error("所选箱子不能超过3个");
		} else {
			var span2 = `<li style='height:auto;'><span>箱子容积</span><span>件数</span></li>`;
			$(".rongj").hide();
			for(let i = 0; i < dataSpan.length; i++) {
				var li = $("<li><span><span class='sheng' id='" + dataSpan[i].id + "'>" + dataSpan[i].textContent +
					"</span></span><input type='number' class='box_numbsers' style='border:1px solid #ccc;text-align:center;'></li>"
				);
				$(".rongNum").append(li);

			}
			$(".rongNum li:first-of-type").before(span2);
			$(".deep").show();
		}
	}
	$(".nextNum span").on("click", function() {
		if(isRongji) {
			rongNext();
		}
	})
	// 点击所需容积  数量中的确认

	var aBool = true; //用来记录以后有没填的项目
	var isOrd = true; // 判断重复点击
	//所属容积的 添好数量的 “确定” 按钮
	$(".rongque span").click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
		aBool = true; //表示填好了
		$(".rongNum li input").each(function() {
			if(typeof $(this).val() == 'undefined' || $(this).val() == '') {
				aBool = false;
			}
		});
		if(isOrd) {
			rongQu();
		}
	})
	//确定里的循环便利判断
	function rongQu() {
		if(aBool) {
			$(".ewrq").html("");
			var li = $(".rongNum li .sheng");
			var input = $(".rongNum li input");
			for(var i = 0; i < li.length; i++) {
				var span = $("<li style='height:auto;'><span class='rongji' id='" + li[i].id + "'>" + $(
						li[i]).text() + "</span><span class='shuli'>" + $(input[i]).val() +
					"</span></li>");
				$(".ewrq").append(span);
			}

			$(".jiantou").hide();
			$(".rongNum").html("");

			$(".rongjiTan").hide();
			$('body,html').animate({
				scrollTop: 0
			}, 1000);
		} else {

			isOrd = false;
			setTimeout(() => {
				isOrd = true
			}, 3000);
			toastr.error("请输入数量");
		}
	}
	// 点击温度计

	function rongClick() {
		if($(".wenqj").val() == "") {
			isRongji = false;
			window.setTimeout(() => {
				isRongji = true
			}, 3000);
			toastr.error("请选择温度要求");
		} else {
			$(".wenlei span").attr("class", "");
			$(".dujiTan").show();
			$(".afsda").show();
			$(".wenduNum").hide();

		}
	}
	$(".wenduji").on('click', function() {
		if(isRongji) {
			rongClick();
		}
	})
	// 点击温度计下的类型
	$(".wenlei span").on("click", function() {
		if($(this).html() == "不使用温度计") {
			//              $(".wenduValue").next().hide();
			//              $(".wenduValue").html($(this).html());
			//              $(".dujiTan").hide();
			//====================
			$(".wdj").html("");
			var li = $(".wendujiNum li .wdjtype");
			var input = $(".wendujiNum li input");
			//"<li style='height:auto;'><span class='wenduji'>不使用温度计</span><span class='shuli'></span></li>"
			var span = $("<li style='height:auto;'><span class='wenduji'>不使用温度计</span></li>");
			$(".wdj").append(span);
			$(".wdjfh").hide();
			$(".wendujiNum").html("");
			$(".dujiTan").hide();
			//====================
		} else {
			//原来的
			//              $(".wenxing").html($(this).html());
			if($(this).attr("class") == "") {
				$(this).attr("class", "spanActive");
			} else if($(this).attr("class") == "spanActive") {
				$(this).attr("class", "");
			}
		}

	})
	// 点击温度计弹框中的下一步  选择数量
	$(".temNext").on("click", function() {
		wdjnxt();
	})
	//温度计里的下一步
	function wdjnxt() {
		let len = $(".wenlei span[class=spanActive]");
		if(frame) {
			if(len.length != 0) {
				//新添 移除方法
				$(".wendujiNum").empty();
				//              console.log($(".wenlei span[class=spanActive]"))
				for(let i = 0; i < len.length; i++) {
					let li1 = $("<li style='height:auto;'><span class='wdjtype'>" + len[i].innerHTML +
						"</span>&nbsp;件数：<input type='number' style='border:1px solid #ccc;text-align:center;' class='box_numbsers'></li>"
					);
					$(".wendujiNum").append(li1);
				}
				$(".afsda").hide();
				$(".wenduNum").show();
			} else {
				frame = false;
				setTimeout(function() {
					frame = true;
				}, 3000)
				toastr.error("请选择温度计");
			}
		}
	}
	
    

	//点击温度计里的数量的确定按钮

	//温度计里的确定按钮
	function determine() {
		if(aBool) {
			$(".wdj").html("");
			var li = $(".wendujiNum li .wdjtype");
			var input = $(".wendujiNum li input");
			for(var i = 0; i < li.length; i++) {
				var span = $("<li style='height:auto;'><span class='wenduji'>" + $(
						li[i]).text() + "</span><span class='shuli'>" + $(input[i]).val() +
					"</span></li>");
				$(".wdj").append(span);
			}

			$(".wdjfh").hide();
			$(".wendujiNum").html("");
			$(".dujiTan").hide();
		} else {

			isOrd = false;
			setTimeout(() => {
				isOrd = true
			}, 3000);
			toastr.error("请输入数量");
		}
	}
	//新 点击确按钮 温度计
	$('.wenQue').on('click', function() {
		aBool = true; //表示填好了
		let ipt = $(".wendujiNum li input");
		//			console.log(ipt);
		$(".wendujiNum li input").each(function() {
			if(typeof $(this).val() == 'undefined' || $(this).val() == '') {
				aBool = false;
			}
		});
		if(isOrd) {
			determine();
		}
	})
	//        点击弹框消失
	$(".yin").on('click', function() {
		$(".fda").hide();
		$(".rongNum").html("");
	})
	//点击下一步
	$(".next").on('click', function() {

		if(frame) {
			nexts();
		}
	});
	//下一步的判断
	function nexts() {
		if($(".countnum").val() == "" || $(".countnum").val() == null) {
			frame = false;
			setTimeout(function() {
				frame = true;
			}, 3000)
			toastr.error("请输入客户账号");
		} else if($(".wenqj").val() == "" || $(".wenqj").val() == null) {
			frame = false;
			setTimeout(function() {
				frame = true;
			}, 3000)
			toastr.error("请输入温度要求");
		} else if($(".ming").val() == "" || $(".ming").val() == null) {
			frame = false;
			setTimeout(function() {
				frame = true;
			}, 3000)
			toastr.error("请输入货物名称");
		} else if($(".ewrq").html() == "" || $(".ewrq").html() == null) {
			frame = false;
			setTimeout(function() {
				frame = true;
			}, 3000)
			toastr.error("请输入所属容积");
		} else {
			fdsafs();
		}
	}

	function fdsafs() {
		var isty = [];
		var isnu = [];
		var isw;
		if($(".iswenduji").is(":checked")) {
			isw = "使用";
		} else {
			isw = "不使用";
		} //温度上限是否开启；
		//      	var isw ;
		//				if($(".wenduValue ul li .wenduji ").text() == "不使用温度计") {
		//					var isw = 0;
		//					isty = '';
		//					isnu = '';
		//				} else {
		//					isw = 1;
		//					//温度计
		//					for(let i = 0; i < $(".wdj li").length; i++) {
		//						isty.push($(".wdj li span[class='wenduji']")[i].innerHTML);
		//						isnu.push($(".wdj li span[class='shuli']")[i].innerHTML);
		//					}
		//				}
		//				console.log(isw);
		//				console.log(isty);
		//				console.log(isnu);

		var dui = {};
		var arr1 = [];
		//          console.log(arr1);
		for(let i = 0; i < $(".ewrq li").length; i++) {
			//					var rongji = $(".ewrq li span[class='rongji']")[i].id;//以前是id
			var rongji = $(".ewrq li span[class='rongji']")[i].textContent;
			var shu = $(".ewrq li span[class='shuli']")[i].textContent;
			dui[rongji] = shu;
		}
		arr1.push(dui);

		var wenArr = [];
		//          console.log(wenArr);
		for(let i = 0; i < $(".ewrq li").length; i++) {
			var obje = {};
			obje.PackageName = $(".ewrq li span[class='rongji']")[i].textContent;
			obje.Num = $(".ewrq li span[class='shuli']")[i].textContent;
			wenArr.push(obje);
		}

		var obj = {
			Acount: $(".countnum").val(),
			wdqj: $(".wenqj").val(),
			bchj: $(".huan").html(),
			cargoname: $(".ming").val(), // 货物名称
			bcnum: arr1, // 所需容积
			iswdj: isw, // 是否使用温度计
			//					wdjtype: isty, // tp温度计  u盘温度计  
			//					wdjnum: isnu, // 温度计数量
			note: $("#beizh").val() // 备注
		};

		localStorage.setItem("wen", JSON.stringify(obj));
		localStorage.setItem("wenArr", JSON.stringify(wenArr));
		if(JSON.parse(localStorage.getItem('zxdxs'))) {
			localStorage.removeItem('zxdxs');
		}
		var newAcount = $(".countnum").val();
		if(JSON.parse(localStorage.getItem('Acount'))) {
			var Acount = localStorage.getItem('Acount');
			if(Acount == newAcount) {
				window.location.href = "ordertake.html";
			} else {
				window.localStorage.removeItem('orderMsg');
				window.localStorage.removeItem('sjorderMsg');
				window.localStorage.removeItem('fjorderMsg');
				window.localStorage.setItem("Acount", newAcount);
				window.location.href = "ordertake.html";
			}
		} else {
			window.localStorage.setItem("Acount", newAcount);
			window.location.href = "ordertake.html";
		}

	};
	//历史订单
	$('.title_history_img').on("click", function() {
		var r = confirm("确认是否注销登录！");
		if(r == true) {
			//				  	window.localStorage.removeItem("fjorderMsg");
			//				  	window.localStorage.removeItem("myNum");
			//				  	window.localStorage.removeItem("orderMsg");
			//				  	window.localStorage.removeItem("phone");
			//				  	window.localStorage.removeItem("sjorderMsg");
			//				  	window.localStorage.removeItem("wen");
			//				  	window.localStorage.removeItem("wenArr");
			window.localStorage.clear();
			window.close();
			WeixinJSBridge.call("closeWindow");

		} else {
			console.log("取消注销");
		}

	})
	$("#beizh").blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	$("#checkbox_c1").blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	$(".ming").blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	$("#beizh").blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	$(document).delegate("input", "keyup", function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	

})