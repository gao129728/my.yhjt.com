<?php

namespace app\admin\controller;
use app\admin\model\ConfigModel;
use think\Db;

class Config extends Base
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
        $configModel = new ConfigModel();
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
            $configModel = new ConfigModel();

            if($config && is_array($config)){
                foreach ($config as $name => $value) {
                    $map = array('name' => $name);
                    $configModel->SaveConfig($map,$value);
                }

                cache('db_config_data',null);

                if($config['wap_site_domain']){
                    $aa=$config['wap_site_domain'];
                }else{
                    $aa='';
                }

                $route_dir = ROOT_PATH . "data/route/";
                if (!file_exists($route_dir)) {
                    mkdir($route_dir);
                }

                $route_file = $route_dir . "mobile_domain.php";
                file_put_contents($route_file, "<?php\treturn '" . stripslashes($aa) . "'");

                return json(['code' => 1, 'msg' =>'保存成功！']);
            }else{
                return json(['code' => 0, 'msg' =>'保存失败！']);
            }
        }
    }

}