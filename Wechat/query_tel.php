<?php
header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");//½â¾ö¿çÓòÎÊÌâ
$arr=array();

// $openid=$_POST['openid'];//ÃÜÂë
$openid=$_POST['openid'];//ÃÜÂë
// $admin_permit=$_POST['admin_permit'];//Ä¬ÈÏpermitÂëÔÝ¶¨Îªzjly8888
$pdo = new PDO("mysql:host=rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com;dbname=wlgl","test01","Pzg790915"); 
$pdo->exec("set names utf-8");
//var_dump($pdo);die;
$sql='select mobile from tb_contact where openid="'.$openid.'"';
$stmt = $pdo -> query($sql);

$arr = $stmt -> fetch(PDO::FETCH_ASSOC);

echo json_encode($arr);
