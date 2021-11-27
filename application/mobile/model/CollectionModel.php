<?php

namespace app\mobile\model;
use think\Model;
use think\Db;

class CollectionModel extends Model
{
    protected $name = 'collection';


    public function getCollectionByWhere($map, $limits)
    {
        return $this->where($map)->paginate($limits)->order('id desc')->select();
    }

    public function getCollectionListByWhere($map, $limits)
    {
        return $this->where($map)->order('id desc')->paginate($limits);
    }

    public function getCollectionCount($map)
    {
        return $this->where($map)->count();
    }
    public function insertCollection($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
//                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
                return ['code' => 1, 'data' => '', 'msg' => 'Collect successfully'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public  function editCollection($param)
    {
        try{
            $result =  $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => 'Add successfully'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public  function updateCollection($map,$param)
    {
        try{
            $result =  $this->where($map)->update($param);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '更新成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function getOneCollection($map)
    {
        return $this->where($map)->find();
    }

    public function getCollectionList($map){

        return $this->where($map)->select();
    }

    public function delCollection($map){
        try{
            $result = $this->where($map)->delete();
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => 'Delete successfully'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }




}