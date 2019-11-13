<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/jquery-barcode.js"></script>
	<script type="text/javascript" src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://static.runoob.com/assets/qrcode/qrcode.min.js"></script>
    <title>入场码</title>
    <style type="text/css">
		.logo {
			width: 8rem;
			height: 2rem;
			margin: 1.2rem 1.6rem;
		}
		.logo img {
			width: 100%;
			height: 100%;
		}
        body{
        	background:#66AEFF;
        	opacity: 0.9;
        }
        .content{width:100%;margin:15px auto;}
        .hide_box{z-index:999;filter:alpha(opacity=50);background:#66AEFF;opacity: 0.9;-moz-opacity: 0.5;left:0;top:0;height:100%;width:100%;position:fixed;}
        .shang_box{width:300px;height:300px;padding:10px;background-color:#fff;border-radius:10px;position:fixed;z-index:1000;left:50%;top:50%;margin-left:-280px;margin-top:-280px;border:1px dotted #dedede;}
        .shang_box img{border:none;border-width:0;}
        .dashang{display:block;width:100px;margin:5px auto;height:25px;line-height:25px;padding:10px;background-color:#E74851;color:#fff;text-align:center;text-decoration:none;border-radius:10px;font-weight:bold;font-size:16px;transition: all 0.3s;}
        .dashang:hover{opacity:0.8;padding:15px;font-size:18px;}
        .shang_close{float:right;display:inline-block;}
        .shang_logo{display:block;text-align:center;margin:20px auto;}
        .shang_tit{width: 100%;height: 30px;text-align: center;line-height: 30px;color: #a3a3a3;font-size: 16px;font-family: 'Microsoft YaHei';margin-top: 7px;margin-right:2px;margin-bottom: 15px;}
        .shang_tit p{color:#000000;text-align:center;font-size:16px;font-weight: bold;}
        .shang_payimg{width:150px;background:#FFFFFF;padding:80px;margin:0 auto;}
        .shang_payimg img{display:block;text-align:center;width:150px;height:150px; }
        .pay_explain{text-align:center;margin:15px auto;font-size:16px;color:#000000;}
        .radiobox{width: 16px;height: 16px;background: url('img/radio2.jpg');display: block;float: left;margin-top: 5px;margin-right: 14px;}
        .checked .radiobox{background:url('img/radio1.jpg');}
        .shang_payselect{text-align:center;margin:0 auto;margin-top:40px;cursor:pointer;height:60px;width:280px;}
        .shang_payselect .pay_item{display:inline-block;margin-right:10px;float:left;}
        .shang_info{clear:both;}
		.shang_info p,.shang_info a{color:#C3C3C3;text-align:center;font-size:12px;text-decoration:none;line-height:2em;}

    </style>
</head>

<body>
    <div class="content">
		<div class="logo">
			<img src="img/logo.png" alt="">
		</div>
    	<div class="shang_tit">
    		<p>中集冷云客户交流会入场门票</p>
    	</div>

    	<div class="shang_payimg">
			<div id="qrcode" style="width:150px; height:150px; margin-top:15px;"></div>
			
		</div>
      <div class="pay_explain" style="margin-top: 30px;">湖南&middot;长沙 世纪金源大酒店</div>
      <div class="pay_explain">2018年10月31日-11月2日</div>
      <div class="pay_explain">&nbsp;&nbsp;由衷期待各位领导的到来！</div>

    </div>
    <script type="text/javascript">
      	  var qrcode = new QRCode(document.getElementById("qrcode"), {
				width : 100,
				height : 100
			});
    $(function(){
    	
    function UrlSearch() {
		var name, value;
		var str = location.href; //取得整个地址栏
		var num = str.indexOf("?")
		str = str.substr(num + 1); //取得所有参数 stringvar.substr(start [, length ]

		var arr = str.split("&"); //各个参数放到数组里
		for(var i = 0; i < arr.length; i++) {
			num = arr[i].indexOf("=");
			if(num > 0) {
				name = arr[i].substring(0, num);
				value = arr[i].substr(num + 1);
				this[name] = value;
			}
		}
	}
	var Request = new UrlSearch(); //实例化
	var _openId = Request.openid;
	console.log(_openId);

    function a(){
        $.ajax({
            url: 'http://www.zjcoldcloud.com/weixin_lucky/admin_select.php',
            type: 'post',
            dataType: 'JSON',
            data:{
                openid:_openId
            },
            success: function (res) {
            	console.log(res);
            	if(res.code=='0'){
            		if(res.data.is_sign=='0'&&res.data.is_check=='0'){
            			alert("请先参与签到");
            			window.setTimeout(window.location.href="../Sign/index.php?openid="+_openId,2000); 
            			//window.location.href="../Sign/index.php?openid="+_openId;
            		} 
            		else if(res.data.is_sign=='1'&&res.data.is_check=='0'){
            			alert("联系管理员审核");
            			//window.setTimeout(window.location.href="../Sign/index.php?openid="+_openId,2000); 
            			//window.location.href="../Sign/index.php?openid="+_openId;
            		} 
            		else if(res.data.is_sign=='1'&&res.data.is_check=='1'){
            			var aid = res.data.id;
		                console.log(aid);
		               // $("#bcTarget").empty().barcode(a, "int25",{barWidth:1, barHeight:30,showHRI:false});
		               qrcode.makeCode(aid);
            		}else{
            			alert("无效签到 ,请联系管理员！");
            			console.log("不存在")
            		}
            	}
            	else{
            		alert("请先参关注并签到");
            		window.setTimeout(window.location.href="../Sign/index.php?openid="+_openId,2000); 
            	}
                
            },

            error: function (err) {
                console.log(err);
            }
        })

    }
    a()

    });











    </script>
</body>

</html>