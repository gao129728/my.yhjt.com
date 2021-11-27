<?php

namespace app\admin\controller;
use app\admin\model\FloatingModel;
use think\Db;

class Floating extends Base
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

    //*********************************************广告列表*********************************************//
    /**
     * [index 广告列表]
     * @return [type] [description]
     */
    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!=="")
        {
            $map['title'] = ['like',"%" . $key . "%"];          
        }             
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db('floating')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $ad = new FloatingModel();
        $lists = $ad->getAdAll($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            switch ($v['mode'])
            {
                case 'popup':
                    $v['mode_name'] = '弹窗广告';
                    break;
                case 'float':
                    $v['mode_name'] = '全屏漂浮广告';
                    break;
                case 'hangL':
                    $v['mode_name'] = '左侧浮动广告';
                    break;
                case 'hangR':
                    $v['mode_name'] = '右侧浮动广告';
                    break;
                case 'pullScreen':
                    $v['mode_name'] = '拉屏广告';
                    break;
                default:
                    $v['mode_name'] = '<font color="#f00">错误</font>';
            }
            if($v['start_date']) $v['start_date'] = date('Y-m-d', $v['start_date']);
            if($v['end_date']) $v['end_date'] = date('Y-m-d', $v['end_date']);
            $lists[$k] = $v;
        }
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
     * [add_ad 添加广告]
     * @return [type] [description]
     */
    public function add_ad()
    {
        if(request()->isAjax()){
            $param = input('post.');

            $param['closed'] = isset($param['closed'])? $param['closed']: 0;
            $param['status'] = isset($param['status'])? $param['status']: 0;
            $param['start_date'] = empty($param['start_date'])? 0:strtotime($param['start_date']);
            $param['end_date'] = empty($param['end_date'])? 0:strtotime($param['end_date']);

            $file  = request()->file('photo');
            if($file){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
            }

            $adModel = new FloatingModel();
            $flag = $adModel->insertAd($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $orderby = Db::name('floating')->max('orderby') + 10;
        $this->assign('orderby',$orderby);
        return $this->fetch();

    }


    /**
     * [edit_ad 编辑广告]
     * @return [type] [description]
     */
    public function edit_ad()
    {
        $adModel = new FloatingModel();
        if(request()->isPost()){
            $param = input('post.');

            $param['closed'] = isset($param['closed'])? $param['closed']: 0;
            $param['status'] = isset($param['status'])? $param['status']: 0;
            $param['start_date'] = empty($param['start_date'])? 0:strtotime($param['start_date']);
            $param['end_date'] = empty($param['end_date'])? 0:strtotime($param['end_date']);

            $file  = request()->file('photo');
            if($file || (isset($param['delPhoto']) && $param['delPhoto'] == 1)){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
                $photo = Db::name('floating')->where('id',$param['id'])->value('photo');
            }else{
                unset($param['photo']);
            }

            $flag = $adModel->editAd($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $ad = $adModel->getOneAd($id);
        if(!empty($ad['start_date'])) $ad['start_date'] = date('Y-m-d', $ad['start_date']);
        if(!empty($ad['end_date'])) $ad['end_date'] = date('Y-m-d', $ad['end_date']);
        $this->assign('ad', $ad);
        return $this->fetch();
    }


    /**
     * [del_ad 删除广告]
     */
    public function del_ad()
    {
        $id = input('param.id');
        $ad = new FloatingModel();
        $photo = Db::name('floating')->where('id',$id)->value('photo');
        $flag = $ad->delAd($id);
        if($flag['code']>0){
            if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
        }
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

}