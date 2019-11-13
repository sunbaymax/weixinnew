<?php

header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");//解决跨域问题
include "connA_weixin.inc";
$arr=array();


$admin_permit=trim($_POST['admin_permit']); //操作允许码，默认permit码暂定为zjly8888


$starttime=strtotime(trim($_POST['starttime']));             //开始时间
$endtime=strtotime(trim($_POST['endtime']));      //结束时间
$page=trim($_POST['StartNo']);             //起始行号
$limit=trim($_POST['Length']);             //返回条目数

if($admin_permit=="zjly8888"){
	$a="select * from question where nowtime between '$starttime' and '$endtime' order by id desc limit $page,$limit";
	
	
	$sql=mysql_query($a);
	if ($sql) {
    // 输出数据
		while($row = mysql_fetch_assoc($sql)) {
			$data[]=$row;
		}
		$data['code']=10000;
		$arr=$data;
	} else {
			$arr['code']=20000;
			$arr['message']='fail';
			$arr['resultCode']='fail';
	}								
}else {
	$arr['code']=30000;
	$arr['message']='fail';
	$arr['resultCode']='Nopermit';
}
$returns=stripslashes(json_encode($arr,JSON_UNESCAPED_UNICODE));//删除反斜杠
echo $returns;
?>


