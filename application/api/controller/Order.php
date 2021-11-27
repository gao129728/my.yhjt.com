<?php
namespace app\api\controller;
use app\admin\model\OrderModel;
use app\admin\model\GroundTimeModel;
use think\Db;

class Order extends Base
{
    public function comfirm()
    {
        $param = input('param.');
        $data = [];
        $cateid = $param['cateid'];
        $data['cate_name'] = Db::name('ground_cate')->where('id', $cateid)->value('name');
        $field = config('ball')[$cateid]['pre'];
        $member = $this->getMemberInfo($param['openId'], $cateid);
        $data['group_name'] = $member['group_name'];
        if($member[$field] > 0){
            $pre = $member[$field]/10;
            $data['pre'] = $member[$field];
            $data['payPrice'] = bcmul($param['totalPrice'], $pre, 2);
        }else{
            $data['payPrice'] = $param['totalPrice'];
            $data['pre'] = '';
        }
        return json($data);
    }

    public function complete()
    {
        $param = input('post.');
        $seatList = $param['seatList'];
        $member = $this->getMemberInfo($param['openId'], $param['cateId']);
        $totalPrice = 0;
        $orderModel = new OrderModel();
        $v_time = time() - config('pay_validity')*60;
        $start_time = $seatList[0]['start_time'];
        foreach($seatList as $key=>$val){
            $map['a.cateId'] = $param['cateId'];
            $map['a.orderTime'] = $param['date'];
            $map['a.groundId'] = $val['seatId'];
            $map['a.timeId'] = $val['timeId'];

            $offline_cnt = Db::name('ground_offline')->alias('a')->where($map)->count();
            $order_cnt = $orderModel->seatOrderCnt($map,$v_time);
            if($offline_cnt > 0 || $order_cnt > 0){
                return json(['code'=>1,'msg'=>'所选场地已被预订，请重新选择']);
            }

            if(strtotime($val['start_time']) < strtotime($start_time)){
                $start_time = $val['start_time'];
            }
            $totalPrice += $val['price'];
        }
        $data['userId'] = $member['id'];
        $data['cateId'] = $param['cateId'];
        $data['orderTime'] = $param['date'];
        $data['start_time'] = $start_time;
        $data['order_sn'] = build_order_no();
        $data['totalPrice'] = $totalPrice;
        $field = config('ball')[$param['cateId']]['pre'];
        if($member[$field] > 0){
            $pre = $member[$field]/10;
            $data['promot'] = $member['group_name'].'享'.$member[$field].'折优惠';
            $data['payPrice'] = bcmul($totalPrice, $pre, 2);
        }else{
            $data['promot'] = '';
            $data['payPrice'] = $totalPrice;
        }

        $data['pay_type'] = 0;
        $data['pay_status'] = 0;
        $data['order_status'] = 1;
        $data['create_time'] = time();
        $flag = Db::name('orders')->insert($data);
        if($flag > 0){
            $orderId = Db::name('orders')->getLastInsID();
            $order_list = [];
            foreach($seatList as $k=>$v){
                $order_list[$k]['orderId'] = $orderId;
                $order_list[$k]['order_sn'] = $data['order_sn'];
                $order_list[$k]['cateId'] = $param['cateId'];
                $order_list[$k]['orderTime'] = $param['date'];
                $order_list[$k]['groundId'] = $v['seatId'];
                $order_list[$k]['price'] = $v['price'];
                $order_list[$k]['timeId'] = $v['timeId'];
            }
            $result = Db::name('orders_list')->insertAll($order_list);
            if($result > 0){
                return json(['code'=>2,'msg'=>'提交成功','order_sn'=>$data['order_sn']]);
            }else{
                Db::name('orders')->where('id',$orderId)->delete();
                return json(['code'=>0,'msg'=>'提交失败，请稍后再试']);
            }
        }else{
            return json(['code'=>0,'msg'=>'提交失败，请稍后再试']);
        }

    }

    public function payInfo(){
        $order_sn = input('order_sn');
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderInfo(['order_sn'=>$order_sn]);
        if($order['pay_status'] > 0){
            return json(['code'=>0,'msg'=>'订单已支付过了']);
        }

        $v_time = time() - config('pay_validity')*60;
        if(strtotime($order['create_time']) < $v_time){
            return json(['code'=>0,'msg'=>'支付超时，订单已取消']);
        }

        $cate_name = Db::name('ground_cate')->where('id', $order['cateId'])->value('name');
        $remain = (strtotime($order['create_time']) - $v_time)*1000;

        return json(['code'=>1, 'remain'=>$remain, 'payPrice'=>$order['payPrice'], 'cate_name'=>$cate_name]);

    }

    public function checkOrder(){
        $order_sn = input('order_sn');
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderInfo(['order_sn'=>$order_sn]);
        if($order){
            $v_time = time() - config('pay_validity')*60;
            if(strtotime($order['create_time']) < $v_time && $order['pay_status'] == 0){
                return json(['code'=>0,'msg'=>'订单已失效']);
            }else{
                return json(['code'=>1,'msg'=>'正常订单']);
            }
        }else{
            return json(['code'=>0,'msg'=>'订单已失效']);
        }
    }

