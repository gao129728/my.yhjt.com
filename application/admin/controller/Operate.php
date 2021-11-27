<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;

class Operate
{
    public function status_switch()
    {
        $id=input('param.id');
        $name = input('param.name');
        $table = input('param.table');

        $info = Db::name($table)->where('id', $id)->find();
        $cur_val = $info[$name];//判断当前状态情况
        $data['id'] = $id;
        if($cur_val==1)
        {
            $data[$name] = 0;
            Db::name($table)->update($data);
            return json(['code' => 1, 'msg' => '已关闭']);
        }
        else
        {
            $data[$name] = 1;
            Db::name($table)->update($data);
            return json(['code' => 0, 'msg' => '已开启']);
        }

    }

    public function update_text()
    {
        $param = input('param.');
        $name = $param['name'];
        $table = $param['table'];
        $data['id'] = $param['id'];
        $data[$name] = $param['val'];
        $flag = Db::name($table)->update($data);
        if($flag==1)
        {
            return json(['code' => 1, 'msg' => '更新成功']);
        }else{
            return json(['code' => 0, 'msg' => '更新失败']);
        }
    }
}