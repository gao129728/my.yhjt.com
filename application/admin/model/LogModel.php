<?php

namespace app\admin\model;
use think\Model;

class LogModel extends Model
{
    protected $name = 'log';

    /**
     * 删除日志
     */
    public function delLog($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除日志成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}