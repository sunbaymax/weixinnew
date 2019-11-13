<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<style>
		.box{
			width:480px;height:400px;border:1px solid #ccc;padding:20px;margin:250px auto;
		}
		.box_div{
			text-align:center;font-size:16px;width:100%;height:32px;margin-bottom:28px;
		}
		
		.dfinput{
			width:360px;height:30px;
		}
		
		.box_span{
			display:inline-block;width:100px;
		}
		
		button{
			width:80px;height:35px;margin:50px 200px;
		}
	</style>
</head>
<body>
	<form action="jiekou_doBox.php" method="post" />
	<div class="box">
		<h1 style='text-align:center;'>温度计与箱子编号查询</h1>
		<p style="color:red;"><?php echo @$_GET['err']; ?></p>
		<div class="box_div"><span class="box_span">温度计编号：</span><input class="dfinput" type="text" name="shebeibianhao" value="<?php echo @$_GET['shebeibianhao']; ?>" /></div>
		<div class="box_div"><span class="box_span">箱子码编号：</span><input class="dfinput" type="text" name="yewubianhao" value="<?php echo @$_GET['yewubianhao']; ?>" /></div>
		<button>查询</button>
		</div>
	</form>
</body>
</html>