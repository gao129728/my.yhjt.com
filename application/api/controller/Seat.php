<?php
namespace app\api\controller;
use app\admin\model\GroundModel;
use app\admin\model\GroundTimeModel;
use app\admin\model\OrderModel;
use think\Db;

class Seat
{
    public function getDate()
    {
        $param = input('param.');
        $data = getDateList();
        $list = [];
        foreach($data as $key => $val){
            if($param['site'] == 'left'){
                if($key <= 3){
                    $list[$key] = $val;
                }
            }else{
                if($key >= 3){
                    $list[$key] = $val;
                }
            }
        }
        return json($list);
    }

    public function nowDate()
    {
        return date('Y-m-d');
    }

    public function getGround()
    {
        $cateid = input('param.cateid');
        $map['cate_id'] = $cateid;
        $map['status'] = 1;
        $lists = Db::name('ground')->field('title')->where($map)->order('sortnum asc, id asc')->select();
        return json($lists);
    }

    public function getSeat()
    {
        $cateid = input('param.cateid');
        $date   = input('param.date');
        if(empty($date)){
            $date = date('Y-m-d');
        }

        $orderModel = new OrderModel();
        $v_time = time() - config('pay_validity')*60;

        $groundTimeModel = new GroundTimeModel();
        $ground_time = $groundTimeModel->getAllTime();
        $map_ground['status'] = 1;
        $map_ground['cate_id'] = $cateid;
        $groundModel = new GroundModel();
        $ground = $groundModel->getGroundList($map_ground);
        $lists = [];
        foreach($ground_time as $key => $val){
            $lists[$key]['id'] = $val['id'];
            $lists[$key]['s_time'] = $val['start_time'];
            $lists[$key]['e_time'] = $val['end_time'];
            $map['cateId'] = $cateid;
            $map['timeId'] = $val['id'];
            $timePrice = Db::name('ground_price')->where($map)->find();
            $week = date("w",strtotime($date));
            if($week == 0 || $week == 6){
                $lists[$key]['price'] = $timePrice['week_price'];
            }else{
                $lists[$key]['price'] = $timePrice['price'];
            }
            $arr = [];
            $lists[$key]['seat'] = [];
            foreach($ground as $k => $v){
                $map_seat['a.cateId'] = $v['cate_id'];
                $map_seat['a.groundId'] = $v['id'];
                $map_seat['a.timeId'] = $val['id'];
                $map_seat['a.orderTime'] = $date;
                $order_cnt = $orderModel->seatOrderCnt($map_seat,$v_time);
                if($val['status'] == 0){
                    $arr[$k]['state']= 0;
                }elseif($order_cnt > 0){
                    $arr[$k]['state']= 0;
                }elseif(strtotime(date('G:i')) > strtotime($val['start_time']) && $date == date('Y-m-d')){
                    $arr[$k]['state']= 0;
                }else{
                    $cnt = Db::name('ground_offline')->alias('a')->where($map_seat)->find();
                    $arr[$k]['state']= $cnt > 0? 0:1;
                }
                $arr[$k]['seatId'] = $v['id'];
                $arr[$k]['selected'] = 0;
            }
            $lists[$key]['seat'] = $arr;
        }
        return json($lists);
    }
}
