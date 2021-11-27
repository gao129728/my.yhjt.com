<?php

namespace app\admin\controller;
use app\admin\model\AdModel;
use app\admin\model\AdPositionModel;
use think\Db;

class Ad extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index', 'index_position');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }
    //*********************************************广告列表*********************************************//
    /**
     * [index 广告列表]
     * @return [type] [description]
     *
     */
    public function index(){
        $position = input('position');
        $map = [];
        if($position>0)
        {
            $map['ad_position_id'] = $position;
        }             
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db('ad')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $ad = new AdModel();
        $lists = $ad->getAdAll($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('position', $position);
        if(input('get.page'))
        {
            return json($lists);
        }
        $adPosition= new AdPositionModel();
        $position_list = $adPosition->getAllPosition();
        $this->assign('position_list',$position_list);
        return $this->fetch();
    }


    /**
     * [add_ad 添加广告]
     * @return [type] [description]
     *
     */
    public function add_ad()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $file  = request()->file('photo');
            if($file){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
            }
            $ad = new AdModel();
            $flag = $ad->insertAd($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $position = input('param.position');
        $adPosition = new AdPositionModel();
        $orderby = Db::name('ad')->max('orderby') + 10;
        $backUrl = url('ad/index',['position'=>$position]);
        $this->assign('orderby',$orderby);
        $this->assign('position_list',$adPosition->getAllPosition());
        $this->assign('position',$position);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();

    }


    /**
     * [edit_ad 编辑广告]
     * @return [type] [description]
     *
     */
    public function edit_ad()
    {
        $ad = new AdModel();
        if(request()->isPost()){
            $param = input('post.');
            $file  = request()->file('photo');
            if($file || (isset($param['delPhoto']) && $param['delPhoto'] == 1)){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
                $photo = Db::name('ad')->where('id',$param['id'])->value('photo');
            }else{
                unset($param['photo']);
            }
            $flag = $ad->editAd($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $adPosition = new AdPositionModel();
        $backUrl = url('index',['position'=>input('param.position'),'cur_page'=>input('param.cur_page')]);
        $this->assign('ad',$ad->getOneAd($id));
        $this->assign('position_list',$adPosition->getAllPosition());
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }


    /**
     * [del_ad 删除广告]
     * @return [type] [description]
     *
     */
    public function del_ad()
    {
        $id = input('param.id');
        $ad = new AdModel();
        $adInfo = $ad->getOneAd($id);
        $flag = $ad->delAd($id);
        if($flag['code'] > 0){
            if(!empty($adInfo['photo'])) deleteFile($adInfo['photo'], config('upload_img.path'));
        }
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }


    /**
     * [ad_state 广告状态]
     * @return [type] [description]
     *
     */
    public function ad_state()
    {
        $id=input('param.id');
        $status = Db::name('ad')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ad')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ad')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }  
    } 



    //*********************************************广告位*********************************************//
    /**
     * [index_position 广告位列表]
     * @return [type] [description]
     *
     */
    public function index_position(){

        $ad = new AdPositionModel();    
        $nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('ad_position')->count();//计算总页面
        $allpage = intval(ceil($count / $limits));     
        $list = $ad->getAll($nowpage, $limits);
        $orderby = Db::name('ad_position')->max('orderby') + 10;
        $this->assign('orderby', $orderby);
        $this->assign('nowpage', $nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('list', $list);
        return $this->fetch();
    }


    /**
     * [add_position 添加广告位]
     * @return [type] [description]
     *
     */
    public function add_position()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $ad = new AdPositionModel();
            $flag = $ad->insertAdPosition($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $sortnum = Db::name('ad')->max('orderby') + 10;
        $this->assign('orderby',$sortnum);
        return $this->fetch();
    }


    /**
     * [edit_position 编辑广告位]
     * @return [type] [description]
     *
     */
    public function edit_position()
    {
        $ad = new AdPositionModel();
        if(request()->isAjax()){
            $param = input('post.');
            $flag = $ad->editAdPosition($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $this->assign('ad',$ad->getOne($id));
        return $this->fetch();
    }


    /**
     * [del_position 删除广告位]
     * @return [type] [description]
     *
     */
    public function del_position()
    {
        $id = input('param.id');
        $count = Db::name('ad')->where('ad_position_id',$id)->count(); //判断是否有下级
        if($count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '广告位下有广告，请先删除广告位下的广告！']);
        }else{
            $ad = new AdPositionModel();
            $flag = $ad->delAdPosition($id);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }



    /**
     * [position_state 广告位状态]
     * @return [type] [description]
     *
     */
    public function position_state()
    {
        $id=input('param.id');
        $status = Db::name('ad_position')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ad_position')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ad_position')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }  
    }  

}