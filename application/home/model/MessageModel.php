<?php

namespace app\home\model;
use think\Model;
use think\Db;

class MessageModel extends Model
{
    protected $name = 'message';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;





    public function getMessageByWhere($map, $limits)
    {
        return $this->where($map)->order('sortnum desc, id desc')->paginate($limits);
    }


    /**
     * [根据id获取一条信息]
     */
    public function getOneMessage($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * [删除]
     */
    public function delMessage($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}