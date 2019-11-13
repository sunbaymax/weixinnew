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
$arr=array();


$admin_permit=$_POST['admin_permit']; //操作允许码，默认permit码暂定为ccc

$openid=$_POST['openid'];       //微信ID
$tel=$_POST['tel'];             //电话号码
$first=$_POST['first'];      //单选第一题答案
$second=$_POST['second'];            //单选第一题答案
$third=$_POST['third'];          //多选第三题答案
$fourth=$_POST['fourth'];          //第四题答案
$name=$_POST['name'];            //用户姓名
$company=$_POST['company'];          //公司名称
$wechatname=$_POST['wechatname'];            //微信用户名
$nowtime=time();    //登录时间;

if($admin_permit=="zjly8888"){
		$INS=mysql_query("INSERT INTO `question` (`first`, `second`, `third`, `fourth`, `name`, `tel`, `company`, `openid`, `wechatname`, `nowtime`) VALUES ('$first', '$second', '$third', '$fourth', '$name', '$tel', '$company', '$openid', '$wechatname', '$nowtime')");
		if($INS==true){
			$arr['code']=10000;
			$arr['message']='success';
			$arr['resultCode']='success';
		}											
}	
else {
$arr['code']=30000;
$arr['message']='fail';
$arr['resultCode']='Nopermit';
}
$returns=stripslashes(json_encode($arr));//删除反斜杠
echo $returns;
?>


