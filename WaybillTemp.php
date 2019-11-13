<div style="display:none">
	<?php
		require_once "jssdk.php";
		$jssdk = new JSSDK("wx82dbac04fa8fd8ef", "98ecda31265ffc327d59adc969089650");
		$signPackage = $jssdk->GetSignPackage();
	?>
</div>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<title>运单温度数据详情</title>
		<link rel="stylesheet" href="css/index.css" />
		<link rel="stylesheet" href="css/index01.css" />
		<link rel="stylesheet" href="JD_select/css/change_users.css" />
		<link rel="stylesheet" type="text/css" href="css/changeM.css"/>
		<link rel="stylesheet" href="JD_select/css/iconfont.css" />
		<link rel="stylesheet" href="css/iconfont.css" />
		<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script src="http://apps.bdimg.com/libs/layer/2.1/layer.js"></script>
	</head>
	<style>
		.user_top div:nth-of-type(1) {
		    width: 8rem;
		    height: 8rem;
		    float: left;
		    margin-top: 1.5rem;
		    margin-left: 10%;
		    background: #fefefe;
		    /* background-image: url(../../img/user_di02.png); */
		    background-size: 80% 80%;
		    border: 1px solid #ccc;
		    overflow: hidden;
		    border-radius: 50%;
		}
		.user_top div:nth-of-type(1) img {
		    display: block;
		    width: 80%;
		    margin-left: 10%;
		    height: 80%;
		    margin-top: 10%;
		}
		.content .user_bottom li input {
		    font-size: 1.5rem;
		    color: #000;
		    white-space: nowrap;
		    display: block;
		    height: 3rem;
		    margin-top: 0rem;
		    float: left;
		    /* margin-right: 5%; */
		    box-sizing: border-box;
		    text-align: left;
		    padding-left: 0px;
		    border: none;
		    width: 40%;
		    font-size: 13px;
		}
		ul li img{
			display:inline-block; width: 20px;height: 20px; float: right; margin-top:15px;margin-right: 20px;
		}
		.common_btn{
			display: inline-block; margin-top:20px;width: 70%;height: 3rem;line-height: 3rem;text-align: center;
                    font-size: 1.5rem;background: #3299fe;border: none;box-shadow: 1px 1px 2px 2px #ccc;color: #fefefe;border-radius: 1rem;
		}
		.btn1{
			padding: 0;
		}
		.content .user_bottom li {
		    width: 90%;
		    margin-left: 10%;
		    height: 4rem;
		    line-height: 4rem;
		    font-size: 1.7rem;
		    border-bottom: 1px solid #a5a5a5;
		    white-space: nowrap;
		    display: flex;
		}
		.content .user_bottom li input {
            float: none;
        }
		.mail{
			display: inline-block;
		    width: 100%;
		    height: 30px;
		    border: none;
		}
		.modal-content {
		    position: relative;
		    top: 60px;
		}
		.modal-body input{
		    width: 100%;
		    height: 30px;
		    box-sizing: border-box;
		    border: 1px solid #d7d7d7;
		    font-size: 14px;
		    padding: 15px 0 15px 20px;
		    line-height: 20px;
		    color: #888;
		    margin-bottom: 15px;
		}
		.modal-body input:hover{
			border: #4791ff transparent  #4791ff  #4791ff;
		   
		}
		.modal-body textarea{
		    width: 100%;
		    height: 150px;
		    box-sizing: border-box;
		    border: 1px solid #d7d7d7;
		    font-size: 14px;
		    color: #888;
		    margin-bottom: 15px;
		    text-indent:15px
		}
		.content .user_bottom li input {
			padding-top: 10px;
			box-sizing: border-box;
		    font-size: 1.5rem;
		    color: #000;
		    white-space: nowrap;
		    display: block;
		    height: 4rem;
		    margin-top: 0rem;
		    /* float: left; */
		    /* margin-right: 5%; */
		    box-sizing: border-box;
		    text-align: left;
		    padding-left: 0px;
		    border: none;
		    width: 40%;
		    font-size: 13px;
		    background: none;
		}
		.modal-body input:hover{
		    border-color: #999 transparent #b3b3b3 #999;
		}
		.btn1{
			cursor: pointer;
		}
		.Maillist{
		    display: inline-block;
		    height: 20px;
		    width: auto;
		    position: absolute;
		    top: 20px;
		    right: 20px;
		}
		
	</style>
	<body>
		<div class="header">
			<!--<img class="back_list_user" src="img/back.png"/>-->
			运单温度数据详情PDF
		</div>
		<div class="content">
			<div class="user_top" >
				<div>
					<img src="img/lenglian_index.png" />					
				</div>
			</div>
			<div class="user_bottom">
			<form action="http://out.ccsc58.cc/tcpdf/pdf/pdf_out5.php?BillNumber='+_BillNumber'+Thermometer=+'_Thermometer'" method="get">
				<ul>	
					<li><i class="icon iconfont icon-yundan1"></i><span>运单单号：</span><input type="text" name="BillNumber" id="xm" placeholder="请输入运单单号" value="" class="yewubianhao"/><img id="saoyisao1" class="saoma1" src="img/saoyisao.png" alt="" style=""></li>
				    <li><i class="icon iconfont icon-shoujihaoma"></i><span>设备编号：</span><input type="text" name="Thermometer" id="sbm" placeholder="请输入温度计编号" value="" class="yewubianhao"/><img id="saoyisao2" class="saoma2" src="img/saoyisao.png" alt="" style=";"></li>
				</ul>
					<button class="common_btn">查询预览</button>
                    <div class="common_btn btn1" data-toggle="modal" data-target="#myModal" >mail邮件</div>
			</form>
			</div>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					PDF报告mail发送
				</h4>
			</div>
			<div class="modal-body">
				<div class="Maillistfather">
					<input type="text" class="mail" placeholder="请输入收件邮箱账号"/><img src="img/Mail_list.png" class="Maillist" />
				</div>
				<div>
					<input type="text" class="mail_tittle" placeholder="请输入邮件主题"/>
				</div>
				<div>
					<textarea type="text" class="mail_content" placeholder="请输入邮件内容"></textarea>
				</div>
				
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary" id="send_ok">
					发送
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
		</div>
		<script src="js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="JD_select/js/change_users.js" type="text/javascript" charset="utf-8"></script>-->
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
        <!--<script>
        	接口地址：out.ccsc58.cc/tcpdf/pdf/pdf_out5.php
