<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/29
 * Time: 11:17
 */

namespace app\admin\controller;
use app\admin\model\ArticleModel;
use app\admin\model\OrdersModel;
use app\admin\model\ShopModel;
use app\admin\model\ShopCateModel;
use app\api\model\MemberModel;
use app\home\model\CartModel;
use think\Db;

class Orders  extends Base
{
    public function index(){
        $param=input('param.','','trim');
        $type = input('type');
        $val = input('val');
        $map = [];
        if($val!==''){
            if($type==1){
                $map['a.order_num']=$val;
            } else if($type==3){
                $map['a.total']=$val;
            }
        }
        $times = input('times');
        $mintime = input('mintime');
        $maxtime = input('maxtime');
        if($mintime>0&&$maxtime>0){
            if($times==1){
                $map['a.create_time']=['between',[strtotime($mintime),strtotime($maxtime)]];
            }
            if($times==2){
                $map['a.sure_time']=['between',[strtotime($mintime),strtotime($maxtime)]];
            }
        }

        if($param['status']==1){
            $map['a.status']=0;
        }else if($param['status']==2){
            $map['a.status']=1;
        }


        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 每页显示页数10
        $count = OrdersModel::getOrdersCount($map);//计算总订单数
        $allpage = intval(ceil($count / $limits));
        $lists = OrdersModel::getOrdersByWhere($map, $Nowpage, $limits);

        $article =new ArticleModel();
        foreach($lists as $k => $v){
            $v['pinfo'] = $article->getArticleList(['id' => ['in', $v['product_ids']]]);

            $v['address']=json_decode($v['address'],true);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
//        dump($lists);
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('type', $type);
        $this->assign('val', $val);
        $this->assign('times', $times);
        $this->assign('mintime', $mintime);
        $this->assign('maxtime', $maxtime);
        $this->assign('param', $param);
        if(input('get.page')){
            return json($lists);
        }
        /********本月数据统计start********/
        //获取本月开始的时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        //获取本月结束的时间戳
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        /***未支付订单***/
        $nopay=OrdersModel::where(['status'=>0,'create_time'=>['between',[$beginThismonth,$endThismonth]]])->count();
        $this->assign('nopay', $nopay);
        /***已预约订单***/
        $orderpay=OrdersModel::where(['status'=>1,'create_time'=>['between',[$beginThismonth,$endThismonth]]])->count();
        $this->assign('orderpay', $orderpay);
        /***单月已付***/
        $moneyday=OrdersModel::where(['status'=>1,'create_time'=>['between',[$beginThismonth,$endThismonth]]])->sum('total');
        $this->assign('moneyday', $moneyday?$moneyday:0);

        /***总已付***/
        $moneysum=OrdersModel::where(['status'=>1])->sum('total');
        $this->assign('moneysum', $moneysum?$moneysum:0);

        /*******本月数据统计end********/

        return $this->fetch();
    }

    public function view_message(){

        $id = input('id');
        $article =new ArticleModel();
        $cart =new CartModel();

        $info=OrdersModel::getOneOrders($id);

        $info['cart_info'] = $cart->getCartList(['id' => ['in', $info['cart_ids']]]);
        foreach ($info['cart_info'] as &$v){
            $v['pinfo'] = $article->getOneArticle($v['product_id']);
        }

        $info['address_detail']=json_decode($info['address'],true);


        $this->assign('info', $info);

        $backUrl = url('index',['cur_page'=>input('param.cur_page')]);
        $this->assign('backUrl',$backUrl);
        return $this->fetch();
    }



    /**
     * [删除]
     */
    public function del_orders()
    {
        $param['id'] = input('param.id');

        $flag =OrdersModel::delOrders($param);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    /**
     * [批量删除]
     */
    public function all_del_message()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $map['id'] = ['in', ''.$ids.''];
            $flag =OrdersModel::delOrders($map);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }

    public function datas(){

        return $this->fetch();
    }

    public function imports(){


        $param=input('param.','','trim');
        $type = input('type');
        $val = input('val');
        $map = [];
        if($val!==''){
            if($type==1){
                $map['a.order_num']=$val;
            }
           else if($type==3){
                $map['a.price']=$val;
            }
        }
        $times = input('times');
        $mintime = input('mintime');
        $maxtime = input('maxtime');

        if($mintime>0&&$maxtime>0){
            if($times==1){
                $map['a.create_time']=['between',[strtotime($mintime),strtotime($maxtime)]];
            }
//            if($times==2){
//                $map['a.sure_time']=['between',[strtotime($mintime),strtotime($maxtime)]];
//            }
        }

        if($param['status']==1){
            $map['a.status']=0;
        }else if($param['status']==2){
            $map['a.status']=1;
        }

        $lists =OrdersModel::getList($map);


        $filename = "excel".date("YmdHis").'.xls';

        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<style>td,th{text-align: left; height:34px; line-height:34px;}</style>";
        $str .="<table border=1>";
        $str .= "<tr style='font-weight:bold; font-size: 14px;'>";
        $str .= "<th width='140'>序号</th>";
        $str .= "<th width='140'>订单号</th>";
        $str .= "<th width='200'>商品名称及数量</th>";
        $str .= "<th width='160'>总价</th>";
        $str .= "<th width='160'>收货人</th>";
//        $str .= "<th width='160'>固定电话</th>";
        $str .= "<th width='160'>手机号码</th>";
        $str .= "<th width='180'>邮编</th>";
        $str .= "<th width='180'>收货地址</th>";
//        $str .= "<th width='100'>公司</th>";
//        $str .= "<th width='100'>支付方式</th>";
        $str .= "<th width='100'>支付状态</th>";
        $str .= "<th width='160'>下单时间</th>";
//        $str .= "<th width='100'>是否需要发票</th>";
//        $str .= "<th width='100'>发票类型</th>";

//        $str .= "<th width='100'>发票抬头</th>";
//        $str .= "<th width='100'>纳税人识别号</th>";
//        $str .= "<th width='100'>地址</th>";
//        $str .= "<th width='100'>电话</th>";
//        $str .= "<th width='100'>开户行</th>";
//        $str .= "<th width='100'>账号</th>";
//
//        $str .= "<th width='100'>接受发票电子邮箱</th>";
//        $str .= "<th width='100'>邮寄发票联系人</th>";
//        $str .= "<th width='100'>邮寄发票电话</th>";
//        $str .= "<th width='100'>邮寄发票地址</th>";
        $str .= "</tr>";

        if($lists) {
            foreach ($lists as $key => &$val) {
                $cart = new CartModel();
                $val['address_detail']=json_decode($val['address'],true);
                $val['cart_info'] = $cart->getCartList(['id' => ['in', $val['cart_ids']]]);


//                $val['cart_detail']=json_decode($val['cart_info'],true);
               /* if($val['invoice']){
                    $val['invoice_detail']=json_decode($val['invoice'],true);
                }else{
                    $val['invoice_detail']='';
                }

                if($val['is_invoice']==1){
                    $is_invoice='是';
                }else{
                    $is_invoice='否';
                }*/


//                $pay_type_name = $val['pay_type'] == 1? '微信支付':'余额支付';
                $pay_status_name = $val['status'] == 0? '未支付':'已支付';
                $mm=$key+1;
                $store='';
                foreach ($val['cart_info'] as $v){
                    $v['pinfo'] = Db::name('article')->where(['id'=>$v['product_id']])->find();
                    $store.=$v['pinfo']['title'].'|'.'x'.$v['cart_num']."<br/>";
                }
                $str .= "<tr>";
                $str .= "<td>".$mm."</td>";
                $str .= "<td>".$val['order_num']."</td>";
                $str .= "<td>".$store."</td>";
                $str .= "<td>$".$val['total']."</td>";

                $str .= "<td>".$val['address_detail']['name']."</td>";
//                $str .= "<td>".$val['address_detail']['tel']."</td>";
                $str .= "<td>".$val['address_detail']['phone']."</td>";
                $str .= "<td>".$val['address_detail']['postcode']."</td>";
                $str .= "<td>".$val['address_detail']['address']."</td>";
//                $str .= "<td>".$val['address_detail']['company']."</td>";


//                $str .= "<td>".$pay_type_name."</td>";
                $str .= "<td>".$pay_status_name."</td>";
                $str .= "<td>".$val['create_time']."</td>";
//                $str .= "<td>".$is_invoice."</td>";
               /* if($val['is_invoice']==1){

                    $invoice_type = $val['invoice_detail']['type'] == 1? '电子票':'专票';
                    $str .= "<td>".$invoice_type."</td>";

                    $str .= "<td>".$val['invoice_detail']['invoice_title']."</td>";
                    $str .= "<td>".$val['invoice_detail']['invoice_num']."</td>";
                    $str .= "<td>".$val['invoice_detail']['address']."</td>";
                    $str .= "<td>".$val['invoice_detail']['phone']."</td>";
                    $str .= "<td>".$val['invoice_detail']['bank']."</td>";
                    $str .= "<td>".$val['invoice_detail']['account']."</td>";
                    if($val['invoice_detail']['type'] == 1){
                        $str .= "<td>".$val['invoice_detail']['send_email']."</td>";
                        $str .= "<td></td>";
                        $str .= "<td></td>";
                        $str .= "<td></td>";
                    }else{
                        $str .= "<td></td>";
                        $str .= "<td>".$val['invoice_detail']['send_name']."</td>";
                        $str .= "<td>".$val['invoice_detail']['send_phone']."</td>";
                        $str .= "<td>".$val['invoice_detail']['send_province'].$val['invoice_detail']['send_city'].$val['invoice_detail']['send_street'].$val['invoice_detail']['send_address']."</td>";
                    }
                }else{
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                    $str .= "<td></td>";
                }*/
                $str .= "</tr>\n";
            }
        }
        $str .= "</table></body></html>";

        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        //header("Content-type: application/vnd.ms-excel; charset=UTF-8");
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );


    }
}