<?php

namespace app\admin\controller;
use app\admin\model\OrderModel;
use app\admin\model\MemberModel;
use app\admin\model\GroundCateModel;
use app\admin\model\GroundTimeModel;
use think\Db;

class Order extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        if($action == 'index' || $action == 'search' || $action == 'order_report'){
            $this->CheckAuth();
        }
    }

    /**
     * [index 订单列表]
     */
    public function index(){
        $order_sn = input('get.order_sn');
        $nickname = input('nickname');
        $cateId = input('cateId');

        $orderModel = new OrderModel();
        $orderModel->setFailureOrder();

        $map = [];
        if(!empty($order_sn)){
            $map['order_sn'] = ['like',"%" . $order_sn . "%"];
        }
        if(!empty($nickname)){
            $user_id_arr = Db::name('member')->where('nickname','like','%'.$nickname.'%')->column('id');
            $user_id_str = implode(',', $user_id_arr);
            $map['userId'] = ['in', ''.$user_id_str.''];
        }

        if($cateId > -1){
            $map['cateId'] = $cateId;
        }

        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 每页显示个数
        $count = $orderModel->getOrderCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $orderModel->getOrderByWhere($map, $Nowpage, $limits);
        $timeModel = new GroundTimeModel();
        foreach ($lists as $key => $val){
            $val['cate_name'] = Db::name('ground_cate')->where('id', $val['cateId'])->value('name');
            $seatList = $orderModel->getOrderSeat(['orderId'=>$val['id']]);
            foreach ($seatList as $k => $v){
               $v['seat_name'] = Db::name('ground')->where('id', $v['groundId'])->value('title');
               $groundTime = $timeModel->getOneTime($v['timeId']);
               $v['time'] = $groundTime['start_time'].'-'.$groundTime['end_time'];
                $seatList[$k] = $v;
            }
            $val['seat'] = $seatList;
            $lists[$key] = $val;
        }
        $cateModel = new GroundCateModel();
        $this->assign('cateList', $cateModel->getAllCate());
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('order_sn', $order_sn);
        $this->assign('nickname', $nickname);
        $this->assign('cateId', $cateId);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [订单详情]
     */
    public function order_info()
    {

        $orderModel = new OrderModel();

        $id      = input('param.id');
        $map['id'] = $id;
        $order = $orderModel->getOrderInfo($map);
        $v_time = time() - config('pay_validity')*60;
        if(strtotime($order['create_time']) < $v_time && $order['pay_status'] == 0){
            $map['order_status'] = 0;
            $orderModel->updateOrder($map);
        }

        $order['cate_name'] = Db::name('ground_cate')->where('id', $order['cateId'])->value('name');
        $orderList = Db::name('orders_list')->where('orderId', $id)->order('groundId asc, timeId asc')->select();
        $timeModel = new GroundTimeModel();
        foreach ($orderList as $k => $v){
            $v['seat_name'] = Db::name('ground')->where('id', $v['groundId'])->value('title');
            $groundTime = $timeModel->getOneTime($v['timeId']);
            $v['time'] = $groundTime['start_time'].'-'.$groundTime['end_time'];
            $orderList[$k] = $v;
        }

        $member = $this->getMemberInfo($order['userId'], $order['cateId']);
        $order['nickname'] = $member['nickname'];

        $this->assign('order',$order);
        $this->assign('order_list', $orderList);
        return $this->fetch();
    }

    /**
     * [删除订单]
     */
    public function del_order()
    {
        $id = input('param.id');

        $orderModel = new OrderModel();
        $flag = $orderModel->delOrder($id);
        if($flag['code'] > 0){
            Db::name('orders_list')->where('orderId', $id)->delete();
        }
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * [订单查询]
     */
    public function search(){
        $orderModel = new OrderModel();
        $orderModel->setFailureOrder();

        $search = input('param.');
        if($search['action'] == 'search') {
            $map = [];
            if (!empty($search['start_date'])) {
                $map['a.create_time'] = ['>=', strtotime($search['start_date'])];
            }

            if (!empty($search['end_date'])) {
                $end_date = strtotime($search['end_date'])+86399;
                $map['a.create_time'] = ['<=', $end_date];
            }

            if(!empty($search['start_date']) && !empty($search['end_date'])){
                $end_date = strtotime($search['end_date'])+86399;
                $map['a.create_time'] = ['between', ''.strtotime($search['start_date']).','.$end_date.''];
            }

            if (!empty($search['order_sn'])) {
                $map['a.order_sn'] = ['like', "%" . $search['order_sn'] . "%"];
            }

            if (!empty($search['nickname'])) {
                $user_id_arr = Db::name('member')->where('nickname', 'like', '%' . $search['nickname'] . '%')->column('id');
                $user_id_str = implode(',', $user_id_arr);
                $map['a.userId'] = ['in', '' . $user_id_str . ''];
            }
            if (!empty($search['orderTime'])) {
                $map['a.orderTime'] = $search['orderTime'];
            }
            if ($search['cateId'] > -1) {
                $map['a.cateId'] = $search['cateId'];
            }
            if ($search['pay_state'] > -1) {
                $map['a.pay_status'] = $search['pay_state'];
            }
            if ($search['pay_type'] > -1) {
                $map['a.pay_type'] = $search['pay_type'];
            }

            $Nowpage = input('get.page') ? input('get.page') : 1;
            $limits = config('list_rows');// 获取总条数
            $count = $orderModel->getOrderCount($map);//计算总页面
            $allpage = intval(ceil($count / $limits));
            $lists = $orderModel->getOrderByWhere($map, $Nowpage, $limits);
            $timeModel = new GroundTimeModel();
            foreach ($lists as $key => $val){
                $val['cate_name'] = Db::name('ground_cate')->where('id', $val['cateId'])->value('name');
                $seatList = Db::name('orders_list')->where('orderId', $val['id'])->order('groundId asc, timeId asc')->select();
                foreach ($seatList as $k => $v){
                    $v['seat_name'] = Db::name('ground')->where('id', $v['groundId'])->value('title');
                    $groundTime = $timeModel->getOneTime($v['timeId']);
                    $v['time'] = $groundTime['start_time'].'-'.$groundTime['end_time'];
                    $seatList[$k] = $v;
                }
                $val['seat'] = $seatList;
                $lists[$key] = $val;
            }
            $this->assign('Nowpage', $Nowpage); //当前页
            $this->assign('allpage', $allpage); //总页数
            $this->assign('count', $count);
        }
        $cateModel = new GroundCateModel();
        $this->assign('cateList', $cateModel->getAllCate());
        $this->assign('search', $search);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [index 导出报表]
     */
    public function order_export(){

        $search = input('param.');
        $map = [];
        if (!empty($search['start_date'])) {
            $map['a.create_time'] = ['>=', strtotime($search['start_date'])];
        }

        if (!empty($search['end_date'])) {
            $end_date = strtotime($search['end_date'])+86399;
            $map['a.create_time'] = ['<=', $end_date];
        }

        if(!empty($search['start_date']) && !empty($search['end_date'])){
            $end_date = strtotime($search['end_date'])+86399;
            $map['a.create_time'] = ['between', ''.strtotime($search['start_date']).','.$end_date.''];
        }

        if (!empty($search['order_sn'])) {
            $map['a.order_sn'] = ['like', "%" . $search['order_sn'] . "%"];
        }

        if (!empty($search['nickname'])) {
            $user_id_arr = Db::name('member')->where('nickname', 'like', '%' . $search['nickname'] . '%')->column('id');
            $user_id_str = implode(',', $user_id_arr);
            $map['a.userId'] = ['in', '' . $user_id_str . ''];
        }
        if (!empty($search['orderTime'])) {
            $map['a.orderTime'] = $search['orderTime'];
        }
        if ($search['cateId'] > -1) {
            $map['a.cateId'] = $search['cateId'];
        }
        if ($search['pay_state'] > -1) {
            $map['a.pay_status'] = $search['pay_state'];
        }
        if ($search['pay_type'] > -1) {
            $map['a.pay_type'] = $search['pay_type'];
        }

        $orderModel = new OrderModel();
        $lists = $orderModel->getOrderList($map);
        $timeModel = new GroundTimeModel();

        $filename = "excel".date("YmdHis").'.xls';

        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<style>td,th{text-align: left; height:34px; line-height:34px;}</style>";
        $str .="<table border=1>";
        $str .= "<tr style='font-weight:bold; font-size: 14px;'>";
        $str .= "<th width='140'>订单号</th>";
        $str .= "<th width='140'>会员昵称</th>";
        $str .= "<th width='160'>球场类型</th>";
        $str .= "<th width='160'>预订时间</th>";
        $str .= "<th width='180'>预订场地</th>";
        $str .= "<th width='180'>优惠信息</th>";
        $str .= "<th width='100'>付款金额</th>";
        $str .= "<th width='100'>支付方式</th>";
        $str .= "<th width='100'>支付状态</th>";
        $str .= "<th width='160'>下单时间</th>";
        $str .= "</tr>";

        if($lists) {
            foreach ($lists as $key => $val) {
                $member = $this->getMemberInfo($val['userId'], $val['cateId']);
                $cate_name = Db::name('ground_cate')->where('id', $val['cateId'])->value('name');
                $seatStr = '';
                $seatList = Db::name('orders_list')->where('orderId', $val['id'])->order('groundId asc, timeId asc')->select();
                foreach ($seatList as $k => $v){
                    $seat_name = Db::name('ground')->where('id', $v['groundId'])->value('title');
                    $groundTime = $timeModel->getOneTime($v['timeId']);
                    $time = $groundTime['start_time'].'-'.$groundTime['end_time'];
                    $seat = $seat_name.'&nbsp;&nbsp;'.$time.'&nbsp;&nbsp;'.$v['price'].'元<br>';
                    $seatStr .= $seat;
                }
                $pay_type_name = $val['pay_type'] == 0? '微信支付':'余额支付';
                $pay_status_name = $val['pay_status'] == 0? '未支付':'已支付';
                $str .= "<tr>";
                $str .= "<td>".$val['order_sn']."</td>";
                $str .= "<td>".$member['nickname']."</td>";
                $str .= "<td>".$cate_name."</td>";
                $str .= "<td>".$val['orderTime']."</td>";
                $str .= "<td>".$seatStr."</td>";
                $str .= "<td>".$val['promot']."</td>";
                $str .= "<td>".$val['payPrice']."元</td>";
                $str .= "<td>".$pay_type_name."</td>";
                $str .= "<td>".$pay_status_name."</td>";
                $str .= "<td>".$val['create_time']."</td>";
                $str .= "</tr>\n";
            }
        }
        $str .= "</table></body></html>";

        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        //header("Content-type: application/vnd.ms-excel; charset=UTF-8");
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }

    public function getMemberInfo($userId, $cateId)
    {
        $table = config('database.prefix').'member_group';
        $field1 = config('ball')[$cateId]['group'];
        $field2 = config('ball')[$cateId]['pre'];
        $field3 = config('ball')[$cateId]['amount'];
        $member =  Db::name('member')->alias('a')->field('a.*,b.group_name, b.'.$field2.', b.'.$field3)->join($table.' b', 'a.'.$field1.' = b.id', 'LEFT')->where('a.id', $userId)->find();

        return $member;
    }

}