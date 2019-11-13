<?php

header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");//解决跨域问题
include "connA_weixin.inc";
$arr=array();


$admin_permit=trim($_POST['admin_permit']); //操作允许码，默认permit码暂定为zjly8888


$starttime=strtotime(trim($_POST['starttime']));             //开始时间
$endtime=strtotime(trim($_POST['endtime']));      //结束时间
$page=trim($_POST['StartNo']);             //开始时间
$limit=trim($_POST['Length'])+1;             //开始时间

if($admin_permit=="zjly8888"){
	$a="select * from question where nowtime between '$starttime' and '$endtime' limit $page,$limit";
	
	$sql=mysql_query($a);
       
	$row = mysql_fetch_array($sql, MYSQL_ASSOC);
	$num = mysql_num_rows($sql);
	if ($row) {
			//for($i=1;$i<=$num;$i++){
				while($row = mysql_fetch_array($sql, MYSQL_ASSOC)){
					$data[]=$row;
				/*$data[$i]['id']=$row['id'];
				$data[$i]['first']=$row['first'];
				$data[$i]['second']=$row['second'];
				$data[$i]['third']=$row['third'];
				$data[$i]['fourth']=$row['fourth'];
				$data[$i]['name']=$row['name'];
				$data[$i]['tel']=$row['tel'];
				$data[$i]['company']=$row['company'];
				$data[$i]['openid']=$row['openid'];
				$data[$i]['wechatname']=$row['wechatname'];
				$data[$i]['nowtime']=$row['nowtime'];*/
			}
		//var_dump($data);die;

		$data['code']=10000;
		$arr=$data;
	}else {
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


