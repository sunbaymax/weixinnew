<?php
    function getInfo($danhao,$openId){
    $admin_permit="zjly8888";
    $post_data = array(
        "danhao" => $danhao,
        "admin_permit" =>$admin_permit
        );
    $url='http://www.ccsc58.com/json/tms.php';
    $aa=request_post($url,$post_data);
    $bb=json_decode($aa);
    $yundanhao=$bb->billnumber;
    $sjzl=$bb->Aweight;
    $hwmc=$bb->CargoName;
    $jfzl=$bb->Cweight;
    $StartCity=$bb->StartCity;
    $EndCity=$bb->EndCity;
    $wdjsy=$bb->WTNO1;
    $js=$bb->Jian;
    $qsr=$bb->GetName;
    $qj=$bb->WDQJ;
    $qssj=str_replace('T',' ',$bb->GetTime);
    $wtsj=str_replace('T',' ',$bb->Indate);
    $info = json_decode(json_encode($bb->result),true);
    $object =  json_decode( json_encode( $object),true);
   
    $post_data = array(
        "billnumber" =>$danhao
        );
    $url='http://out.ccsc58.cc/DATA_PUBLIC/Search.php';
    $luxian=request_post($url,$post_data);
    $cars=array(json_decode($luxian, true));
  	$cars = $cars[0]['result'];
  	$str1 = '';
    foreach ($cars as $key => $value) {	
    	$str1.=substr($value['Indate'] , 5 , 11).' 货物在'.$value['city'].$value['BillNote']."\n";
    }
//	foreach($info as $key=>&$val){
//		if($val['BillNote']=='DE'){
//			unset($info[$key]);
//		}else{
//			$val['Indate'] = str_replace('T',' ',$val['Indate']);
//		}
//		
//	}
//  echo '<pre>';
//  	print_r($info);die;
//  var_dump($info);die;
    
    
    
    if(isset($bb->billnumber)){
        $contentStr="运单号:";
        $contentStr.=$yundanhao."\n"."货物名称:".$hwmc."\n"."始发城市:".$StartCity."\n"."目的城市:".$EndCity."\n"."温度计使用:".$wdjsy."\n"."件数:".$js."\n"."签收人:".$qsr."\n"."温度计区间:".$qj."\n"."委托时间:".substr($wtsj, 0 , 19)."\n"."签收时间:".$qssj."\n"."物流详情:"."\n".$str1;
        return $contentStr;
    }else{
        $contentStr = "运单信息获取失败，请重试~~~";
        return $contentStr;
    }
 }


    function request_post($url = '', $param = '') {
            if (empty($url) || empty($param)) {
                return false;
            }
            $postUrl = $url;
            $curlPost = $param;
            $ch = curl_init();//初始化curl
            curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
            curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
            curl_setopt($ch, CURLOPT_POST, 0);//post提交方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
            $data = curl_exec($ch);//运行curl
            curl_close($ch);
            return $data;
  }





















































