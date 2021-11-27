<?php
namespace app\mobile\controller;
use app\mobile\model\IndexModel;
use app\mobile\model\BaseModel;
use app\mobile\model\ArticleModel;
use think\Db;
class Index extends Base
{
    public function index(){

        $BaseModel = new BaseModel();
        $Article = new ArticleModel();
        $banner=$BaseModel->getAdverList(['ad_position_id'=>26]);

        /****product***/
        $cateid=Db::name('article_cate')->where(['parent_id'=>80])->order('orderby desc')->select();
        $topiclists = array();
        foreach ($cateid as &$v) {
            $topics = Db::name('article')->where(['cate_id'=>$v['id']])->order('sortnum desc')->select();
            foreach ($topics as &$val){
                if(!empty($val)){
                    array_push($topiclists, $val);
                }
            }
        }
        $this->assign('topiclists',$topiclists);


        /****关于我们***/
        $aboutus=$Article->getOneArticle(['cate_id'=>79]);
        $this->assign('aboutus',$aboutus);

        /*news*/
        $news=Db::name('article')->where(['cate_id'=>['in',[84,85]]])->limit(3)->order('create_time desc')->select();
        $this->assign('news',$news);



        $this->assign([
            'web_site_title'  => $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],
            'navCur' => 'index',
            'banner'=>$banner,

        ]);

        return $this->fetch();
    }

    public function get_child_cate($cid, $lvl=0)
    {
        $arr = [];
        $indexModel = new IndexModel();
        $cate = $indexModel->getCateId(['parent_id' => $cid]);
        if (count($cate) > 0) {
            $arr = $cate;
            foreach($cate as $v){
                $arr = array_merge($arr, $this->get_child_cate($v, $lvl+1));
            }
        }
        if($lvl == 0) array_push($arr, $cid);
        return $arr;
    }

}
