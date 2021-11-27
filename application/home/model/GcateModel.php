<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:42
 */
namespace app\home\model;
use think\Model;
use think\Db;
class GcateModel extends Model
{
    protected $name = 'gcate';


    public function gcateList(){

        return $this->field('id,name,parent_id')->order(' id asc')->select();
    }


}
