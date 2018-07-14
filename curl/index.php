<?php

/**
 * @Author: CraspHB彬
 * @Date:   2018-07-14 09:11:28
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-14 16:11:36
 */

// POST /WebServices/WeatherWebService.asmx/getWeatherbyCityName HTTP/1.1
// Host: www.webxml.com.cn
// Content-Type: application/x-www-form-urlencoded
// Content-Length: length

// theCityName=string

$data = "theCityName=郑州";
$url = "www.webxml.com.cn/WebServices/WeatherWebService.asmx/getWeatherbyCityName";

$url2 = "www.webxml.com.cn/WebServices/WeatherWebService.asmx/getSupportCity";
$data2 = ['byProvinceName' => "河南"];

// $ch = curl_init(); //实例化curl

// curl_setopt($ch, CURLOPT_URL , $url); //设置请求的url地址
// curl_setopt($ch , CURLOPT_HEADER , 0); //是否将header头信息作为数据流输出
// curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);  //是否将获取的信息以文件流的形式返回，而不是直接输出。

// curl_setopt($ch , CURLOPT_POST , 1);        //设置post请求
// curl_setopt($ch , CURLOPT_POSTFIELDS , $data);  //设置post请求的参数

// curl_setopt($ch , CURLOPT_USERAGENT , $_SERVER['HTTP_USER_AGENT']); //设置浏览器信息，如果未设置可能会报“未将对象引用设置到对象的实例”的错误
// curl_setopt($ch , CURLOPT_HTTPHEADER , ['Content-Type: application/x-www-form-urlencoded;charset=utf-8','Content-Length: '.strlen($data)]);  //设置header头信息
// curl_setopt($ch , CURLOPT_TIMEOUT , 30); //设置超时时间

// $res = curl_exec($ch);    //执行

// if(curl_errno($ch)) {
// 	exit(curl_error($ch));
// }
// curl_close($ch);  ///关闭

require_once('curl.php');
$header = ['Content-Type'=>'application/x-www-form-urlencoded;charset=utf-8'];
$curl = new Curl(300);
var_dump($curl->post($url , $data , $header));
echo "</br>";
var_dump($curl->post($url2 , $data2 , $header));