<?php

namespace app\api\controller;
use think\Controller;
use think\Db;

class Base extends Controller
{
    /*
	 * 获取指定会员信息
	 * */
    public function getMemberInfo($openId, $cateId)
    {
        $table = config('database.prefix').'member_group';
        $field1 = config('ball')[$cateId]['group'];
        $field2 = config('ball')[$cateId]['pre'];
        $field3 = config('ball')[$cateId]['amount'];
        $member =  Db::name('member')->alias('a')->field('a.*,b.group_name, b.'.$field2.', b.'.$field3)->join($table.' b', 'a.'.$field1.' = b.id', 'LEFT')->where('a.open_id', $openId)->find();

        return $member;
    }
}