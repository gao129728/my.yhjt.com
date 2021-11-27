<?php

namespace app\admin\controller;
use app\admin\controller\Upload;
use app\admin\model\NatureModel;
use app\admin\model\NatureCateModel;
use think\Db;

class Nature extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $cateModel = new NatureCateModel();
        $cate = $cateModel->getAllCate();


        $this->assign('cates',$cate);

       

    }

    /*
     * [index 文章列表]
     */
    public function index(){
        $key = input('get.key');
        $nature_id = (int)input('get.nature_id');

        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];
        }
        if($nature_id > 0){
            $map['nature_id'] = $nature_id;
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $getNature = new NatureModel();
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
        $this->assign('nature_id', $nature_id);

        if(input('get.page')){
            return json($lists);
        }
        $tree = new \org\Leftnav;
        $this->assign('nature_id',input('param.nature_id'));
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
            $article = new NatureModel();
            $flag = $article->insertNature($param);
            if($flag['code'] > 0 && isset($param['img_src']) && count($param['img_src']) > 0){
               
                $i = 1;
                foreach($param['img_src'] as $k => $arr){
                    $list[$k]['sortnum'] = $i;
                    $list[$k]['articleId'] = $flag['data'];
                    $list[$k]['photo'] = $arr;
                    $list[$k]['title'] = $param['img_name'][$k];
                    $list[$k]['url'] = $param['img_url'][$k];
                   
                    $i+=1;
                }
            }

            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        }
        $backUrl = url('index',['nature_id'=>input('param.nature_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $orderby = Db::name('nature')->max('sortnum') + 10;

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
        $articleModel = new NatureModel();
       
        if(request()->isAjax()){
            $param = input('post.');


            $file  = request()->file('pic');
            if($file || (isset($param['delPic']) && $param['delPic'] == 1)){
                $upload = new Upload();
                $param['pic'] = $upload->uploadImage($file);
                $photo = Db::name('Nature')->where('id',$param['id'])->value('pic');
            }else{
                unset($param['pic']);
            }

            $param['create_time'] = strtotime($param['create_time']);
            $flag = $articleModel->updateArticle($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));

            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');


        $kmap['id']=$id;
        $article = $articleModel->getOneNature($kmap);


        $fmap['nature_id']=$article['nature_id'];
       
        $fList=$articleModel->getNatureList($fmap);

        $backUrl = url('index',['nature_id'=>input('param.nature_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $this->assign('flist',$fList);
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
        $cate = new NatureModel();


            $map['id']=$id;

            $flag = $cate->delArticle($map);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);


    }


    //*********************************************分类管理*********************************************//

    /**
     * [gcate 族谱分类列表]
     * @return [type] [description]
     */
    public function cate(){

        $cateModel = new NatureCateModel();
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
        $cate = new NatureCateModel();
        if (request()->isAjax()) {
            $param = input('post.');



            $flag = $cate->insertCate($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $sortnum = Db::name('nature_cate')->max('sortnum') + 1;
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
        $cateModel = new NatureCateModel();
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
        $cate = new NatureCateModel();


        $a_count = Db::name('Nature')->where('nature_id',$id)->count(); //判断分类下是否有文章
        if($a_count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '分类下有内容，请先删除分类下的内容！']);
        }else{

            $flag = $cate->delCate($id);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }


}