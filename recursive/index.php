<?php

/**
 * @Author: CraspHB彬
 * @Date:   2018-07-12 09:16:42
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-12 17:59:05
 */

$dir = str_replace('\\','/',dirname(dirname(__DIR__))).'/study';

function get_file_list($dir){
     static $array = [];
     $dh = opendir($dir);
     while(($file = readdir($dh)) !== false){
     	 if($file == ".." || $file == ".") continue; // 跳过.跟..
     	 $filename = $dir.'/'.$file;
     	 if(is_dir($filename)){
     	 	get_file_list($filename);
     	 }
     	 $array[] = $filename;

     }
     closedir($dh);
     return $array;
}