<?php

namespace app\home\model;
use think\Model;
use think\Db;

class AddressModel extends Model
{
    protected $name = 'address';


    public function getAddressByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

    public function getAddressListByWhere($map,$order='is_default desc,id desc')
    {
        return $this->where($map)->order($order)->select();
    }

    public function getAddressCount($map)
    {
        return $this->where($map)->count();
    }
    public function insertAddress($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => 'Add address successfully'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public  function editAddress($param)
    {
        try{
            $result =  $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => 'Edit successfully'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public  function updateAddress($map,$param)
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


    public function getOneAddress($map)
    {
        return $this->where($map)->find();
    }

    public function getCartAddress($map){

        return $this->where($map)->select();
    }

    public function delAddress($map){
        try{
            $result =   $this->where($map)->delete();
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