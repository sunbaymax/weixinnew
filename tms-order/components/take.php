
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我要下单</title>
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/shijian.css" />
    <link rel="stylesheet" href="../css/toastr.min.css">
</head>

<body>
    <nav>
        <div>
            < 上一步</div>
                <div>下单</div>
                <div></div>
                <div></div>
                <img src="../img/history5.png" class="title_history_img" />
    </nav>
    <div style="display: none;">
		<?php 
			require_once "../../jssdk.php";
			$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
			$signPackage = $jssdk->GetSignPackage();
		?>
</div>
    <!--内容部分-->
    <main>
        <!--发货信息 start-->
        <div style="padding: 10px;border-bottom: 1px solid #000000;">
            <p style="font-size: 14px;padding: 5px;">请输入发货信息</p>
        </div>
        <ul class="contant">
            <li>
                <div>
                    <span>发货人</span>
                    <input type="text" placeholder="请输入发货人姓名" class="faName">
                </div>
            </li>
            <li>

                <div>
                    <span>联系电话</span>
                    <input type="text" placeholder="请输入联系电话" class="faPhone">
                </div>
            </li>
            <li>

                <div>
                    <span>公司</span>
                    <input type="text" placeholder="请输入所在公司" class="faCompany">
                </div>
            </li>
            <li>

                <div>
                    <span>部门/科室</span>
                    <input type="text" placeholder="请输入所在部门/科室" class="faBumen">
                </div>
            </li>
            <li>
                <div>
                    <span>选择省份/城市</span>
                    <div class="faCom" style="display:flex;justify-content:flex-start;">
                        <span class="span1">请选择</span>
                        <span class="span2"></span>
                    </div>
                </div>
            </li>
            <li>

                <div style="justify-content:inherit;">
                    <span class="fahuo">发货地址</span>
                     <input type="text" placeholder="请输入收货地址" style="text-align: right;margin-right: 10px;" class="faAddress">
                    <span href="postion.html" class="fujin" style="font-size: 12px;color: blue;">附近地址</span>
                </div>
                <!--<div style="justify-content:inherit;position: absolute;">
                    <span class="fahuo" style="width:20Vw">发货地址</span>
                     <input type="text" placeholder="选择或请输入收货地址" class="shouAddress" style="text-align:right;width:60Vw">
                    <a href="postion.html" style="width:18Vw;font-size:12px;color:blue;margin-left: 2vw;" class="fujin">附近地址</a>
                </div>-->
            </li>
        </ul>
        <!--发货信息  end-->
        <!--收件信息 start-->
        <div style="padding: 10px;border-bottom: 1px solid #000000;">
            <p style="font-size: 14px;padding: 5px;">请输入收货信息</p>
        </div>
        <ul class="contant">
            <li>
                <div>
                    <span>收货人</span>
                    <input type="text" placeholder="请输入收货人姓名" class="shouName">
                </div>
            </li>
            <li>

                <div>
                    <span>联系电话</span>
                    <input type="text" placeholder="请输入联系电话" class="shouPhone">
                </div>
            </li>
            <li>

                <div>
                    <span>公司</span>
                    <input type="text" placeholder="请输入所在公司" class="showCompany">
                </div>
            </li>
            <li>
                <div>
                    <span>部门/科室</span>
                    <input type="text" placeholder="请输入所在部门/科室" class="shouBumen">
                </div>
            </li>
            <li>
                <div>
                    <span>选择省份/城市</span>
                    <div class="shouCom" style="display:flex;justify-content:flex-start;">
                        <span class="span3">请选择</span>
                        <span class="span4"></span>
                    </div>
                </div>
            </li>
            <li>

                <div style="border: none;justify-content:inherit;">
                    <span>收货地址</span>
                    <input type="text" placeholder="请输入收货地址" class="shouAddress">
                </div>
            </li>
        </ul>
        <!--取件时间  与 送达时间-->
        <ul class="contant">
            <li>
                <div>
                    <span>上门取件时间</span>
                    <input type="text" placeholder="请选择上门取件时间" class="dsa">
                </div>
            </li>
            <li>
                <div style="border: none;">
                    <span>要求送达时间</span>
                    <select class="sel">
                        <option value="">请选择</option>
                        <option value="24H">24H</option>
                        <option value="36H">36H</option>
                        <option value="48H">48H</option>
                        <option value="72H">72H</option>
                        <option value="96H">96H</option>
                    </select>
                </div>
            </li>
        </ul>
        <!--投保 -->
        <div class="tou">
            <div>
                <input type="checkbox" id="isTou" value="">
                <label for="isTou">&nbsp;是否投保</label>
            </div>
            <div>
                <span>投保金额</span>
                <div>
                    <input type="text" placeholder="请填写您的物品实际价值" style="text-align: right" class="cargovalue">
                    <span>&nbsp;元</span>
                </div>
            </div>
        </div>
        <div style="height: 0.7rem;"></div>
    </main>
    <!--按钮  下一步-->
    <footer>
        <span>确认</span>
    </footer>
    <!-- 发件省份  城市弹框  start-->
    <div class="faCityTan fda">
        <div class="yin"></div>

        <div class="cit">
            <p>
                <span class="close">X</span>
            </p>
            <!-- 左边   省份 -->

            <ul class="leftPro" style="height:85%;overflow:scroll;">
            </ul>
            <!-- 右边   城市 -->
            <ul class="rightCity" style="height:85%;overflow:scroll;">
            </ul>
        </div>
    </div>
    <!-- 发件省份  城市弹框  end -->
    <!-- 收件省份 城市弹框 start -->
    <div class="shouCityTan fda">
        <div class="yin"></div>

        <div class="shouCit">
            <p>
                <span class="close">X</span>
            </p>
            <!-- 左边   省份 -->
            <ul class="shouleftPro" style="height:85%;overflow:scroll;">
            </ul>
            <!-- 右边   城市 -->
            <ul class="shourightCity" style="height:85%;overflow:scroll;">

            </ul>
        </div>
    </div>

    <!-- 收件省份 城市弹框 end -->
