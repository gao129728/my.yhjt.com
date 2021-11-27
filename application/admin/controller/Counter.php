<?php

namespace app\admin\controller;
use app\admin\model\CounterModel;
use think\Db;

class Counter extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    /*
     * [列表]
     */
    public function index(){
        $client = input('client');
        $start_date = input('start_date');
        $end_date = input('end_date');
        $map = [];
        if($client&&$client>0) $map['client'] = $client;

        if (!empty($start_date)) {
            $map['create_time'] = ['>=', strtotime($start_date)];
        }
        if (!empty($end_date)) {
            $end_time = strtotime($end_date)+86399;
            $map['create_time'] = ['<=', $end_time];
        }
        if(!empty($start_date) && !empty($end_date)){
            $end_time = strtotime($end_date)+86399;
            $map['create_time'] = ['between', ''.strtotime($start_date).','.$end_time.''];
        }

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $counterModel = new CounterModel();
        $count = $counterModel->getCounterCnt($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $counterModel->getCounterByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['client_name'] = config('client_list')[$v['client']];
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('client_list', config('client_list'));
        $this->assign('client', $client);
        $this->assign('start_date', $start_date);
        $this->assign('end_date', $end_date);

        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * [批量删除]
     */
    public function del_counter()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $counterModel = new CounterModel();
            $flag = $counterModel->delCounter($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }

    /**
     * [清空全部]
     */
    public function empty_counter()
    {
        if(request()->isAjax()){
            $client = input('param.client');
            $start_date = input('param.start_date');
            $end_date = input('param.end_date');
            $map['state'] = 0;
            if($client&&$client>0) $map['client'] = $client;

            if (!empty($start_date)) {
                $map['create_time'] = ['>=', strtotime($start_date)];
            }
            if (!empty($end_date)) {
                $end_time = strtotime($end_date)+86399;
                $map['create_time'] = ['<=', $end_time];
            }
            if(!empty($start_date) && !empty($end_date)){
                $end_time = strtotime($end_date)+86399;
                $map['create_time'] = ['between', ''.strtotime($start_date).','.$end_time.''];
            }

            $counterModel = new CounterModel();
            $flag = $counterModel->delCounter($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '清空成功']);
            }else{
                return json(['code' => 0, 'msg' => '清空失败']);
            }
        }
    }
}