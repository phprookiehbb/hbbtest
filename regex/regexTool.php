<?php

/**
 * @Author: CraspHB彬
 * @Date:   2018-07-09 15:34:45
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-10 15:38:55
 */
/**
 *  正则验证的工具栏
 */
class regexTool{

    //定义常用的验证正则
    public $validate = [
        'require' => '/.+/',                                       //不能为空
        'number'  => '/^[-|+]?\d+$/',                              //必须是数字
        'float'   => '/^[-|+]?\d+.\d+$/',                          //浮点类型
        'alpha'   => '/^[a-zA-Z]+$/',                              //是字母
        'email'   => '/^\w+(.\w+)*@\w+(.\w+)*$/',                  //邮箱646054215@qq.com    qq.vip.a@qq.com.cn
        'phone'   => '/^1[3|4|5|7|8|9]\d{9}$/',                    //电话
        'url'     => '/^(https?:\/\/)?\w+(.\w+)*.(net|com|cn)$/',  //url    https://www.zjwam.net   zjwam.net

    ];
    //正则表达式
    public $patten;
    //是否返回匹配结果
    public $isReturnRes;
    //模式修正符
    public $modifier;
    //返回的结果
    public $matches = [];
    //返回的bool结果
    public $isMatch;

    public function __construct( $isReturnRes = false , $modifier = '' ){

           	 $this->isReturnRes = $isReturnRes;  	
           	 $this->modifier = $modifier;  
    }
    /**
     * 正则验证
     * @param  [type] $patten  [正则表达式或者定义的字段]
     * @param  [type] $subject [需要查找的值]
     * @return [type]          [bool|array]
     */
    public function regex($patten , $subject){
        $validate = $this->validate;
    	//判断是否存在已定义的验证规则
    	  	if( array_key_exists(strtolower($patten) , $validate) !== false ) {   //在定义的中
	            if(!empty($this->modifier)){
	            	$patten = $validate[strtolower($patten)].$this->modifier;
	            }else{
	            	$patten = $validate[strtolower($patten)];
	            }
           	} 
            if($this->isReturnRes){ //返回结果集
            	 $matches = [];
                 $res = preg_match_all($patten , $subject , $matches);
                 $this->isMatch = $res === 0 ? false : true;
                 $this->matches = $matches;
                 return $this->matches;
            }else{
            	$res = preg_match($patten , $subject);
            	$this->isMatch = $res === 0 ? false : true;
            	return $this->isMatch;
            }
    	
    }
	/**
     * 是否为空
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isEmpty($subject){
         $this->regex('require' , $subject);
         return !$this->isMatch;
    }   
    /**
     * 是否是数字
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isNumber($subject){
         $this->regex('number' , $subject);
         return $this->isMatch;
    } 
	/**
     * 是否是小数
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isFloat($subject){
         $this->regex('float' , $subject);
         return $this->isMatch;
    }
    /**
     * 是否是字母
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isAlpha($subject){
         $this->regex('alpha' , $subject);
         return $this->isMatch;
    }             
	/**
     * 是否是email
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isEmail($subject){
         $this->regex('email' , $subject);
         return $this->isMatch;
    }       
    /**
     * 是否是电话
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isPhone($subject){
         $this->regex('phone' , $subject);
         return $this->isMatch;
    }
 	/**
     * 是否是url
     * @param  [type]  $subject [description]
     * @return boolean          [description]
     */
    public function isUrl($subject){
         $this->regex('url' , $subject);
         return $this->isMatch;
    } 


 	// public function isUrl($subject){
  //        $res = $this->regex('url' , $subject);
  //        return $this->changeBool($res);
  //   }                
  //   protected function changeBool($res){
		// if ( empty($res) || $res === false ){
  //        	 return false;
  //        }else{
  //        	return true;
  //        }
  //   }
}


// $regex = new regexTool(true , 'Ui');

// $subject = "";
// var_dump($regex->isEmpty($subject));
