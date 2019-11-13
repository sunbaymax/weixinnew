<div style="display: none;">
<?php 
	require_once "../jssdk.php";
	$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
	$signPackage = $jssdk->GetSignPackage();
?>
</div>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />	
    <title>释冷温度</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.3/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="css/index.css" />	
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script><!--调用jQuery-->
</head>
<style>
	.bd {
	width: 100%;
	height: 400px;
	/*border: 1px solid #C2C2C2;*/
	margin: 100px auto;
	text-align: center;
}
	.storage_time,.city {
    display: inline-block;
    text-align: left;
    width: 46%;
    height: 30px;
    line-height: 30px;
    padding-left: 5px;
     border: solid 1px #000;
    /*background: none;*/
    border: solid 1px #000;
    /*outline: none;*/
}
.footer{
	padding: 0 15%;
    box-sizing: border-box;
    height:auto;
    margin: 15px 0px;
    text-align: left;
    font-size: 12px;
}
.footer div{
	width: 76%;
	background: none;
	outline: none;
	
	font-size: 12px;
	
}
.hide{
	display: none;
}
</style>
<body>
   <div class="bd">
		<!--<div class="weui_cell">
            <button class="weui_btn weui_btn_primary" id="getLocationId">获取数据</button>
            <p class="currentaddress" style="">当前位置：未知</p>
            <p id="mufeng"></p>
            <p class="weui_cell" style="display: none;">
                <button class="weui_btn weui_btn_primary" id="openLocationId">openLocation</button>
		    </p>
		</div>-->
		<div class="operation">
			<p>
				<span>当前城市:</span><select class="city">
					<option value="0">请选择城市</option>
					<option value="上海">上海市</option>
					<option value="广州">广州市</option>
				</select>
			</p>
			<p>
				<span>环境温度:</span><input type="text" class="ambient_temperature" placeholder="" />
			</p>
			<p>
				<span>更新时间:</span><input type="text" class="serverTime" placeholder="" />
			</p>
			<p>
				<span>暂存时长:</span><select class="storage_time" id="selectId"></select>
			</p>
			
			<p>
				<button class="button_ok">查询</button>
			</p>
			
			<div class="footer hide" >
				释冷温度：<span class="sl"></span>℃<br />释冷描述：<span class="slms"></span>
			</div>
			
		</div>
		
       

   </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script><!--调用JSSDK-->
<script> 
  //JSSDK配置参数 通过config接口注入权限验证配置
  wx.config({
      debug: false,
      appId: '<?php echo $signPackage["appId"];?>',
      timestamp: '<?php echo $signPackage["timestamp"];?>',
      nonceStr: '<?php echo $signPackage["nonceStr"];?>',
      signature: '<?php echo $signPackage["signature"];?>',
      jsApiList: [
        'checkJsApi',
        'openLocation',
        'getLocation',
        'openCard'
      ]
  });
   $(function() {// 初始化内容
   	 for (var i=4;i<=18;i++){
			$("#selectId").append("<option value='"+i+"'>"+i+" 小时</option>");
			}
			   
	$(".city").change(function () {  
            var _city = $(this).children('option:selected').val();  
            if (_city == "北京") {  
              window.location.href='Checkpostion.php';
            } else if (_city == "上海") {  
               getWeather(_city);
            }else{
            	alert("当前城市开发中")
            }  
        });  		   	
   	$('.button_ok').on("click",function(){
   		var _storage_time=$(".storage_time").val();
   		var _city=$(".city").val();
   		var _temp=$(".ambient_temperature").attr('hjwd');
   		var _time=$(".serverTime").attr('hour');
   		$.ajax({
   			type:"post",
   			url:"http://www.zjcoldcloud.com/weixin/lengku.php",
   			data:{
   				city:_city,
   				environment:_temp,
   				hour:_storage_time
   			},
   			dataType:"JSON",
   			success:function(res){
   				console.log(res);
   				$(".footer").show();
   				$('.sl').html(res.data.temperature);
   				$('.slms').html(res.data.remark);
   			},
   			error:function(err){
   				
   			}
   		});
   		
   	   })
    });  
  
   function getWeather(city){
   	   var _url='http://v.juhe.cn/weather/index?format=2&key=89ec1a30b20176748756c8afde176533&cityname='+city
   	   $.ajax({
   	   	type:"get",
   	   	url:_url,
   	   	async:true,
   	   	dataType:"jsonp",
   	   	success:function(data){
                var sk = data.result.sk;
		        var today = data.result.today;
		        var futur = data.result.future; 
                var fut = "日期温度天气风向";
                var servertime=today.date_y+''+sk.time;
                $('.city').val(today.city);
                $('.ambient_temperature').val(sk.temp+' ℃');
                $('.ambient_temperature').attr("hjwd",sk.temp);
                $('.serverTime').val(servertime);
                $('.serverTime').attr("hour",sk.time);
           },  
   	   	error:function(err){
   	   		console.log(err)
   	   	}
   	   });
   } 
</script>
</html>
