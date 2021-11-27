<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class WeixinModel extends Model
{
    protected $name = 'wx_account';

    //获取配置所有信息
    public function getAllConfig()
    {
        return $this->where(['id'=>1])->find();
    }


    //保存信息
    public function SaveConfig($param)
    {


        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => -1, 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'msg' => '保存成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}