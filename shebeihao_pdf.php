<?php
	
	function geturl($openId,$shebeihao,$yundanhao){
    $contentStr = "<a href='http://www.ccsc58.cc/jiekou/tcpdf/pdf/yundanPDF.PHP?danhao=$yundanhao'>PDF下载</a>";
    $url="http://www.ccsc58.cc/wlgl/Api/piciPDF/shebeibianhao/$shebeihao/yundanhao/$yundanhao";    
    $admin_permit="zjly8888";
    $post_data = array(
        "shebeihao" => $shebeihao,
        "yundanhao" => $yundanhao,
        "url" => $url,
        "openid" => $openId,
        "admin_permit" =>$admin_permit,
        );
    $url_pdf='http://www.ccsc58.com/json/weixin_pdf.php';
    $aa=request_post($url_pdf,$post_data);
    $bb=json_decode($aa);
    if ($bb->code=='10000') {
    	return $contentStr;
    	# code...
    }else{
    	$contentStr = "PDF链接获取失败，请重试~~~";
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




?>
