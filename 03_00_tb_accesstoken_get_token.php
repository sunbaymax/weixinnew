	<?php
	//phpinfo();die;
    header("Content-Type: text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");//解决跨域问题
    //////////////////////////////////准备本地数据库
    $conn=mysqli_connect("rm-2ze3o57ph836pk46r.mysql.rds.aliyuncs.com","test01","Pzg790915",'wlgl');
    //mysqli_select_db($conn,'wlgl');
    //mysqli_query($conn,"set names utf-8");
    function Curl(){
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx82dbac04fa8fd8ef&secret=98ecda31265ffc327d59adc969089650";
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_TIMEOUT,5);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	$data=curl_exec($ch);
	curl_close($ch);
	$res=json_decode($data,true);
	echo $res['access_token'];
	return $res['access_token'];
    
}
function Serilizable(){
	global $conn;
	$appid="wx82dbac04fa8fd8ef";
	$secret="98ecda31265ffc327d59adc969089650";
	$sql='select A_ID,A_Token,A_Date from tb_accesstoken order by A_ID desc';
	$rs=mysqli_query($conn,$sql);
	$times=time();
//	$rownum=mysqli_fetch_row($rs);
//	echo '<pre>';
//	var_dump($rownum);	
	$row=mysqli_fetch_array($rs);
//	echo '<pre>';
//	var_dump($row);
	if(!$row){
		$timestamp=time()+6000;//每隔100分钟重新获取token
		$token=Curl();
		$sqlin="INSERT INTO `tb_accesstoken` (`A_Token`, `A_Date`) VALUES ('".$token."', '".$timestamp."')";
		mysqli_query($conn,$sqlin);
	}else{

		if($row['A_Date']<$times){
			$token=Curl();
			$timestamp=time()+6000;
			$sqlu="UPDATE tb_accesstoken SET A_Token='".$token."',A_Date='".$timestamp."' WHERE (`A_ID`=".$row['A_ID'].")";
			$res = mysqli_query($conn,$sqlu);
			return $token;
		}else{
			return $row['A_Token'];
		}
	}
}
	
	$token=Serilizable();
	echo '<hr>'.$token;
	
	
	
	
	
		
	
	
	
	