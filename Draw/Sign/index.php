<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>签到页面</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/validate.css">
</head>
<style>
	.line_postion{
		position: relative;
	}
	.Click_yzm{
		position: absolute;
		width: 4.9rem;
	    height: 2.2rem;
	    line-height: 2.3rem;
	    color: #ffffff;
	    text-align: center;
	    background: #3299FE;
	    border-radius: 5px;
        right: 0;
	}
	.hide{
		display: none;
	}
	.show{
		display: block;
	}
	.sign_term i{
		display: block;
	}
	.gzh_img{
		height: 6rem;
		width: 6rem;
	}
	.sign_tk_ts{
		top: 40%;
	} 
	.sign_button button{
		cursor:pointer;
	}
</style>
<body>
<div class="sign_wrap">
    <div class="logo"><img src="img/logo.png" alt="中厚明德logo"></div>
    <!--<div class="sign_title"><img src="img/title.png" alt=""></div>-->
    <div class="sign_line"><img src="img/line.png" alt=""></div>
    <div class="sign_text">
    	<p>中集冷云客户交流会（北京）</p>
    	<p>2018年10月28日-31日</p>
    </div>
    <div class="sign_form"  id="signForm">
        <div class="sign_term">
            <label class="sign_name"></label>
            <input type="text" placeholder="请输入姓名" name="name"  id="username" >
            <i id="user"></i>
        </div>
        <div class="sign_term">
            <label class="sign_phone"></label>
            <input type="text" placeholder="请输入手机号" name="phone" id="phone">
            <i id="pt"></i>
            <i id="pt2"></i>
            
        </div>
        
        <div class="sign_term line_postion">
            <label class="sign_yanz"></label>
            <input type="text" placeholder="请输入验证码" name="yanz" id="yanz" style="width: 6.2rem;">
            <span class="Click_yzm">获取验证码</span>
            <i id="yz" style="    position: absolute;
    top: 38px;
    left: 0;"></i>
    <i id="pt3"></i>
        </div>
         <div class="sign_term">
            <label class="sign_company"></label>
            <input type="text" placeholder="请输入公司名称" name="name" id="company">
             <i id="cm"></i>
        </div>
         <div class="sign_term">
            <label class="sign_gongw"></label>
            <input type="text" placeholder="请输入从事职务" name="name" id="duty" >
             <i id="du" style=""></i>
        </div>
        <div class="sign_button">
            <button type="button" class="btn_sign">签到</button>
        </div>
    </div>
    <div class="sign_welcome">
    	<i>/</i>诚<i>/</i>挚<i>/</i>欢<i>/</i>迎<i>/</i>您<i>/</i>的<i>/</i>到<i>/</i>来<i>/</i>
    </div>
</div>
<!--!&#45;&#45; 遮罩背景 &ndash;&gt;-->
<div class="sign_bg hide"></div>

<div class="sign_tk sign_tk_ts hide" id="unsuc_tk_wechat" style="height: 16rem;">
	<div class="sign_suc">
		<div class="unsuc_title">未关注</div>
		<div class="sign_con">
			<p>中集冷云</p>
			<p style="font-size:0.5rem ;letter-spacing: 0.1rem;">签到成功可参与现场抽奖<br>请先识别图中二维码关注</p>
			<p>
				<img src="img/wechat.jpg" class="gzh_img"/>
			</p>
		</div>
		<div class="sign_close" id="unsuc_close"></div>
	</div>
</div>
<!--&lt;!&ndash; 签到成功弹框 &ndash;&gt;-->
<div class="sign_tk  hide" id="suc_tk">
	<div class="sign_suc">
		<div class="suc_title"></div>
		<div class="sign_con">
			<p>恭喜您</p>
			<p>签到成功</p>
		</div>
		<div class="sign_close" id="suc_close"></div>
	</div>
