<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class ArticleImageModel extends Model
{
    protected $name = 'article_image';

    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;


    public function getAllImage($map)
    {
        return $this->where($map)->order('sortnum asc, id asc')->select();
    }

    public function insertImage($param)
    {
        return $this->allowField(true)->insert($param);
    }

    public function updateImage($param)
    {
        return $this->allowField(true)->update($param);
    }

    public function delImage($map)
    {
        return $this->where($map)->delete();
    }

    public function getImageSrc($map)
    {
        return $this->where($map)->column('photo');
    }

}
