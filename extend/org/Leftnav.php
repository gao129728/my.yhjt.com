<?php
namespace org;

class leftnav{

	static public function rule($cate , $lefthtml = '— — ' , $pid=0 , $lvl=0, $leftpin=0 ){
		$arr=array();
		foreach ($cate as $v){
			if($v['pid']==$pid){
				$v['lvl']=$lvl + 1;
				$v['leftpin']=$leftpin + 0;//左边距
				$v['lefthtml']=str_repeat($lefthtml,$lvl);
				$arr[]=$v;
				$arr= array_merge($arr,self::rule($cate,$lefthtml,$v['id'],$lvl+1 , $leftpin+20));
			}
		}
		return $arr;
	}

	static public function get_cate_tree($cate, $lefthtml = '— — ' , $leftpin=0, $pid=0 , $lvl=0){
		$arr=array();
		foreach ($cate as $v){
			if($v['parent_id']==$pid){
				$v['lvl']=$lvl + 1;
				$v['leftpin']=$leftpin + 0;//左边距
				$v['lefthtml']=str_repeat($lefthtml,$lvl);
				$arr[]=$v;
				$arr= array_merge($arr,self::get_cate_tree($cate,$lefthtml,$leftpin+24,$v['id'],$lvl+1));
			}
		}
		return $arr;
	}

	static public function get_cate_id($cate, $pid=0){
		$arr=array();
		foreach ($cate as $v){
			if($v['parent_id']==$pid){
				$arr[]=$v['id'];
				$arr= array_merge($arr,self::get_cate_id($cate,$v['id']));
			}
		}
		return $arr;
	}
	
}


?>