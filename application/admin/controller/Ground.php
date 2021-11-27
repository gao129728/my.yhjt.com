<?php

namespace app\admin\controller;
use app\admin\model\GroundModel;
use app\admin\model\GroundCateModel;
use app\admin\model\GroundTimeModel;
use app\admin\model\OrderModel;
use think\Db;

class Ground extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index', 'index_cate', 'ground_time');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    /**
     * [index 场地列表]
     */
    public function index(){
        $key = input('key');
        $cate = input('cate');
        $map = [];
        if($key&&$key!==""){
            $map['title'] = ['like',"%" . $key . "%"];          
        }
        if($cate>0){
            $map['cate_id'] = $cate;
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('ground')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $ground = new GroundModel();
        $lists = $ground->getGroundByWhere($map, $Nowpage, $limits);
        $groundCateModel = new GroundCateModel();
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
        $this->assign('val', $key);
        $this->assign('cate', $cate);
        $this->assign('ground_cate', $groundCateModel->getAllCate());
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [添加场地]
     */
    public function add_ground()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $ground = new GroundModel();
            $flag = $ground->insertGround($param);
            if($flag['code'] > 0 && !empty($photo)){
                deleteFile($photo, config('upload_img.path'));
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $cate = new GroundCateModel();
        $sortnum = Db::name('ground')->max('sortnum') + 10;
        $this->assign('cate',$cate->getAllCate());
        $this->assign('sortnum', $sortnum);
        return $this->fetch();
    }

    /**
     * [编辑场地]
     */
    public function edit_ground()
    {
        $ground = new GroundModel();
        if(request()->isAjax()){
            $param = input('post.');         
            $flag = $ground->updateGround($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $cate = new GroundCateModel();
        $this->assign('cate',$cate->getAllCate());
        $this->assign('ground',$ground->getOneGround($id));
        return $this->fetch();
    }

    /**
     * [删除场地]
     */
    public function del_ground()
    {
        $id = input('param.id');
        $cate = new GroundModel();
        $flag = $cate->delGround($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * [场地状态]
     */
    public function ground_state()
    {
        $id=input('param.id');
        $status = Db::name('ground')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ground')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ground')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

    /**
     * [场地订单]
     */
    public function ground_order(){
        $orderModel = new OrderModel();
        $orderModel->setFailureOrder();

        $id = input('id');
        $start_date = input('start_date');
        $end_date = input('end_date');

        $map = [];
        if($id < 1){
            $this->error('参数错误');
        }
        $map['b.groundId'] = $id;

        if (!empty($start_date)) {
            $map['a.create_time'] = ['>=', strtotime($start_date)];
        }
        if (!empty($end_date)) {
            $end_date_time = strtotime($end_date)+86399;
            $map['a.create_time'] = ['<=', $end_date_time];
        }
        if(!empty($start_date) && !empty($end_date)){
            $end_date_time = strtotime($end_date)+86399;
            $map['a.create_time'] = ['between', ''.strtotime($start_date).','.$end_date_time.''];
        }

        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 每页显示个数
        $count = $orderModel->getOrderGroundCnt($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $orderModel->getOrderGround($map, $Nowpage, $limits);
        $timeModel = new GroundTimeModel();
        foreach ($lists as $key => $val){
            $val['cate_name'] = Db::name('ground_cate')->where('id', $val['cateId'])->value('name');
            $val['nickname'] = Db::name('member')->where('id', $val['userId'])->value('nickname');
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
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('start_date', $start_date);
        $this->assign('end_date', $end_date);
        $this->assign('id', $id);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    //*********************************************分类管理*********************************************//

    /**
     * [index_cate 分类列表]
     */
    public function index_cate(){
        $cate = new GroundCateModel();
        $list = $cate->getAllCate();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * [add_cate 添加分类]
     */
    public function add_cate()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $cate = new GroundCateModel();
            $flag = $cate->insertCate($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        return $this->fetch();
    }

    /**
     * [edit_cate 编辑分类]
     */
    public function edit_cate()
    {
        $cate = new GroundCateModel();
        if(request()->isAjax()){
            $param = input('post.');
            $file  = request()->file('photo');
            if($file || (isset($param['delPhoto']) && $param['delPhoto'] == 1)){
                $photo = Db::name('ground_cate')->where('id',$param['id'])->value('photo');
            }else{
                unset($param['photo']);
            }

            if($file){
                $info  = $file->validate(['size'=>config('upload_img.size'),'ext'=>config('upload_img.ext')])->move(ROOT_PATH . 'public' . DS . config('upload_img.path'));
                if($info){
                    $param['photo'] = $info->getSaveName();
                }else{
                    return json(['code' => 0, 'data' => '', 'msg' => $file->getError()]);
                }
            }

            $flag = $cate->editCate($param);
            if($flag['code'] > 0 && !empty($photo)){
                deleteFile($photo, config('upload_img.path'));
            }
            if($flag['code'] > 0 && count($param['time_id']) > 0){
                foreach($param['time_id'] as $k => $arr){
                    $list[$k]['timeId']   = $arr;
                    $list[$k]['cateId'] = $param['id'];
                    $list[$k]['price'] = $param['price'][$k];
                    $list[$k]['week_price']= $param['week_price'][$k];
                    if(!empty($param['price_id'][$k])){
                        $list[$k]['id'] = $param['price_id'][$k];
                        Db::name('ground_price')->update($list[$k]);
                    }else{
                        Db::name('ground_price')->insert($list[$k]);
                    }
                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');

        $timeModel = new GroundTimeModel();
        $lists = $timeModel->getAllTime();
        foreach($lists as $key => $val){
            $groundPrice = Db::name('ground_price')->where('cateId', $id)->where('timeId', $val['id'])->find();
            if($groundPrice){
                $val['price_id']   = $groundPrice['id'];
                $val['price']      = $groundPrice['price'];
                $val['week_price'] = $groundPrice['week_price'];
            }else{
                $val['price_id'] = $val['price'] = $val['week_price'] = $val['is_order'] = '';
            }
            $lists[$key] = $val;
        }
        $this->assign('cate',$cate->getOneCate($id));
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * [del_cate 删除分类]
     */
    public function del_cate()
    {
        $id = input('param.id');
        $count = Db::name('ground')->where('cate_id',$id)->count(); //判断是否有下级
        if($count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '分类下有场地，请先删除分类下的场地！']);
        }else{
            $cate = new GroundCateModel();
            $flag = $cate->delCate($id);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }

    /**
     * [cate_state 分类状态]
     */
    public function cate_state()
    {
        $id=input('param.id');
        $status = Db::name('ground_cate')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ground_cate')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ground_cate')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

    /**
     * [预订时间段]
     */
    public function ground_time(){
        $time = new GroundTimeModel();
        $list = $time->getAllTime();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * [添加时间段]
     */
    public function add_ground_time()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $param['start_time'] = $param['start_time_h'].':'.$param['start_time_m'];
            $param['end_time'] = $param['end_time_h'].':'.$param['end_time_m'];
            $time = new GroundTimeModel();
            $flag = $time->insertTime($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $hour_arr = [];
        $min_arr = [];
        for($i=0; $i<=23; $i++){
            $hour_arr[$i] = $i;
        }
        for($i=0; $i<=59; $i++){
            if(strlen($i) == 1){
                $num='0'.$i;
            }else{
                $num=$i;
            }
            $min_arr[$i] = $num;
        }
        $this->assign('hour_arr',$hour_arr);
        $this->assign('min_arr',$min_arr);
        return $this->fetch();
    }

    /**
     * [编辑时间段]
     */
    public function edit_ground_time()
    {
        $time = new GroundTimeModel();

        if(request()->isAjax()){
            $param = input('post.');
            $param['start_time'] = $param['start_time_h'].':'.$param['start_time_m'];
            $param['end_time'] = $param['end_time_h'].':'.$param['end_time_m'];
            $flag = $time->editTime($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $cate = $time->getOneTime($id);
        $start_time = explode(':', $cate['start_time']);
        $cate['start_time_h'] = $start_time[0];
        $cate['start_time_m'] = $start_time[1];
        $end_time = explode(':', $cate['end_time']);
        $cate['end_time_h'] = $end_time[0];
        $cate['end_time_m'] = $end_time[1];
        $this->assign('cate',$cate);
        $hour_arr = [];
        $min_arr = [];
        for($i=0; $i<=23; $i++){
            $hour_arr[$i] = $i;
        }
        for($i=0; $i<=59; $i++){
            if(strlen($i) == 1){
                $num='0'.$i;
            }else{
                $num=$i;
            }
            $min_arr[$i] = $num;
        }
        $this->assign('hour_arr',$hour_arr);
        $this->assign('min_arr',$min_arr);
        return $this->fetch();
    }


    /**
     * [删除时间段]
     */
    public function del_ground_time()
    {
        $id = input('param.id');
        $time = new GroundTimeModel();
        Db::name('ground_price')->where('timeId', $id)->delete();
        $flag = $time->delTime($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * [状态]
     */
    public function ground_time_state()
    {
        $id=input('param.id');
        $status = Db::name('ground_time')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ground_time')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ground_time')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }

    }

    /**
     * [线下预订]
     */
    public function ground_offline(){
        $orderModel = new OrderModel();
        $orderModel->setFailureOrder();

        $start_date = input('param.start_date');
        $end_date = input('param.end_date');
        $cate_id = input('id');
        if($cate_id < 1){
            $this->error('参数错误');
        }
        $map['cateId'] = $cate_id;
        if(!empty($start_date)){
            $map['orderTime'] = ['>=', $start_date];
        }
        if (!empty($end_date)) {
            $map['orderTime'] = ['<=', $end_date];
        }

        if(!empty($start_date) && !empty($end_date)){
            $map['orderTime'] = ['between', ''.$start_date.','.$end_date.''];
        }

        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('ground_offline')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $groundModel = new GroundModel();
        $lists = $groundModel->getOfflineByWhere($map, $Nowpage, $limits);
        $cate_name = Db::name('ground_cate')->where('id', $cate_id)->value('name');
        $groundTimeModel = new GroundTimeModel();

        foreach($lists as $k1 => $v1){
            $v1['title'] = Db::name('ground')->where('id', $v1['groundId'])->value('title');
            $v1['name'] = $cate_name;
            $time = $groundTimeModel->getOneTime($v1['timeId']);
            $v1['time'] = $time['start_time'].'-'.$time['end_time'];
            $lists[$k1]=$v1;
        }

        $v_time = time() - config('pay_validity')*60;
        $ground_time = $groundTimeModel->getAllTime();
        $map_ground['status'] = 1;
        $map_ground['cate_id'] = $cate_id;
        $ground = $groundModel->getGroundList($map_ground);
        foreach($ground_time as $key => $val){
            $arr = [];
            $ground_time[$key]['seat'] = [];
            foreach($ground as $k => $v){
                $map_seat['a.cateId'] = $v['cate_id'];
                $map_seat['a.groundId'] = $v['id'];
                $map_seat['a.timeId'] = $val['id'];
                $map_seat['a.orderTime'] = date("Y-m-d");
                $order_cnt = $orderModel->seatOrderCnt($map_seat,$v_time);
                if($val['status'] == 0){
                    $arr[$k]['state']= 0;
                }elseif($order_cnt > 0){
                    $arr[$k]['state']= 3;
                }else{
                    $cnt = Db::name('ground_offline')->alias('a')->where($map_seat)->find();
                    $arr[$k]['state']= $cnt > 0? 1:2;
                }
                $arr[$k]['id'] = $v['id'];
                $arr[$k]['date'] = date("Y-m-d");
            }
            $ground_time[$key]['seat'] = $arr;
        }

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('start_date', $start_date);
        $this->assign('end_date', $end_date);
        $this->assign('cate_id', $cate_id);
        $this->assign('ground_time', $ground_time);
        $this->assign('ground_list', $ground);
        $this->assign('date_list', getDateList());
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }
    /**
     * [获取座位列表]
     */
    public function getSeatList(){
        if(request()->isAjax()) {
            $param = input('post.');

            $orderModel = new OrderModel();
            $v_time = time() - config('pay_validity')*60;
            $groundTimeModel = new GroundTimeModel();
            $ground_time = $groundTimeModel->getAllTime();
            $map_ground['status'] = 1;
            $map_ground['cate_id'] = $param['cate_id'];
            $groundModel = new GroundModel();
            $ground = $groundModel->getGroundList($map_ground);
            foreach($ground_time as $key => $val){
                $arr = [];
                $ground_time[$key]['seat'] = [];
                foreach($ground as $k => $v){
                    $map_seat['a.cateId'] = $v['cate_id'];
                    $map_seat['a.groundId'] = $v['id'];
                    $map_seat['a.timeId'] = $val['id'];
                    $map_seat['a.orderTime'] = $param['date'];

                    $order_cnt = $orderModel->seatOrderCnt($map_seat,$v_time);
                    if($val['status'] == 0){
                        $arr[$k]['state']= 0;
                    }elseif($order_cnt > 0){
                        $arr[$k]['state']= 3;
                    }else{
                        $cnt = Db::name('ground_offline')->alias('a')->where($map_seat)->find();
                        $arr[$k]['state']= $cnt > 0? 1:2;
                    }
                    $arr[$k]['id'] = $v['id'];
                    $arr[$k]['date'] = $param['date'];
                }
                $ground_time[$key]['seat'] = $arr;
            }
            return json(['code' => 1, 'data' => $ground_time]);
        }
    }

    /**
     * [删除线下预订]
     */
    public function del_ground_offline()
    {
        $id = input('param.id');
        $flag = $flag = Db::name('ground_offline')->where('id', $id)->delete();
        if($flag){
            return json(['code' => 1, 'msg' => '删除成功']);
        }else{
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * [设置座位状态]
     */
    public function handleSeat(){
        if(request()->isAjax()) {
            $param = input('post.');
            $map['cateId'] = $param['cate_id'];
            $map['groundId'] = $param['groundId'];
            $map['timeId'] = $param['time'];
            $map['orderTime'] = $param['date'];
            $offline = Db::name('ground_offline')->where($map)->find();
            if($offline){
                $flag = Db::name('ground_offline')->where('id', $offline['id'])->delete();
                $type = 'cancel';
            }else{
                $map['create_time'] = time();
                $flag = Db::name('ground_offline')->insert($map);
                $type = 'insert';

            }

            if($flag){
                return json(['code' => 1, 'type' => $type, 'msg'=>'操作成功']);
            }else{
                return json(['code' => 0, 'type' => $type, 'msg'=>'操作失败']);
            }
        }
    }
}