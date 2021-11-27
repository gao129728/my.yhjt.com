<?php

namespace app\admin\controller;
use app\admin\model\WeixinModel;
use think\Db;

class Weixin extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    /**
     * 获取配置参数
     *
     */
    public function index() {
        $configModel = new WeixinModel();
        $list = $configModel->getAllConfig();
        $this->assign('wx',$list);
        return $this->fetch();
    }

    /**
     * 批量保存配置
     *
     */
    public function save(){
        if(request()->isAjax()){
            $param = input('post.');

            $configModel = new WeixinModel();
            $flag=$configModel->SaveConfig($param);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);


        }
    }

}