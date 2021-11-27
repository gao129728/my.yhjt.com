<?php

namespace app\mobile\model;
use think\Model;
use think\Db;


class OrdersModel extends Model
{
    protected $name = 'orders';

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    public static function getOrdersByWhere($map, $limits)
    {

        return self::where($map)->order('id desc')->paginate($limits);
    }


    public static function getOrdersCount($map)
    {
        return self::where($map)->count();
    }

    public static function insertOrders($param)
    {
        try{
            $result = self::strict(false)->insert($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' =>self::getError()];
            }else{
                return ['code' => 1,  'msg' => 'Order place successfully'];
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
            return ['code' => 1, 'data' => '', 'msg' => 'Delete successfully'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}