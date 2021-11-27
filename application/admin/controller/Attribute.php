<?php

namespace app\admin\controller;
use app\admin\controller\Upload;
use app\admin\model\AttributeModel;
use app\admin\model\ClassificationModel;
use think\Db;

class Attribute extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $cateModel = new ClassificationModel();
        $cate = $cateModel->getAllCate();


        $this->assign('cates',$cate);

       

    }

    /*
     * [index 文章列表]
     */
    public function index(){
        $key = input('get.key');
        $nature_id = (int)input('get.class_id');

        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];
        }
        if($nature_id > 0){
            $map['class_id'] = $nature_id;
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $getNature = new AttributeModel();
        $count = $getNature->getNatureCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $getNature->getNatureByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => &$v){
            $v['create_time'] = date('Y-m-d', $v['create_time']);
            $v['page'] = $Nowpage;

        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
        $this->assign('val', $key);
        $this->assign('class_id', $nature_id);

        if(input('get.page')){
            return json($lists);
        }

        return $this->fetch();
    }



    /**
     * [add_article 添加宗谱人员]
     * @return [type] [description]
     */
    public function add_Nature()
    {
        if(request()->isAjax()){
            $param = input('post.');



            $file  = request()->file('pic');
            if($file){
                $upload = new Upload();
                $param['pic'] = $upload->uploadImage($file);
            }

            $param['create_time'] = strtotime($param['create_time']);
            $article = new AttributeModel();
            $flag = $article->insertNature($param);

            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        }
        $backUrl = url('index',['class_id'=>input('param.class_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $orderby = Db::name('attribute')->max('sortnum') + 10;

        $this->assign('sortnum',$orderby);
        $this->assign('backUrl',$backUrl);
        $this->assign('nature_id',input('param.nature_id'));
        $this->assign('create_time', date('Y-m-d H:i:s'));
        return $this->fetch();
    }

    /**
     * [edit_article 编辑文章]
     * @return [type] [description]
     */
    public function edit_Nature()
    {
        $articleModel = new AttributeModel();
       
        if(request()->isAjax()){
            $param = input('post.');


            $param['create_time'] = strtotime($param['create_time']);
            $flag = $articleModel->updateArticle($param);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');


        $kmap['id']=$id;
        $article = $articleModel->getOneNature($kmap);

        $backUrl = url('index',['class_id'=>input('param.class_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $this->assign('article',$article);
        $this->assign('backUrl',$backUrl);
        //$this->assign('imageList',$articleImage->getAllImage(['articleId'=>$id]));
        return $this->fetch();
    }
    /**
     * [del_Nature 删除]
     * @return [type] [description]
     */
    public function del_Nature()
    {
        $id = input('param.id');
        $cate = new AttributeModel();


            $map['id']=$id;

            $flag = $cate->delArticle($map);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);


    }


}