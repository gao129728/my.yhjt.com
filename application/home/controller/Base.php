<?php

namespace app\home\controller;
use app\home\model\ArticleModel;
use app\home\model\BaseModel;
use think\Controller;
use think\Db;
use redis\RedisPackage;
class Base extends Controller
{
    protected static $redis;

    public function __construct()
    {
        parent::__construct();
    }
    public function _initialize()
    {
    	$model = new BaseModel();
        $article = new ArticleModel();
        $SystemConfig =  $model->getSystemConfig();
//        if($SystemConfig['web_site_state'] != 1){
//            $this->error('网站无法访问');
//        }

        $config = $model->getWebConfig();
        $this->config = $config;
        $map['status'] = 1;
        $map['parent_id'] = 0;
        $navCate = $model->getNavCate($map);
        foreach($navCate as $key => $val){
            $val['url'] = getCateUrl($val['id'], $val['website'], $val['catedir']);
                $map['parent_id'] = $val['id'];
                $val['sub'] = $model->getNavCate($map);
                if(count($val['sub'])>0){
                    foreach($val['sub'] as $k => $v){
                        $v['url'] = getCateUrl($v['id'], $v['website'], $v['catedir']);
                        $val['sub'][$k] = $v;
                    }
                }
            $navCate[$key] = $val;
        }
        $nav_width = substr(sprintf('%.3f', 1200/(count($navCate)+1)),0,-1);

        $this->assign('nav_width',$nav_width);
        $this->assign('nav_cate',$navCate);
        $this->assign('config',$config);

        //访问统计
        $web_user_counter = cookie('web_user_counter');
        if(empty($web_user_counter))
        {
            cookie('web_user_counter', 'value', 3600);
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!= '')
            {
                $data['source'] = $_SERVER['HTTP_REFERER']; //有来源
            }else{
                $data['source'] = ""; //直接输入网址访问
            }
            $data['id'] = Db::name('counter')->max('id') + 1;
            $data['ip']	 =	get_client_ip();
            $data['client'] ='电脑端';
            $data['create_time']  =	time();
            $data['state'] = 0;
            Db::name('counter')->insert($data);
        }


        //访问数量
        $counter=Db::name('counter')->count();
        $this->assign('counter',$counter);
        $str = $counter;
        $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
        $this->assign('chars',$chars);


        //在线客服
        $online_config = $model->getOnlineConfig();
        $this->assign('online_config',$online_config);
        if($online_config['status'] == 1){
            $this->assign('online_list',$model->getOnlineList());
        }

        //广告列表
        $adverList = $model->getAdverLists(['status'=>1]);
        $this->assign('adverList',$adverList);

        //是否登录
        $member_login = $this->isLogin();
        if($member_login){
            $isLogin = true;
            $this->assign('member',$member_login);
        }else{
            $isLogin = false;
        }
        $this->assign('isLogin',$isLogin);


        /*底部二维码*/
        $qrcode=DB::name('ad')->where(['ad_position_id'=>27])->order('orderby desc')->select();
        $this->assign('qrcode',$qrcode);

        /*内页logo*/
        $logo=DB::name('ad')->where(['ad_position_id'=>26])->order('orderby desc')->limit(1)->value('photo');
        $this->assign('logo',$logo);

        /*友情链接*/
        $link=DB::name('nature')->where(['nature_id'=>1])->order('sortnum desc')->select();
        $this->assign('link',$link);

        /*左侧外链*/
        $left_link=DB::name('nature')->where(['nature_id'=>2])->order('sortnum desc')->select();
        $this->assign('left_link',$left_link);

        $empty= '<div style="text-align:center;padding:20px 0px;vertical-align:middle;color: #8c8484;font-size: 20px">No information is available...</div>';
        $this->assign('empty',$empty);


    }

    /*
   * [获取banner配置]
   */
    public function getBannerConfig($id)
    {
        return Db::name('banner_cate')->where('id',$id)->find();
    }

    /*
     * [判断用户是否登录]
     */
//    public function isLogin()
//    {
//        if(cookieCrypt('web_userId')){
//            $userId    = (int)cookieCrypt('web_userId');
//            $baseModel = new BaseModel();
//            $member  = $baseModel->getMemberInfo($userId);
//            if($member){
//                if($member['status'] == 0|| $member['group_status'] == 0){
//                    cookie('web_userId', null);
//                    return false;
//                }
//                return $member;
//            }else{
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }


    public function isLogin()
    {
        if(session('web_userId')){
            $userId    = (int)session('web_userId');
            $baseModel = new BaseModel();
            $member  = $baseModel->getMemberInfo($userId);
            if($member){
                if($member['status'] == 0|| $member['group_status'] == 0){
                    session('web_userId', null);
                    return false;
                }
                return $member;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }




}

