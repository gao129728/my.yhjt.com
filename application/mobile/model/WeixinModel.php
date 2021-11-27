<?php
namespace app\home\model;
use think\Db;
use think\Validate;
use think\Loader;
use think\Model;

class WeixinModel extends model
{
	protected $appScrect;
	protected $appId;
	private   $account = array();

	public function __construct($appScrect="xxxxxxxxx",$appId="xxxxxxxx"){
		    $this->account=Db::name('wx_account')->where(['id'=>1])->find();
			$this->appScrect=$this->account['appsecret'];
			$this->appId=$this->account['appid'];


	}

	public function code_shouquan(){
		// echo $this->appScrect;
		// echo $this->appId;

		  //$redirect_uri=urlencode("你自己的域名/index/index/pay");//微信获取网页授权地址
		$redirect_uri='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			// 1、引导用户进入授权页面同意授权，获取code 
			// 2、通过code换取网页授权access_token
			// 3、如果需要，开发者可以刷新网页授权access_token，避免过期 
			// 4、通过网页授权access_token和openid获取用户基本信息（支持UnionID机制） 
		 $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appId."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
		
		header("Location: $url");
	}

 	public   function get_Openid($access_token)
    {

        $url="https://api.weixin.qq.com/sns/oauth2/access_token?".$access_token;
        $res= file_get_contents($url);
		$res=json_decode($res,true);
        return $res;
    }
	public function get_access_token($code){


		// $account = $this->account;
		// $now_time = time();
		// if($now_time-$account['access_token_time']<7000){
			
		// 	return $account['access_token'];
		// }
		$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appScrect."&code=".$code."&grant_type=authorization_code";

		$res= file_get_contents($url);
		$res=json_decode($res,true);

		if($res){
			// $data['access_token'] = $res['access_token'];$data['access_token_time'] =$now_time;
			// $flag=Db::name('wx_account')->where(['id'=>1])->update($data);
			return $res;
			
		}
		return false;
	}


	public function get_refresh_token($refresh_token){

		$url="https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->appId."&grant_type=refresh_token&refresh_token=".$refresh_token;

		$res= file_get_contents($url);
		$res=json_decode($res,true);

		return $res;


	}

	 public function get_openid_userinfo($access_token,$openid){
	 	$url="https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
	 	$res= file_get_contents($url);
		$res=json_decode($res,true);

		return $res;
	 }


}