<?php

namespace app\admin\controller;
use app\admin\model\MenuModel;
use think\Db;

class Menu extends Base
{
    /**
     * [index 菜单列表]
     * @return [type] [description]
     *
     */
    public function index()
    {
        $nav = new \org\Leftnav;
        $menu = new MenuModel();
        $admin_rule = $menu->getAllMenu();
        $arr = $nav::rule($admin_rule);
        $this->assign('admin_rule',$arr);
        return $this->fetch();
    }
    public function articlecate()
    {
        $list=Db::name('cate_config')->select();
        $config = [];
        foreach ($list as $k => $v) {
            $config[trim($v['name'])] = $v['value'];
        }

        $this->assign('config',$config);
        return $this->fetch();
    }

	
    /**
     * [add_rule 添加菜单]
     * @return [type] [description]
     *
     */
	public function add_rule()
    {
        if(request()->isAjax()){
            $param = input('post.');           
            $menu = new MenuModel();
            $flag = $menu->insertMenu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        return $this->fetch();
    }
    public function save(){
        if(request()->isAjax()){
            $param = input('post.');
            $config = $param['config'];
            if($config && is_array($config)){
                foreach ($config as $name => $value) {
                    $map = array('name' => $name);
                     Db::name('cate_config')->where($map)->setField('value', $value);
                }

                return ['code' => 1, 'msg' => '保存成功'];
            }else{
                return ['code' => -1, 'msg' => '保存失败'];
            }
        }
    }

    /**
     * [edit_rule 编辑菜单]
     * @return [type] [description]
     *
     */
    public function edit_rule()
    {
        $menu = new MenuModel();
        if(request()->isPost()){
            $param = input('post.');
            $flag = $menu->editMenu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('menu',$menu->getOneMenu($id));
        return $this->fetch();
    }


    /**
     * [roleDel 删除角色]
     * @return [type] [description]
     *
     */
    public function del_rule()
    {
        $id = input('param.id');
        $menu = new MenuModel();
        $flag = $menu->delMenu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * [ruleorder 排序]
     * @return [type] [description]
     *
     */
    public function ruleorder()
    {
        if (request()->isAjax()){
            $param = input('post.');     
            $auth_rule = Db::name('auth_rule');
            foreach ($param as $id => $sort){
                $auth_rule->where(array('id' => $id ))->setField('sort' , $sort);
            }
            return json(['code' => 1, 'msg' => '排序更新成功']);
        }
    }
}