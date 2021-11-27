<?php

namespace app\mobile\model;
use think\Model;
use think\Db;

class BaseModel extends Model
{
    /*
    * [getWebConfig 获取网站配置]
    */
    public function getWebConfig()
    {
        $list = Db::name('web_config')->select();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        return $config;
    }

    /*
    * [getSystemConfig 获取系统配置]
    */
    public function getSystemConfig()
    {
        $list = Db::name('config')->select();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        return $config;
    }

    /*
     * [获取会员]
     */
    public function getMemberInfo($id)
    {
        $table = config('database.prefix').'member_group';
        return Db::name('member')->alias('a')->field('a.*,b.group_name,b.status as group_status')->join($table.' b', 'a.group_id = b.id', 'LEFT')->where('a.id', $id)->find();
    }

    /*
    * [获取在线客服配置]
    */
    public function getOnlineConfig()
    {
        $list = Db::name('online_config')->select();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        return $config;
    }

    /*
     * [获取客服列表]
     */
    public function getOnlineList()
    {
        return Db::name('online_list')->where('state',1)->order('sortnum asc')->select();
    }

    /*
     * [获取栏目分类]
     */
    public function getNavCate($map, $limit=null)
    {
        return Db::name('article_cate')->where($map)->limit($limit)->order('orderby asc, id asc')->select();
    }


    /*
     * [获取附加信息]
     */
    public function getOtherList($map)
    {
        return Db::name('other_list')->where($map)->order('sortnum asc, id asc')->select();
    }

    /*
     * [获取广告列表]
     */
    public function getAdverList($map,$type=1)
    {
        $date = strtotime(date('Y-m-d'));
        if($type==1){
            return Db::name('ad')->where($map)->where('status',1)->select();
        }else{
            return Db::name('ad')->where($map)->where('status',1)->order('orderby desc')->limit(1)->find();
        }

    }
    public function getAdverOne($map)
    {
        return Db::name('ad')->where($map)
            ->order('orderby asc, id asc')
            ->find();
    }
    /*
     * [获取微信配置]
     */
    public function getWeixinConfig()
    {
        $list = Db::name('wx_account')->select();
        return  $list;
    }
}