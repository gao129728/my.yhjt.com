<?php


namespace app\mobile\controller;
use app\mobile\model\AddressModel;
use app\mobile\model\CartModel;
use app\mobile\model\ArticleModel;
use app\admin\model\OrdersModel;
class Cart extends Base
{
    /**
     *sort 1=>asc 2=>desc
     *       默认defailt=>sortnum  销量sales=》sales   价格price=》price 人气（浏览量）browse=》browse
     **/

    public function index(){
        $param=input('param.','','trim');
        $sort=empty($param['sort'])?1:$param['sort'];
        if($sort==1){
            $sort_order='asc';
        }else{
            $sort_order='desc';
        }
        $order=empty($param['order'])?'default':$param['order'];
        if($order=='sales'){
            $orderby='sales '.$sort_order;
        }else if($order=='price'){
            $orderby='price '.$sort_order;
        }else if($order=='browse'){
            $orderby='browse '.$sort_order;
        }else{
            $orderby='sortnum '.$sort_order;
            $order='default';
        }

        $product=new ProductModel();
        $map_list['is_show']=1;
        $limit=9;
        $lists = $product->getProductListByWhere($map_list,$limit,$orderby);
        $count = $product->getProductCount($map_list);
        if($sort==1){
            $sort=2;
        }else{
            $sort=1;
        }

        $this->assign('order', $order);
        $this->assign('sort', $sort);
        $this->assign('lists', $lists);
        $this->assign('count', $count);
        $web_site_keyword = $this->config['web_site_keyword'];
        $web_site_description = $this->config['web_site_description'];
        $web_site_title = '订阅系统 - '.$this->config['web_site_title'];
        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
        ]);
        return $this->fetch();
    }

    public function detail(){

        $product=new ProductModel();
        $id=input('id');
        $info=$product->getOneProduct(['id'=>$id]);
        if(!$info){
            $this->error('参数错误',url('home/product/index'));
        }
        if($info['slider_image']){
            $info['img_list']=explode(',',$info['slider_image']);
        }else{
            $info['img_list']='';
        }

        $map['id']=$id;
        $map['browse']=$info['browse']+1;
        $product->editProduct($map);


        $this->assign('info', $info);
        $web_site_keyword = $this->config['web_site_keyword'];
        $web_site_description = $this->config['web_site_description'];
        $web_site_title = '订阅系统 - '.$this->config['web_site_title'];
        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
        ]);
        return $this->fetch();
    }




    public function addcart(){
        $uid=$this->uid;
        if(!$uid){
            return json(['code'=>-1,'msg'=>'请登录']);
        }
        $param=input('param.','','trim');
        $cartmodel=new CartModel();
        $product=new ProductModel();
        $infos=$product->getOneProduct(['id'=>$param['id']]);
        if(!$infos){
            return json(['code'=>-1,'msg'=>'该产品已下架']);
        }
        if($param['num']>$infos['stock']){
            return json(['code'=>-1,'msg'=>'库存不足']);
        }

        $map['uid']=$uid;
        $map['product_id']=$param['id'];
        $map['is_del']=0;
        $map['is_pay']=0;
        $info=$cartmodel->getOneCart($map);
        if($info){
            if($param['method']=='add'){
                $maps['cart_num']=$info['cart_num']+$param['num'];

            }else{
                $maps['cart_num']=$param['num'];
            }
            if($maps['cart_num']>$infos['stock']){
                $maps['cart_num']=$infos['stock'];
            }
            $maps['id']=$info['id'];
            $flag=$cartmodel->editCart($maps);
        }else{
            $map['add_time']=time();
            $map['cart_num']=1;
            $flag=$cartmodel->insertCart($map);
        }
        if($param['method']=='add'){
            return json(['code'=>$flag['code'],'msg'=>$flag['msg']]);
        }else{
            $total=$this->getcartList($uid);
            $s_price=bcmul($infos['price'],$param['num'],2);
            return json(['code'=>$flag['code'],'msg'=>$flag['msg'],'s_price'=>$s_price,'t_price'=>$total['total']]);
        }

    }

    public function cart(){
        $uid=$this->uid;
        if(!$uid){
            $this->error('请登录',url('home/member/login'));
        }
        $list=$this->getcartList($uid);

        $this->assign('total', $list['total']);
        $this->assign('cartList', $list['cartlist']);
        $web_site_keyword = $this->config['web_site_keyword'];
        $web_site_description = $this->config['web_site_description'];
        $web_site_title = '购物车 - '.$this->config['web_site_title'];
        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
        ]);
        return $this->fetch();
    }


    public function delcart(){
        $uid=$this->uid;
        if(!$uid){
            return json(['code'=>-1,'msg'=>'请登录']);
        }
        $cartmodel=new CartModel();
        $id=input('id');
        if($id==0){
            $flag=$cartmodel->delcart(['uid'=>$uid,'is_del'=>0,'is_pay'=>0]);
        }else{
            $flag=$cartmodel->delcart(['id'=>$id]);
        }

        return json(['code'=>$flag['code'],'msg'=>$flag['msg']]);
    }


    public function confirm(){
        $uid=$this->uid;
        if(!$uid){
            $this->error('请登录',url('home/member/login'));
        }
        $info=$this->getcartList($uid);
        if(!$info['cartlist']){
            $this->error('请选择商品',url('home/product/index'));
        }
        $addressmodel=new AddressModel();

        $address=$addressmodel->getOneAddress(['uid'=>$uid,'is_default'=>1]);

        $invoicemodel=new InvoiceModel();

        $invoice=$invoicemodel->getOneInvoice(['uid'=>$uid]);



        $this->assign('invoice',$invoice);
        $this->assign('info',$info);
        $this->assign('address',$address);
        $web_site_keyword = $this->config['web_site_keyword'];
        $web_site_description = $this->config['web_site_description'];
        $web_site_title = '确认订单 - '.$this->config['web_site_title'];
        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
        ]);
        return $this->fetch();
    }

    public function create_order(){
        $uid=$this->uid;
        if(!$uid){
            return json(['code'=>-1,'msg'=>'请登录']);
        }
        $param=input('param.','','trim');
        $plist=$this->getcartList($uid);
        if(!$plist['cartlist']){
            return json(['code'=>-1,'msg'=>'购物车为空，快去购物']);
        }
        if(empty($param['address'])){
            return json(['code'=>-1,'msg'=>'收货地址不能为空']);
        }

        if($param['is_invoice']==1){
            $result = $this->validate($param['invoice'],'InvoiceValidate');
            if(true !== $result){
                return json(["code" => -1, "msg" => $result]);
            }else{
                $invoicemodel=new InvoiceModel();
                $mm=$invoicemodel->getOneInvoice(['uid'=>$uid]);
                $invoice=$param['invoice'];
                if($mm){
                    $invoice['id']=$mm['id'];
                    $invoicemodel->editInvoice($invoice);
                }else{
                    $invoice['add_time']=time();
                    $invoice['uid']=$uid;
                    $invoicemodel->insertInvoice($invoice);
                }
            }
            $datas['invoice']=json_encode($param['invoice']);
        }
        $datas['uid']=$uid;
        $datas['is_invoice']=$param['is_invoice'];
        $datas['pay_type']=$param['pay_type'];
        $datas['address']=json_encode($param['address']);
        $datas['cart_info']=json_encode($plist['cartlist']);
        $datas['cart_id']=$plist['cart_id'];
        $datas['status']=0;
        $datas['state']=0;
        $datas['order_num']=date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $datas['add_time']=time();
        $datas['price']=$plist['total'];


        $flag=OrdersModel::insertOrders($datas);
        if($flag['code']>0){
            $cartmodel=new CartModel();
            $cartmodel->updateCart(['uid'=>$uid],['is_del'=>1]);
        }
        return  json(['code'=>$flag['code'],'msg'=>$flag['msg']]);
    }


    /**获取会员购物车商品及总价**/
    public function getcartList($userId){
        $cartmodel=new CartModel();
        $product=new ArticleModel();
        $cartList=$cartmodel->getCartList(['user_id'=>$userId]);
        $total=0;
        $cart_id=array();
        foreach ($cartList as $k=>&$v){
            $v['pinfo']=$product->getOneArticle(['id'=>$v['product_id'],'status'=>1]);
            if(!$v['pinfo']){
                unset($cartList[$k]);
                $cartmodel->delcart(['id'=>$v['id']]);
            }else{
                $v['total']=bcmul($v['pinfo']['price'],$v['cart_num'],2);
                $total=bcadd($total, $v['total'], 2);
                $cart_id[]=$v['id'];
            }
        }
        if($cart_id){
            $cart_id=implode(',',$cart_id);
        }
        return array('cartlist'=>$cartList,'total'=>$total,'cart_id'=>$cart_id);
    }


}