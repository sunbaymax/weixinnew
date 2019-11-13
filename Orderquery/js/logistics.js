! function(window, document, $, undefined) {
	var $details = $('#details'),
		$detailsGoods = $('.detailsGoods'),
		$imgcon = $('#details').find('img');
	$trackrcol2 = $('.track-rcol2');

	$(document).ready(function() {
		var formControlVal = localStorage.getItem("yundanhao");
		//				var formControlVal ="000000001234";

		$.ajax({
			url: 'http://www.ccsc58.com/json/tms.php',
			type: 'post',
			dataType: 'json',
			data: {
				admin_permit: 'zjly8888',
				danhao: formControlVal
			},
			success: function(res) {
				//console.log(res);
				if(res.code == 300) {
					$(".ddh").css("color", "red").html("没有此单号!");
					$("div").removeClass("kanbujian");
					var imgHTM;
					imgHTM = "<image src='img/nofind.png' />";
					$(".noimg").append(imgHTM);
				}
				/* var gt = res.GetTime-8*60*60;
				 var i_d = res.Indate-8*60*60;*/
				var dateArr = [],
					/*GetTime = fmtDate(parseInt(gt) * 1000),
					Indate = fmtDate(parseInt(i_d) * 1000),*/
					GetTime = (res.GetTime.substr(0, 10)),
					Indate = (res.Indate.substr(0, 10)),
					result = res.result,
					dateList = [];
				dateArr.push(
					'<p>', '<span>货物名称:</span>', res.CargoName, '</p>',
					'<p>', '<span>始发城市:</span>', res.StartCity, '</p>',
					'<p>', '<span>目的城市:</span>', res.EndCity, '</p>',
					'<p>', '<span>件数:</span>', res.Jian, '</p>',
					'<p>', '<span>温度计使用:</span>', res.WTNO1, '</p>',
					'<p>', '<span>温度计区间:</span>', res.WDQJ, '</p>',
					'<p>', '<span>实际重量:</span>', res.Aweight, '</p>',
					'<p>', '<span>计费重量:</span>', res.Cweight, '</p>',
					'<p>', '<span>签收人:</span>', res.GetName, '</p>',
					'<p>', '<span>签收时间:</span>', GetTime, '</p>',
					'<p>', '<span>委托时间:</span>', Indate, '</p>'
				);
				$('.ddh').html(res.billnumber);
				$detailsGoods.html(dateArr.join(''));

				$.ajax({
					url: 'http://out.ccsc58.cc/DATA_PUBLIC/Search.php',
					type: 'post',
					dataType: 'json',
					data: {
						billnumber: formControlVal
					},
					success: function(res) {
						//console.log(res.result);return false;
						$.each(res.result, function(ind, key) {
							var BillNote = key.BillNote,
								/* Indates = key.Indate-8*60*60,*/
								city = key.city,
								newIndate1 = key.Indate.substr(5, 5),
								newIndate2 = key.Indate.substr(11, 5);

							/*  var date = new Date(Indates*1000);
							  var m = (date.getMonth()+1);
							  var d = date.getDate();
							  var h = date.getHours();
							  var mm = date.getMinutes();*/
							/*  var newIndate1 =fil(m)+'-'+fil(d) ;
							  var newIndate2 = fil(h)+':'+fil(mm);*/
							function fil(d) {
								if(d < 10) {
									return '0' + d;
								}
								return d;
							}
							if(BillNote == "入库") {
								dateList.push(
									'<div class="track-list">',
									'<img class="node-icon icon1 " src="img/huise.png" alt="">',
									'<div class="left" style="border-left: 1px solid #9999;">',
									'<div class="dateAndTime">', newIndate1, '</div>',
									'<div class="dateAndTime times">', newIndate2, '</div>',
									'</div>',

									'<div class="stateAndPlace  ml36">',
									'<div class="place">', city, '</div>',
									'<div class="state">', BillNote, '</div>',
									'</div>',
									'<div class="claar"></div>',
									'</div>'
								)
							} else if(BillNote == "签收") {
								dateList.push(
									'<div class="track-list" style="height:30px;border-bottom:1px dotted #785;">',
									'<img class="node-icon icon1 " src="img/huise.png" alt="">',
									'<div class="left" style="height:30px;border:none;">',
									'<div class="dateAndTime">', newIndate1, '</div>',
									'<div class="dateAndTime times">', newIndate2, '</div>',
									'</div>',

									'<div class="stateAndPlace  ml36">',
									'<div class="place">', city, '</div>',
									'<div class="state">', BillNote, '</div>',
									'</div>',
									'<div class="claar"></div>',
									'</div>'
								)
							} else if(BillNote == "出库") {
								dateList.push(
									'<div class="track-list">',
									'<div class="left">',
									'<div class="dateAndTime">', newIndate1, '</div>',
									'<div class="dateAndTime times">', newIndate2, '</div>',
									'</div>',
									'<img class="node-icon icon1 "src="img/huangse.png" alt="">',
									'<div class="stateAndPlace  ml36">',
									'<div class="place">', city, '</div>',
									'<div class="state">', BillNote, '</div>',
									'</div>',
									'<div class="claar"></div>',
									'</div>'
								)

							} else {
								dateList.push(
									'<div class="track-list">',
									'<div class="left" >',
									'<div class="dateAndTime ">', newIndate1, '</div>',
									'<div class="dateAndTime  times">', newIndate2, '</div>',
									'</div>',
									'<img class="node-icon icon1 "src="img/yuanquan.png" alt="">',
									'<div class="stateAndPlace  ml36">',
									'<div class="place ">', city, '</div>',
									'<div class="state old">', BillNote, '</div>',
									'</div>',
									'<div class="claar"></div>',
									'</div>'
								)
							}

						});

						$trackrcol2.html(dateList.join(''));
						$trackrcol2.find('.track-list').first().find('div').css('color', '#FF9500');
						console.log($trackrcol2.find('.track-list').first());
						var str, snewIndate1, snewIndate2;
						$.each(res.CiChenDa, function(indix, value) {
							snewIndate1 = value.LinkTime.substr(5, 5);
							snewIndate2 = value.LinkTime.substr(11, 5);
							if(indix == 0) {
								str = `<h5>次晨达</h5><div class="track-list"><div class="left"><div class="dateAndTime ">${snewIndate1}</div><div class="dateAndTime  times">${snewIndate1}</div></div><img class="node-icon icon1 " src="img/yuanquan.png" alt=""><div class="stateAndPlace  ml36"><div class="place ">${value.LinkRemark}</div></div><div class="claar"></div></div>`;
								$('.track-rcol-secound').append(str);
							} else {
								str = `<div class="track-list"><div class="left"><div class="dateAndTime ">${snewIndate1}</div><div class="dateAndTime  times">${snewIndate2}</div></div><img class="node-icon icon1 " src="img/yuanquan.png" alt=""><div class="stateAndPlace  ml36"><div class="place ">${value.LinkRemark}</div></div><div class="claar"></div></div>`;
								$('.track-rcol-secound').append(str);
							}

						});

					}

				});

			},
			error: function(err) {
				console.log(err);
			}
		})

		$(".form-control").val("");

	});
	$(".return").on("click", function() {
		window.history.go(-1);
		//window.location.href = "index.php";
		/*  $(".track-rcol").html("");
                    $(".detailsGoods").html("")
*/
	});
	$("body").keydown(function() {
		if(event.keyCode == "13") { //keyCode=13是回车键
			$('.chaxun').trigger("click")
		}
	});
	$details.on('click', function() {
		if($detailsGoods.css('display') == 'block') {
			$detailsGoods.slideUp();
			$imgcon.attr('src', 'img/details.png');
		} else {
			$detailsGoods.slideDown();
			$imgcon.attr('src', 'img/detail2.png');
		}
	})
}(window, document, jQuery)