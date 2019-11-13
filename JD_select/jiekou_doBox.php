<?php
	// var_dump($_POST);die;
	$shebeibianhao = $_POST['shebeibianhao'];
	$yewubianhao = $_POST['yewubianhao'];
	$m = new MongoClient("mongodb://jd_admin_readwrite_all:Zjly8888@jd.ccsc58.cc:27017/admin");
		$db = $m->selectDB('wlgl');
		$tablename="device";
		$collection = $db->selectCollection("$tablename");
	if($shebeibianhao && !$yewubianhao){
		$res = $collection -> findOne(["shebeibianhao" => $shebeibianhao]);
		if($res){
			if($res['yewubianhao']){
				header("Location: select_box.php?shebeibianhao=".$shebeibianhao."&yewubianhao=".$res['yewubianhao']);
			}else{
				header("Location: select_box.php?shebeibianhao=".$shebeibianhao."&err=箱子未绑定");
			}
		}else{
			header("Location: select_box.php?shebeibianhao=".$shebeibianhao."&err=温度计编号输入有误");
		}
	}else if($yewubianhao && !$shebeibianhao){
		$res = $collection -> findOne(["yewubianhao" => $yewubianhao]);
		if($res){
			if($res['shebeibianhao']){
				header("Location: select_box.php?shebeibianhao=".$res['shebeibianhao']."&yewubianhao=".$yewubianhao);
			}else{
				header("Location: select_box.php?yewubianhao=".$yewubianhao."&err=箱子编号输入有误");
			}
		}else{
			header("Location: select_box.php?yewubianhao=".$yewubianhao."&err=箱子编号输入有误");
		}
	}else if($shebeibianhao && $yewubianhao){
		header("Location: select_box.php?shebeibianhao=".$shebeibianhao."&yewubianhao=".$yewubianhao."&err=请只输入一个编号");
	}else{
		header("Location: select_box.php?err=请输入温度计编号或箱子编号");
	}
