<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class ProductModel extends Model
{
    protected $name = 'product';

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    /**
     * 根据搜索条件获取产品列表信息
     */
    public function getProductByWhere($map, $Nowpage, $limits)
    {
        $table = config('database.prefix').'product_cate';
        return $this->alias('a')->field('a.*,b.name,b.is_annex')->join($table.' b', 'a.cate_id = b.id')->where($map)->page($Nowpage, $limits)->order('a.sortnum desc, a.id desc')->select();
    }

    /**
     * 根据搜索条件获取产品总数
     */
    public function getProductCount($map)
    {
        $table = config('database.prefix').'product_cate';
        return $this->alias('a')->where($map)->count();
    }

    /**
     * 获取产品列表信息
     */
    public function getProductList($map)
    {
        return $this->where($map)->select();
    }


    /**
     * [insertProduct 添加产品]
     *
     */
    public function insertProduct($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => $this->id, 'msg' => '产品添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * [updateProduct 编辑产品]
     */
    public function updateProduct($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '产品编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * [getOneProduct 根据产品id获取一条信息]
     */
    public function getOneProduct($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * [delProduct 删除产品]
     */
    public function delProduct($map)
    {
        try{
            $this->where($map)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '产品删除成功'];
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