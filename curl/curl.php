<?php
/**
 * @Author: CraspHB彬
 * @Date:   2018-07-14 09:11:23
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-14 16:16:15
 */

class Curl{
    
    protected $timeout = 300;
    protected $ch;
    
   /**
    * 初始化
    * @param string $timeout [description]
    */
   public function __construct($timeout = ''){

   	   $this->timeout = $timeout;
   	   $this->ch = curl_init();
   }
   /**
    * post请求
    * @param  [type] $url    [url地址]
    * @param  [type] $data   [post的参数,可以是"name=hbb&password=123"，也可以是['name'=>'hbb','password'=>132]]
    * @param  [type] $header [header头信息，数组,例子['Content-Type'=>'application/x-www-form-urlencoded;charset=utf-8'],此处不需要写‘Content-Length’]
    * @param  [type] $params [url的参数,可以是"name=hbb&password=123"，也可以是['name'=>'hbb','password'=>132]]
    * @return [type]         [description]
    */
   public function post($url , $data , $header = []  , $params = ''){
         $url = $this->http_build_url($url , $params);
         //获取post的值进行处理
         $postFields = is_array($data) ? http_build_query($data) : $data;
         //拼接"Content-Length"
         $httpheader = $this->http_bulid_header($header);
         array_push($httpheader,'Content-Length: '.strlen($postFields));

         curl_setopt($this->ch , CURLOPT_URL , $url);
         curl_setopt($this->ch , CURLOPT_HEADER , false);
         curl_setopt($this->ch , CURLOPT_RETURNTRANSFER , true);
         curl_setopt($this->ch , CURLOPT_TIMEOUT , $this->timeout);

         curl_setopt($this->ch , CURLOPT_SSL_VERIFYPEER , false);  //终止从服务端进行验证
         curl_setopt($this->ch , CURLOPT_SSL_VERIFYHOST , false);

         curl_setopt($this->ch , CURLOPT_POST , true);
         curl_setopt($this->ch , CURLOPT_POSTFIELDS , $postFields);
         curl_setopt($this->ch , CURLOPT_USERAGENT , $_SERVER['HTTP_USER_AGENT']);  //不设置会报“未将对象引用设置到对象的实例”
         curl_setopt($this->ch , CURLOPT_HTTPHEADER , $httpheader);

         $res = curl_exec($this->ch);
         if(curl_errno($this->ch)){
         	throw new Exception(curl_error($this->ch));
         }
         return $res;

   }
   /**
    * get请求
    * @param  [type] $url    [url地址]
    * @param  [type] $header [header头信息，数组,例子['Content-Type'=>'application/x-www-form-urlencoded;charset=utf-8'],此处不需要写‘Content-Length’]
    * @param  string $params [description]
    * @return [type]         [url的参数,可以是"name=hbb&password=123"，也可以是['name'=>'hbb','password'=>132]]
    */
   public function get($url , $header = []  , $params = ''){
		 $url = $this->http_build_url($url , $params);
         //header的值进行处理
         $httpheader = $this->http_bulid_header($header);

 		 curl_setopt($this->ch , CURLOPT_URL , $url);
         curl_setopt($this->ch , CURLOPT_HEADER , false);
         curl_setopt($this->ch , CURLOPT_RETURNTRANSFER , true);
         curl_setopt($this->ch , CURLOPT_TIMEOUT , $this->timeout);   

 		 curl_setopt($this->ch , CURLOPT_SSL_VERIFYPEER , false);  //终止从服务端进行验证
         curl_setopt($this->ch , CURLOPT_SSL_VERIFYHOST , false);     

         curl_setopt($this->ch , CURLOPT_USERAGENT , $_SERVER['HTTP_USER_AGENT']);
         curl_setopt($this->ch , CURLOPT_HTTPHEADER , $httpheader);

         $res = curl_exec($this->ch);
         if(curl_errno($this->ch)){
         	throw new Exception(curl_error($this->ch));
         }
         return $res;          

   }
   /**
    * header头拼接
    * @param  [type] $header [description]
    * @return [type]         [description]
    */
   protected function http_bulid_header($header){
   	   $httpheader = [];
       foreach($header as $k => $v){
          $httpheader[] = sprintf("%s: %s" , $k , $v);
       }
       return $httpheader;
   }
   /**
    * 获取url
    * @param  [type] $params [description]
    * @return [type]         [description]
    */
   protected function http_build_url($url , $params){

      if(empty($params)) return $url;
      $params = is_array($params) ? http_build_query($params): $params;
      $query = strpos($url,'?') !== false ? '&' : '?' . $params;
      return $url . $query;
   }
   /**
    * 销毁句柄资源
    */
   public function __destruct(){

   	  curl_close($this->ch);
   }
   
}

