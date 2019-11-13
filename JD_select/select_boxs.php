<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<title>中集冷云（北京）冷链科技有限公司</title>
		<link rel="stylesheet" href="../css/index.css" />
		<link rel="stylesheet" href="../css/index01.css" />
		<link rel="stylesheet" href="css/change_users.css" />
		<link rel="stylesheet" type="text/css" href="../css/changeM.css"/>
		<link rel="stylesheet" href="css/iconfont.css" />
		<link rel="stylesheet" href="../css/iconfont.css" />
	</head>
	<body>
		<div class="header">
			<img class="back_list_user" src="../img/back.png"/>
			温度计与箱子编号查询
		</div>
		<div class="content">
			<div class="user_top">
				<div>
					
				</div>
				<div>
					冷云科技制作
				</div>
			</div>
			<div class="user_bottom">
				<ul>	
					<li><i class="icon iconfont icon-weishiyong"></i><span>箱子码：</span><input type="text" name="shebeibianhao"  value="<?php echo @$_GET['shebeibianhao']; ?>"/><img id="saoyisao1" class="saoma" src="../img/saoyisao.png" alt="" style="display:inline-block; width: 20px;height: 20px; float: right; margin-top: 20px;padding-right: 5%;"></li>
					<li><i class="icon iconfont icon-shoujihaoma"></i><span>设备号：</span><input type="text" name="yewubianhao" value="<?php echo @$_GET['yewubianhao']; ?>"/><img id="saoyisao2" class="saoma" src="../img/saoyisao.png" alt=""style="display:inline-block; width: 20px;height: 20px; float: right;margin-top: 20px;padding-right: 5%;"></li>					
				</ul>
				<p style="color:red;"><?php echo @$_GET['err']; ?></p>
				<form action="jiekou_doBox.php">
					<div>查询</div>
				</form>
			</div>
		</div>
		<script src="../js/jquery-1.11.0.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/change_user.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
