<?php
	//按时间查询多条记录
	header("Content-Type: text/html; charset=utf-8");
	header("Access-Control-Allow-Origin: *");//解决跨域问题
	$conn=mysql_connect("localhost","test01","Pzg790915");
	mysql_select_db("wlgl",$conn);
	mysql_query("set names utf-8");
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$admin_permit=trim($_POST['admin_permit']);//默认permit码暂定为zjly8888
	$StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
	
	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='wlgl';    //使用的数据库
	$user='test01';      //数据库连接用户名
	$pass='Pzg790915';          //对应的密码
	$dsn="$dbms:host=$host;dbname=$dbName";
	try {
    $pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象
} catch (PDOException $e) {
    die(json_encode(array('code'=>10000,'message'=>'数据库连接失败')));
}
	
	if(!empty($StartTime)&&empty($EndTime)){
		$sql = "select * from weixin_feedback where nowtime between '$StartTime' and '9999-12-12 12:12:12'";
	}elseif(empty($StartTime)&&!empty($EndTime)){
		$sql = "select * from weixin_feedback where nowtime between '1970-01-01 00:00:00' and '$EndTime'";
	}elseif(!empty($StartTime)&&!empty($EndTime)){
		$sql = "select * from weixin_feedback where nowtime between '$StartTime' and '$EndTime'";
	}else{
		$sql = "select * from weixin_feedback";
	}
	$row = $pdo->query($sql);
	$row = $row->fetchAll(PDO::FETCH_ASSOC);
	
	if(!$row){
		die(json_encode(array('code'=>'10001','message'=>'暂无数据')));
	}
	
	die(json_encode(array('code'=>'20000','message'=>'请求成功','list'=>$row)));

