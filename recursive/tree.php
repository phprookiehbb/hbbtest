<?php

/**
 * @Author: CraspHB彬
 * @Date:   2018-07-12 11:23:05
 * @Email:   646054215@qq.com
 * @Last Modified time: 2018-07-12 17:10:35
 */
class Tree{

    private $arr = [];
    //配置的参数
	private $config = [
         'id' => 'id',
         'pid' => 'pid',
         'child' => 'child',
	]; 

	public function __construct($arr , $config = []){
        if(!empty($config)){
        	$this->config = array_merge($this->config, $config); //初始化参数
        }
        $this->arr = $arr;
	}
    /**
     * 递归获取列表
     * @param  integer $id   [description]
     * @param  integer $level [description]
     * @return [type]         [description]
     */
    public function get_list($id = 0 , $level = 1){
        $array = [];
        foreach($this->arr as $k => $v){
        	if( $v[$this->config['pid']] == $id ){
        		$lev = $level;
        		$v['level'] = $lev;
        		$v[$arr[$this->config['child']]] = $this->get_list($this->arr,$v[$this->config['id']] , ++$lev);
        		$array[] = $v;
        	}
        }
        return $array;
    }
    /**
     * 获取该id下所有子类的id
     * @param  [type]  $id   [description]
     * @param  boolean $only_id [description]
     * @return [type]        [description]
     */
    public function get_childs_all($id , $only_id = false){   
        static $array = [];
        foreach($this->arr as $k => $v){
        	if( $v[$this->config['pid']] == $id ){
        		if($only_id){
        			array_push($array,$v[$this->config['id']]);
        		}else{
        			array_push($array,$v);
        		}
        		$this->get_childs_all($v[$this->config['id']] , $only_id);
        	}
        }
        return $array;
    }
}