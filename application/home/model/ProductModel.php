<?php

namespace app\home\model;
use think\Model;
use think\Db;

class ProductModel extends Model
{
    protected $name = 'product';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    protected $createTime = false;

    /**
     * 根据条件获取文章列表信息
     */
    public function getProductByWhere($map, $limits)
    {
        return $this->where($map)->order('sortnum desc, id desc')->paginate($limits)->each(function($item){
            $item['url'] = getDetailUrl($item['id'],$item['website']);
            return $item;
        });
    }

    /**
     * 根据搜索条件获取文章总数
     */
    public function getProductCount($map)
    {
        return $this->where($map)->count();
    }

    /**
     * 获取文章列表信息
     */
    public function getProductList($map,$limits=null)
    {
        return $this->where($map)->order('isTop desc,sortnum desc, id desc')->limit($limits)->select();
    }

    /**
     * [根据文章id获取一条信息]
     */
    public function getOneProduct($map)
    {
        return $this->where($map)->order('isTop desc,sortnum desc, id desc')->find();
    }
    /**
     * [更新信息]
     */
    public function updateProduct($param)
    {
        return $this->allowField(true)->save($param, ['id' => $param['id']]);
    }

    /**
     * [根据分类id获取分类信息]
     */
    public function getOneCate($map)
    {
        return Db::name('product_cate')->where($map)->order('orderby asc, id asc')->find();
    }

    /**
     * [根据分类信息]
     */
    public function getCateList($map)
    {
        return Db::name('product_cate')->where($map)->where('status=1')->order('orderby asc, id asc')->select();
    }


    /**
     * 根据条件统计分类总数
     */
    public function getCateCnt($map)
    {
        return Db::name('product_cate')->where($map)->where('status=1')->count();
    }

    /**
     * 根据搜索条件获取文章列表
     */
    public function getSearchProduct($map, $limits, $count, $keyword)
    {
        return $this->where($map)->order('sortnum desc, id desc')->paginate($limits,$count, ['query' =>['keyword'=>$keyword]])->each(function($item, $key) use ($keyword){
            $item['url'] = getDetailUrl($item['id'],$item['website']);
            $pattern = '/'.$keyword.'/i';
            $item['k_title'] = preg_replace($pattern, '<em>$0</em>', $item['title']);
            $content = leftstr_html($item['content'],160);
            $site = stripos($content, $keyword);
            if($site !== false){
                $content = preg_replace($pattern, '<em>$0</em>', $content);
            }
            $item['content'] = $content;
            return $item;
        });
    }

    /**
     * [获取产品切换图片]
     */
    public function getProductImage($map)
    {
        return Db::name('product_image')->where($map)->order('sortnum asc, id asc')->select();
    }

    /**
     * 多图
     */
    public function getPicList($map)
    {
        return Db::name('pic_list')->where($map)->order('product_id asc, sortnum asc')->select();
    }
}