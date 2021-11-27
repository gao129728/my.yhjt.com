<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class ArticleModel extends Model
{
    protected $name = 'article';

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    /**
     * 根据搜索条件获取文章列表信息
     */
    public function getArticleByWhere($map, $Nowpage, $limits)
    {
        $table = config('database.prefix').'article_cate';
        return $this->alias('a')->field('a.*,b.name,b.is_annex')->join($table.' b', 'a.cate_id = b.id')->where($map)->page($Nowpage, $limits)->order('a.sortnum desc, a.id desc')->select();
    }

    /**
     * 根据搜索条件获取文章总数
     */
    public function getArticleCount($map)
    {
        $table = config('database.prefix').'article_cate';
        return $this->alias('a')->where($map)->count();
    }

    /**
     * 获取文章列表信息
     */
    public function getArticleList($map)
    {
        return $this->where($map)->select();
    }


    /**
     * [insertArticle 添加文章]
     *
     */
    public function insertArticle($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => '文章添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * [updateArticle 编辑文章]
     */
    public function updateArticle($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '文章编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [getOneArticle 根据文章id获取一条信息]
     */
    public function getOneArticle($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * [delArticle 删除文章]
     */
    public function delArticle($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '文章删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function maxId(){

        return $this->max('id');
    }

    public function delImage($map)
    {
        return Db::name('pic_list')->where($map)->delete();
    }

    public function updateImage($param)
    {
        return Db::name('pic_list')->update($param);
    }
    public function getAllImage($map)
    {
        return Db::name('pic_list')->where($map)->order('sortnum asc,id asc')->select();
    }

    public function insertImage($param)
    {
        return Db::name('pic_list')->insert($param);
    }

}