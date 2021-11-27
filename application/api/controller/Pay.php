<?php
/**
 * 支付类
 * User: 梅振宇
 * Date: 2017/11/20
 * Time: 10:38
 */
namespace app\api\controller;
use think\Controller;
use think\Db;

class Pay extends Controller{
    /**
     * 微信JSAPI支付
     */
    public function wxPay(){
        $param = input('param.');
        $order_sn = $param['order_sn'];
        $openId = $param['openId'];
        $order = Db::name('orders')->where('order_sn', $order_sn)->find();
        if($order) {
            if($order['pay_status'] == 1){
                return json(['code'=>0, 'msg'=>'订单已支付过了！']);
            }

            $body = '订单支付';
            $out_trade_no = $order['order_sn'].'_'.random();
            $total_fee = $order['payPrice'];

            ini_set('date.timezone', 'Asia/Shanghai');
            import('wxpay.lib.WxPay', EXTEND_PATH, '.Api.php');
            import('wxpay.WxPay', EXTEND_PATH, '.JsApiPay.php');

            $tools = new \JsApiPay();
            $input = new \WxPayUnifiedOrder();
            $input->SetBody($body);
            $input->SetAttach($body);
            $input->SetOut_trade_no($out_trade_no);
            $input->SetTotal_fee($total_fee*100);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag($body);
            $input->SetNotify_url(config('website_domain')."/api/pay/wxpay_notify");
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openId);
            $parameters = \WxPayApi::unifiedOrder($input);
            $jsApiParameters = $tools->GetJsApiParameters($parameters);

            return json(['code'=>1, 'data'=>json_decode($jsApiParameters,true)]);
        }else{
            return json(['code'=>0, 'msg'=>'订单不存在！']);
        }
    }

    /**
     *  作用：将xml转为array
     */
    function xmlToArray($xml)
    {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    /**
     * 订单支付回调处理
     */
    public function wxpay_notify(){
        ini_set('date.timezone','Asia/Shanghai');

        import('wxpay.PayNotifyCallBack', EXTEND_PATH);
        import('wxpay.log', EXTEND_PATH);

        //初始化日志
        $logHandler = new \CLogFileHandler(EXTEND_PATH."wxpay/logs/".date('Y-m-d').'.log');
        \Log::Init($logHandler, 15);
        \Log::DEBUG("begin notify");

        $notify = new \PayNotifyCallBack();
        $notify->Handle(false);

        $postXml = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postArr = $this->xmlToArray($postXml);

        // 查询是否支付成功
        $result = $notify->Queryorder($postArr['transaction_id']);
        if ($result){
            $out_trade_no = substr($postArr['out_trade_no'], 0, 16);
            $order = Db::name('orders')->where('order_sn', $out_trade_no)->find();
            $map['id'] = $order['id'];
            $map['pay_time'] = time();
            $map['pay_type'] = 0;
            $map['pay_status'] = 1;
            Db::name('orders')->update($map);
        }
    }

    /**
     * 会员充值
     */
    public function wxRecharge(){
        $param = input('param.');
        $order_sn = $param['order_sn'];
        $openId = $param['openId'];
        $recharge = Db::name('recharge')->where('order_sn', $order_sn)->find();
        if($recharge) {
            if($recharge['pay_status'] == 1){
                return json(['code'=>0, 'msg'=>'已充值过了！']);
            }

            $body = '会员充值';
            $out_trade_no = $recharge['order_sn'].'_'.random();
            $total_fee = $recharge['amount'];

            ini_set('date.timezone', 'Asia/Shanghai');
            import('wxpay.lib.WxPay', EXTEND_PATH, '.Api.php');
            import('wxpay.WxPay', EXTEND_PATH, '.JsApiPay.php');

            $tools = new \JsApiPay();
            $input = new \WxPayUnifiedOrder();
            $input->SetBody($body);
            $input->SetAttach($body);
            $input->SetOut_trade_no($out_trade_no);
            $input->SetTotal_fee($total_fee*100);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag($body);
            $input->SetNotify_url(config('website_domain')."/api/pay/recharge_notify");
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openId);
            $parameters = \WxPayApi::unifiedOrder($input);
            $jsApiParameters = $tools->GetJsApiParameters($parameters);

            return json(['code'=>1, 'data'=>json_decode($jsApiParameters,true)]);
        }else{
            return json(['code'=>0, 'msg'=>'充值记录不存在！']);
        }
    }

    public function recharge_notify(){
        ini_set('date.timezone','Asia/Shanghai');

        import('wxpay.PayNotifyCallBack', EXTEND_PATH);
        import('wxpay.log', EXTEND_PATH);

        //初始化日志
        $logHandler = new \CLogFileHandler(EXTEND_PATH."wxpay/logs/".date('Y-m-d').'.log');
        \Log::Init($logHandler, 15);
        \Log::DEBUG("begin notify");

        $notify = new \PayNotifyCallBack();
        $notify->Handle(false);

        $postXml = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postArr = $this->xmlToArray($postXml);

        // 查询是否支付成功
        $result = $notify->Queryorder($postArr['transaction_id']);
        if ($result){
            $out_trade_no = substr($postArr['out_trade_no'], 0, 16);
            $recharge = Db::name('recharge')->where('order_sn', $out_trade_no)->find();
            $map['id'] = $recharge['id'];
            $map['pay_status'] = 1;
            Db::name('recharge')->update($map);

            $member = Db::name('member')->where('id', $recharge['userId'])->find();
            $cateId = $recharge['cateId'];
            $field = config('ball')[$cateId]['money'];
            $field1 = config('ball')[$cateId]['group'];
            $param['id'] = $member['id'];
            $param[$field] = bcadd($member[$field], $recharge['amount'], 2);
            $param[$field1] = $recharge['groundId'];
            Db::name('member')->update($param);
        }
    }

}
