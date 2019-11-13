<?php
header("content-type:text/html;charset=utf-8");
set_time_limit(0);
require_once('lengyun_kj.php');

$con = mysqli_connect("rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com","test01","Pzg790915");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  else{
//	  	echo '连接成功';
	  	mysqli_select_db($con,"wlgl");
	  	$mysql_state="select * from tb_weixin_lengyunuser where nickname=''";
	  	$result = mysqli_query($con,$mysql_state);
	  	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		  {
			    //echo $row['openid'];
				$sexes=array("","男","女");
				$openid=$row['openid'];
			//	var_dump($openid);
				$info=$weixin->get_user_info($openid);
				//var_dump($info);
				
				$mysql_state2="update tb_weixin_lengyunuser set
				subscribe='".$info['subscribe']."',
			    sex='".$sexes[$info['sex']]."',
				country='".$info['country']."',
				province='".$info['province']."',
				city='".$info['city']."',
				nickname='".$info['nickname']."',
				headimgurl='".$info['headimgurl']."',
				subscribe_time='".$info['subscribe_time']."' 
				where openid='".$openid."';";
				var_dump($mysql_state2);
				$result1=mysqli_query($con,$mysql_state2);
				var_dump($result1);
				
//				$mysql_state3="update tb_weixin_user set nickname='".$info['nickname']."' where openid='".$openid."';";
//				$result=$db->query($mysql_state3);
				echo "<script language =javascript>location.replace(location.href);</script>";
				
				
		  
		  }
	  }






?>