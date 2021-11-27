<?php

namespace app\admin\controller;
use app\admin\model\LogModel;
use think\Db;
use com\IpLocation;
 
class Log extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('operate_log');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }
    /**
     * [operate_log 操作日志]
     * @return [type] [description]
     *
     */
    public function operate_log()
    {

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['admin_id'] =  $key;          
        }      
        $arr=Db::name("admin")->column("id,username"); //获取用户列表      
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('log')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('log')->where($map)->page($Nowpage, $limits)->order('add_time desc')->select();       
        $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        foreach($lists as $k=>$v){
            $lists[$k]['add_time']=date('Y-m-d H:i:s',$v['add_time']);
            $lists[$k]['ipaddr'] = $Ip->getlocation($lists[$k]['ip']);
            $lists[$k]['page'] = $Nowpage;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('count', $count);
        $this->assign("search_user",$arr);
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * [批量删除]
     */
    public function del_log()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $map['log_id'] = ['in', ''.$ids.''];
            $log = new LogModel();
            $flag = $log->delLog($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }
 
}