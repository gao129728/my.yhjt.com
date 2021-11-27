<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class ArticleCateModel extends Model
{
    protected $name = 'article_cate';
    
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;


    /**
     * [getAllCate 获取全部分类]
     *
     */
    public function getAllCate()
    {
        return $this->order('orderby asc,id asc')->select();
    }

    /**
     * [getAllCate 获取全部分类]
     *
     */
    public function getCateByWhere($map)
    {
        return $this->where($map)->order('id asc')->select();
    }

    /**
     * [根据条件统计分类个数]
     *
     */
    public function getCateCount($map)
    {
        return $this->where($map)->count();
    }

    /**
     * [insertCate 添加分类]
     *
     */
    public function insertCate($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){     
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => '分类添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * [editMenu 编辑分类]
     *
     */
    public function editCate($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '分类编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * [getOneMenu 根据分类id获取一条信息]
     * @return [type] [description]
     *
     */
    public function getOneCate($id)
    {
        return $this->where('id', $id)->find();
    }



    /**
     * [delMenu 删除分类]
     * @return [type] [description]
     *
     */
    public function delCate($id)
    {
        try{
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '分类删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function maxId(){

        return $this->max('id');
    }

    public function delImage($map)
    {
        return Db::name('pic_catelist')->where($map)->delete();
    }

    public function updateImage($param)
    {
        return Db::name('pic_catelist')->update($param);
    }
    public function getAllImage($map)
    {
        return Db::name('pic_catelist')->where($map)->order('sortnum  asc, id asc')->select();
    }

    public function insertImage($param)
    {
        return Db::name('pic_catelist')->insert($param);
    }

}