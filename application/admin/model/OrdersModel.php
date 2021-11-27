<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class OrdersModel extends Model
{
    protected $name = 'orders';


    public static function getOrdersByWhere($map, $Nowpage, $limits)
    {
        return self::alias('a')->field('a.*,b.email as uemail')->join(__MEMBER__.' b','a.user_id=b.id','left')->where($map)->page($Nowpage, $limits)->order('a.id desc')->select();
    }
    public static function getOrdersByWheres($map, $limits)
    {
        return self::alias('a')->field('a.*,b.mobile as uphone')->join(__MEMBER__.' b','a.user_id=b.id','left')->where($map)->order('a.id desc')->paginate($limits);
    }

    public static  function getOrdersCount($map)
    {
        return self::alias('a')->join(__MEMBER__.' b','a.user_id=b.id','left')->where($map)->count();
    }

    public static function getList($map, $limits=null)
    {
        return self::alias('a')->field('a.*,b.mobile as uphone')->join(__MEMBER__.' b','a.user_id=b.id','left')->where($map)->order('a.id desc')->limit($limits)->select();
    }

    /**
     * [插入留言]
     */
    public static function insertOrders($param)
    {
        try{
            $result = self::strict(false)->insert($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' =>self::getError()];
            }else{
                return ['code' => 1,  'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2,  'msg' => $e->getMessage()];
        }
    }

    public static function updateOrders($param)
    {
        try{
            $result = self::where(['id'=>$param['id']])->update($param);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' =>self::getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '保存成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [根据id获取一条信息]
     */
    public static function getOneOrders($id)
    {
        return self::where('id', $id)->find();
    }

    public static function getInfo($map)
    {
        return self::where($map)->find();
    }

    /**
     * [删除]
     */
    public static function delOrders($map)
    {
        try{
            self::where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}