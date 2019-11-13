<?php
	
	function getBDInfo($phone,$openid){
	print_r($phone.'he'.$openid);	
//初始化
    $curl = curl_init();
    
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, 'http://www.ccsc58.com/json/03_00_tb_contact_openid.php');
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 1);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    $admin_permit="zjly8888";
    $post_data = array(
        "mobile" => $phone,
        "openid" => $openid,
        "admin_permit" =>$admin_permit,
        );
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    //执行命令
  
    $data = curl_exec($curl);
    //关闭URL请求
   
    curl_close($curl);
    
       if(msg.code == '10000'){	
            $contentStr = "恭喜您绑定成功,中集冷云会推送最新消息给您！";
            return $contentStr;
		}else if(msg.code == '30000'){
            $contentStr = "绑定失败";
            return $contentStr;
		}else{
            $contentStr = "恭喜您绑定成功,中集冷云会推送最新消息给您！";
            return $contentStr;
			}

    }
    //显示获得的数据
    //print_r($data);
     $contentStr = "绑定成功";
     return $contentStr;
    

// var_dump(getWeatherInfo("桃江"));

//function getBDInfo($phone)
//{
//		           $url = "http://www.ccsc58.com/json/03_00_tb_contact_openid.php";
//						　　$post_data = array ("mobile" => "18588886666","openid" => "oTarnv5aWyxLcCENYrs5UOR3FqvQ","admin_permit" =>"zjly8888");
//						'uid' => 123,  
//                              'uids' => array(12,455),  
//                              'msgType' => 'WITH',   
//                              'nick' => 'aaa',    
//						　　$ch = curl_init();
//						　　curl_setopt($ch, CURLOPT_URL, $url);
//						　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//						　　// post数据
//						　　curl_setopt($ch, CURLOPT_POST, 1);
//						　　// post的变量
//						　　curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//						　　$output = curl_exec($ch);
//						　　curl_close($ch);
//						　　//打印获得的数据
//						　　print_r($output);
//						   $nihao="nihao";
//						   return $nihao;
//  if ($cityName == "" || (strstr($cityName, "+"))){
//      return "发送天气加城市，例如'天气深圳'";
//  }
//	
//	$ak = 'WT7idirGGBgA6BNdGM36f3kZ';
//	$sk = 'uqBuEvbvnLKC8QbNVB26dQYpMmGcSEHM';
//	
//	$url = 'http://api.map.baidu.com/telematics/v3/weather?ak=%s&location=%s&output=%s&sn=%s';
//	$uri = '/telematics/v3/weather';
//	$location = $cityName;
//	$output = 'json';
//	$querystring_arrays = array(
//		'ak' => $ak,
//		'location' => $location,
//		'output' => $output
//	);
//	$querystring = http_build_query($querystring_arrays);
//  $sn = md5(urlencode($uri.'?'.$querystring.$sk));
//	$targetUrl = sprintf($url, $ak, urlencode($location), $output, $sn);
//	// var_dump($targetUrl);
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_URL, $targetUrl);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  $result = curl_exec($ch);
//  curl_close($ch);
//  $result = json_decode($result, true);
//  if ($result["error"] != 0){
//      return $result["status"];
//  }
//  $curHour = (int)date('H',time());
//  $weather = $result["results"][0];
//  $weatherArray[] = array("Title" =>$weather['currentCity']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
//  for ($i = 0; $i < count($weather["weather_data"]); $i++) {
//      $weatherArray[] = array("Title"=>
//          $weather["weather_data"][$i]["date"]."\n".
//          $weather["weather_data"][$i]["weather"]." ".
//          $weather["weather_data"][$i]["wind"]." ".
//          $weather["weather_data"][$i]["temperature"],
//      "Description"=>"", 
//      "PicUrl"=>(($curHour >= 6) && ($curHour < 18))?$weather["weather_data"][$i]["dayPictureUrl"]:$weather["weather_data"][$i]["nightPictureUrl"], "Url"=>"https://m.tianqi.com");
//  }
//  return $weatherArray;
//}


?>