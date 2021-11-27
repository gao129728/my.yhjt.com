<?php

namespace app\home\controller;
use think\Db;

class Sitemap extends Base
{
    //网站地图
    public function sitemap()
    {
        $base_name = '网站地图';
        $this->assign([
            'web_site_title'  => $base_name.' - '.$this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],
            'navCur'=>'sitemap'
        ]);

        $cate = Db::name('article_cate')->where('status=1')->order('orderby asc, id asc')->select();
        $cate_tree = $this->make_tree($cate);
        $this->assign('cate_tree', $cate_tree);
        $this->assign('base_name', $base_name);

        return $this->fetch();
    }

    function make_tree($arr){
        $refer = [];
        $tree = [];
        foreach($arr as $k => $v){
            $arr[$k]['url'] =  getCateUrl($v['id'], $v['website'], $v['catedir']);
            $refer[$v['id']] = & $arr[$k]; //创建主键的数组引用
        }
        foreach($arr as $k => $v){
            $pid = $v['parent_id'];  //获取当前分类的父级id
            if($pid == 0){
                $tree[] = & $arr[$k];  //顶级栏目
            }else{
                if(isset($refer[$pid])){
                    $refer[$pid]['child'][] = & $arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
                }
            }
        }
        return $tree;
    }
}