</body>
<script src="../js/rem.js" type="text/javascript"></script>
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquer_shijian.js?ver=1" type="text/javascript" charset="utf-8"></script>
<script src="../js/toastr.min.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><!--调用JSSDK-->
	<script> 
  		//JSSDK配置参数 通过config接口注入权限验证配置
	  wx.config({
	      debug: false,
	      appId: '<?php echo $signPackage["appId"];?>',
	      timestamp: <?php echo $signPackage["timestamp"];?>,
	      nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	      signature: '<?php echo $signPackage["signature"];?>',
	      jsApiList: [
	        'openLocation',
	        'getLocation',
	        'scanQRCode',
	        'openCard'
	      ]
	  });
	</script>
<script>
     $(function() {
     	//微信地图
     	var weizhi=window.localStorage.getItem("weizhi");
     	var faName=window.localStorage.getItem("faName");
     	var faPhone=window.localStorage.getItem("faPhone");
     	var faCompany=window.localStorage.getItem("faCompany");
     	var faBumen=window.localStorage.getItem("faBumen");
     	var faSheng = window.localStorage.getItem('faSheng');
     	var faCity = window.localStorage.getItem('faCity');
     	if(weizhi==""||weizhi==null){
  		   console.log("没选附近地址"); //$(".fujin").html('附近地址');
    	}else{
    		console.log("地址位置");
    		$(".faAddress").val(weizhi);
  	        window.localStorage.removeItem('weizhi');
    	}
    	$(".faName").val(faName);
    	$(".faPhone").val(faPhone);
    	$(".faCompany").val(faCompany);
    	$(".faBumen").val(faBumen);
    	if(faSheng!=null){
    		$(".faCom .span1").html(faSheng);
    		$(".faCom .span2").html(faCity);
    	}
    	
    	
    	$(".fujin").on("click",function(){
    		var _faName=$(".faName").val();
    		var _faPhone=$(".faPhone").val();
    		var _faCompany=$(".faCompany").val();
    		var _faBumen=$(".faBumen").val();
    		
    		
    		window.localStorage.setItem("faName",_faName);
    		window.localStorage.setItem("faPhone",_faPhone);
    		window.localStorage.setItem("faCompany",_faCompany);
    		window.localStorage.setItem("faBumen",_faBumen);
    		window.localStorage.setItem('faSheng',$(".faCom .span1").html());
    		window.localStorage.setItem('faCity',$(".faCom .span2").html());
    		
    			 wx.getLocation({
			      success: function (res) {
			         	//alert("nihao"+JSON.stringify(res)); 
						var latitude = res.latitude; //纬度
						var longitude = res.longitude; //经度
						var locationStr = "latitude："+latitude+"，"+"longitude："+longitude;
			            var locationStrdan = latitude+","+longitude;
			            //http://api.map.baidu.com/geocoder/v2/?output=json&ak=XP1alssWsEscC3NfYAhj6YfqKvgQgUXF&location=39.82669830222656,116.28823852539062
			            	$.ajax({
									url: "http://api.map.baidu.com/geocoder/v2/",
									data: {
										"output": "json",
										"ak": "XP1alssWsEscC3NfYAhj6YfqKvgQgUXF",
										"location": locationStrdan
									},
									dataType: 'JSONP',
									method: 'GET',
									success: function(data) {
										//$("p").html(data.result.formatted_address);
										window.localStorage.setItem("_latitude",latitude);
										window.localStorage.setItem("_longitude",longitude);
										//console.log("微信名"+wechatname+", 你的地址"+ data.result.formatted_address);
										//alert(locationStr+"微信名"+wechatname+", 你的地址"+ data.result.formatted_address);
										window.location.href="postion.html";
			//							
									},
									error: function(xhr) {
										// 导致出错的原因较多，以后再研究
										console.log(xhr);
									}
								})


				    },
				      cancel: function (res) {
				        alert('用户拒绝授权获取地理位置');
				      },
				      fail: function (res) {
				        console.log(JSON.stringify(res));
				     }
				    });
    	})
    	   //历史订单
        $('.title_history_img').on("click", function () {
			//获取客户账号 成功跳转页面
            window.location.href = "history.html"
         
	    });
			toastr.options = {
				timeOut: "3000",
				positionClass: "toast-center-center"
			};
			if (JSON.parse(localStorage.getItem('orderMsg'))) {
				var orderMsg = JSON.parse(localStorage.getItem('orderMsg'));
				$(".faName").val(orderMsg.addresser);
				$(".faPhone").val(orderMsg.addresserphone);
				$(".faCompany").val(orderMsg.fjgongsi);
				$(".faBumen").val(orderMsg.fjbumen);
				$(".faAddress").val(orderMsg.addresserdizhi);
				$(".shouName").val(orderMsg.shouname);
				$(".shouPhone").val(orderMsg.shoutelephone);
				$(".showCompany").val(orderMsg.shougongsi);
				$(".shouBumen").val(orderMsg.shoubumen);
				$(".shouAddress").val(orderMsg.shouadderss);
				$(".dsa").val(orderMsg.requiretaketime);
				$(".sel").val(orderMsg.limittime);
				$(".span1").text(orderMsg.startprovince);
				$(".span2").text(orderMsg.endprovince);
				$(".span3").text(orderMsg.startcity);
				$(".span4").text(orderMsg.endcity);
				if (orderMsg.isinsure == 1) {
					$("#isTou").prop("checked", "true");
					$(".cargovalue").val(orderMsg.cargovalue);
				}
			}
			$(".dsa").focus(function() {
				$(".dsa").shijian(); // 调时间接口
			});
			var box = true;
			// 点击 提交
			$('footer span').on('click', function() {
				if (box) {
					if ($(".faName").val() == "" || $(".faName").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入发货人");
					} else if ($(".faPhone").val() == "" || $(".faPhone").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入发货人联系电话");
					} else if ($(".faCompany").val() == "" || $(".faCompany").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入发货所在公司");
					} else if ($(".faBumen").val() == "" || $(".faBumen").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入发货所在部门/科室");
					} else if ($(".faAddress").val() == "" || $(".faAddress").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入发货地址");
					} else if ($(".shouName").val() == "" || $(".shouName").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入收货人姓名 ");
					} else if ($(".shouPhone").val() == "" || $(".shouPhone").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入收货人联系电话");
					} else if ($(".showCompany").val() == "" || $(".showCompany").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入收货人所在公司");
					} else if ($(".shouBumen").val() == "" || $(".shouBumen").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入收货部门/科室");
					} else if ($(".shouAddress").val() == "" || $(".shouAddress").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入收货地址");
					} else if ($(".dsa").val() == "" || $(".dsa").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入上门取件时间");
					} else if ($(".sel").val() == "" || $(".sel").val() == null) {
						box = false;
						setTimeout(function() {
							box = true;
						}, 3000)
						toastr.error("请输入送达时间");
					} else {
						order();
					}
				}
			});
			$(".cargovalue").focus(function() {
				if ($("#isTou").prop("checked") == false) {
					$(".cargovalue").blur();
					toastr.error("请选择投保状态");
					return false;
				}
			});

			function order() {
				var obj = {
					addresser: $(".faName").val(),
					addresserphone: $(".faPhone").val(),
					fjgongsi: $(".faCompany").val(),
					fjbumen: $(".faBumen").val(),
					addresserdizhi: $(".faAddress").val(),
					shouname: $(".shouName").val(),
					shoutelephone: $(".shouPhone").val(),
					shougongsi: $(".showCompany").val(),
					shoubumen: $(".shouBumen").val(),
					shouadderss: $(".shouAddress").val(),
					requiretaketime: $(".dsa").val(),
					limittime: $(".sel").val(),
					isinsure: $("#isTou").prop("checked") ? 1 : 0,
					cargovalue: $("#isTou").prop("checked") ? $(".cargovalue").val() : 0,
					startprovince: $(".span1").text(),
					endprovince: $(".span3").text(),
					startcity: $(".span2").text(),
					endcity: $(".span4").text()
				};
				localStorage.setItem('orderMsg', JSON.stringify(obj));
				$("main input, main select").val('');
				$("#isTou").attr("checked", false);
				// window.localStorage.clear();
				window.location.href = "details.html";
			}
			// 点击上一步
			$("nav div:first-of-type").on('click', function() {
				window.location.href = "tempature.html"
				//window.history.go(-1);
			})
			// 查询  省份  
			$(".faCom,.shouCom").click(function() {
					$.ajax({
						url: "http://www.ccsc58.cc/zjlytms/api.php/price/getProvince",
						type: "get",
						dataType: "JSONP",
						jsonp: "callback",
						jsonpCallback: "data",
						success: function(res) {
							var pro, shouPro;
							pro = "<li class='active'>请选择</li>";
							shouPro = "<li class='active'>请选择</li>";
							for (var i = 0; i < res.list.startProvince.length; i++) {
								pro += "<li>" + res.list.startProvince[i].startprovince + "</li>"
							}
							for (var j = 0; j < res.list.endProvince.length; j++) {
								shouPro += "<li>" + res.list.endProvince[j].endprovince + "</li>"
							}
							$(".leftPro").html(pro);
							$(".shouleftPro").html(shouPro);
						},
						error: function(err) {
							console.log(err);
						}
					})
					$(".cit").css({
						"height": window.screen.height / 2
					});
					$(".faCityTan").show();
					$(".rightCity").html("");
					$("body").css({
						"overflow": "hidden"
					});
				})
				// 发件   点击省份  选择城市
			$("body").on("click", ".leftPro li", function() {
					$(this).attr("class", "active").siblings().attr("class", "");
					$(".faCom .span1").html($(this).text());
					$.ajax({
						url: "http://www.ccsc58.cc/zjlytms/api.php/price/getCity",
						type: "post",
						data: {
							startProvince: $(this).text()
						},
						dataType: "JSONP",
						jsonp: "callback",
						jsonpCallback: "data",
						success: function(res) {
							var city = "";
							for (var i = 0; i < res.list.startCity.length; i++) {
								city += "<li>" + res.list.startCity[i].startcity + "</li>"
							}
							$(".rightCity").html(city);
						},
						error: function(err) {
							console.log(err);
						}
					})
				})
				// 发件  城市  点击  
			$("body").on("click", ".rightCity li", function() {
				$(".faCom .span2").html($(this).text());
				$(".faCityTan,.shouCityTan").hide();
				$("body").css({
					"overflow": "auto"
				});
			})
			// 收件  
			$(".shouCom").click(function() {
					$(".shouCit").css({
						"height": window.screen.height / 2
					});
					$(".shouCityTan").show();
					$("body").css({
						"overflow": "auto"
					});
				})
				// 收件 身份 点击
			$("body").on("click", ".shouleftPro li", function() {
					$(this).attr("class", "active").siblings().attr("class", "");
					$(".shouCom .span3").text($(this).text());
					$.ajax({
						url: "http://www.ccsc58.cc/zjlytms/api.php/price/getCity",
						type: "post",
						data: {
							endProvince: $(this).text()
						},
						dataType: "JSONP",
						jsonp: "callback",
						jsonpCallback: "data",
						success: function(res) {
							var city = "";
							for (var i = 0; i < res.list.endCity.length; i++) {
								city += "<li>" + res.list.endCity[i].endcity + "</li>"
							}
							$(".shourightCity").html(city);
						},
						error: function(err) {
							//                  console.log(err);
						}
					})
				})
				// 收件  城市 
				// 发件  城市  点击  
			$("body").on("click", ".shourightCity li", function() {
					$(".shouCom .span4").text($(this).text());
					$(".faCityTan,.shouCityTan").hide();
					$("body").css({
						"overflow": "auto"
					});
				})
				//        点击弹框消失
			$(".yin").on('click', function() {
				if ($(".span1,.span3").html() == "请选择") {
					$(".span1,.span3").html("请选择");
					$(".span2,.span4").html("");
				}
				$(".faCityTan,.shouCityTan").hide();
				$("body").css({
					"overflow": "auto"
				});
			})
			$(".close").click(function() {
				if ($(".span1,.span3").html() == "请选择") {
					$(".span1,.span3").html("请选择");
					$(".span2,.span4").html("");
				}
				$(".faCityTan,.shouCityTan").hide();
				$("body").css({
					"overflow": "auto"
				});
			})
		})
  
    	
</script>

</html>
