<?php
	//添加意见 插入数据库接口
	header("Content-Type: text/html; charset=utf-8");
	header("Access-Control-Allow-Origin: *");//解决跨域问题
	$conn=mysql_connect("localhost","test01","Pzg790915");
	mysql_select_db("wlgl",$conn);
	mysql_query("set names utf-8");
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$admin_permit=$_POST['admin_permit'];//默认permit码暂定为zjly8888
	$wechat_touxiang=$_POST['wechat_touxiang'];
	$wechat_nicheng=$_POST['wechat_nicheng'];
	$openid=$_POST['openid'];
	$contacts=$_POST['contacts'];
	$tel=$_POST['tel'];
	$companys=$_POST['companys'];
	$products=$_POST['products'];
	$nowtime=$_POST['nowtime'];
	$desc=$_POST['desc'];
	$img_urls=$_POST['img_urls'];
	$last_product=$_POST['last_product'];
	$flag=0;

	//默认permit码暂定为zjly8888
		if($admin_permit=="zjly8888"){
			$create_time=time();
			$aa="INSERT INTO `wlgl`.`weixin_feedback` (`wechat_touxiang`, `wechat_nicheng`, `openid`, `contacts`, `tel`, `companys`, `products`, `nowtime`, `desc`, `img_urls`, `last_product`, `create_time`) VALUES ('".$wechat_touxiang."', '".$wechat_nicheng."', '".$openid."', '".$contacts."', '".$tel."', '".$companys."', '".$products."', '".$nowtime."', '".$desc."', '".$img_urls."', '".$last_product."', '".$create_time."')";
			$sql=mysql_query($aa);
			if(!$sql){
				$flag=1;
			}
		}else{
			$flag=2;
		}
	
	//当数据有错误时
	
	if($flag==0){
	$arr['code']=10000;
	$arr['message']='sucess';
	$arr['resultCode']='Ok';
	}
	if($flag==1){
	$arr['code']=20000;
	$arr['message']='插入失败';
	$arr['resultCode']='Error';
	}
	if($flag==2){
	$arr['code']=30000;
	$arr['message']='fail';
	$arr['resultCode']='Nopermit';
	}
	
	$returns=stripslashes(json_encode($arr));//删除反斜杠
	echo $returns;

