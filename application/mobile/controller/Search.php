<?php

namespace app\mobile\controller;
use app\mobile\model\ArticleModel;
use app\mobile\model\BaseModel;
use think\Db;

class Search extends Base
{
    //信息搜索
    public function index()
    {
        $articleModel = new ArticleModel();
        $BaseModel = new BaseModel();



        $key=input('param.keys');

        $adbanner=$BaseModel->getAdverOne(['ad_position_id'=>25]);
        $banner_img=$adbanner['photo'];
        $this->assign('banner_img', $banner_img);

        $map_list['title|content'] = ['like','%'.$key.'%'];
        $map_list['status'] = 1;
        $lists = $articleModel->getArticleByWhere($map_list,8);
        foreach($lists as &$vf){
            $vf['content']=leftstr_html($vf['content'],50);
            $vf['title']=str_replace($key, "<span style='color:#ef1d26;'>".$key."</span>", $vf['title']);
        }
        $current_title=$key.' - '.$this->config['web_site_title'];
        $web_site_keyword = empty($cateCur['keyword']) ? $this->config['web_site_keyword'] : $cateCur['keyword'];
        $web_site_description = empty($cateCur['description']) ? $this->config['web_site_description'] : $cateCur['description'];
        $web_site_title = empty($cateCur['seo_title']) ? $current_title : $cateCur['seo_title'];

        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
            'navCur' => 0,
            'keyss' => $key,
        ]);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function get_sub_menu($category)
    {
        if($category && is_array($category)){
            $lvl = count($category) - 1;
            if($lvl == 0){
                $category[0]['isCurrent'] = 1;
                $sub_menu = $category;
            }else {
                for ($i = $lvl; $i >= 0; $i--) {
                    if ($category[$i]['child']) {
                        foreach ($category[$i]['child'] as $k => $v) {
                            $v['url'] = getCateUrl($v['id'], $v['website'], $v['catedir']);
                            $v['isCurrent'] = 0;
                            $v['child'] = [];
                            if ($v['id'] == $category[$i + 1]['id']) {
                                $v['isCurrent'] = 1;
                                if ($category[$i + 1]['child']) $v['child'] = $category[$i + 1]['child'];
                            }
                            $category[$i]['child'][$k] = $v;
                        }
                    }
                }
                $sub_menu = $category[0]['child'];
            }
            return $sub_menu;
        }else{
            return false;
        }
    }


}