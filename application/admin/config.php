<?php

return [
    //模板参数替换
    'view_replace_str' => array(
        '__CSS__' => '/static/admin/css',
        '__JS__'  => '/static/admin/js',
        '__IMG__' => '/static/admin/images',
        '__UPLOAD_PATH__' => '/uploads/images',
        '__UPLOAD_FACE__' => '/uploads/face',
    ),

    // +----------------------------------------------------------------------
    // | 访问统计客户端
    // +----------------------------------------------------------------------
    'client_list'=> [
        '1' => 'PC网站',
        '2' => '微信小程序'
    ],
    'upload_file_path'       => 'uploads/file/',
];
