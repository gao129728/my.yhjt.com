<?php

namespace app\api\model;
use think\Model;
use think\Db;

class MemberModel extends Model
{
    protected $name = 'member';  
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳
    protected $updateTime = false;

    /**
     * 插入信息
     */
    public function insertMember($param)
    {
        return $this->allowField(true)->save($param);
    }

    /**
     * 编辑信息
     */
    public function updateMember($param)
    {
        return  $this->allowField(true)->save($param, ['id' => $param['id']]);
    }

    /**
     * 获取会员信息
     */
    public function getOneMember($map)
    {
        return $this->where($map)->find();
    }

}