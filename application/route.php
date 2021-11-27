<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

use think\Route;
Route::rule([
    'index$'=>'home/index/index',
    'ajax$'=>'home/action/index',
    'cases$'=>'home/cases/index',
    'login$'=>'home/member/login',
    'register$'=>'home/member/register',
    'zhmm'=>'home/member/zhmm',
    'sitemap$'=>'home/sitemap/sitemap',
    'search$'=>'home/search/index',
    'category/:id$'=>'home/category/index',
    'category/detail/:id$'=>'home/category/detail',
    'genealogy/[:gid]/[:id]$'=>'home/genealogy/index',
    'zspic/[:gid]/[:id]$'=>'home/genealogy/zspic',
]);


if (file_exists(ROOT_PATH . "data/route/home.php")) {
    $runtimeRoutes = include ROOT_PATH . "data/route/home.php";
    Route::rule($runtimeRoutes);
}

if (file_exists(ROOT_PATH . "data/route/mobile_domain.php")) {
    $mobile_domain = include ROOT_PATH . "data/route/mobile_domain.php";
} else {
    $mobile_domain = '';
}
$mobile_pre = empty($mobile_domain)? 'mobile/':'';
$default_mobile_route = [
    $mobile_pre.'index$'=>'mobile/index/index',
    $mobile_pre.'login$'=>'mobile/member/login',
    $mobile_pre.'register$'=>'mobile/member/register',
    $mobile_pre.'category/:id$'=>'mobile/category/index',
    $mobile_pre.'category/detail/:id$'=>'mobile/category/detail',
];

if (file_exists(ROOT_PATH . "data/route/mobile.php")) {
    $mobileRoutes= include ROOT_PATH . "data/route/mobile.php";
} else {
    $mobileRoutes = '';
}
if(!empty($mobile_domain)){
    $all_mobile_route = array_merge($default_mobile_route, $mobileRoutes);
    Route::domain($mobile_domain, $all_mobile_route);
}else{
    Route::rule($default_mobile_route);
    return $mobileRoutes;
}