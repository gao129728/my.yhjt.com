<?php

namespace app\admin\controller;
use app\admin\model\Node;
use think\Controller;
use think\Db;

class Base extends Controller
{
    public function _initialize()
    {






        if((!session('uid') && session('uid') != 0) ||!session('username')){
            $this->redirect(('login/index'),302);
        }


        $node = new Node();
        $this->assign([
            'uid' => session('uid'),
            'username' => session('username'),
            'portrait' => session('portrait'),
            'rolename' => session('rolename'),
            'login_time' => session('login_time'),
            'menu' => $node->getMenu(session('rule'))
        ]);

        $config = cache('db_config_data');

        if(!$config){
            $config = load_config();
            cache('db_config_data',$config);
        }
        config($config);

        if(config('web_site_close') == 0 && session('uid') !=0 && session('uid') !=1 ){
            $this->error('站点已经关闭，请稍后访问~');
        }

        if(config('admin_allow_ip') && session('uid') !=0 && session('uid') !=1 ){
            if(in_array(request()->ip(),explode('#',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }

        $this->assign('wap_state',config('wap_site_state'));

    }

    public function CheckAuth(){
        $auth = new \com\Auth();
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;

        //跳过检测以及主页权限
        if(session('uid')!=0 && session('uid') !=1){
            if(!in_array($url, ['admin/index/index','admin/index/indexpage','admin/upload/upload','admin/index/uploadface'])){
                if(!$auth->check($url,session('uid'))){
                    $this->error('抱歉，您没有操作权限');
                }
            }
        }
    }

    public function update(){
        $param=input('param.');

        $info= Db::name($param['name'])->where(['id'=>$param['id']])->find();
        $result=Db::name($param['name'])->where(['id'=>$param['id']])->update(['video'=>$param['video']]);

        if(!empty($info['video'])) deleteFile($info['video'],'');

    }
}