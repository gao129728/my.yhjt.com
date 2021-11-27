<?php

namespace app\home\validate;
use think\Validate;

class FormValidate extends Validate
{

    protected $rule = [
        'name|Name'  => ['require'],
        'lastname|Lastname'  => ['require'],
        'company|Company'  => ['require'],
        'address|Add'  => ['require'],
        'email|E-mail'  => ['require','email'],
        'topic|Subject'  => ['require'],
        'postcode|Postcode'  => ['require'],
        'phone|Tel'  => ['require', 'regex'=>'/^0?(13|14|15|17|18)[0-9]{9}$/'],
        'fax|Fax'  => ['require'],
        'topic|Topic'  => ['require'],
        'content|Message'  => ['require'],
    ];

    protected $message  =   [
        'phone.regex' => 'Please enter the correct mobile phone number',
    ];

    protected $scene = [
        'message' =>  ['name','company','phone','email','topic','content'],
        'consult' =>  ['name','email','topic','content'],
        'subscribe' =>  ['email'],
        'job' =>  ['name','phone','sex','age','college','graduate_time','email','resumes','appraise','annex'],
        'address' =>  ['name','address','email','postcode','phone'],
    ];
}