<?php

namespace app\admin\controller;
use app\admin\model\MemberModel;
use app\admin\model\MemberGroupModel;
use think\Db;

class Member extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('group', 'index');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    //*********************************************会员组*********************************************//
    /**
     * [group 会员组]
     */
    public function group(){
        $groupModel = new MemberGroupModel();
        $group = $groupModel->getGroup();
        $this->assign('group', $group);
        return $this->fetch();
    }

    /**
     * [add_group 添加会员组]
     */
    public function add_group()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $group = new MemberGroupModel();
            $flag = $group->insertGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }


    /**
     * [edit_group 编辑会员组]
     */
    public function edit_group()
    {
        $group = new MemberGroupModel();
        if(request()->isPost()){           
            $param = input('post.');
            $flag = $group->editGroup($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('group',$group->getOne($id));
        return $this->fetch();
    }


    /**
     * [del_group 删除会员组]
     */
    public function del_group()
    {
        $id = input('param.id');
        $count = Db::name('member')->where(['group_id'=>$id])->count(); //判断是否有会员
        if($count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '会员组下有会员，请先删除会员！']);
        }else{
            $group = new MemberGroupModel();
            $flag = $group->delGroup($id);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }

    //*********************************************会员列表*********************************************//
    /**
     * 会员列表
     */
    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!=="")
        {
            $map['account|mobile'] = ['like',"%" . $key . "%"];
        }
        $member = new MemberModel();
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = $member->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $member->getMemberByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * 添加会员
     */
    public function add_member()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $param['password'] = md5(md5($param['password']) . config('auth_key'));
            $param['status'] = isset($param['status'])? $param['status']: 0;
            $param['login_num'] = 0;

            $file  = request()->file('head_img');
            if($file){
                $upload = new Upload();
                $param['head_img'] = $upload->uploadFace($file);
            }
            $member = new MemberModel();
            $flag = $member->insertMember($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $backUrl = url('index',['key'=>input('param.key')]);
        $group = new MemberGroupModel();
        $this->assign('group',$group->getGroup());
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }


    /**
     * 编辑会员
     */
    public function edit_member()
    {
        $member = new MemberModel();
        if(request()->isAjax()){
            $param = input('post.');
            if(empty($param['password'])){
                unset($param['password']);
            }else{
                $param['password'] = md5(md5($param['password']) . config('auth_key'));
            }
            $param['status'] = isset($param['status'])? $param['status']: 0;
            $file  = request()->file('head_img');
            if($file || (isset($param['delHeadImg']) && $param['delHeadImg'] == 1)){
                $upload = new Upload();
                $param['head_img'] = $upload->uploadFace($file);
                $head_img = Db::name('member')->where('id',$param['id'])->value('head_img');
            }else{
                unset($param['head_img']);
            }

            $flag = $member->editMember($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_face.path'));
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $group = new MemberGroupModel();
        $this->assign([
            'member' => $member->getOneMember($id),
            'group' => $group->getGroup()
        ]);
        $backUrl = url('index',['key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }


    /**
     * 删除会员
     *
     */
    public function del_member()
    {
        $id = input('param.id');
        $member = new MemberModel();
        $head_img = Db::name('member')->where('id',$id)->value('head_img');
        $map['id'] = $id;
        $flag = $member->delMember($map);
        if($flag['code']>0){
            if(!empty($head_img)) deleteFile($head_img, config('upload_face.path'));
        }
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * 批量删除
     */
    public function all_delete()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $member = new MemberModel();
            $img_arr = Db::name('member')->where($map)->column('head_img');
            $flag = $member->delMember($map);
            if($flag > 0){
                if(count($img_arr) > 0){
                    deleteFiles($img_arr, config('upload_face.path'));
                }
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }
}