参数：单号BillNumber设备号Thermometer
传参方式：GET
例子：http://out.ccsc58.cc/tcpdf/pdf/pdf_out5.php?BillNumber=100002474226&Thermometer=136265
例子：http://out.ccsc58.cc/tcpdf/pdf/pdf_out5.php?BillNumber=100002474301&Thermometer=132810
第一个例子为未签收状态 第二个已签收
        	
        </script>-->
    <script type="text/javascript">
    	$(function(){ 
			var _BillNumber=$("#xm").val();
			var _Thermometer=$("#sbm").val();
			wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: '<?php echo $signPackage["timestamp"];?>',
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'chooseImage',
				'scanQRCode'
			]
		});
		$(".saoma1").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					 if(result.includes(',')){
                      result = result.split(',')[1];        
                     } // 当needResult 为 1 时，扫码返回的结果;
					$("#xm").val(result);
				}
			});
			
		});
		$(".saoma2").on("click", function() {
			wx.scanQRCode({
				needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function(res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果;
					 if(result.includes(',')){
                      result = result.split(',')[1];        
                     } // 当needResult 为 1 时，扫码返回的结果;
					$("#sbm").val(result);
				}
			});
			
		});
		$("#send_ok").on("click",function(){
			var _danhao=$("#xm").val();
			var _shebeihao=$("#sbm").val();
			var _mail=$(".mail").val();
			var _mail_tittle=$(".mail_tittle").val();
			var _mail_content=$(".mail_content").val();
            if(_danhao.length==0||_danhao==''){
            	alert("请录入运单号");
            	return false;
            }else if(_shebeihao==''||_shebeihao.length==0){
            	alert("请录入设备号");
            	return false;
            }else if(_mail==''||_mail.length==0){
            	alert("请录入邮件地址");
            	return false;
            }else if(_mail_tittle==''||_mail_tittle.length==0){
            	alert("请录入邮件标题");
            	return false;
            }else if(_mail_content==''||_mail_content.length==0){
            	alert("请录入邮件内容");
            	return false;
            }else{
        	    //console.log('单号:'+_danhao+',设备号:'+_shebeihao+',邮箱地址:'+_mail+',邮箱标题:'+_mail_tittle+',邮箱内容'+_mail_content);
        	    $.ajax({
        	    	type:"post",
        	    	url:"http://out.ccsc58.cc/tcpdf/pdf/pdf_out5.php",
        	    	data:{
        	    	  BillNumber:_danhao,
        	    	  Thermometer:_shebeihao,
        	    	  email:_mail,
        	    	  theme:_mail_tittle,
        	    	  content:_mail_content
        	    	},
        	    	dataType:"JSON",
        	    	success:function(res){
        	    		console.log(res);
        	    		if(res.code=='0'||res.message=='success'){
        	    			layer.msg('邮件发送成功中', {
							  icon: 16
							  ,shade: 0.01
							});
							//alert('邮件发送成功');        	    			
        	    		}
        	    	},
        	    	error:function(err){
        	    		console.log(err);
        	    	}
        	    });
            }
		})
		
}); 
		
		</script>
	</body>
</html>
