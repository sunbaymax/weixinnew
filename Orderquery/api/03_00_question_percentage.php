<?php
/*
------------------------------------------------------------------
微信调查问卷数据接口-录入接口：
www.ccsc58.com/json/weixin/03_00_question_post.php
$controller=$_POST[controller];      //操作编码，默认register需要POST数值
$admin_permit=$_POST[admin_permit]; //操作允许码，默认permit码暂定为zjly8888
$openid=$_POST[openid];       //微信ID
$tel=$_POST[tel];             //电话号码
$company$_POST[company];      //公司名称
$name$_POST[name];            //姓名      
返回：{"code":10000,"message":"success","resultCode":"success"} 为成功
------------------------------------------------------------------
*/

header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");//解决跨域问题
include "connW_weixin.inc";
error_reporting(0);
$arr=array();

//$conn=mysql_connect("rr-2zeyxw9h3g93mt404.mysql.rds.aliyuncs.com","yewu01","Pzg790915");
$admin_permit=$_POST['admin_permit']; //操作允许码，默认permit码暂定为ccc
/*
$openid=$_POST['openid'];       //微信ID
$tel=$_POST['tel'];             //电话号码
$first=$_POST['first'];      //单选第一题答案
$second=$_POST['second'];            //单选第一题答案
$third=$_POST['third'];          //多选第三题答案
$fourth=$_POST['fourth'];          //第四题答案
$name=$_POST['name'];            //用户姓名
$company=$_POST['company'];          //公司名称
$wechatname=$_POST['wechatname'];            //微信用户名
$nowtime=time();    //登录时间;*/

