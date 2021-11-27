<?php

namespace app\mobile\controller;
use app\mobile\model\BaseModel;
use app\mobile\model\WeixinModel;
use app\mobile\model\Weixin_payModel;
use think\Controller;
use think\Db;

class Base extends Controller
{
    public function _initialize()
    {
    	$model = new BaseModel();
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
            $data['client'] ='手机端';
            $data['ip']	 =	get_client_ip();
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


        //网站会员
        if($config['web_site_member'] == 1){
            $member_login = $this->isLogin();
            if($member_login){
                $isLogin = true;
                $this->assign('member',$member_login);
            }else{
                $isLogin = false;
            }
            $this->assign('isLogin',$isLogin);
        }


        //是否登录
        $member_login = $this->isLogin();
        if($member_login){
            $isLogin = true;
            $this->assign('member',$member_login);
        }else{
            $isLogin = false;
        }
        $this->assign('isLogin',$isLogin);




        if($SystemConfig['web_weixin_state'] == 1){
            $this->wxpz=$model->getWeixinConfig();
            $Weixin=new WeixinModel($this->wxpz['appscrect'],$this->wxpz['appid']);

            $code=(input('param.code'));

            if (!empty($code)) {

                $res=$Weixin->get_access_token($code);
                $userinfo=$Weixin->get_openid_userinfo($res['access_token'],$res['openid']);

                halt($userinfo);

            }

            $res=$Weixin->code_shouquan();
        }


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

        $empty= '<div style="text-align:center;padding:20px 0px;vertical-align:middle;color: #8c8484;font-size: 14px">No information is available...</div>';
        $this->assign('empty',$empty);

        $empty_collect= '<div style="text-align:center;padding:20px 0px;vertical-align:middle;color: #8c8484;font-size: 14px">Collection is empty,<br><a href="/mobile/category/index/id/80" style="text-decoration-line: underline">View products right away!</a></div>';
        $this->assign('empty_collect',$empty_collect);

        $empty_shopcart= '<div style="text-align:center;padding:20px 0px;vertical-align:middle;color: #8c8484;font-size: 14px">Cart is empty,<br><a href="/mobile/category/index/id/80" style="text-decoration-line: underline">View products right away!</a></div>';
        $this->assign('empty_shopcart',$empty_shopcart);

        $empty_order= '<div style="text-align:center;padding:20px 0px;vertical-align:middle;color: #8c8484;font-size: 14px">Order is empty,<br><a href="/mobile/category/index/id/80" style="text-decoration-line: underline">View products right away!</a></div>';
        $this->assign('empty_order',$empty_order);



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

