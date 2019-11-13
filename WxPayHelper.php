<?php


class WxPayHelper {
    var $parameters; //配置参数；
    //构造函数；
    function __construct() {


    }


    //设置参数;
    function setParameter($parameter, $parameterValue) {
        $this -> parameters[CommonUtil::trimString($parameter)] = CommonUtil::trimString($parameterValue);
    }
    //获取参数；
    function getParameter($parameter) {
        return $this -> parameters[$parameter];
    }


    //生成16位随机字符串；
    protected function create_noncester($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
	
	//检查配置参数；
	function check_cft_parameters()
	{
		if($this->parameters["bank_type"]==null||$this->parameters["body"]==null||$this->parameters["partner"]==null||$this->parameters["out_trade_no"]==null||$this->parameters["total_fee"]==null||$this->parameters["fee_type"]==null||$this->parameters["notifu_url"]==null||$this->parameters["spbill_create_ip"]==null||$this->parameters["input_charset"]==null){
			return false;
		}
		return true;
	}
	
	//生成package订单详情；
	protected function get_cft_package()
	{
		try{
			if(null==PARTNERKEY||""==PARTNERKEY){
				throw new SDKRuntimeException("密钥不能为空！"."<br>");
			}
			$commonUtil=new CommonUtil();
			ksort($this->parameters);
			$unSignParaString=$commonUtil->formatQueryParaMap($this->parameters,false);
			$paraString=$commonUtil->formatQueryParaMap($this->parameters,true);
			$md5SignUtil=new MD5SignUtil();
			return $paraString."&sign=".$md5SignUtil->sign($unSignParaString,$commonUtil->trimString(PARTNERKEY));
		}catch(SDKRuntimeEXception $e){
			die($e->errorMessage());		
		}
	}

	//生成签名
	protected function get_biz_sign($bizObj)
	{
		foreach($bizObj as $k=>$v){
			$bizParameters[strtolowe($k)]=$v;
		}
		try{
			if(APPKEY==""){
				throw new SDKRuntimeException("APPKEY!"."<br>");
			}
			$bizParameters["appkey"]=APPKEY;
			ksort($bizParameters);
		}catch(SDKRuntimeException $e){
			die($e->errorMessage());
		}
	}

//生成app支付请求json
function create_app_package($traceid="")
{
	try{
		if($this->check_cft_parameters()==false){
			throw new SDKRuntimeException("生成package参数失败！"."<br>");
		}
		$nativeObj["appid"]=APPID;
		$nativeObj["package"]=$this->get_cft_package();
		$nativeObj["timestamp"]=time();
		$nativeObj["traceid"]=$traceid;
		$nativeObj["noncestr"]=$this->create_noncestr();
		$nativeObj["app_signature"]=$this->get_biz_sign($nativeObj);
		$nativeObj["sign_method"]=SIGNTYPE;
		return json_encode($nativeObj);
	}catch(SDKRuntimeException $e){
		die($e->errorMessage);
	}
}
//生成jsapi支付请求json
function create_biz_package()
{
	try{
		if($this->check_cft_parameters()==false){
			throw new SDKRuntimeException("生成package参数缺失！"."<br>");
		}
		$nativeObj["appId"]=APPID;
		$nativeObj["package"]=$this->get_cft_package();
		$nativeObj["timeStamp"]=strval(time());
		$nativeObj["nonceStr"]=$this->create_noncestr();
		$nativeObj["paySign"]=$this->get_biz_sign($nativeObj);
		$nativeObj["signType"]=SIGNTYPE;
		return json_encode($nativeObj);
	}catch(SDKRuntimeException $e){
		die($e->errorMessage());
	}
}

//生成原生支付url
function create_native_url($productid)
{
	$commonUtil=new CommonUtil();
	$nativeObj["appid"]=APPID;
	$nativeObj["productid"]=urlencode($productid);
	$nativeObj["timestamp"]=time();
	$nativeObj["noncestr"]=$this->create_noncestr();
	$naticeObj["sign"]=$this->get_biz_sign($nativeObj);
	$bizString=$commonUtil->formatQueryParaMap($naticeObj,false);
	return "weixin://wxpay/bizpayurl?".$bizString;	
}

//生成原生支付请求xml
function create_native_package($retcode=0,$reterrmsg="ok")
{
	try{
		if($this->check_cft_parameters()==false&&$retcode==0){
			throw new SDKRuntimeException("生成package参数缺失！"."<br>");
		}
		$nativeObj["AppId"]=APPID;
		$nativeObj["Package"]=$this->get_cft_package();
		$nativeObj["TimeStamp"]=time();
		$nativeObj["NonceStr"]=$this->create_noncestr();
		$nativeObj["RetCode"]=$retcode;
		$nativeObj["RetErrMsg"]=$reterrmsg;
		$nativeObj["AppSignature"]=$this->get_biz_sign($nativeObj);
		$nativeObj["SignMethod"]=SIGNTYPE;
		$commonUtil=new CommonUtil();
		return $commonUtil->arrayToXml($nativeObj);
	}catch(SDKRuntimeException $e){
		die($e->errorMessage());
	}
}






















































}