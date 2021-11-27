<?php
namespace app\admin\controller;
use app\admin\model\WebsiteModel;
use app\admin\controller\Upload;
use think\Db;

class Website extends Base
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
        $configModel = new WebsiteModel();
        $list = $configModel->getAllConfig();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }
        $this->assign('config',$config);

        return $this->fetch();
    }

    /**
     * 批量保存配置
     *
     */
    public function save(){
        if(request()->isAjax()){
            $param = input('post.');
            $config = $param['config'];
            $configModel = new WebsiteModel();
            $upload = new Upload();

            $file  = request()->file('web_site_logo');
            if($file || (isset($param['delLogo']) && $param['delLogo'] == 1)){
                $config['web_site_logo'] = $upload->uploadImage($file);
                $logo = Db::name('config')->where('name','web_site_logo')->value('value');
            }

            $file1  = request()->file('web_site_ico');
            if($file1 || (isset($param['delIco']) && $param['delIco'] == 1)){
                $config['web_site_ico'] = $upload->uploadImage($file1);
                $ico = Db::name('config')->where('name','web_site_ico')->value('value');
            }
            $file2  = request()->file('web_site_qrcode');
            if($file2 || (isset($param['delQrcode']) && $param['delQrcode'] == 1)){
                $config['web_site_qrcode'] = $upload->uploadImage($file2);
                $qrcode = Db::name('config')->where('name','web_site_qrcode')->value('value');
            }

            $file3  = request()->file('web_site_waplogo');
            if($file3 || (isset($param['delwapLogo']) && $param['delwapLogo'] == 1)){
                $config['web_site_waplogo'] = $upload->uploadImage($file3);
                $waplogo = Db::name('config')->where('name','web_site_waplogo')->value('value');
            }

            $file4  = request()->file('web_site_wapqrcode');
            if($file4 || (isset($param['delwapqrcode']) && $param['delwapqrcode'] == 1)){
                $config['web_site_wapqrcode'] = $upload->uploadImage($file4);
                $wapqrcode = Db::name('config')->where('name','web_site_wapqrcode')->value('value');
            }

            if($config && is_array($config)){
                foreach ($config as $name => $value) {
                    $map = array('name' => $name);
                    $configModel->SaveConfig($map,$value);
                }

                if(!empty($logo)) deleteFile($logo, config('upload_img.path'));
                if(!empty($waplogo)) deleteFile($waplogo, config('upload_img.path'));
                if(!empty($ico)) deleteFile($ico, config('upload_img.path'));
                if(!empty($qrcode)) deleteFile($qrcode, config('upload_img.path'));
                if(!empty($wapqrcode)) deleteFile($wapqrcode, config('upload_img.path'));

                return json(['code' => 1, 'msg' =>'保存成功！']);
            }else{
                return json(['code' => 0, 'msg' =>'保存失败！']);
            }
        }
    }

}