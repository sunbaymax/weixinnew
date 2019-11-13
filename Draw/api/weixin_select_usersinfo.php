<?php
	//查询一条意见
	header("Content-Type: text/html; charset=utf-8");
	header("Access-Control-Allow-Origin: *");//解决跨域问题
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	
	$dbms='mysql';     //数据库类型
	$host='rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com'; //数据库主机名
	$dbName='wlgl';    //使用的数据库
	$user='test01';      //数据库连接用户名
	$pass='Pzg790915';          //对应的密码
	$dsn="$dbms:host=$host;dbname=$dbName";
	try {
		$pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象
	} catch (PDOException $e) {
		die(json_encode(array('code'=>10000,'message'=>'数据库连接失败')));
	}
	
	$sql = "select * from tb_weixin_lengyunuser;
	$row = $pdo->query($sql);
	
	$row = $row->fetch(PDO::FETCH_ASSOC);
	
	if(!$row){
		die(json_encode(array('code'=>'10001','message'=>'没有该数据')));
	}
	
	die(json_encode(array('code'=>'20000','message'=>'请求成功','list'=>$row)));

