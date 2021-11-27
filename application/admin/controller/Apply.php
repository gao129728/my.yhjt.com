<?php

namespace app\admin\controller;
use app\admin\controller\Upload;
use app\admin\model\MessageModel;
use app\admin\model\JoinModel;
use app\admin\model\JobModel;
use app\admin\model\ArticleCateModel;
use app\admin\model\ArticleModel;
use think\Db;

class Apply extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('message','join_index','job_index');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    /*
     * [留言列表]
     */
    public function message(){
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
        $backUrl = url('message',['name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('message',$message);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    /**
     * [删除]
     */
    public function del_message()
    {
        $this->TestAuth();
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
            $this->TestAuth();
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

    /*
    * [加盟申请列表]
    */
    public function join_index(){
        $name = input('name');
        $phone = input('phone');
        $map = [];
        if($name&&$name!=="") $map['name'] = ['like',"%" . $name . "%"];
        if($phone&&$phone!=="") $map['phone'] = ['like',"%" . $phone . "%"];

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $joinModel = new JoinModel();
        $count = $joinModel->getJoinCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $joinModel->getJoinByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
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

    /**
     * 查看
     */
    public function view_join()
    {
        $joinModel = new JoinModel();
        if(request()->isAjax()){
            $param = input('post.');

            $flag = $joinModel->updateJoin($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');

        $join = $joinModel->getOneJoin($id);
        if($join['state'] == 0){
            $data['id'] = $id;
            $data['state'] = 1;
            $joinModel->updateJoin($data);
        }
        $backUrl = url('join_index',['name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('join',$join);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    /**
     * [删除]
     */
    public function del_join()
    {
        //$this->TestAuth();
        $param['id'] = input('param.id');
        $joinModel = new JoinModel();
        $flag = $joinModel->delJoin($param);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    /**
     * [批量删除]
     */
    public function all_del_join()
    {
        if(request()->isAjax()){
            //$this->TestAuth();
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $joinModel = new JoinModel();
            $flag = $joinModel->delJoin($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }

    /*
    * [人才招聘列表]
    */
    public function job_index(){
        $name = input('name');
        $phone = input('phone');
        $map = [];
        if($name&&$name!=="") $map['name'] = ['like',"%" . $name . "%"];
        if($phone&&$phone!=="") $map['phone'] = ['like',"%" . $phone . "%"];

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $jobModel = new JobModel();
        $count = $jobModel->getJobCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $jobModel->getJobByWhere($map, $Nowpage, $limits);
        $cateModel = new ArticleModel();
        foreach($lists as $k => $v){
            $cate = $cateModel->getOneArticle($v['cateId']);
            $v['cate_name'] = $cate['title'];
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

    /**
     * 查看
     */
    public function view_job()
    {
        $jobModel = new JobModel();
        if(request()->isAjax()){
            $param = input('post.');

            $flag = $jobModel->updateJob($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $job = $jobModel->getOneJob($id);
        $cateModel = new ArticleCateModel();
        $cate = $cateModel->getOneCate($job['cateId']);
        $job['cate_name'] = $cate['name'];
        if($job['state'] == 0){
            $data['id'] = $id;
            $data['state'] = 1;
            $jobModel->updateJob($data);
        }
        $backUrl = url('job_index',['name'=>input('param.name'),'phone'=>input('param.phone'),'cur_page'=>input('param.cur_page')]);
        $this->assign('job',$job);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }

    /**
     * [删除]
     */
    public function del_job()
    {
        //$this->TestAuth();
        $param['id'] = input('param.id');
        $jobModel = new JobModel();
        $flag = $jobModel->delJob($param);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    /**
     * [批量删除]
     */
    public function all_del_job()
    {
        if(request()->isAjax()){
            //$this->TestAuth();
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $jobModel = new JobModel();
            $flag = $jobModel->delJob($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }

}