</div>
<!--&lt;!&ndash; 签到失败弹框 &ndash;&gt;-->
<div class="sign_tk hide" id="unsuc_tk">
	<div class="sign_suc">
		<div class="unsuc_title">签到失败</div>
		<div class="sign_con">
			<p>请不要重复签到</p>
			<p>每个微信号只允许签到一次</p>
		</div>
		<div class="sign_close" id="unsuc_close1"></div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- 信息验证 -->
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/validate_expand.js"></script>
<script>
$(function () {
	
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
	is_check();
	function is_check(){
		$.ajax({
			type:"post",
			url:"http://www.zjcoldcloud.com/weixin_lucky/check_attention.php",
			async:true,
			dataType:"JSON",
			data:{
				openid:_openId
			},
			success:function(res){
				console.log(res);
				if(res.code=='1'){
                  console.log('请先关注"中集冷云"微信公众号！');
                  $('.sign_bg').fadeIn(1000);
                  $('#unsuc_tk_wechat').fadeIn(1000);					
				}
			},
			error:function(err){
				console.log(err);
			}
		});
	}

    
    var boo = true;
    $(".Click_yzm").on('click', function () {
        if (boo == false) {
            return
        }  else {
                yanz();
            }

    });


    function yanz() {
        if (boo == true) {
            var num = 60;
            var id = setInterval(function () {
                boo = false;
                num = num - 1;
                $(".Click_yzm").html(num).css("color", "#000000").css("background", "#ccc");
                if (num == 0) {
                    $(".Click_yzm").html("重新发送").css("color", "#ffffff").css("background", "#009dd9");
                    boo = true;
                    window.clearInterval(id);
                }
            }, 1000);
            $.ajax({
                url: 'http://www.ccsc58.com/SMS/SMS-telephone.php?telephone=' + $('#phone').val() +
                '&action=call&admin_permit=zjly8888',
                type: 'post',
                dataType: 'JSON',
                success: function (res) {
                    console.log(res);
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }


    }
	$("#suc_close").click(function(){
		$("#suc_tk,.sign_bg").fadeOut(400);
		$("#unsuc_tk,.sign_bg").fadeOut(400);
		WeixinJSBridge.call('closeWindow');
	});
	/!*签到失败弹框关闭*!/
	$(".sign_close").click(function(){
		$("#unsuc_tk,.sign_bg").fadeOut(400);
		$("#unsuc_tk_wechat,.sign_bg").fadeOut(400);
	});
	$("#unsuc_close").click(function(){
        window.location.reload();
	});
   
   $(".btn_sign").click(function () {
       var username = $("#username").val(),
           phone = $("#phone").val(),
           yanz = $("#yanz").val(),
           company = $("#company").val(),
           duty = $("#duty").val();
       if(username.length==0){
       	   $("#user").html('');
           $("#user").append("<font color='red'>账号不能为空</font>");
           $("#user").focus();
           return false;
       }else{
           $("#user").hide();
       }
      if(yanz.length==0){
      	  $("#yz").html('');
          $("#yz").append("<font color='red'>验证码不能为空</font>")
          $("#yz").focus();
          return false;

      }else{
          $("#yz").hide();
      }

       if(phone.length==0){
       	   $("#pt").html('');
           $("#pt").append("<font color='red'>手机号不能为空</font>");
           $("#pt").focus();
           return false;
       }else{
           $("#pt").hide();
           var reg = /(1[3-9]\d{9}$)/;
           if (!reg.test($('#phone').val()))
           {
               $('#phone').focus();
               $("#pt2").html('');
               $("#pt2").append("<font color='red'>请输入正确格式的手机号码</font>");
               return false;
           }else{
           	  $("#pt").hide();
           }
               
           

       }
       if(company.length==0){
       	   $("#cm").html('');
           $("#cm").append("<font color='red'>公司名称不能为空</font>")
           $("#cm").focus();
           return false;
       }else{
           $("#cm").hide();
       }
      if(duty.length==0){
          $("#du").html('');
          $("#du").append("<font color='red'>从事职务不能为空</font>")
          $("#du").focus();
         
      }else{
      	$("#du").hide();
      }
     qingqiu();
//    $.ajax({
//          url: "http://www.ccsc58.com/SMS/SMS-telephone.php?telephone=" + $("#phone").val() +
//                 "&action=bijiao&admin_permit=zjly8888&yanzhengmas=" + $("#yanz").val(),
//                 type: "get",
//                 dataType: "JSON",
//                 success: function (res) {
//                     if (res.result == "success") {
//                        console.log("验证码正确");
//                        qingqiu();
//                     } else if (res.result == "fail") {
//                     	console.log(12)
//                     	  $("#pt3").html('');
//                     	  $("#pt3").append("<font color='red'>请输入正确的验证码</font>");
//                        return false;
//                     }
//                 },
//                 error:function(err){
//                 	console.log(err);
//                 	$("#pt3").html('');
//                  $("#pt3").append("<font color='red'>请输入正确的验证码</font>");
//                  return false;
//                 }
//             })
       
   })


    function qingqiu() {
        $.ajax({
            url: "http://www.zjcoldcloud.com/weixin_lucky/sign.php",
            type: "post",
            data: {
                username: $("#username").val(),
                telphone: $("#phone").val(),
                company:$("#company").val(),
                job:$("#duty").val(),
                openid:_openId
            },
            dataType: "JSON",
            success: function (res) {
              console.log(res);
              if(res.code=="0"){
                 $('.sign_bg').fadeIn(1000);
                 $('#suc_tk').fadeIn(1000);
                  
              }else if(res.code=="1"){
              	 $('.sign_bg').fadeIn(1000);
                 $('#unsuc_tk').fadeIn(1000);
                 
              }else{
              	
              }
            },
            error: function (err) {
                console.log(err);
            }
        })
    }


})
</script>
</body>
</html>
