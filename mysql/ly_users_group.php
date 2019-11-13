<?php
	
    $con = mysqli_connect("rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com","test01","Pzg790915");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  else{
//	  	echo '连接成功';
	  	mysqli_select_db($con,"wlgl");
	  	
//	  	$userlist=$weixin->get_user_list();
//	  	for($i=0;$i<count($userlist["data"]["openid"]);$i++){
//			$openid=$userlist["data"]["openid"][$i];
//			$mysql_state="insert into tb_weixin_lengyunuser (openid) values('".$openid."');";
//			//$result=$db->query($mysql_state);
//			$result=mysqli_query($con,$mysql_state);
//			echo $result;
//		}
//查询
		$result = mysqli_query($con,"SELECT * FROM tb_contact");

		$data = [];
		$i=0;
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		  {
		  $i++;
		  $data[] = $row;
		  $mobile=$row['mobile'];
		  $openid=$row['openid'];
		  $sql="update tb_weixin_lengyunuser set telphone='$mobile' where openid='$openid'";
	      $result1=mysqli_query($con,$sql)=='1'?"修改成功":"插入失败";
		  echo $i.' :'.$result1;
		  echo '<br>';
		  }

		  echo '总数量：'.count($data);

	  }


?>