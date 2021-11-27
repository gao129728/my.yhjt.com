<?php

namespace app\admin\controller;
use app\admin\controller\Upload;
use app\admin\model\NatureModel;
use app\admin\model\ClassificationModel;
use think\Db;

class Classification extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $Classification = new ClassificationModel();
        $cate = $Classification->getAllCate();
        $this->assign('cates',$cate);

       

    }


    public function index(){

        $cateModel = new ClassificationModel();
        $list = $cateModel->getAllCate();

        $this->assign('cate_tree',$list);
        return $this->fetch();
    }

    /**
     * [add_cate 添加分类]
     * @return [type] [description]
     */
    public function add_vcate()
    {
        $cate = new ClassificationModel();
        if (request()->isAjax()) {
            $param = input('post.');



            $flag = $cate->insertCate($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $sortnum = Db::name('classification')->max('sortnum') + 1;
        $this->assign('sortnum',$sortnum);
        $this->assign('create_time', date('Y-m-d H:i:s'));
        return $this->fetch();
    }

    /**
     * [edit_cate 编辑分类]
     * @return [type] [description]
     */
    public function edit_vcate()
    {
        $cateModel = new ClassificationModel();
        $tree = new \org\Leftnav;
        if(request()->isAjax()) {

            $param = input('post.');

            $flag=$cateModel->updateCate($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);

        }

        $id = input('param.id');
       
        $cate_info = $cateModel->getOneCate($id);



        $this->assign('cate',$cate_info);

        return $this->fetch();
    }



    /**
     * [del_cate 删除分类]
     * @return [type] [description]
     */
    public function del_cate()
    {
        $id = input('param.id');
        $cate = new ClassificationModel();


        $a_count = Db::name('attribute')->where('class_id',$id)->count(); //判断分类下是否有文章
        if($a_count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '分类下有内容，请先删除分类下的内容！']);
        }else{

            $flag = $cate->delCate($id);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }


}