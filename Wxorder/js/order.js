$(function() {

	window.alert = function(name) {
		var iframe = document.createElement("IFRAME");
		iframe.style.display = "none";
		iframe.setAttribute("src", 'data:text/plain,');
		document.documentElement.appendChild(iframe);
		window.frames[0].window.alert(name);
		iframe.parentNode.removeChild(iframe);
	}

	localStorage.setItem('state', 'show')
	var _account = localStorage.getItem('Acount');
	var _tel = localStorage.getItem('Telphone');
	localStorage.removeItem('Inmain')
	var _openid = localStorage.getItem('openid');

	if(sessionStorage.getItem('order')) {
		var hisorder = JSON.parse(sessionStorage.getItem('order'));
		$("#Goodstypes").text(hisorder.BusinessType);
		$("#goodname").val(hisorder.CargoName);
		//		$("#Temparea").text(hisorder.WDQJ);
		//		if(hisorder.Box.length >= 2) {
		//			$('.childbox').remove();
		//			$('.fatherbox .choosewenqu .gw_num').removeClass('hide');
		//			$(hisorder.Box).each(function(index, value) {
		//				if(index != 0) {
		//					let str = `<li class="childbox orderbox">
		//							<div>
		//								<img src="../img/box.png" class="img_temp" />
		//							</div>
		//							<div class="choosewenqu">
		//								<label class="clickbox boxinput Cchildbox">${value.PackageName}</label>
		//								<img src="../img/delbox.png" class="delbox" />
		//								<p class="gw_num">
		//									<img src="../img/reduce.png" class="jian" />
		//									<input type="text" value="1" class="num" readonly="readonly" />
		//									<img src="../img/addbox.png" class="add" />
		//								</p>
		//							</div>
		//						</li>`;
		//					$('.fatherbox').after(str);
		//				} else {
		//					$(".fatherbox #BoxType").text(value)
		//				}
		//			});
		//		} else {
		//			$(".fatherbox #BoxType").text(chooseBoxTxt)
		//			$('.fatherbox .choosewenqu .gw_num').removeClass('hide');
		//			$('.childbox').each(function() {
		//				$(this).remove();
		//			});
		//		}
		if(hisorder.Name4 == "使用") {
			$(".uiswitch").attr("checked", true);
		} else {
			$(".uiswitch").attr("checked", false);;
		}

		$("#ChooseTimes").text(hisorder.OrderTime);
		$(".note .time-right textarea").val(hisorder.Note);
	}

	//check();
	function check() {
		$.ajax({
			url: "http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/OrderShow.php",
			type: "post",
			async: true,
			data: {
				Telephone: _tel,
				AccountNumber: _account
			},
			dataType: "json",
			success: function(res) {
				console.log(res.code);
				localStorage.removeItem('SendaddData');

				if(res.code == '300') {

					var r = confirm("请先进行寄件信息录入")
					if(r == true) {
						location.href = 'InfoInput.html'
					} else {
						console.log(res)
					}
				} else if(res.code == "200") {
					$('#send_username').text(res.data.Name);
					$('#send_tel').text(res.data.Telephone);
					$('#send_address').text(res.data.Depart + " " + res.data.City + " " + res.data.Area + " " + res.data.Address);
					var addData = {
						addressname: res.data.Name,
						addresstel: res.data.Telephone,
						address: res.data.Depart + " " + res.data.City + " " + res.data.Area + " " + res.data.Address,
						addressaccount: res.data.AccountNumber,
						company: res.data.Company
					};

					localStorage.setItem('SendaddData', JSON.stringify(addData));
					//location.reload();

					//					setTimeout(function() {
					//                    window.location.href="order.html?r="+Math.ceil(Math.random()*10); 
					//					}, "1000");

				} else {
					console.log("123")
				}
			},
			error: function(err) {
				console.log(err)
			}
		})
	}
	if(_account == null) {
		window.location.href = '../OldLogin.html?openid=' + _openid;
		return false;
	}

	if(JSON.parse(localStorage.getItem('wxobject'))) {
		var wxobject = JSON.parse(localStorage.getItem('wxobject'));
		var touxiangImg = wxobject.touxing;
		var nickname = wxobject.nickname;
	}

	if(touxiangImg != '' || touxiangImg != null) {
		$('.menu_footer .touxiang').attr('src', touxiangImg)
	}
	if(nickname != '' || nickname != null) {
		$('.menu_footer .turename').text(nickname)
		$('.menu_footer .turetel').text(_tel)
	}

	if($('#Goodstypes').text() == '请选择货物类型' && $('#Temparea').text() == '请选择温区' && $('#BoxType').text() == '请选择箱型' && $('#ChooseTimes').text() == '预约取件时间') {
		$('.btndiv button').attr('disabled', true);
	} else {
		$('.btndiv button').attr('disabled', false);
	}

	$('header label .acount').text(_account);

	//新增账号
	$('.acountlist .send button').on("click", function() {
		sessionStorage.setItem('Acount', _account);
		sessionStorage.setItem('yemian', "order");
		localStorage.setItem('state', 'xinzeng');
		location.href = '../MobileBind.html?openid=' + _openid
	})
	//点击账号切换
	$('body').on("click", ".acountlist .send li", function() {
		console.log($(this).text());
		localStorage.setItem('Acount', $(this).text());
		localStorage.removeItem('SendaddData');

		$.ajax({
			url: "http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/OrderShow.php",
			type: "post",
			data: {
				Telephone: _tel,
				AccountNumber: $(this).text()
			},
			dataType: "json",
			success: function(res) {
				if(res.code == '300') {
					//					var r = confirm("请先进行寄件信息录入")
					//					if(r == true) {
					//						location.href = 'InfoInput.html'
					//					} else {
					console.log(res)
					location.reload();
					//					}
				} else if(res.code == "200") {

					var addData = {
						id: res.data.ID,
						addressname: res.data.Name,
						addresstel: res.data.Telephone,
						address: res.data.Depart + " " + res.data.City + " " + res.data.Area + " " + res.data.Address,
						addressaccount: res.data.AccountNumber,
						company: res.data.Company
					};

					localStorage.setItem('SendaddData', JSON.stringify(addData));
					window.location.href = "order.html?r=" + Math.ceil(Math.random() * 10);
				} else {
					console.log("123")
				}
			},
			error: function(err) {
				console.log(err)
			}
		})

	})

	$("header label").on('click', function() {
		$('.acountlist .send .acounts').html('');
		$('.acountlist').toggle();
		var Acountlists = '';
		$.ajax({
			type: "post",
			url: "http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/Login.php",
			async: true,
			data: {
				OpenId: _openid,
				State: "show"
			},
			dataType: "json",
			success: function(res) {
				if(res.code == '400') {
					location.href = '../MobileBind.html?openid=' + _openid;
					localStorage.clear();
				}
				$.each(res.data.AccountNumber, function(index, value) {
					Acountlists = '<li>';
					Acountlists += value;
					Acountlists += '</li>';
					$('.acountlist .send .acounts').append(Acountlists);
				});

			},
			error: function(err) {
				console.log(err)
			}
		});
	})
	toastr.options = {
		timeOut: "3000",
		positionClass: "toast-center-center"
	};

	function GetDateStr(AddDayCount) {
		var dd = new Date();
		dd.setDate(dd.getDate() + AddDayCount); //获取AddDayCount天后的日期
		var y = dd.getFullYear();
		var m = dd.getMonth() + 1; //获取当前月份的日期
		var d = dd.getDate();
		return y + "-" + m + "-" + d;
	}
	var date = [GetDateStr(0), GetDateStr(1), GetDateStr(2)];
	var currtime = [];
	var d = new Date();

	var currhour = d.getHours();
	if(currhour < 0 || currhour > 24) {
		currtime = ['无效时间']
	} else if(currhour >= 0 && currhour < 24) {
		currtime = ['2小时上门', '8:30-10:30', '10:30-12:30', '12:30-14:30', '14:30-16:30', '16:30-17:30']
	} else {
		currtime = ['非正常预约时间'];
	}
	$(".TimeType .TimeType-Ways .qi").each(function(key, index) {
		$(this).text(date[key]);
	});
	$(currtime).each(function(key, index) {
		let str = '<span class="ni">';
		str += index;
		str += '</span>';
		$('.TimeType-datetime').append(str);
	});

	var telephone = localStorage.getItem('Telephone');
	if(JSON.parse(localStorage.getItem('SendaddData'))) {
		var _ChoseaddData = JSON.parse(localStorage.getItem('SendaddData'));
		var _ChaddreType = localStorage.getItem('ChaddreType');
		$(".Noexistsend").hide();
		$(".existsend").show();
		$('#send_username').text(_ChoseaddData.addressname);
		$('#send_tel').text(_ChoseaddData.addresstel);
		$('#send_address').text(_ChoseaddData.address);
	} else {
		$.ajax({
			url: "http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/OrderShow.php",
			type: "post",
			async: true,
			data: {
				Telephone: _tel,
				AccountNumber: _account
			},
			dataType: "json",
			success: function(res) {
				console.log(res.code);
				localStorage.removeItem('SendaddData');

				if(res.code == '300') {

					//					var r = confirm("请先进行寄件信息录入")
					//					if(r == true) {
					//						location.href = 'InfoInput.html'
					//					} else {
					console.log(res)
					//					}
				} else if(res.code == "200") {
					console.log("12");
					$(".Noexistsend").hide();
					$(".existsend").show();
					$('#send_username').text(res.data.Name);
					$('#send_tel').text(res.data.Telephone);
					$('#send_address').text(res.data.Depart + " " + res.data.City + " " + res.data.Area + " " + res.data.Address);
					var addData = {
						id: res.data.ID,
						addressname: res.data.Name,
						addresstel: res.data.Telephone,
						address: res.data.Depart + " " + res.data.City + " " + res.data.Area + " " + res.data.Address,
						addressaccount: res.data.AccountNumber,
						company: res.data.Company
					};
					localStorage.setItem('SendaddData', JSON.stringify(addData));
				} else {
					console.log("123")
				}
			},
			error: function(err) {
				console.log(err)
			}
		})
	}
	if(JSON.parse(localStorage.getItem('getaddData'))) {
		var _ChosogaddData = JSON.parse(localStorage.getItem('getaddData'));
		var _ChaddreType = localStorage.getItem('ChaddreType');
		$(".Noexistget").hide();
		$(".existget").show();
		$('#get_username').text(_ChosogaddData.addressname);
		$('#get_tel').text(_ChosogaddData.addresstel);
		$('#get_address').text(_ChosogaddData.address);
	}
	$('.clear').on('click', function() {
		sessionStorage.removeItem('order');
		location.reload();
	})
	//寄件人地址薄选择
	$(".sendaddress").on("click", function() {
		var _ChaddreType = 'send';
		localStorage.setItem('ChaddreType', _ChaddreType);
		localStorage.removeItem('Inmain');
		location.href = 'addressbook.html';

	})
	//寄件人地址编辑
	$(".existsend").on("click", function() {
		var _ChoseaddData = JSON.parse(localStorage.getItem('SendaddData'));
		var _ChaddreType = 'send';
		localStorage.setItem('ChaddreType', _ChaddreType);
		localStorage.setItem('Inmain', "Insendinfo");
		//		localStorage.removeItem('Inmain');
		localStorage.removeItem('mystate')
		location.href = 'InfoInput.html?id=' + _ChoseaddData.id;

	})
	//收件人地址编辑
	$(".existget").on("click", function() {
		var _ChoseaddData = JSON.parse(localStorage.getItem('getaddData'));
		var _ChaddreType = 'get';
		localStorage.setItem('ChaddreType', _ChaddreType);
		localStorage.removeItem('mystate')
		localStorage.setItem('Inmain', "Ingetinfo");
		location.href = 'InfoInput.html?id=' + _ChoseaddData.id;
	})
	//收件人地址薄选择
	$(".getaddress").on("click", function() {
		var _ChaddreType = 'get';
		localStorage.removeItem('Inmain');
		localStorage.setItem('ChaddreType', _ChaddreType);
		location.href = 'addressbook.html';
		//		$.ajax({
		//			type: "post",
		//			url: 'http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/AddressBook.php',
		//			data: {
		//				State: "show",
		//				UserNumber: telephone
		//			},
		//			dataType: "json",
		//			success: function(res) {
		//				if(res.data.length > 0) {
		//					location.href = 'addressbook.html';
		//				} else {
		//					location.href = 'Addgetaddress.html';
		//				}
		//			},
		//			error: function(err) {
		//
		//			}
		//		})

	})

	//新增寄件人地址
	$(".Noexistsend").on("click", function() {
		var _ChaddreType = 'send';
		localStorage.setItem('ChaddreType', _ChaddreType);
		localStorage.setItem('Inmain', "Insendinfo");
		localStorage.removeItem('mystate')
		location.href = 'Addsendress.html';
	})
	//新增收件人地址
	$(".Noexistget").on("click", function() {
		var _ChaddreType = 'get';
		localStorage.setItem('ChaddreType', _ChaddreType);
		localStorage.removeItem('mystate')
		localStorage.setItem('Inmain', "Ingetinfo");
		location.href = 'Addgetaddress.html';
	})
	$(".yin").on('click', function() {
		$(".setbg").hide();

	})

	$(".closewindow").on('click', function() {
		$(".setbg").hide();
	})
	//点击温度区间
	$(".Tempqu").on('click', function() {
		$('.acountlist').hide();
		$('body,html').animate({
			scrollTop: 0
		}, 0);
		$(".setbg").show();
		$(".goodsType").hide();
		$(".Temparea").show();
		$(".BoxType").hide();
		$(".TimeType").hide();
		if($('#Goodstypes').text() == '请选择货物类型' && $('#Temparea').text() == '请选择温区' && $('#BoxType').text() == '请选择箱型' && $('#ChooseTimes').text() == '预约取件时间') {

			$('.btndiv button').attr('disabled', true);
		} else {

			$('.btndiv button').removeAttr("disabled");
			$(".btndiv button").css('background', '#12599B');
		}
	})
	//点击箱型
	$(".clickbox").on('click', function() {
		//查看当前选中的箱子
		$('body,html').animate({
			scrollTop: 0
		}, 0);
		if($("#Temparea").text() == '请选择温区') {
			alert("请选择温度区间");
		} else {
			$('.acountlist').hide();
			$(".setbg").show();
			$(".goodsType").hide();
			$(".Temparea").hide();
			$(".BoxType").show();
			$(".TimeType").hide();
		}
		if($('#Goodstypes').text() == '请选择货物类型' && $('#Temparea').text() == '请选择温区' && $('#BoxType').text() == '请选择箱型' && $('#ChooseTimes').text() == '预约取件时间') {

			$('.btndiv button').attr('disabled', true);
		} else {

			$('.btndiv button').removeAttr("disabled");
			$(".btndiv button").css('background', '#12599B');
		}

	})

	//点击货物类型
	$(".cgoodtype").on('click', function() {
		//查看当前选中的箱子
		$('body,html').animate({
			scrollTop: 0
		}, 0);
		$('.acountlist').hide();
		$(".setbg").show();
		$(".goodsType").show();
		$(".Temparea").hide();
		$(".BoxType").hide();
		$(".TimeType").hide();
		if($('#Goodstypes').text() == '请选择货物类型' && $('#Temparea').text() == '请选择温区' && $('#BoxType').text() == '请选择箱型' && $('#ChooseTimes').text() == '预约取件时间') {
			$('.btndiv button').attr('disabled', true);
		} else {
			$('.btndiv button').removeAttr("disabled");
			$(".btndiv button").css('background', '#12599B');
		}

	})
	//点击预约时间
	var mytime = '';
	$(".clickTime").on('click', function() {
		$("#popup").show()
		this.isShow = true;
		//		$('body,html').animate({
		//			scrollTop: 0
		//		}, 0);
		//		$(".setbg").show();
		//		$(".Temparea").hide();
		//		$(".BoxType").hide();
		//		$(".TimeType").show();

		//		pickuptime.init(0, function(data) {
		//			console.log(data)
		//			$('#ChooseTimes').text(data)
		//		});
		//		if($(".iDate.full").length > 0) {
		//			$(".iDate.full").datetimepicker({
		//				locale: "zh-cn",
		//				format: "YYYY-MM-DD a hh:mm",
		//				dayViewHeaderFormat: "YYYY年 MMMM"
		//			});
		//		}
	})
	$(".bar.bar-1 img").on("click", function() {
		$("#popup").hide()
	})
	$(".Temparea-Ways .Tempareac .ni").on('click', function() {
		$(this).parents('.Temparea-Ways').find('.ni').removeClass('spanActive');
		$(this).addClass('spanActive');
		if($(this).parent().attr("class").indexOf("Dryice") != -1) {
			$('.BoxTypef1 .ni').removeClass('disable');
			$('.BoxTypef2').hide();
			$('.BoxTypef1').show();
			$('.BoxTypef2 .ni').addClass('disable');
			$('.BoxTypef2 .ni').removeClass('spanActive');
		} else {
			$('.BoxTypef1').hide();
			$('.BoxTypef2').show();
			$('.BoxTypef1 .ni').addClass('disable');
			$('.BoxTypef2 .ni').removeClass('disable');
			$('.BoxTypef1 .ni').removeClass('spanActive');
		}

	});
	var arrCbox = [];
	$(".BoxType .ni").on('click', function() {
		if($(this).attr('class').indexOf("spanActive") != -1) {
			$(this).removeClass('spanActive')
		} else {
			$(this).addClass('spanActive');
		}
	});
	$("body").on("click", "li .gw_num .add", function() {
		var n = $(this).prev().val();
		var num = parseInt(n) + 1;
		if(num == 0) {
			return;
		}
		$(this).prev().val(num);
	});
	//减的效果
	$("body").on("click", "li .gw_num .jian", function() {
		var n = $(this).next().val();
		var num = parseInt(n) - 1;
		if(num == 0) {
			var delnumtext = $(this).parent().prev().prev().text();
			arrcBoxTxts.remove(delnumtext);
			$(".BoxType-Ways .spanActive").each(function() {
				if($(this).text().indexOf(delnumtext) != -1) {
					$(this).removeClass('spanActive')
				}
			});
			$(this).parents('.childbox').remove();
			return
		}
		$(this).next().val(num);
	});
	var arrcBoxTxts = [];
	//点击时间日期
	$(".TimeType-Ways .TimeType-day .ni").on('click', function() {
		$(this).siblings().removeClass('spanActive');
		$(this).addClass('spanActive');
		$(this).find('img').show();
		$(this).siblings().find('img').hide();
		if($(this).find('.ri').text() == '明日' || $(this).find('.ri').text() == '后日') {
			$('.TimeType-datetime').empty();
			let currtime = ['8:30-10:30', '10:30-12:30', '12:30-14:30', '14:30-16:30', '16:30-17:30']
			$(currtime).each(function(key, index) {
				let str = '<span class="ni">';
				str += index;
				str += '</span>';
				$('.TimeType-datetime').append(str);
			});
		} else {
			let currhour = d.getHours();
			$('.TimeType-datetime').empty();
			if(currhour < 0 || currhour > 24) {
				currtime = ['无效时间']
			} else if(currhour >= 6 && currhour < 17) {
				currtime = ['2小时上门', '8:30-10:30', '10:30-12:30', '12:30-14:30', '14:30-16:30', '16:30-17:30']
			} else {
				currtime = ['非正常预约时间'];
			}
			$(currtime).each(function(key, index) {
				let str = '';
				if(currhour <= 8) {
					str = '<span class="ni">';
					str += index;
					str += '</span>';
				} else if(currhour >= 10 && currhour < 12) {
					if(key == 1) {
						str = '<span class="ni disable">';
						str += index;
						str += '</span>';
					} else {
						str = '<span class="ni">';
						str += index;
						str += '</span>';
					}
				} else if(currhour >= 12 && currhour < 14) {
					if(key == 1 || key == 2) {
						str = '<span class="ni disable">';
						str += index;
						str += '</span>';
					} else {
						str = '<span class="ni">';
						str += index;
						str += '</span>';
					}
				} else if(currhour >= 14 && currhour < 16) {
					if(key >= 1 && key <= 3) {
						str = '<span class="ni disable">';
						str += index;
						str += '</span>';
					} else {
						str = '<span class="ni">';
						str += index;
						str += '</span>';
					}
				} else {
					str = '<span class="ni disable">';
					str += index;
					str += '</span>';
				}
				$('.TimeType-datetime').append(str);
			});
		}
	});
	//监听备注录入
	$(".note .time-right textarea").bind("input propertychange", function(event) {
		if($('#Goodstypes').text() == '请选择货物类型' && $('#Temparea').text() == '请选择温区' && $('#BoxType').text() == '请选择箱型' && $('#ChooseTimes').text() == '预约取件时间') {
			$('.btndiv button').attr('disabled', true);
		} else {
			$('.btndiv button').removeAttr("disabled");
			$(".btndiv button").css('background', '#12599B');
		}
	});
	//点击小时
	$('body').on('click', ".TimeType-Ways .TimeType-datetime .ni", function() {
		$(this).siblings().removeClass('spanActive');
		$(this).addClass('spanActive');
	});

	$(".Temparea-btn").on('click', function() {
		var chooseTempTxt = $('.Temparea .spanActive').text();
		if(chooseTempTxt == '') {
			alert("请选择温度区间");
			$("#Temparea").removeClass('chooseTemp');
			$(".fatherbox .choosewenqu .gw_num").removeClass('hide');
		} else {
			$("#Temparea").text(chooseTempTxt);
			$("#Temparea").addClass('chooseTemp');
			$("#BoxType").text('请选择箱型');
			$('.BoxType .BoxType-Ways .ni').removeClass('spanActive');
			$(".fatherbox .choosewenqu p").addClass('hide');
			$('.childbox').remove();
			arrcBoxTxts = [];
			$('.choosewenqu .gw_num input').val('1');
			$(".setbg").hide();
			$(".setbg").hide();
		}
	});
	//货物类型确定
	$(".Goodstype-btn").on('click', function() {
		var chooseGoodtypeTxt = $('.goodsType  .Tempareac .spanActive').text();
		if(chooseGoodtypeTxt == '') {
			alert("请选择货物类型");
		} else {
			$("#Goodstypes").text(chooseGoodtypeTxt);
			$("#Goodstypes").addClass('Cgoods');

			$(".setbg").hide();
		}
	});

	$(".BoxType-btn").on('click', function() {
		var chooseBoxTxt = $('.BoxType .spanActive').text();
		arrcBoxTxts = chooseBoxTxt.trim().split(/\s+/);
		if(chooseBoxTxt == '') {
			alert("请选择箱型");
			$("#BoxType").removeClass("chooseBox");
		} else {
			//			$("#BoxType").text(chooseBoxTxt);
			console.log(arrcBoxTxts)
			if(arrcBoxTxts.length >= 2) {
				$('.childbox').remove();
				$('.fatherbox .choosewenqu .gw_num').removeClass('hide');
				$(arrcBoxTxts).each(function(index, value) {
					if(index != 0) {
						let str = `<li class="childbox orderbox">
							<div>
								<img src="../img/box.png" class="img_temp" />
							</div>
							<div class="choosewenqu">
								<label class="clickbox boxinput Cchildbox">${value}</label>
								<img src="../img/delbox.png" class="delbox" />
								<p class="gw_num">
									<img src="../img/reduce.png" class="jian" />
									<input type="text" value="1" class="num" readonly="readonly" />
									<img src="../img/addbox.png" class="add" />
								</p>
							</div>
						</li>`;
						$('.fatherbox').after(str);
					} else {
						$(".fatherbox #BoxType").text(value)
					}
				});
			} else {
				$(".fatherbox #BoxType").text(chooseBoxTxt)
				$('.fatherbox .choosewenqu .gw_num').removeClass('hide');
				$('.childbox').each(function() {
					$(this).remove();
				});
			}

			$("#BoxType").addClass("chooseBox");
			$(".setbg").hide();
		}
	});
	Array.prototype.remove = function(val) {
		var index = this.indexOf(val);
		if(index > -1) {
			this.splice(index, 1);
		}
	};
	//删除选择的箱型
	$("body").on("click", '.childbox .delbox', function() {
		var deltext = $(this).prev().text();
		$(".BoxType-Ways .spanActive").each(function() {
			if($(this).text().indexOf(deltext) != -1) {
				$(this).removeClass('spanActive')
			}
		});
		arrcBoxTxts.remove(deltext);
		console.log(arrcBoxTxts);
		$(this).parents('.childbox').remove();

	})
	$(".time-btn").on('click', function() {
		var chooseDay = $('.TimeType-day .spanActive .qi').text();
		var chooseTimeTxt = $('.TimeType-datetime .spanActive').text();
		$("#ChooseTimes").text(chooseDay + ' ' + chooseTimeTxt);
		$(".time .time-right label").addClass("chooseTimes");
		$(".setbg").hide();
	});
	$('aside.slide-wrapper').on('touchstart', 'li', function(e) {
		$(this).addClass('current').siblings('li').removeClass('current');
	});

	$('a.slide-menu').on('click', function(e) {
		var wh = $('div.wrapper').height();
		$('div.slide-mask').css('height', '100%').show();
		$('aside.slide-wrapper').css('height', '100%').addClass('moved');
	});

	$('div.slide-mask').on('click', function() {
		$('div.slide-mask').hide();
		$('aside.slide-wrapper').removeClass('moved');
	});
	$('.menu_top img').on('click', function() {
		$('div.slide-mask').hide();
		$('aside.slide-wrapper').removeClass('moved');
	});
	//提取汉字
	function  GetChinese(strValue)  {     
		if(strValue !=  null  &&  strValue !=  "") {         
			var  reg  =  /[\u4e00-\u9fa5]/g;          
			return  strValue.match(reg).join("");      
		}      
		else   
			return  "";  
	} 
	//去掉汉字
	function  RemoveChinese(strValue)  {     
		if(strValue !=  null  &&  strValue  !=  "") {         
			var  reg  =  /[\u4e00-\u9fa5]/g;         
			return  strValue.replace(reg, "");      
		}      
		else 
			return  "";  
	} 
	function trimstart(v) { //去除字符串尾空白
		if(typeof v == 'string') return v.replace(/^\s+/, '')
		return v;
	}

	function replacepos(text, start, stop, replacetext) {
		mystr = text.substring(0, stop - 1) + replacetext + text.substring(stop + 1);
		return mystr;
	}
	//点击下单
	$('.btndiv button').on('click', function() {
		if(JSON.parse(localStorage.getItem('SendaddData'))) {
			var sendInfo = JSON.parse(localStorage.getItem('SendaddData'));
			var _Manager = sendInfo.addressname;
			var _Telephone = sendInfo.addresstel;
			var _sendaddress = sendInfo.address.trim().split(/\s+/);
			var _Depart = _sendaddress[0];
			var _City = _sendaddress[1];
			var _Address = _sendaddress[2] + _sendaddress[3];
			var _Company = sendInfo.company;
		} else {
			alert("请选择寄件联系人")
		}

		if(JSON.parse(localStorage.getItem('getaddData'))) {
			var getInfo = JSON.parse(localStorage.getItem('getaddData'));
			var _GetName = getInfo.addressname;
			var _GetTelephone = getInfo.addresstel;
			var _getaddress = getInfo.address.trim().split(/\s+/);
			var _GetDepart = _getaddress[0];
			var _GetCity = _getaddress[1];
			var _GetAddress = _getaddress[2] + _getaddress[3];
			var _GetCompany = getInfo.company;
		} else {
			alert("请选择收件联系人")
		}

		var GoodType = $("#Goodstypes").text();
		var GoodName = $("#goodname").val();
		var TempArea = $("#Temparea").text();
		var orderboxs = [];
		var objbox = {};
		$('.orderbox').each(function(i) {
			var cbox = $(this).find('.boxinput').text().replace(/\s/g, "");
			var cboxnum = $(this).find('.num').val();
			objbox = {
				"PackageName": cbox,
				"Num": cboxnum
			}
			orderboxs.push(objbox);
		});

		var iswdj = $(".uiswitch").prop("checked") ? "使用" : "不使用";
		var _orderTime = $("#ChooseTimes").text();
		var _note = $(".note .time-right textarea").val();
		console.log(orderboxs);
		if(sendInfo == getInfo) {
			alert('寄件人收件人信息一致');
			localStorage.removeItem('getaddData');
		} else if(GoodType == '请选择货物类型') {
			alert("请选择货物类型");
		} else if(TempArea == '请选择温区') {
			alert("请选择温区");
		} else if(objbox.length == 0) {
			alert("请选择箱型");
		} else if(_orderTime == '预约取件时间') {
			alert("请选择预约取件时间 ");
		} else {
			$('.btndiv button').attr('disabled', true);
			var _data = {
				AccountNumber: _account,
				AccountTelephone: _tel,
				Token: "KHWX",
				Manager: _Manager,
				Telephone: _Telephone,
				Depart: _Depart,
				City: _City,
				Address: _Address,
				Company: _Company,
				GetName: _GetName,
				GetTelephone: _GetTelephone,
				GetDepart: _GetDepart,
				GetCity: _GetCity,
				GetAddress: _GetAddress,
				GetCompany: _GetCompany,
				WDQJ: TempArea,
				CargoName: GoodName,
				Name4: iswdj,
				OrderTime: _orderTime,
				BusinessType: GoodType,
				Note: _note,
				Box: orderboxs
			}

			$.ajax({
				type: "post",
				url: "http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/Order.php",
				data: _data,
				dataType: "json",
				success: function(res) {
					console.log(res)
					if(res.code == '200') {
					var nowtime = getNowFormatDate();
					var openids=['oTarnv-4gXJ3TRvg415ECeck61lQ','oTarnv5aWyxLcCENYrs5UOR3FqvQ'];
					for (i = 0; i < openids.length; i++) { 
					    $.ajax({
						type: "post",
						url: 'http://www.ccsc58.cc/weixinnew/Push_message.php',
						data: {
							first: "您好，您有新的订单需要处理",
							keyword1: res.ID,
							keyword2: '微信下单',
							keyword3: nowtime,
							keyword4: _Manager,
							keyword5: _Depart+' '+_City+' '+_Address,
							remark: 'TMS查看处理详细订单',
							openId: openids[i],
							app_key: '261AFF68C0E9F076420D083D66222824'
		
						},
						dataType: "json",
						success: function(res) {
							console.log('tuisong')
						},
						error: function(err) {
		
						}
			         })
					};

			             

						location.href = 'ordersuccess.html';
						sessionStorage.setItem("order", JSON.stringify(_data));
					} else {
						alert(res.msg)
					}
				},
				error: function(err) {
					console.log(err)
				}
			})
		}

	});

	function getNowFormatDate() {
		var date = new Date();
		var seperator1 = "-";
		var seperator2 = ":";
		var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
		var strDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
		var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate +
			" " + date.getHours() + seperator2 + date.getMinutes() +
			seperator2 + date.getSeconds();
		return currentdate;
	}

	$('input').blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 0);
	})
	$('textarea').blur(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 0);
	})
	//点击头像跳转
	$(".menu_footer").on("click", function() {
		location.href = 'person.html';
	})

	$(".alldizhi").on("click", function(res) {
		location.href = 'Alladdressbook.html';
		console.log("123");
		localStorage.setItem('state', 'all');
		localStorage.setItem('ChaddreType', 'all');
	})

});