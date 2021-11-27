<?php

namespace app\home\model;
use think\Model;
use think\Db;

class GenealogyModel extends Model
{
    protected $name = 'genealogy';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    /**
     * 根据搜索条件获取文章列表信息
     */
    public function getGenealogyByWhere($map, $Nowpage, $limits)
    {
        $table = config('database.prefix').'gcate';
        return $this->alias('a')->field('a.*,b.name as catename')->join($table.' b', 'a.gid = b.id')->where($map)->page($Nowpage, $limits)->order('a.gid asc,a.dai asc,id asc ')->select();
    }

    /**
     * 根据搜索条件获取文章总数
     */
    public function getGenealogyCount($map)
    {
        $table = config('database.prefix').'gcate';
        return $this->alias('a')->where($map)->count();
    }

    /**
     * 获取文章列表信息
     */
    public function getGenealogyList($map,$limits=null)
    {
        return $this->where($map)->order('dai asc,id asc')->paginate($limits)->each(function($item){
            $item['url']=url('home/genealogy/index',['id'=>$item['id'],'gid'=>$item['gid']]);

        });
    }

    public function getGenealogyList2($map,$limits)
    {
        return $this->where($map)->order('dai asc,id asc')->paginate($limits)->each(function($item){
            $item['url']=url('home/genealogy/zspic',['id'=>$item['id'],'gid'=>$item['gid']]);

        });
    }


    
    /**
     * [insertArticle 添加文章]
     *
     */
    public function insertGenealogy($param)
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
     * [getOneGenealogy 根据文章id获取一条信息]
     */
    public function getOneGenealogy($map)
    {
        return $this->where($map)->find();
    }

    public function getGeneaLists($map)
    {
        return $this->where($map)->select();
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