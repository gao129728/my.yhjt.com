<?php
namespace app\api\controller;
use think\Db;

class Index
{
    public function getBanner()
    {
        $map['ad_position_id'] = 1;
        $map['status'] = 1;
        $lists = Db::name('ad')->field('images')->where($map)->order('orderby desc, id desc')->select();
        foreach($lists as $key => $val){
            $val['images'] = config('website_domain').'/uploads/images/'.$val['images'];
            $lists[$key] = $val;
        }
        return json($lists);
    }

    public function getBallCate()
    {
        $lists = Db::name('ground_cate')->field('id,name,photo,status')->order('orderby asc, id asc')->select();
        foreach($lists as $key => $val){
            $val['photo'] = config('website_domain').'/uploads/images/'.$val['photo'];
            $lists[$key] = $val;
        }
        return json($lists);
    }
    public function copyRight()
    {
        $copyright = Db::name('config')->where('name','web_site_copy')->value('value');
        return $copyright;
    }
}
