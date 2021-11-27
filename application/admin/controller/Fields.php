<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 9:56
 */

namespace app\admin\controller;
use app\admin\model\FieldsModel;
use think\Db;

class Fields  extends Base
{
    public function index(){
        $key = input('get.key');
        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数
        $getNature = new FieldsModel();
        $count = $getNature->getFieldsCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $getNature->getFieldsByWhere($map, $Nowpage, $limits);

        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('val', $key);

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
    public function add_fields()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $value=$param['value'];
            $aa=DB::query('select count(*) as cnt from INFORMATION_SCHEMA.Columns where table_name=\'core_article\' and table_schema=\'hqyscs\' and column_name = \''.$value.'\'');
            if($aa['cnt']>0){
                return json(['code' => -1, 'msg' =>'该字段已存在']);
            }

            $param['create_time'] = strtotime($param['create_time']);
            $article = new FieldsModel();
            $flag = $article->insertFields($param);
            if($flag['code']>0){
                if($param['style']==1){
                    DB::query('ALTER TABLE `core_article` ADD '.$value.' VARCHAR(200)  NULL');
                }else{
                    DB::query('ALTER TABLE `core_article` ADD '.$value.'  text  NULL');
                }

                $bb=DB::query('select count(*) as cnt from INFORMATION_SCHEMA.Columns where table_name=\'core_article\' and table_schema=\'hqyscs\' and column_name = \''.$value.'\'');
                if($bb<0){
                    $article->delFields(['id'=>$flag['data']]);
                    return json(['code' =>-1, 'msg' => '添加失败，请重试']);
                }
            }

            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        }
        $backUrl = url('index',['key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);

        $this->assign('backUrl',$backUrl);
        $this->assign('create_time', date('Y-m-d H:i:s'));
        return $this->fetch();
    }

    /**
     * [edit_article 编辑文章]
     * @return [type] [description]
     */
    public function edit_fields()
    {
        $articleModel = new FieldsModel();
        if(request()->isAjax()){
            $param = input('post.');
            $param['create_time'] = strtotime($param['create_time']);
            $flag = $articleModel->updateFields($param);

            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $kmap['id']=$id;
        $article = $articleModel->getOneFields($kmap);
        $backUrl = url('index',['nature_id'=>input('param.nature_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $this->assign('article',$article);
        $this->assign('backUrl',$backUrl);
        //$this->assign('imageList',$articleImage->getAllImage(['articleId'=>$id]));
        return $this->fetch();
    }

    public function del_fields()
    {
        $id = input('param.id');
        $cate = new FieldsModel();
        $map['id']=$id;
        $article = $cate->getOneFields($map);
        $value=$article['value'];
        DB::query('alter table `core_article` drop column '.$value);
        $bb=DB::query('select count(*) as cnt from INFORMATION_SCHEMA.Columns where table_name=\'core_article\'  and column_name = \''.$value.'\'');
        if($bb['cnt']<=0){
            $flag = $cate->delFields($map);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }else{
            return json(['code' =>-1,'bb'=>$bb, 'msg' => '删除失败，请重试']);
        }
    }
}