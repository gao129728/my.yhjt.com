<?php

namespace app\api\controller;
use think\Db;

class Config
{
	public function index()
    {
		$list = Db::name('config')->select();
		if($list){
			$config = [];
			foreach ($list as $k => $v) {
				$config[trim($v['name'])] = $v['value'];
			}
			$title = $config['web_site_title'];
			$address = $config['web_address'];
			$copyright= $config['web_site_copy'];
			return json(['code' => 1, 'title' => $title, 'address' => $address, 'copyright'=>$copyright]);
		}else{
			return json(['code' => 0, 'msg' => '获取失败']);
		}

    }
}