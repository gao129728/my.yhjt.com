<?php

namespace app\admin\controller;
use app\admin\model\MessageModel;
use think\Db;

class Message extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }

        $productlist = Db::name('message')->where(['isMessage'=>0])->order('sortnum desc')->select();
        $this->assign('productlist',$productlist);



    }

    /*
     * [留言列表]
     */
    public function index(){
        $name = input('name');
        $phone = input('phone');
        $map = [];
        if($name&&$name!=="") $map['name'] = ['like',"%" . $name . "%"];
        if($phone&&$phone!=="") $map['phone'] = ['like',"%" . $phone . "%"];

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $messageModel = new MessageModel();
        $count = $messageModel->getMessageCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $messageModel->getMessageByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['content'] = leftstr_html($v['content'],30);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
        $this->assign('name', $name);
        $this->assign('phone', $phone);

        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

//   咨询
    public function consult_index(){
        $product = input('product');
        $name = input('name');
        $phone = input('phone');
        $map = [];
        if($product&&$product!=="") $map['product'] = $product;
        if($name&&$name!=="") $map['name'] = ['like',"%" . $name . "%"];
        if($phone&&$phone!=="") $map['phone'] = ['like',"%" . $phone . "%"];

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $messageModel = new MessageModel();
        $count = $messageModel->getMessageCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $messageModel->getMessageByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['content'] = leftstr_html($v['content'],30);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('product', $product);
        $this->assign('name', $name);
        $this->assign('phone', $phone);

        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }
    //   订阅
    public function subscribe_index(){
        $email = input('email');
        $map = [];
        if($email&&$email!=="") $map['email'] = ['like',"%" . $email . "%"];

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $messageModel = new MessageModel();
        $count = $messageModel->getMessageCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $messageModel->getMessageByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['content'] = leftstr_html($v['content'],30);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('email', $email);

        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * 查看
     */
    public function view_message()
    {
        $messageModel = new MessageModel();
        if(request()->isAjax()){
            $param = input('post.');

            $flag = $messageModel->updateMessage($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');

        $message = $messageModel->getOneMessage($id);
        if($message['state'] == 0){
            $data['id'] = $id;
            $data['state'] = 1;
            $messageModel->updateMessage($data);
        }
        $backUrl = url('index',['name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('message',$message);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    public function view_consult()
    {
        $messageModel = new MessageModel();
        if(request()->isAjax()){
            $param = input('post.');

            $flag = $messageModel->updateMessage($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');

        $message = $messageModel->getOneMessage($id);
        if($message['state'] == 0){
            $data['id'] = $id;
            $data['state'] = 1;
            $messageModel->updateMessage($data);
        }
        $backUrl = url('consult_index',['product'=>input('param.product'),'name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('message',$message);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    public function view_subscribe()
    {
        $messageModel = new MessageModel();
        if(request()->isAjax()){
            $param = input('post.');

            $flag = $messageModel->updateMessage($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');

        $message = $messageModel->getOneMessage($id);
        if($message['state'] == 0){
            $data['id'] = $id;
            $data['state'] = 1;
            $messageModel->updateMessage($data);
        }
        $backUrl = url('consult_index',['product'=>input('param.product'),'name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('message',$message);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    /**
     * [删除]
     */
    public function del_message()
    {
        $param['id'] = input('param.id');
        $messageModel = new MessageModel();
        $flag = $messageModel->delMessage($param);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    /**
     * [批量删除]
     */
    public function all_del_message()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $messageModel = new MessageModel();
            $flag = $messageModel->delMessage($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }
}