$(document).ready(function() {
	
	var _down_panDuan = 0;
	//返回顶端的函数；
	window.onscroll = function() {
		var t = document.documentElement.scrollTop || document.body.scrollTop;
		if(t >= 300) {
			$(".back_top").removeClass("hidden");
		} else {
			$(".back_top").addClass("hidden");
		}
	};
	$(".back_top").on("click", function() {
		nihaohao()
	})
	var sdelay = 0;

	function nihaohao() {
		window.scrollBy(0, -200);
		if(document.body.scrollTop > 0) {
			sdelay = setTimeout(nihaohao, 10);
		} else {
			window.clearTimeout(sdelay);
		}
	};
	
	$(".details_address").on("click", function() {
			var _jingDu = $(this).find("span:nth-of-type(1)").html();
			var _weiDu = $(this).find("span:nth-of-type(2)").html();
			var _time = $(this).prev().prev().find("span").html();
			var _wenDu01 = $(this).parent().find("p:nth-of-type(2) span:nth-of-type(1)").html();
			var _wenDu02 = $(this).parent().find("p:nth-of-type(3) span:nth-of-type(1)").html();
			var _shiDu = $(this).parent().find("p:nth-of-type(2) span:nth-of-type(3)").html();
			_details_map(_jingDu, _weiDu, _time, _wenDu01, _wenDu02, _shiDu);
		});

	function details_now_map() {
		$(".details_address").on("click", function() {
			var _jingDu = $(this).find("span:nth-of-type(1)").html();
			var _weiDu = $(this).find("span:nth-of-type(2)").html();
			var _time = $(this).prev().prev().find("span").html();
			var _wenDu01 = $(this).parent().find("p:nth-of-type(2) span:nth-of-type(1)").html();
			var _wenDu02 = $(this).parent().find("p:nth-of-type(3) span:nth-of-type(1)").html();
			var _shiDu = $(this).parent().find("p:nth-of-type(2) span:nth-of-type(3)").html();
			_details_map(_jingDu, _weiDu, _time, _wenDu01, _wenDu02, _shiDu);
		});
		/*弹窗关闭按钮
		 */
		$(".JieChuBang_left").on("click",function(){
			$(".JieChuBang_box").addClass("hidden");
		})
		function _details_map(_jingDu, _weiDu, _time, _wenDu01, _wenDu02, _shiDu) {
			if(_jingDu == 0 || _weiDu == 0) {
				//alert("未查到位置信息");
				$(".JieChuBang_box").removeClass("hidden");
				return;
			}
			now_one_map(_jingDu, _weiDu);

			function now_one_map(x, y) {
				$(".content_details").css({
					minHeight: "80vh"
				});
				$("#content_details").css({
					height: "80vh",
					width: "100vw"
				});
				$(".detailNow").addClass("hidden");
				var map = new BMap.Map("content_details");
				var point = new BMap.Point(x, y);
				map.centerAndZoom(point, 15);
				var geoc = new BMap.Geocoder(); //添加地图到页面并确定中心点；
				var marker = new BMap.Marker(point);
				map.addOverlay(marker); //添加小红点；
				geoc.getLocation(point, function(rs) {
					var addComp = rs.addressComponents;
					var address = (addComp.province == addComp.city) ? (addComp.city + addComp.district + addComp.street + addComp.streetNumber) : (addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber);
					var _label = new BMap.Label("上报地址：" + address + "<br/>温度01/温度02/湿度：" + _wenDu01 + "/" + _wenDu02 + "/" + _shiDu + "<br/>时间：" + _time, {
						offset: new BMap.Size(20, -25)
					})
					_label.setStyle({
						color: "#046da9",
						fontSize: "1rem",
						backgroundColor: "#fefefe",
						fontWeight: "normal",
						border: "1px solid #ff892a"
					});
					marker.setLabel(_label);
				});
			}
		}
	}
	/*
	 *后台请求查看数据的最新的前五条数据；
	 * */
	/*
	 * 通过百度地图接口坐标转换的函数；
	 */

	/*获取最新数据时获取单条位置的函数；
	 */
	function my_machine_list(_jingDu, _weiDu, _dem) {
		$.ajax({
			url: "http://api.map.baidu.com/geoconv/v1/?ak=XP1alssWsEscC3NfYAhj6YfqKvgQgUXF&from=1&to=5",
			type: "post",
			dataType: "JSONP",
			data: {
				coords: _jingDu + "," + _weiDu
			},
			success: function(data) {
				if(data.status == 0) {
					now_one_map_address(data.result[0].x, data.result[0].y);
					_dem.find(".details_now_right .details_address span:nth-of-type(1)").html(data.result[0].x);
					_dem.find(".details_now_right .details_address span:nth-of-type(2)").html(data.result[0].y);
				} else {
					now_one_map_address(0, 0);
					_dem.find(".details_now_right .details_address span:nth-of-type(1)").html(0);
					_dem.find(".details_now_right .details_address span:nth-of-type(2)").html(0);
				}

			},
			error: function() {
				alert("网络错误，请重新进入");
				$(".wait").addClass("hidden");
			}
		});

		function now_one_map_address(_jingDu, _weiDu) {
			var point = new BMap.Point(_jingDu, _weiDu);
			var geoc = new BMap.Geocoder(); //添加地图到页面并确定中心点；
			geoc.getLocation(point, function(rs) {
				var address = rs.address;
				if(address == "") {
					_dem.find(".details_now_right p:nth-of-type(4) span").html("未发现位置信息");
				} else {
					_dem.find(".details_now_right p:nth-of-type(4) span").html(address);
				}

			})
		}
	}
//	$("#time").change(function(){
//		alert(1);
//	   //$("#dis2").load(location.href+" .detailNow"); 
//
//	});
//	
	//获取页面当前时间；

	$("#search").on("click", function() {
		var _BoxNumber = $("#xm").val();
		var _SheBeiBianHao = $("#sbh").val();
		var _Time = $("#time").val();
		
		$.ajax({
		url: "http://www.zjcoldcloud.com/01_00_tb_history_data_jd.php",
		type:"post",
		data: {
			admin_permit: "zjly8888",
			BoxNumber: _BoxNumber,
			SheBeiBianHao:_SheBeiBianHao,
			datetime: _Time,
		},
		success: function(data) {
			
			var _json = JSON.parse(data);
			if(_json.code == 10000) {
					var _list = _json.resultCode;
					$(".detailNow").eq(0).html('');
					for(var i = 0; i < _list.length; i++) {
						var _demN = $(".details_now").eq(0).clone().removeClass("hidden").appendTo($(".detailNow"));						
						_demN.find(".details_now_right p:nth-of-type(1) span").html(_list[i].shebeibianhao);
						_demN.find(".details_now_right p:nth-of-type(2) span:nth-of-type(1)").html(_list[i].temperature01 + "℃");
						_demN.find(".details_now_right p:nth-of-type(2) span:nth-of-type(3)").html(_list[i].humidity + "%RH");
						_demN.find(".details_now_right p:nth-of-type(3) span:nth-of-type(1)").html(_list[i].temperature02 + "℃");
						_demN.find(".details_now_right p:nth-of-type(3) span:nth-of-type(3)").html(_list[i].power + "%");
						_demN.find(".details_now_right p:nth-of-type(5) span").html(_list[i].time);
						_demN.find(".details_now_right p:nth-of-type(6) span").html(_list[i].servicetime);
						if(_list[i].xinghaoqiangdu >= 0 && _list[i].xinghaoqiangdu < 5) {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("无信号");
						} else if(_list[i].xinghaoqiangdu >= 5 && _list[i].xinghaoqiangdu < 13) {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("弱");
						} else if(_list[i].xinghaoqiangdu >= 13 && _list[i].xinghaoqiangdu < 20) {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("良");
						} else if(_list[i].xinghaoqiangdu >= 20 && _list[i].xinghaoqiangdu < 26) {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("好");
						} else if(_list[i].xinghaoqiangdu >= 26) {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("强");
						} else {
							_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(1)").html("无信号");
						}
						_demN.find(".details_now_right p:nth-of-type(7) span:nth-of-type(3)").html("-km/h");
						_demN.find(".details_now_right .details_address span:nth-of-type(1)").html(_list[i].jingdu);
						_demN.find(".details_now_right .details_address span:nth-of-type(2)").html(_list[i].weidu);
						my_machine_list(_list[i].jingdu, _list[i].weidu, _demN)
					};
				
					details_now_map();
					
				}else {
				alert("请求错误");
				window.location.href = "../machineList.php";
			}
		},
		error: function() {
			var _s = "<a href=\"../machineList.php\">您查看的设备不存在或未开启，请点击返回前一页面重新查看</a>";
			var _dem = $(".details_now").clone().removeClass("hidden").html(_s);
			_dem.css({
				width: "100vw",
				height: "10rem",
				textAlign: "left",
				fontSize: "2rem",
				lineHeight: "5rem"
			})
			$(".details_now").before(_dem)
		}
	});
		  
		});	
		 
	})



