<?php
//curl模拟登陆
require_once "baiduai/AipOcr.php";
//初始化curl
$ch = curl_init();
$codeurl = "https://www.imooc.com/passport/user/verifycode?t=".time();

curl_setopt($ch , CURLOPT_URL , $codeurl); //设置url 
curl_setopt($ch , CURLOPT_HEADER , 0); //不输出header头
curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1); //不直接打印
date_default_timezone_set("PRC"); //设置时区
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$res = curl_exec($ch);
if(curl_errno($ch)){
	exit(curl_error($ch));  
}
$api= new AipOcr("11389966","tTTHEVMCwVn9TiF1FW8waoYq","WQGhlzAk9jzGFH3R1Vt1Z2RiAdM6Vwjd ");
$word = $api->basicGeneral($res);
$words = '';
if(count($word['words_result']) > 0) {
   $words = $word['words_result'][0]['words'];
}

$data = "username=646054215@qq.com&password=65454878&remember=1&verify=".$words;
$url = "https://www.imooc.com/passport/user/login";


curl_setopt($ch , CURLOPT_URL , $url); //设置url 

//设置登陆的信息，设置cookie
curl_setopt($ch ,CURLOPT_COOKIESESSION , true); //打开cookie
curl_setopt($ch , CURLOPT_COOKIEFILE , "cookiefile"); //设置cookie
curl_setopt($ch , CURLOPT_COOKIEJAR , "cookiefile"); //保存cookie
curl_setopt($ch , CURLOPT_COOKIE , session_name() . "=" . session_id()); //设置http中的cookie内容
curl_setopt($ch , CURLOPT_FOLLOWLOCATION , true); //登陆成功之后是否允许跳转

//设置post
curl_setopt($ch , CURLOPT_POST , 1);
curl_setopt($ch , CURLOPT_POSTFIELDS , $data);
curl_setopt($ch , CURLOPT_USERAGENT , $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch , CURLOPT_REFERER , "https://wwww.imooc.com/"); //设置refer头信息，否则报“访问来源被拒绝”
curl_setopt($ch , CURLOPT_HTTPHEADER , ['Content-Type: application/x-www-form-urlencoded;charset=utf-8','Referer: https://www.imooc.com/','Content-Length: '.strlen($data),]);  //设置header头信息
curl_setopt($ch , CURLOPT_TIMEOUT , 30); //设置超时时间

$res = curl_exec($ch);
if(curl_errno($ch)){
	exit(curl_error($ch));   //    访问来源被拒绝(--设置refer)    验证码为空
}
//跳转
$reurl = "https://www.imooc.com/u/3809422/courses";
curl_setopt($ch , CURLOPT_URL , $ch); //设置url 
curl_setopt($ch , CURLOPT_POST , 0);
curl_setopt($ch , CURLOPT_HTTPHEADER , ['Content-Type: text/xml']); 

$res = curl_exec($ch);

if(curl_errno($ch)){
	exit(curl_error($ch));   //Could not resolve host: Resource id #2 
}
curl_close($ch);
echo $res;

