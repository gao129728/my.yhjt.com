<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class NatureModel extends Model
{
    protected $name = 'nature';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    /**
     * 根据搜索条件获取文章列表信息
     */
    public function getNatureByWhere($map, $Nowpage, $limits)
    {
        $table = config('database.prefix').'nature_cate';
        return $this->alias('a')->field('a.*,b.name as catename')->join($table.' b', 'a.nature_id = b.id')->where($map)->page($Nowpage, $limits)->order('a.nature_id asc,a.id asc ')->select();
    }

    /**
     * 根据搜索条件获取文章总数
     */
    public function getNatureCount($map)
    {
        $table = config('database.prefix').'nature_cate';
        return $this->alias('a')->where($map)->count();
    }

    /**
     * 获取文章列表信息
     */
    public function getNatureList($map)
    {
        return $this->where($map)->select();
    }



    /**
     * 根据分类id，获取列表
     */
    public function getList($map)
    {
        return $this->where($map)->select();
    }

    
    /**
     * [insertArticle 添加文章]
     *
     */
    public function insertNature($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){             
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => '添加成功'];
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
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [getOneNature 根据id获取一条信息]
     */
    public function getOneNature($map)
    {
        return $this->where($map)->find();
    }

    /**
     * [delArticle 删除文章]
     */
    public function delArticle($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}