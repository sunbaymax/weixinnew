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
    $qssj=date('Y-m-d H:i:s',$bb->GetTime);
    $wtsj=date('Y-m-d H:i:s',$bb->Indate);

    if(isset($bb->billnumber)){
        $contentStr="运单号:";
        $contentStr.=$yundanhao."\n"."货物名称:".$hwmc."\n"."实际重量:".$sjzl."KG"."\n"."计费重量:".$jfzl."KG"."\n"."始发城市:".$StartCity."\n"."目的城市:".$EndCity."\n"."温度计使用:".$wdjsy."\n"."件数:".$js."\n"."签收人:".$qsr."\n"."温度计区间:".$qj."\n"."签收时间:".$qssj."\n"."委托时间:".$wtsj;
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






















































