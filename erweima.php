<?php    
　　　define('APPID', 'wx82dbac04fa8fd8ef');
     define('APPSECRET','98ecda31265ffc327d59adc969089650');
 　　@session_start();
    if(isset($_SESSION['dotime']) && ($_SESSION['dotime']+7200)>time())
    {
　　　　//access_token存储在session中

    }
    else
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $out = curl_exec($ch);
        $json = json_decode($out,true);
        curl_close($ch);
        $_SESSION['access_token']=$json['access_token'];
        $_SESSION['dotime'] = time();
    }
    for($index=1;$index<10;$index++)
    {
        $ch = curl_init();
        @$obj->action_name = "QR_LIMIT_SCENE";
        @$obj->action_info->scene->scene_id =$index;
        $data_string = json_encode($obj);
        $ch = curl_init('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$_SESSION['access_token']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $out = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($out,true);
        $ticket = $json['ticket'];
        $ch = curl_init('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $out = curl_exec($ch);
        file_put_contents("/opt/lampp/htdocs/barcode/".$index.".jpg", $out);
        echo $index."jpg<br/>";
    }



?>
