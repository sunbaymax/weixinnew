<?php
	include "WxPay.php";
	$money=1;
	$sender="中集冷云";
	$obj2=array();
	$obj2['wxappid']='wx82dbac04fa8fd8ef';
	$obj2['mch_id']='1406387502';
	$obj2['mch_billno']='1406387502'.date("YmiHis").rand(1000,999);
	$obj2['client_ip']=$_SERVER['REMOTE_ADDR'];
	$obj2['re_openid']='oTarnvxZ-objNsHTLNVIYBV5rOdA';
	$obj2['total_amount']=$money;
	$obj2['min_value']=$money;
	$obj2['max_value']=$money;
	$obj2['total_num']=1;
	$obj2['nick_name']=$sender;
	$obj2['send_name']=$sender;
	$obj2['wishing']="感谢信任中集冷云，恭喜发财";
	$obj2['act_name']=$sender."红包";
	$obj2['remark']=$sender."红包";
	
	var_dump($obj2);
	$url="https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
	$wxHongBaoHelper2 = new WxPay();
	$result=$wxHongBaoHelper2->pay($url,$obj2);
	var_dump($result);
?>