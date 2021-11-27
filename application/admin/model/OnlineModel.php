<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class OnlineModel extends Model
{
    protected $name = 'online_config';

    //获取配置所有信息
    public function getAllConfig()
    {
        return $this->select();
    }


    //保存信息
    public function SaveConfig($map,$value)
    {
        try{
            $result = $this->allowField(true)->where($map)->setField('value', $value);
            if(false === $result){            
                return ['code' => -1, 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'msg' => '保存成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [获取客服列表]
     */
    public function getOnlineList()
    {
        return Db::name('online_list')->order('sortnum asc')->select();
    }

    /**
     * [新增客服]
     */
    public function addOnlineList($param)
    {
        return Db::name('online_list')->insert($param);
    }

    /**
     * [更新客服]
     */
    public function updateOnlineList($param)
    {
        return Db::name('online_list')->update($param);
    }

}