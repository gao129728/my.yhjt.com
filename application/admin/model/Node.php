<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class Node extends Model
{

    protected $name = "auth_rule";


    /**
     * [getNodeInfo 获取节点数据]
     *
     */
    public function getNodeInfo($id)
    {
        $result = $this->field('id,title,pid')->where('status=1')->select();
        $str = "";
        $role = new UserType();
        $rule = $role->getRuleById($id);

        if(!empty($rule)){
            $rule = explode(',', $rule);
        }
        foreach($result as $key=>$vo){
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['pid'] . '", "name":"' . $vo['title'].'"';

            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checked":1';
            }

            $str .= '},';
        }

        return "[" . substr($str, 0, -1) . "]";
    }


    /**
     * [getMenu 根据节点数据获取对应的菜单]
     *
     */
    public function getMenu($nodeStr = '')
    {
        if(session('uid') != 0 && session('uid') != 1 && empty($nodeStr)){
            return '';
        }else {
            //超级管理员没有节点数组
            if (session('uid') == 0) {
                $where = '';
            }elseif(session('uid') == 1){
                $where = 'status = 1';
            }else{
                $where = 'status = 1 and id in(' . $nodeStr . ')';
            }
            $result = Db::name('auth_rule')->where($where)->order('sort')->select();
            $menu = generateTree($result);
            return $menu;
        }
    }
}