<?php
header("Access-Control-Allow-Origin: *");
include_once 'src/Qiniu/Auth.php';
include_once 'autoload.php';
use Qiniu\Auth;
$bucket = 'zjlytms';
$accessKey = 'KXg05-xfaxEg5AOqCMkKDCr6C4Spix4F_D6rXvSg';
$secretKey = 'qPQj3ea9o1f_oUOT6A_gvoYMNZrwEF6JPK6-WT59';
classLoader('Auth');
$auth = new Auth($accessKey, $secretKey);
$returnBody = '{"key":"$(key)","hash":"$(etag)","fsize":$(fsize),"bucket":"$(bucket)","name":"$(x:name)"}';
$policy = array(
    'returnBody' => $returnBody
);
$upToken = $auth->uploadToken($bucket, null, 3600, $policy, true);

echo json_encode(array('code'=>200,'message'=>'请求成功','list'=>$upToken));