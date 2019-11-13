<div style="display: none;">
<?php
	require_once "jssdk.php";
	$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
	$signPackage = $jssdk->GetSignPackage();
?>
</div>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>北京中集智冷科技</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script><!--调用jQuery-->
</head>
<style>
	.bd{
		width: 100%;
		height: 400px;
		border: 1px solid #C2C2C2;
		margin:  100px auto;
		text-align: center;
	}
	.weui_btn {
		margin-top: 50px;
	    width: 300px;
	    height: 44px;
	    color: #FFFFFF;
	    font-size: 18px;
	    background: #3299fe;
	    border-radius: 8px;
	    cursor: pointer;
    }
</style>
<body>
   <div class="bd">
		<div class="weui_cell">
            <button class="weui_btn weui_btn_primary" id="getLocationId">点击获取位置</button>
            <p style="color: #0000FF;font-weight: bold;">当前位置：暂时为未知</p>
             <p id="mufeng"></p>
		</div>
         <div class="weui_cell" style="display: none;">
            <button class="weui_btn weui_btn_primary" id="openLocationId">openLocation</button>
		</div>

   </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><!--调用JSSDK-->
<script src="js/jquery-1.11.0.js"></script>
<script> 
  //JSSDK配置参数 通过config接口注入权限验证配置
wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: '<?php echo $signPackage["timestamp"];?>',
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'chooseImage',
				'scanQRCode',
				 'getLocation'
			]
		});
</script>
<script> 
  //通过ready接口处理成功验证，加载直接调用的程序放在ready中，这里目前为空
  wx.ready(function () {

  });

  //这块是用jQuery来把wx.getLocation获取到的值显示在页面中的id=LocationText的位置
  document.querySelector('#getLocationId').onclick = function () {
   wx.getLocation({
      success: function (res) {
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
						$("p").html(data.result.formatted_address);	
						$("#mufeng").html(locationStrdan);	
						//getWeather(data.result.addressComponent.city);				
					},
					error: function(xhr) {
						alert(xhr)
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
    };

	wx.error(function (res) {
	    alert(res.errMsg);
	});
  
   function getWeather(city){
   	   $.ajax({
   	   	type:"get",
   	   	url:"http://v.juhe.cn/weather/index?format=2&cityname=北京&key=89ec1a30b20176748756c8afde176533",
   	   	async:true,
   	   	dataType:"jsonp",
   	   	success:function(data){
                var sk = data.result.sk;
		        var today = data.result.today;
		        var futur = data.result.future;
                var fut = "日期温度天气风向";
                $('#mufeng').html("<p>" + '当前:  ' + sk.temp + '℃  , ' + sk.wind_direction + sk.wind_strength + ' , ' + '空气湿度' + sk.humidity + ' , 更新时间' + sk.time + "</p><p style='padding-bottom: 10px;'>" + today.city + ' 今天是:  ' + today.date_y + ' ' + today.week + ' , ' + today.temperature + ' , ' + today.weather + ' , ' + today.wind + "<p></p>");
                $('#future').html("<p>" + '未来:  ' + futur[0].temperature+ '℃  , ' + futur[0].weather + futur[0].wind + ' , ' + ' , 更新时间' + futur[0].week+futur[0].date + "</p><p style='padding-bottom: 10px;'>" + today.city + "<p></p>");
           },  
   	   	error:function(err){
   	   		console.log(err)
   	   	}
   	   });
   } 
</script>
</html>
