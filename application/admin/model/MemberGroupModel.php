<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class MemberGroupModel extends Model
{
    protected $name = 'member_group';   
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳

    /**
     * 获取所有的会员组信息
     */ 
    public function getGroup()
    {
        return $this->order('id asc')->select();
    }

    /**
     * 插入信息
     */
    public function insertGroup($param)
    {
        try{
            $result =  $this->validate('MemberGroupValidate')->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     */
    public function editGroup($param)
    {
        try{
            $result =  $this->validate('MemberGroupValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 根据id获取一条信息
     */
    public function getOne($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除信息
     */
    public function delGroup($id)
    {
        try{
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}