<?php

namespace app\api\controller;
use think\Db;

class Article
{
	public function index()
    {
		$map['cate_id'] = 1;
		$map['status'] = 1;
		$article = Db::name('article')->where($map)->order('is_tui desc, id desc')->find();
        if($article){
			$pic = config('website_domain').'/uploads/images/'.$article['photo'];
			return json(['code'=>1, 'title'=>$article['title'], 'pic'=>$pic, 'content'=>$article['content']]);
		}else{
			return json(['code'=>0, 'msg'=>'请求错误，请稍后再试']);
		}
    }
}