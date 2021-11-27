<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 10:01
 */
namespace app\admin\model;
use think\Model;
use think\Db;

class FieldsModel extends Model
{
    protected $name = 'add_field';


    /**
     * 根据搜索条件获取文章列表信息
     */
    public function getFieldsByWhere($map, $Nowpage, $limits)
    {

        return $this->alias('a')->where($map)->page($Nowpage, $limits)->select();
    }

    /**
     * 根据搜索条件获取文章总数
     */
    public function getFieldsCount($map)
    {
        $table = config('database.prefix') . 'nature_cate';
        return $this->alias('a')->where($map)->count();
    }

    /**
     * 获取文章列表信息
     */
    public function getFieldsList($map)
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
    public function insertFields($param)
    {
        try {
            $result = $this->allowField(true)->save($param);
            if (false === $result) {
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            } else {
                return ['code' => 1, 'data' => $this->id, 'msg' => '添加成功'];
            }
        } catch (PDOException $e) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * [updateArticle 编辑文章]
     */
    public function updateFields($param)
    {
        try {
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if (false === $result) {
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            } else {
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [getOneNature 根据id获取一条信息]
     */
    public function getOneFields($map)
    {
        return $this->where($map)->find();
    }

    /**
     * [delArticle 删除文章]
     */
    public function delFields($map)
    {
        try {
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}