if($admin_permit=="zjly8888"){
	$query=mysql_query("select * from question");
	$nums=mysql_num_rows($query);
	$answer1="'CRO','实验室','医院','科研单位','制药企业','SMO','其它'";	
	$answer2="'企业高管','BD','PM','科研人员','CRA','CRC','其它'";	
	$answer3="'临床样本/医药运输','保温箱购买','温度计购买','样本存储'";
	$answer4="'华东','华北','华南','华中','华西','东北','西南','西北'";

	$query1=mysql_query("select * from question where first in ($answer1)");
	$nums1=mysql_num_rows($query1);	
	$query11=mysql_query("select * from question where first ='CRO'");
	$nums11=mysql_num_rows($query11);
	$query12=mysql_query("select * from question where first ='实验室'");
	$nums12=mysql_num_rows($query12);
	$query13=mysql_query("select * from question where first ='医院'");
	$nums13=mysql_num_rows($query13);
	$query14=mysql_query("select * from question where first ='科研单位'");
	$nums14=mysql_num_rows($query14);
	$query15=mysql_query("select * from question where first ='制药企业'");
	$nums15=mysql_num_rows($query15);
	$query16=mysql_query("select * from question where first ='SMO'");
	$nums16=mysql_num_rows($query16);
	$query17=mysql_query("select * from question where first ='其它'");
	$nums17=mysql_num_rows($query17);

	$query2=mysql_query("select * from question where second in ($answer2)");
	$nums2=mysql_num_rows($query2);
	$query21=mysql_query("select * from question where second ='企业高管'");
	$nums21=mysql_num_rows($query21);
	$query22=mysql_query("select * from question where second ='BD'");
	$nums22=mysql_num_rows($query22);
	$query21=mysql_query("select * from question where second ='PM'");
	$nums23=mysql_num_rows($query23);
	$query24=mysql_query("select * from question where second ='科研人员'");
	$nums24=mysql_num_rows($query24);
	$query25=mysql_query("select * from question where second ='CRA'");
	$nums25=mysql_num_rows($query25);
	$query26=mysql_query("select * from question where second ='CRC'");
	$nums26=mysql_num_rows($query26);
	$query27=mysql_query("select * from question where second ='其它'");
	$nums27=mysql_num_rows($query27);

	$query3=mysql_query("select * from question where third in ($answer3)");
	$nums3=mysql_num_rows($query3);
	$query31=mysql_query("select * from question where third like '%临床样本/医药运输%'");
	$nums31=mysql_num_rows($query31);
	$query32=mysql_query("select * from question where third like '%保温箱购买%'");
	$nums32=mysql_num_rows($query32);
	$query33=mysql_query("select * from question where third like '%温度计购买%'");
	$nums33=mysql_num_rows($query33);
	$query34=mysql_query("select * from question where third like '%样本存储%'");
	$nums34=mysql_num_rows($query34);

	$query4=mysql_query("select * from question where fourth in ($answer4)");
	$nums4=mysql_num_rows($query4);	
	$query41=mysql_query("select * from question where fourth ='华东'");
	$nums41=mysql_num_rows($query41);
	$query42=mysql_query("select * from question where fourth ='华北'");
	$nums42=mysql_num_rows($query42);
	$query43=mysql_query("select * from question where fourth ='华南'");
	$nums43=mysql_num_rows($query43);
	$query44=mysql_query("select * from question where fourth ='华中'");
	$nums44=mysql_num_rows($query44);
	$query45=mysql_query("select * from question where fourth ='华西'");
	$nums45=mysql_num_rows($query45);
	$query46=mysql_query("select * from question where fourth ='东北'");
	$nums46=mysql_num_rows($query46);
	$query47=mysql_query("select * from question where fourth ='西南'");
	$nums47=mysql_num_rows($query47);
	$query48=mysql_query("select * from question where fourth ='西北'");
	$nums48=mysql_num_rows($query48);
	$per['first'][]=array('value'=>round($nums11,2),'name'=>'CRO');
	$per['first'][]=array('value'=>round($nums12,2),'name'=>'实验室');
	$per['first'][]=array('value'=>round($nums13,2),'name'=>'医院');
	$per['first'][]=array('value'=>round($nums14,2),'name'=>'科研单位');
	$per['first'][]=array('value'=>round($nums15,2),'name'=>'制药企业');
	$per['first'][]=array('value'=>round($nums16,2),'name'=>'SMO');
	$per['first'][]=array('value'=>round($nums17,2),'name'=>'其它');
	/*$per['first']['实验室']=round($nums12,2);
	$per['first']['医院']=round($nums13,2);
	$per['first']['科研单位']=round($nums14,2);
	$per['first']['制药企业']=round($nums15,2);
	$per['first']['SMO']=round($nums16,2);
	$per['first']['其它']=round($nums17,2);*/

	$per['second'][]=array('value'=>round($nums21,2),'name'=>'企业高管');
	$per['second'][]=array('value'=>round($nums22,2),'name'=>'BD');
	$per['second'][]=array('value'=>round($nums23,2),'name'=>'PM');
	$per['second'][]=array('value'=>round($nums24,2),'name'=>'科研人员');
	$per['second'][]=array('value'=>round($nums25,2),'name'=>'CRA');
	$per['second'][]=array('value'=>round($nums26,2),'name'=>'CRC');
	$per['second'][]=array('value'=>round($nums27,2),'name'=>'其它');
	// $per['second']['BD']=round($nums22,2);
	// $per['second']['PM']=round($nums23,2);
	// $per['second']['科研人员']=round($nums24,2);
	// $per['second']['CRA']=round($nums25,2);
	// $per['second']['CRC']=round($nums26,2);
	// $per['second']['其它']=round($nums27,2);

	$per['third'][]=array('value'=>round($nums31,2),'name'=>'临床样本');
	$per['third'][]=array('value'=>round($nums32,2),'name'=>'保温箱购买');
	$per['third'][]=array('value'=>round($nums33,2),'name'=>'温度计购买');
	$per['third'][]=array('value'=>round($nums34,2),'name'=>'样本存储');
	

	$per['fourth'][]=array('value'=>round($nums41,2),'name'=>'华东');
	$per['fourth'][]=array('value'=>round($nums42,2),'name'=>'华北');
	$per['fourth'][]=array('value'=>round($nums43,2),'name'=>'华南');
	$per['fourth'][]=array('value'=>round($nums44,2),'name'=>'华中');
	$per['fourth'][]=array('value'=>round($nums45,2),'name'=>'华西');
	$per['fourth'][]=array('value'=>round($nums46,2),'name'=>'东北');
	$per['fourth'][]=array('value'=>round($nums47,2),'name'=>'西南');
	$per['fourth'][]=array('value'=>round($nums48,2),'name'=>'西北');



	if ($per) {
		$arr['code']=10000;
		$arr=$per;
		}else{
			$arr['code']=20000;
			$arr['message']='fail';
			$arr['resultCode']='fail';
		}	
}	
else {
$arr['code']=30000;
$arr['message']='fail';
$arr['resultCode']='Nopermit';
}
$returns=stripslashes(json_encode($arr,JSON_UNESCAPED_UNICODE));//删除反斜杠
echo $returns;
?>


