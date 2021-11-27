<?php

namespace app\api\controller;
use app\api\model\MemberModel;
use think\Controller;
use think\Db;

class User extends Base
{
	protected static $AppID = 'wx8fe3e9c714eea4cd';
	protected static $AppSecret = '9ace1e4a3a2785c46cf12ac69d706bb9';

	public function login() {
		$param = input('param.');

		$code = $param['code'];

		$appId = self::$AppID;
		$appSecret = self::$AppSecret;
		$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appId."&secret=".$appSecret."&js_code=".$code."&grant_type=authorization_code";

		$return = $this->curlGet($url);
		$result = json_decode($return,true);
		if($result['openid']) {
			import('weixin.errorCode', EXTEND_PATH);
			import('weixin.wxBizDataCrypt', EXTEND_PATH);
			$DataCrypt = new \WXBizDataCrypt($appId, $result['session_key']);
			$errCode = $DataCrypt->decryptData($param['encryptedData'], $param['iv'], $userInfo);
			if($errCode == 0){
				$memberModel = new MemberModel();
				$map['open_id'] = $result['openid'];
				$member = $memberModel->getOneMember($map);
				$userInfo = json_decode($userInfo,true);
				$data['nickname'] = $userInfo['nickName'];
				$data['gender'] = $userInfo['gender'];
				$data['head_img'] = $userInfo['avatarUrl'];
				$data['login_time'] = time();
				if (!$member) {
					$group = Db::name('member_group')->order('id asc')->find();
					$data['football_money'] = 0;
					$data['tennis_money'] = 0;
					$data['gateball_money'] = 0;
					$data['football_group'] = $group['id'];
					$data['tennis_group'] = $group['id'];
					$data['gateball_group'] = $group['id'];
					$data['open_id'] = $result['openid'];
					$memberModel->insertMember($data);
				} else {
					$data['id'] = $member['id'];
					$memberModel->updateMember($data);
				}
				return json(['code'=>1, 'openid'=>$result['openid']]);
			}else{
				return json(['code'=>0, 'msg'=>'授权登录失败，请重新再试']);
			}
		}else{
			return json(['code'=>0, 'msg'=>'授权登录失败，请重新再试']);
		}
    }

	public function checkUser() {
		$param = input('param.');
		$memberModel = new MemberModel();
		$map['open_id'] = $param['openId'];
		$member = $memberModel->getOneMember($map);
		if ($member){
			$data['login_time'] = time();
			$data['id'] = $member['id'];
			$memberModel->updateMember($data);
			return json(['code'=>1, 'msg'=>'验证通过']);
		} else {
			return json(['code'=>0, 'msg'=>'验证失败']);
		}
	}

	public function getUserInfo() {
		$param = input('param.');
		$cateId = $param['cateid'];
		$field1 = config('ball')[$cateId]['money'];
		$member = $this->getMemberInfo($param['openId'],$cateId);
		if ($member) {
			$data['nickname'] = $member['nickname'];
			$data['avatarUrl'] = $member['head_img'];
			$data['group_name'] = $member['group_name'];
			$data['money'] = $member[$field1];
			return json(['code'=>1, 'msg'=>'获取成功', 'info'=>$data]);
		} else {
			return json(['code'=>0, 'msg'=>'获取用户信息失败']);
		}
	}

	public function curlGet($url){
		$ch = curl_init();
		$headers[] = "Accept-Charset:utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//获得内容
		$result = curl_exec($ch);
		//关闭curl
		curl_close($ch);
		return $result;
	}


}