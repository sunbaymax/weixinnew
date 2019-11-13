<?php
	include 'wxpay.class.php';//数组参数
	$money = 100; //最低1元，单位分
	$sender = "中集冷云";
	$obj = array();
	$obj['wxappid'] = "wx82dbac04fa8fd8ef"; //appid
	$obj['mch_id'] = "1406387502";　　//商户id
	$obj['mch_billno'] = "1406387502".date('YmdHis').rand(1000,9999);　　//组合成28位，根据官方开发文档，可以自行设置
	$obj['client_ip'] = $_SERVER['REMOTE_ADDR'];
	$obj['re_openid'] = "oTarnvxZ-objNsHTLNVIYBV5rOdA";　　//接收红包openid
	$obj['total_amount'] = $money;
	$obj['min_value'] = $money;
	$obj['max_value'] = $money;
	$obj['total_num'] = 1;
	$obj['nick_name'] = $sender;
	$obj['send_name'] = $sender;
	$obj['wishing'] = "恭喜发财";
	$obj['act_name'] = $sender."红包";
	$obj['remark'] = $sender."红包";
	//var_dump($obj2);die
	$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
	$wxpay = new wxPay();
	$res = $wxpay->pay($url, $obj);
	var_dump($res);
?>