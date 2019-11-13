<?php
class WxPay
{
	function __construct()
	{
		
	}
	function pay($url,$obj)
	{
		$obj['nonce_str']=$this->create_noncestr();
		$stringA=$this->formatQueryParaMap($obj,false);
		$stringSignTemp=$stringA. "&key=" .PARTNERKEY;
		$sign=strtoupper(md5($stringSignTemp));
		$obj['sign']=$sign;
		
		$postXml=$this->arrayToXml($obj);
		var_dump($postXml);
		$responseXml=$this->curl_post_ssl($url,$postXml);
		var_dump($responseXml);
		return $responseXml;
	}
	function curl_post_ssl($url,$data=null) {
    	$curl = curl_init();
   				curl_setopt($curl, CURLOPT_URL, $url);
   				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
   			if (!empty($data)){
        		curl_setopt($curl, CURLOPT_POST, 1);
        		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    		}
   			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		$output = curl_exec($curl);
    		curl_close($curl);
    		return $output;
  }
	function create_noncestr($length=32)
	{
		$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str="";
		for($i=0;$i<$length;$i++){
			$str.=substr($chars,mt_rand(0,strlen($chars)-1),1);
		}
		return $str;
	}
	function formatQueryParaMap($paraMap,$urlencode)
	{
		$buff="";
		ksort($paraMap);
		foreach($paraMap as $k=>$v){
			if(null!=$v&&"null"!=$v&&"sign"!=$k){
				if($urlencode){
					$v=urlcode($v);
				}
				$buff.=$k."=".$v."&";
			}
		}
		$reqPar;
		if(strlen($buff)>0){
			$reqPar=substr($buff,0,strlen($buff)-1);
		}
		return $reqPar;
	}
	function arrayToXml($arr)
	{
		$xml="<xml>";
		foreach($arr as $key=>$val)
		{
			if(is_numeric($val)){
				$xml.="<".$key.">".$val."</".$key.">";
			}else{
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
			}
		}
		$xml.="</xml>";
		return $xml;
	}
	
}
?>