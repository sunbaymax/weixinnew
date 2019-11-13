<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="last.php" method="post">
			账号：<input type="text" name="username" /><br />
			设备号：<input type="text" name="password" /><br />
			报警时间：<input type="text" name="nickname" /><br />
			报警级别：<input type="text" name="email" /><br />
			报警模块：<input type="text" name="abc" /><br />
			报警类型：<input type="text" name="cb" /><br />
			公司名称：<input type="text" name="fefe" /><br />
			openID：<input type="text" name="123" value="oTarnvxZ-objNsHTLNVIYBV5rOdA"/><br />
		    appkey：<input type="text" name="app_key" value="261AFF68C0E9F076420D083D66222824"/><br />
		        设备编号：<input type="text" name="567" /><br/>
			<input type="submit" value="提交" />
		</form>
		
		<!--<script src="js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		function my_play(){
			var username = $("input[name='username']").val();
			var password = $("input[name='password']").val();
			var nickname = $("input[name='nickname']").val();
			var email = $("input[name='email']").val();
			var abc = $("input[name='abc']").val();
			var cb = $("input[name='cb']").val();
			var fefe = $("input[name='fefe']").val();
			var m123 = $("input[name='123']").val();
			var app_key = $("input[name='app_key']").val();
			var m567 = $("input[name='567']").val();
			$.ajax({
				type:"post",
				url:"last.php",
				data:{
					username:username,
					password:password,
					nickname:nickname,
					email:email,
					abc:abc,
					cb:cb,
					fefe:fefe,
					m123:m123,
					app_key:app_key,
					m567:m567,
				},
				success:function(data){
					console.log(data);
				},
				error:function(){
					console.log("no");
				}
			});
		}
			
		</script>-->
	</body>
</html>