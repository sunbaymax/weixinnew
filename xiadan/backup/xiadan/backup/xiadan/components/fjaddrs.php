<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>编辑寄件人地址</title>
		<!--<link href="../css/layout.min.css" rel="stylesheet" />-->
		<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
		<link href="../css/scs.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../css/index.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="../css/shijian.css" />
		<link rel="stylesheet" href="../css/toastr.min.css">
		<link rel="stylesheet" href="../css/address.css" />
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<meta content="telephone=no" name="format-detection">
		<meta content="email=no" name="format-detection">

	</head>
	<style>
		.lastline span {
		    position: absolute;
		    top: 15px;
		    left: 15%;
		}
	</style>

	<body>
		<nav>
			<div>
				< 上一步</div>
					<div>编辑寄件人地址</div>
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
			<div class="centect">
				<div class="scroll">
					<div class="currtent">
						<input type="hidden" class="id"  />
						<div class="content_line">
							<input class="luruname fjrusername" placeholder="姓名" />
							<input class="lurutel fjrtel" placeholder="手机号或0开头固话 一 分机号" />
						</div>
						<div class="content_line">
							<img src="../img/send_J.png" class="ji" />
							<input class="luruaddress fjraddress" id="myAddrs" placeholder="省 市 区" />
							<a class="altaddress" href="javascript:;">></a>
						</div>
						<div class="content_line">
							<input class="lurudescaddress fjrDaddrs" placeholder="寄件人详细地址（详细到门牌）" />
							<label class="fujin faAddress ">附近地址</label>
						</div>
					</div>
				</div>
			</div>
			<div class="lastline">
				<input type="checkbox" class="Defultfaaddrs rdo" />
				<span>设为默认寄件地址</span>

			</div>
            
			<div style="height: 0.7rem;"></div>
		</main>
		<!--按钮  下一步-->
		<footer>
			<span>保存</span>
		</footer>

		<!-- 收件省份 城市弹框 end -->
	</body>
	<script src="../js/rem.js" type="text/javascript"></script>
	<script src="../js/jquery-1.11.0.js" type="text/javascript"></script>
	<script src="../js/jquer_shijian.js?ver=1" type="text/javascript" charset="utf-8"></script>
	<script src="../js/toastr.min.js" type="text/javascript"></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<!--调用JSSDK-->
	<script src="../js/jquery.scs.min.js"></script>
	<script src="../js/CNAddrArr.min.js"></script>

	<script>
		$(function() {
				toastr.options = {
				timeOut: "3000",
				positionClass: "toast-center-center"
			};
			
			if(JSON.parse(localStorage.getItem('editfjr'))) {
				var Editfjr = JSON.parse(localStorage.getItem('editfjr'));
				$(".id").val(Editfjr.id);
				$(".fjrusername").val(Editfjr.Name);
				$(".fjrtel").val(Editfjr.Telephone);
				$(".fjraddress").val(Editfjr.addres);
				$(".fjrDaddrs").val(Editfjr.descaddres);
				if(Editfjr.is_default==1){
					$('.rdo').attr("checked",true);
				}else{
					$('.rdo').attr("checked",false)
				}

			} else {
				var weizhi = window.localStorage.getItem("weizhi");
				if(weizhi == "" || weizhi == null) {
					console.log("没选附近地址"); //$(".fujin").html('附近地址');
				} else {
					console.log("地址位置" + weizhi);
					$(".lurudescaddress").val(weizhi);
				}
			}
			var isnull=true;
			$('footer span').on("click",function(){
				if(isnull) {
				if($(".fjrusername").val() == "" || $(".fjrusername").val() == null) {
					isnull = false;
					setTimeout(function() {
						isnull = true;
					}, 3000)
					toastr.error("请输入发货人");
				} else if($(".fjrtel").val() == "" || $(".fjrtel").val() == null) {
					isnull = false;
					setTimeout(function() {
						isnull = true;
					}, 3000)
					toastr.error("请输入发货人联系电话");
				} else if($(".fjraddress").val() == "" || $(".fjraddress").val() == null) {
					isnull = false;
					setTimeout(function() {
						isnull = true;
					}, 3000)
					toastr.error("请输入发货人发货地址");
				} else if($(".fjrDaddrs").val() == "" || $(".fjrDaddrs").val() == null) {
					isnull = false;
					setTimeout(function() {
						isnull = true;
					}, 3000)
					toastr.error("请输入发货人详细联系地址");
				} else {
					if(JSON.parse(localStorage.getItem('editfjr'))){
						Eidtfjr();
						localStorage.removeItem('editfjr');
					}else{
						localStorage.removeItem('editfjr');
						addfjr();
						
					}
					
//					window.location.href = "fjaddrslibs.html"
				}

			}
			
			})
			//修改发件人信息
			function Eidtfjr(){
				var _AccountNumber = localStorage.getItem("myNum");
				var _AccountTelephone = localStorage.getItem("phone");
				var _id=$(".id").val();
				var fjrname=$(".fjrusername").val();
				var fjrtel=$(".fjrtel").val();
				var qkaddrs = $('#myAddrs').val();
				var qu = qkaddrs.split(' ');
				var fjprovince=qu[0];
				var fjcity=qu[1];
				var fjcounty=qu[2];
				var fjrDaddrs = $('.fjrDaddrs').val();
			    var is_default;
				if($('.rdo').attr("checked",true)){
					is_default=1;
				}else{
					is_default=0;
				}
				
				$.ajax({
					type:"post",
					url:"http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/Address_lib2.php",
					data:{
						AccountNumber:_AccountNumber,
						AccountTelephone:_AccountTelephone,
						action:"edit_address",
						id:_id,
						table:"manager_library",
						Name:fjrname,
						Telephone:fjrtel,
						Depart:fjprovince,
						City:fjcity,
						Area:fjcounty,
						Company:"无",
						Address:fjrDaddrs,
						is_default:is_default
					},
					dataType:"JSON",
					success: function(res) {
						if(res.code=="200"){
							 toastr.success("修改成功!");
							 return false;
							 localStorage.removeItem('editfjr');
							 setTimeout("location.href='fjaddrslibs.html';", 500);  
						}else{
							 toastr.info(res.info);
						}
					},
					error: function(res) {
						console.log(res)
					}
				});
			}
			function addfjr(){
				var _AccountNumber = localStorage.getItem("myNum");
				var _AccountTelephone = localStorage.getItem("phone");
				var fjrname=$(".fjrusername").val();
				var fjrtel=$(".fjrtel").val();
				var qkaddrs = $('#myAddrs').val();
				var qu = qkaddrs.split(' ');
				var fjprovince=qu[0];
				var fjcity=qu[1];
				var fjcounty=qu[2];
				var fjrDaddrs = $('.fjrDaddrs').val();
				$.ajax({
					type:"post",
					url:"http://out.ccsc58.cc/DATA_PORT_WECHAT_1.01/Address_lib2.php",
					data:{
						AccountNumber:_AccountNumber,
						AccountTelephone:_AccountTelephone,
						action:"add_address",
						table:"manager_library",
						Name:fjrname,
						Telephone:fjrtel,
						Depart:fjprovince,
						City:fjcity,
						Area:fjcounty,
						Company:"无",
						Address:fjrDaddrs
					},
					dataType:"JSON",
					success: function(res) {
						console.log(res);
						if(res.code=="200"){
							 toastr.success("新增人员成功!");
							 setTimeout("location.href='fjaddrslibs.html';", 500);  
						}else{
							 toastr.info(res.info);
						}
					},
					error: function(res) {
						console.log(res)
					}
				});
				return fjprovince;
				
			}
			
            //微信定位获取接口
			wx.config({
				debug: false,
				appId: '<?php echo $signPackage["appId"];?>',
				timestamp: '<?php echo $signPackage["timestamp"];?>',
				nonceStr: '<?php echo $signPackage["nonceStr"];?>',
				signature: '<?php echo $signPackage["signature"];?>',
				jsApiList: [
					'openLocation',
					'getLocation',
					'scanQRCode',
					'openCard'
				]
			});
			/**
			 * 通过数组id获取地址列表数组
			 *
			 * @param {Number} id
			 * @return {Array} 
			 */
			function getAddrsArrayById(id) {
				var results = [];
				if(addr_arr[id] != undefined)
					addr_arr[id].forEach(function(subArr) {
						results.push({
							key: subArr[0],
							val: subArr[1]
						});
					});
				else {
					return;
				}
				return results;
			}
			/**
			 * 通过开始的key获取开始时应该选中开始数组中哪个元素
			 *
			 * @param {Array} StartArr
			 * @param {Number|String} key
			 * @return {Number} 
			 */
			function getStartIndexByKeyFromStartArr(startArr, key) {
				var result = 0;
				if(startArr != undefined)
					startArr.forEach(function(obj, index) {
						if(obj.key == key) {
							result = index;
							return false;
						}
					});
				return result;
			}

			//bind the click event for 'input' element
			$("#myAddrs").click(function() {
				var PROVINCES = [],
					startCities = [],
					startDists = [];
				//Province data，shall never change.
				addr_arr[0].forEach(function(prov) {
					PROVINCES.push({
						key: prov[0],
						val: prov[1]
					});
				});
				//init other data.
				var $input = $(this),
					dataKey = $input.attr("data-key"),
					provKey = 1, //default province 北京
					cityKey = 36, //default city 北京
					distKey = 37, //default district 北京东城区
					distStartIndex = 0, //default 0
					cityStartIndex = 0, //default 0
					provStartIndex = 0; //default 0

				if(dataKey != "" && dataKey != undefined) {
					var sArr = dataKey.split("-");
					if(sArr.length == 3) {
						provKey = sArr[0];
						cityKey = sArr[1];
						distKey = sArr[2];

					} else if(sArr.length == 2) { //such as 台湾，香港 and the like.
						provKey = sArr[0];
						cityKey = sArr[1];
					}
					startCities = getAddrsArrayById(provKey);
					startDists = getAddrsArrayById(cityKey);
					provStartIndex = getStartIndexByKeyFromStartArr(PROVINCES, provKey);
					cityStartIndex = getStartIndexByKeyFromStartArr(startCities, cityKey);
					distStartIndex = getStartIndexByKeyFromStartArr(startDists, distKey);
				}
				var navArr = [{ //3 scrollers, and the title and id will be as follows:
					title: "省",
					id: "scs_items_prov"
				}, {
					title: "市",
					id: "scs_items_city"
				}, {
					title: "区",
					id: "scs_items_dist"
				}];
				SCS.init({
					navArr: navArr,
					onOk: function(selectedKey, selectedValue) {
						$input.val(selectedValue).attr("data-key", selectedKey);
					}
				});
				var distScroller = new SCS.scrollCascadeSelect({
					el: "#" + navArr[2].id,
					dataArr: startDists,
					startIndex: distStartIndex
				});
				var cityScroller = new SCS.scrollCascadeSelect({
					el: "#" + navArr[1].id,
					dataArr: startCities,
					startIndex: cityStartIndex,
					onChange: function(selectedItem, selectedIndex) {
						distScroller.render(getAddrsArrayById(selectedItem.key), 0); //re-render distScroller when cityScroller change
					}
				});
				var provScroller = new SCS.scrollCascadeSelect({
					el: "#" + navArr[0].id,
					dataArr: PROVINCES,
					startIndex: provStartIndex,
					onChange: function(selectedItem, selectedIndex) { //re-render both cityScroller and distScroller when provScroller change
						cityScroller.render(getAddrsArrayById(selectedItem.key), 0);
						distScroller.render(getAddrsArrayById(cityScroller.getSelectedItem().key), 0);
					}
				});
			});
		});

		
		//微信地图
		$(".fujin").on("click", function() {
			wx.getLocation({
				success: function(res) {
					//alert("nihao"+JSON.stringify(res)); 
					var latitude = res.latitude; //纬度
					var longitude = res.longitude; //经度
					var locationStr = "latitude：" + latitude + "，" + "longitude：" + longitude;
					var locationStrdan = latitude + "," + longitude;
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
							window.localStorage.setItem("_latitude", latitude);
							window.localStorage.setItem("_longitude", longitude);
							//console.log("微信名"+wechatname+", 你的地址"+ data.result.formatted_address);
							//alert(locationStr+"微信名"+wechatname+", 你的地址"+ data.result.formatted_address);
							window.location.href = "postion.html";
							//							
						},
						error: function(xhr) {
							// 导致出错的原因较多，以后再研究
							console.log(xhr);
						}
					})

				},
				cancel: function(res) {
					alert('用户拒绝授权获取地理位置');
				},
				fail: function(res) {
					console.log(JSON.stringify(res));
				}
			});
		})

		// 点击上一步
		$("nav div:first-of-type").on('click', function() {
			window.location.href = "fjaddrslibs.html"
			//window.history.go(-1);
		})
    
	</script>

</html>