<?php

namespace app\mobile\controller;
use app\admin\model\MessageModel;
use app\admin\model\JoinModel;
use app\admin\model\JobModel;
use think\Controller;
use think\Db;

class Form extends Controller
{
    //在线留言
    public function message()
    {
        if(request()->isAjax()){
            $param = input('post.','','trim');
            $result = $this->validate($param,'FormValidate.message');
            if(true !== $result){
                return json(["code" => 0, "msg" => $result]);
            }else {
                if($param['code'] != cookieCrypt('imgcode')){
                    return json(['code' => 0, 'msg' => 'Verification code is wrong']);
//                    return json(['code' => 0, 'msg' => '验证码错误']);
                }
                $param = injectChk($param);
                $param['sortnum'] = Db::name('message')->max('sortnum') + 10;
                $param['ip'] = get_client_ip();
                $param['state'] = 0;

                $message = new MessageModel();
                $flag = $message->insertMessage($param);
                if ($flag['code'] > 0) {
                    return json(['code' => 1, 'msg' => 'Message was successful']);
//                    return json(['code' => 1, 'msg' => '留言成功']);
                } else {
                    return json(['code' => 0, 'msg' => 'Message failed, please try again later']);
//                    return json(['code' => 0, 'msg' => '留言失败，请稍后再试']);
                }
            }
        }else{
            return json(['code' => 0, 'msg' => '错误']);
        }
    }
//咨询
    public function consult()
    {
        if(request()->isAjax()){
            $param = input('post.','','trim');
            $result = $this->validate($param,'FormValidate.consult');
            if(true !== $result){
                return json(["code" => 0, "msg" => $result]);
            }else {
               /* if($param['code'] != cookieCrypt('imgcode')){
                    return json(['code' => 0, 'msg' => 'Verification code is wrong']);
                    // return json(['code' => 0, 'msg' => '验证码错误']);
                }*/
                $param = injectChk($param);
                $param['sortnum'] = Db::name('message')->max('sortnum') + 10;
                $param['ip'] = get_client_ip();
                $param['state'] = 0;

                $message = new MessageModel();
                $flag = $message->insertMessage($param);
                if ($flag['code'] > 0) {
                    return json(['code' => 1, 'msg' => 'Consultation was successful']);
//                    return json(['code' => 1, 'msg' => '咨询成功']);
                } else {
                    return json(['code' => 0, 'msg' => 'Consultation failed, please try again later']);
//                    return json(['code' => 0, 'msg' => '咨询失败，请稍后再试']);
                }
            }
        }else{
            return json(['code' => 0, 'msg' => '错误']);
        }
    }

//    订阅
    public function subscribe()
    {
        if(request()->isAjax()){
            $param = input('post.','','trim');
            $result = $this->validate($param,'FormValidate.subscribe');
            if(true !== $result){
                return json(["code" => 0, "msg" => $result]);
            }else {
                /* if($param['code'] != cookieCrypt('imgcode')){
                     return json(['code' => 0, 'msg' => 'Verification code is wrong']);
                     return json(['code' => 0, 'msg' => '验证码错误']);
                 }*/
                $param = injectChk($param);
                $param['sortnum'] = Db::name('message')->max('sortnum') + 10;
                $param['ip'] = get_client_ip();
                $param['state'] = 0;

                $message = new MessageModel();
                $flag = $message->insertMessage($param);
                if ($flag['code'] > 0) {
                    return json(['code' => 1, 'msg' => 'Subscription was successful']);
//                    return json(['code' => 1, 'msg' => '咨询成功']);
                } else {
                    return json(['code' => 0, 'msg' => 'Subscription failed, please try again later']);
//                    return json(['code' => 0, 'msg' => '咨询失败，请稍后再试']);
                }
            }
        }else{
            return json(['code' => 0, 'msg' => '错误']);
        }
    }

    //人才招聘
    public function job()
    {
        if(request()->isAjax()){
            $param = input('post.','','trim');
            $result = $this->validate($param,'FormValidate.job');
            if(true !== $result){
                return json(["code" => 0, "msg" => $result]);
            }else {

                $param = filter_escape_string($param);

                $param['sortnum'] = Db::name('job')->max('sortnum') + 10;
                $param['state'] = 0;

                $job= new JobModel();
                $flag = $job->insertJob($param);
                if ($flag['code'] > 0) {
                    return json(['code' => 1, 'msg' => '提交成功']);
                } else {
                    return json(['code' => 0, 'msg' => '提交失败，请稍后再试']);
                }
            }
        }
    }

    //加盟申请
    public function apply()
    {
        if(request()->isAjax()){
            $param = input('post.','','trim');
            $result = $this->validate($param,'FormValidate.join');
            if(true !== $result){
                return json(["code" => 0, "msg" => $result]);
            }else {
                if($param['code'] != cookieCrypt('imgcode')){
                    return json(['code' => 0, 'msg' => '验证码输入不正确']);
                }
                $param = filter_escape_string($param);

                $param['sortnum'] = Db::name('join')->max('sortnum') + 10;
                $param['ip'] = get_client_ip();
                $param['state'] = 0;

                $join = new JoinModel();
                $flag = $join->insertJoin($param);
                if ($flag['code'] > 0) {
                    return json(['code' => 1, 'msg' => '提交成功']);
                } else {
                    return json(['code' => 0, 'msg' => '提交失败，请稍后再试']);
                }
            }
        }
    }

    //图片验证码
    public function code_img(){
        $codeImg = new \org\CodeImg;
        $checkcode = $codeImg::make_rand(4);
        cookieCrypt('imgcode', $checkcode, time()+3600);
        $codeImg::getAuthImage($checkcode);
    }
}