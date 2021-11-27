<?php

namespace app\mobile\model;
use think\Model;
use think\Db;

class CartModel extends Model
{
    protected $name = 'shop_cart';


    public function getCartByWhere($map, $limits)
    {
        return $this->where($map)->paginate($limits)->order('id desc')->select();
    }

    public function getCartListByWhere($map, $limits)
    {
        return $this->where($map)->paginate($limits)->order('id desc')->select();
    }

    public function getCartCount($map)
    {
        return $this->where($map)->count();
    }
    public function insertCart($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
//                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
                return ['code' => 1, 'data' => '', 'msg' => 'Add successfully'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public  function editCart($param)
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

    public  function updateCart($map,$param)
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


    public function getOneCart($map)
    {
        return $this->where($map)->find();
    }

    public function getCartList($map){

        return $this->where($map)->select();
    }

    public function delcart($map){
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