<?php
	require_once "lengyun_kj.php";
    $con = mysqli_connect("rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com","test01","Pzg790915");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  else{
//	  	echo '连接成功';
	  	mysqli_select_db($con,"wlgl");
	  	$weixin = new class_weixin_adv();
	  	
	  	$userlist=$weixin->get_user_list();
	  	for($i=0;$i<count($userlist["data"]["openid"]);$i++){
			$openid=$userlist["data"]["openid"][$i];
			$mysql_state="insert into tb_weixin_lengyunuser (openid) values('".$openid."');";
			//$result=$db->query($mysql_state);
			$result=mysqli_query($con,$mysql_state);
			echo $result;
		}
//查询
//		$result = mysqli_query($con,"SELECT * FROM tb_weixin_user");
//		
//		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
//		  {
//		  //echo $row['nickname'] . " " . $row['openid'];
//		  var_dump($row['nickname'] . " " . $row['openid']);
//		  echo "<br />";
//		  }
//增加
//      var_dump(getAccessToken());
//      mysqli_query($con,"INSERT INTO tb_weixin_user (openid,nickname,sex,country,province,city,headimgurl,subscribe,draw,effective) VALUES ('oSPfHv4aFSCNWYOZOC9XoUVPKvO44', '张三', '男', '中国', '山西', '太原', 'http://thirdwx.qlogo.cn/mmopen/PiajxSqBRaEKicLkPW1xF2GC1Z3NlbNx44mZ58FWllQGgQR0xhkYN30UrKXXL2OxLsEJwwSR2LbfCOf8ia27L3Niag/132', '1536904286', '', '');");
//		$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".getAccessToken()."&openid=".$FromUserName."&lang=zh_CN";
//		$userInfo=json_decode(https_request($url),true);
//		$openid = $userInfo['openid'];
//		$nickname = $userInfo['nickname'];
//		$sex = $userInfo['sex'];
//		$country = $userInfo['country'];
//		$province = $userInfo['province'];
//		$city = $userInfo['city'];
//		$headimgurl = $userInfo['headimgurl'];
//		$subscribe = $userInfo['subscribe'];
//		$subscribe_time = $userInfo['subscribe_time'];
//		$sql="INSERT INTO 'tb_weixin_user' (openid,nickname,sex,country,province,city,headimgurl,subscribe,subscribe_time) values('$openid','$nickname','$sex','$country','$province','$city','$headimgurl','$subscribe','$subscribe_time')";
//		var_dump($sql);
//		mysqli_query($con,$sql);
//      mysqli_close($con);
	  }


?>