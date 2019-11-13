<?php
	header('Access-Control-Allow-Origin:*');
    $con = mysqli_connect("rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com","test01","Pzg790915");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  else{
//	  	echo '连接成功';
	  	mysqli_select_db($con,"wlgl");
	  	
//查询
		$result = mysqli_query($con,"SELECT id,openid,nickname,headimgurl,username,telphone,company FROM tb_weixin_lengyunuser where telphone !=''");

		$data = [];
		$i=0;
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		  {
		  $i++;
		  $data[] = $row;
		
           
		  }
		  //echo '总数量：'.count($data);
         //var_dump($data);
        $json= json_encode($data);
        echo $json;
	  }


?>