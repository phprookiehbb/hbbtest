<?php

/**
 * @Author: CraspHB彬
 * @Date:   2018-07-09 16:19:10
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-10 17:48:24
 */
require_once "regexTool.php";
$regex = new regexTool(true , 'Ui');
 

$zkw = file_get_contents('http://www.zkw.org.cn/home/index/xzx/cid/1.html');
//找出img的src
// //<img src="/public/home/images/zkw-0111.png"/>
// $patten = "/<img.*src.*=.*\"(.*)\".*\/>/Ui";
// 
//<a href="/home/pay/car.html">
// $patten = "/<a.*href.*=.*\"(.*)\".*\>/Ui";
// $regex->regex($patten,$zkw);
var_dump($regex->matches);




