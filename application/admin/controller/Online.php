<?php

namespace app\admin\controller;
use app\admin\model\OnlineModel;
use app\admin\controller\Upload;
use think\Db;

class Online extends Base
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
     */
    public function index() {
        $onlineModel = new OnlineModel();
        $list = $onlineModel->getAllConfig();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        $this->assign('config',$config);
        $this->assign('online_list',$onlineModel->getOnlineList());
        return $this->fetch();
    }

    /**
     * 批量保存配置
     */
    public function save(){
        if(request()->isAjax()){
            $param = input('post.');
            $config = $param['config'];
            $onlineModel = new OnlineModel();
            $upload = new Upload();

            $file_code  = request()->file('qrcode');
            if($file_code || (isset($param['delQrcode']) && $param['delQrcode'] == 1)){
                $config['qrcode'] = $upload->uploadImage($file_code);
                $qrcode = Db::name('online_config')->where('name','qrcode')->value('value');
            }

            $config['status'] = isset($config['status'])? $config['status']: 0;
            $config['show_btn'] = isset($config['show_btn'])? $config['show_btn']: 0;
            $config['is_open'] = isset($config['is_open'])? $config['is_open']: 0;

            if($config && is_array($config)){
                foreach ($config as $name => $value) {
                    $map = array('name' => $name);
                    $onlineModel->SaveConfig($map,$value);
                }
                if(count($param['number']) > 0){
                    foreach($param['number'] as $k => $arr){
                        $list[$k]['sortnum'] = $k+1;
                        $list[$k]['number'] = $arr;
                        $list[$k]['name'] = isset($param['name'][$k])? $param['name'][$k] : '';
                        $list[$k]['show_icon'] = $param['show_icon'][$k];
                        $list[$k]['state'] = isset($param['state'][$k])? $param['state'][$k] : '';
                        if(isset($param['id'][$k])){
                            $list[$k]['id'] = $param['id'][$k];
                            $onlineModel->updateOnlineList($list[$k]);
                        }else{
                            $onlineModel->addOnlineList($list[$k]);
                        }
                    }
                }
                if(!empty($qrcode)) deleteFile($qrcode, config('upload_img.path'));

                return json(['code' => 1, 'msg' =>'保存成功！']);
            }else{
                return json(['code' => 0, 'msg' =>'保存失败！']);
            }
        }
    }

    /**
     * [删除客服]
     */
    public function del_online()
    {
        $id = input('param.id');
        $flag = Db::name('online_list')->where('id', $id)->delete();
        if($flag){
            return json(['code' => 1, 'msg' => '删除成功']);
        }else{
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}