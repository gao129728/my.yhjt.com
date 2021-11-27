<?php

namespace app\mobile\validate;

use think\Validate;

class MemberValidate extends Validate
{
    protected $rule = [
        'account|Account'  => ['require', 'min'=>2, 'unique'=>'member'],
        'username|Username'  => ['require'],
        'email|Email'  => ['require', 'email','unique'=>'member'],
        'password|Password'  => ['require', 'min'=>6],
        'repassword|repassword' =>['require','confirm'=>'password'],
        'code|验证码'  => ['require'],
    ];

    protected $message  =   [
        /* 'account.min'     => '会员账号不能少于2位',
         'account.unique'     => '会员账号已存在',
         'email.regex' => '请输入正确的邮箱',
         'email.unique' => '邮箱已存在',
         'password.min'     => '密码不能少于6位',
         'repassword.confirm'     => '两次输入密码不一致'
         */

        'account.min'     => '会员账号不能少于2位',
        'account.unique'     => '会员账号已存在',
        'email.regex' => '请输入正确的邮箱',
        'email.unique' => 'The email already exists',
        'password.min'     => 'Password cannot be less than 6 bits',
        'repassword.confirm'     => 'The two input passwords were inconsistent'
    ];

    protected $scene = [
//        'login' =>  ['email','password'],
        'register' =>  ['email','password','repassword'],
    ];
}