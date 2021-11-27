<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class CounterModel extends Model
{
    protected $name = 'counter';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;


    public function getCounterByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getCounterCnt($map)
    {
        return $this->where($map)->count();
    }

    /**
     * [删除]
     */
    public function delCounter($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}