    public function failureOrder(){
        $order_sn = input('order_sn');
        $map['order_sn'] = $order_sn;
        Db::name('orders')->where($map)->setField('order_status', 0);
    }

    public function cancelOrder(){
        $order_sn = input('order_sn');
        $map['order_sn'] = $order_sn;
        $flag = Db::name('orders')->where($map)->delete();
        if($flag > 0){
            Db::name('orders_list')->where($map)->delete();
            return json(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json(['code'=>0,'msg'=>'删除失败']);
        }
    }

    public function balancePay(){
        $order_sn = input('post.order_sn');
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderInfo(['order_sn'=>$order_sn]);
        $cateId = $order['cateId'];
        $field = config('ball')[$cateId]['money'];
        $member = Db::name('member')->where('id', $order['userId'])->find();
        if($member[$field] < $order['payPrice']){
            return json(['code'=>0,'msg'=>'余额不足，请充值或使用微信支付']);
        }else{
            $param['id'] = $order['id'];
            $param['pay_time'] = time();
            $param['pay_type'] = 1;
            $param['pay_status'] = 1;
            if($orderModel->updateOrder($param)){
                $map['id'] = $order['userId'];
                $map[$field] = bcsub($member[$field], $order['payPrice'], 2);
                Db::name('member')->update($map);
                return json(['code'=>1,'msg'=>'支付成功']);
            }else{
                return json(['code'=>0,'msg'=>'支付失败，请稍后再试']);
            }
        }
    }

    public function getOrderList(){
        $orderModel = new OrderModel();
        $orderModel->setFailureOrder();

        $param = input('param.');
        $member = Db::name('member')->where('open_id', $param['openId'])->find();
        $map['order_status'] = 1;
        $map['userId'] = $member['id'];
        $map['cateId'] = $param['cateId'];
        $map2 = '';
        if($param['classes'] == 0){
            $map['pay_status'] = 1;
            $nowDate = date("Y-m-d");
            $map2 = "orderTime > '".$nowDate."' or (orderTime = '".$nowDate."' and '".date('G:i')."' < str_to_date(start_time, '%k:%i'))";
        }
        $Nowpage = $param['page'] ? $param['page']:1;
        $limits = 4;// 每页显示个数
        $count = $orderModel->getMyOrderCnt($map, $map2);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $orderModel->getMyOrderList($map, $Nowpage, $limits, $map2);
        $orderList = [];
        foreach($lists as $key => $val){
            $seatList = $seatList = $orderModel->getOrderSeat(['orderId'=>$val['id']]);
            $name_str = '';
            foreach ($seatList as $k => $v){
                $short_name = Db::name('ground')->where('id', $v['groundId'])->value('short_title');
                if($k == 0){
                    $name_str = $short_name;
                }else{
                    $name_str .= ','.$short_name;
                }
            }
            $orderList[$key]['order_sn'] = $val['order_sn'];
            $cate = Db::name('ground_cate')->where('id', $val['cateId'])->find();
            $orderList[$key]['cate_name'] = $cate['name'];
            $orderList[$key]['cate_ico'] = config('website_domain').'/uploads/images/'.$cate['photo'];
            $orderList[$key]['pay_status'] = $val['pay_status'];
            $orderList[$key]['orderTime'] = $val['orderTime'];
            $orderList[$key]['name_str'] = $name_str;
            $orderList[$key]['payPrice'] = $val['payPrice'];
            $orderList[$key]['start_time'] = $val['start_time'];
        }

        return json(['allpage'=>$allpage, 'orderList'=>$orderList]);
    }

    public function getOrderInfo(){
        $orderModel = new OrderModel();
        $order_sn = input('param.order_sn');
        $map['order_sn'] = $order_sn;
        $order = $orderModel->getOrderInfo($map);
        $order['cate_name'] = Db::name('ground_cate')->where('id', $order['cateId'])->value('name');
        if(empty($order['promot'])){
            $order['promot'] = '无';
        }
        if(!empty($order['pay_time'])){
            $order['pay_time'] = date('Y-m-d H:i:s', $order['pay_time']);
        }
        $lists = $orderModel->getOrderSeat(['order_sn'=>$order_sn]);
        $searList = [];
        $timeModel = new GroundTimeModel();
        foreach ($lists as $key => $val){
            $timeInfo = $timeModel->getOneTime($val['timeId']);
            $searList[$key]['time'] = $timeInfo['start_time'].'-'.$timeInfo['end_time'];
            $searList[$key]['seat_name'] = Db::name('ground')->where('id', $val['groundId'])->value('title');
            $searList[$key]['price'] = $val['price'];
        }
        $order['seatList'] = $searList;
        return json($order);
    }
}
