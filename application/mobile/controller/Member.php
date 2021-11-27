<?php

namespace app\mobile\controller;

use app\mobile\model\AddressModel;
use app\mobile\model\CollectionModel;
use app\mobile\model\MemberModel;
use app\mobile\model\OrdersModel;
use app\mobile\model\ArticleModel;
use app\mobile\model\CartModel;
use think\Db;

class Member extends Base
{


    /*
     * [会员登录]
     */
    public function login()
    {
        if (request()->isAjax()) {
            $param = input('post.', '', 'trim');
            /* $result = $this->validate($param,'MemberValidate.login');
             if(true !== $result){
                 return json(["code" => 0, "msg" => $result]);
             }else {*/
            /* if($param['code'] != cookieCrypt('imgcode')){
                 return json(['code' => 0, 'msg' => '验证码输入不正确']);
             }*/

            $param = filter_escape_string($param);
            $memberModel = new MemberModel();
            $map['a.email'] = $param['email'];
            $member = $memberModel->getOneMember($map);
            if ($member) {
                if ($member['password'] != md5(md5($param['password']) . config('auth_key'))) {
//                        return json(['code' =>0, 'msg' => '登录密码错误']);
                    return json(['code' => 0, 'msg' => 'Password is wrong']);
                }
                if ($member['status'] == 0 || $member['group_status'] == 0) {
//                        return json(['code' =>0, 'msg' => '您的账号已被禁用，无法登陆']);
                    return json(['code' => 0, 'msg' => 'Your email has been disabled']);
                }
                $save_time = 3600 * 24 * 1;
                // cookieCrypt('web_userId', $member['id'], $save_time);
                session('web_userId', $member['id']);
                $data['id'] = $member['id'];
                $data['login_num'] = $member['login_num'] + 1;
                $memberModel->editMember($data);
//                    return json(['code' =>1, 'msg' => '会员登录成功']);
                return json(['code' => 1, 'msg' => 'Login successfully']);

            } else {
//                    return json(['code' =>0, 'msg' => '会员账号不存在']);
                return json(['code' => 0, 'msg' => 'The email does not exist']);
            }

//            }
        }
        if ($this->isLogin()) {
            $this->redirect('mobile/index/index');
        }

        $this->assign([
            'web_site_title' => 'Login' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();

    }

    /*
     * [会员注册页]
     */
    public function register()
    {
        if (request()->isAjax()) {
            $param = input('post.', '', 'trim');
            $result = $this->validate($param, 'MemberValidate.register');
            if (true !== $result) {
                return json(["code" => 0, "msg" => $result]);
            } else {
//                if($param['code'] != cookieCrypt('imgcode')){
//                    return json(['code' => 0, 'msg' => '验证码输入不正确']);
//                }
                $param = filter_escape_string($param);

                $param['password'] = md5(md5($param['password']) . config('auth_key'));
                $param['group_id'] = config('web_member_group');
                $param['login_num'] = 0;
                $param['status'] = 1;

                $memberModel = new MemberModel();
                $flag = $memberModel->addMember($param);
                return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
            }
        }
        if ($this->isLogin()) {
            $this->redirect('mobile/index/index');
        }
        $this->assign([
            'web_site_title' => 'Register' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();
    }

    public function zhmm()
    {

        return $this->fetch();

    }

    /**
     * 退出登录
     */
    public function loginOut()
    {

        session('web_userId', null);
        $this->redirect('/mobile/index/index');
    }

    public function myorder()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);

        }
        $userId = session('web_userId');
        $status = input('param.status');

        if ($status > 0) {
            if ($status == 1) {
                $map['status'] = 1;
            } else if ($status == 2) {
                $map['status'] = 0;
            }
        }
        $cartModel = new CartModel();
        $map['user_id'] = $userId;
        $list = OrdersModel::getOrdersByWhere($map, 10);
        foreach ($list as &$v) {
            $v['pinfo'] = $cartModel->getCartList(['id' => ['in', $v['cart_ids']]]);
            foreach ($v['pinfo'] as &$k) {
                $k['title'] = Db::name('article')->where(['id' => $k['product_id']])->value('title');
                $k['photo'] = Db::name('article')->where(['id' => $k['product_id']])->value('photo');
                if (empty($k['title'])) {
                    $k['title'] = 'The product has been set up';
                }
            }
        }

        $this->assign('list', $list);

        $this->assign('status', $status);
        $this->assign('menucur', 1);

        $this->assign([
            'web_site_title' => 'My order' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();
    }

    public function myorder_details()
    {
        $userId = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $id = input('id');
        $info = OrdersModel::getOneOrders($id);
        if (!$info) {
            $this->error('Order does not exist', 'mobile/member/myorder');
        }

        $info['address_detail'] = json_decode($info['address'], true);
        $info['count'] = explode(',',$info['product_ids']);
        $cart = new CartModel();
        $info['shop_cart'] = $cart->getCartList(['id'=>['in',$info['cart_ids']]]);
        foreach ($info['shop_cart'] as &$v){
            $product = new ArticleModel();
            $v['pinfo'] = $product->getOneArticle(['id'=>$v['product_id']]);
        }


        $this->assign([
            'web_site_title' => 'Order details' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],
            'menucur' => 1,
            'info' => $info,
        ]);
        return $this->fetch();
    }

    public function collection()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $user_id = session('web_userId');

        $result = $this->getcollectionList($user_id);
        $this->assign('collectionlist', $result['collectionList']);
        $this->assign('menucur', 3);
        $this->assign([
            'web_site_title' => 'My collection' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();
    }

    public function getcollectionList($userId)
    {
        $collectionmodel = new CollectionModel();
        $collectionList = $collectionmodel->getCollectionListByWhere(['user_id' => $userId],10);
        foreach ($collectionList as $k=>&$v){
            $v['info']=Db::name('article')->where(['id'=>$v['product_id']])->find();
            if(!$v['info']){
                unset($collectionList[$k]);
            }
        }
        return array('collectionList' => $collectionList);
    }

    public function addcollection()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $userId = session('web_userId');

        $map['user_id'] = $userId;
        $param = input('param.', '', 'trim');
        $collectionmodel = new CollectionModel();
        $product = new ArticleModel();
        $infos = $product->getOneArticle(['id' => $param['id']]);
        if (!$infos) {
            return json(['code' => -1, 'msg' => 'The product has been set up']);
        }
        $map['product_id'] = $param['id'];
        $map['create_time'] = time();
        $info = $collectionmodel->getOneCollection(['product_id' => $param['id'],'user_id'=>$userId]);
        if ($info) {
            $flag = $collectionmodel->delCollection(['id' => $info['id']]);
            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        } else {
            $flag = $collectionmodel->insertCollection($map);
            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        }

    }

    public function shopping()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $this->assign('menucur', 2);

        $user_id = session('web_userId');


        $result = $this->getcartList($user_id);

        //总计金额
        $this->assign('total', $result['total']);
        //总计数量
        $this->assign('t_num', $result['t_num']);

        $this->assign('cartlist', $result['cartlist']);

        $this->assign([
            'web_site_title' => 'Shopping cart' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();

    }

    public function addshopping()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $userId = session('web_userId');

        $map['user_id'] = $userId;
        $param = input('param.', '', 'trim');
        $cartmodel = new CartModel();
        $product = new ArticleModel();
        $infos = $product->getOneArticle(['id' => $param['id']]);
        if (!$infos) {
            return json(['code' => -1, 'msg' => 'The product has been set up']);
        }
        $map['product_id'] = $param['id'];
        $map['status'] = 0;
        $map['price'] = $infos['price'];
        /* $map['is_pay']=0;*/
        $info = $cartmodel->getOneCart($map);
        if ($info) {
            if ($param['method'] == 'add') {
                $maps['cart_num'] = $info['cart_num'] + $param['num'];
            } else {
                $maps['cart_num'] = $param['num'];
            }
            $maps['update_time'] = time();
            /* if($maps['cart_num']>$infos['stock']){
                 $maps['cart_num']=$infos['stock'];
             }*/
            $maps['id'] = $info['id'];
            $flag = $cartmodel->editCart($maps);
        } else {
            $map['create_time'] = time();
            $map['update_time'] = time();
            $map['cart_num'] = 1;
            $flag = $cartmodel->insertCart($map);
        }
        if ($param['method'] == 'add') {
            return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
        } else {
            $total = $this->getcartList($userId);
            $s_price = bcmul($infos['price'], $param['num'], 2);
            return json(['code' => $flag['code'], 'msg' => $flag['msg'], 's_price' => $s_price, 't_price' => $total['total'], 't_num' => $total['t_num']]);
        }

    }

    /**获取会员购物车商品及总价**/
    public function getcartList($userId)
    {
        $cartmodel = new CartModel();
        $product = new ArticleModel();
        $cartList = $cartmodel->getCartList(['user_id' => $userId, 'status' => 0]);
        $total = 0;
        $t_num = 0;
        $cart_id = array();
        foreach ($cartList as $k => &$v) {
            $v['pinfo'] = $product->getOneArticle(['id' => $v['product_id'], 'status' => 1]);
            if (!$v['pinfo']) {
                unset($cartList[$k]);
                $cartmodel->delcart(['id' => $v['id']]);
            } else {
//                总价
                $v['total'] = bcmul($v['pinfo']['price'], $v['cart_num'], 2);
                $total = bcadd($total, $v['total'], 2);
//                商品总数量
                $v['t_num'] = $v['cart_num'];
                $t_num = bcadd($t_num, $v['t_num']);

                $cart_id[] = $v['id'];
                $product_id[] = $v['product_id'];
            }
        }
        if ($cart_id) {
            $cart_id = implode(',', $cart_id);
            $product_id = implode(',', $product_id);
        }

        return array('cartlist' => $cartList, 'total' => $total, 't_num' => $t_num, 'cart_id' => $cart_id, 'product_id' => $product_id);
    }

    public function delcart()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $userId = session('web_userId');
        $cartmodel = new CartModel();
        $id = input('product_id');
        if ($id == 0) {
            $flag = $cartmodel->delcart(['user_id' => $userId, 'status' => 0]);
        } else {
            $flag = $cartmodel->delcart(['product_id' => $id]);
        }
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    //批量删除商品
    public function all_delete()
    {
        if (request()->isAjax()) {
            $ids = input('param.ids');
            $map['id'] = ['in', '' . $ids . ''];
            $flag = Db::name('shop_cart')->where($map)->delete();
            if ($flag > 0) {
                return json(['code' => 1, 'msg' => 'Selections has been deleted']);
            } else {
                return json(['code' => 0, 'msg' => 'Delete failed']);
            }
        }
    }

    public function address()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }

        $addressModel = new AddressModel();
        $user_id = session('web_userId');

        $type = input('type');
        $type = !empty($type) ? input('type') : 0;

        $addressList = $addressModel->getAddressListByWhere(['user_id'=>$user_id]);
        $this->assign('addressList', $addressList);
        $this->assign('type', $type);

        $this->assign('menucur', 4);
        $this->assign([
            'web_site_title' => 'My address' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description']
        ]);
        return $this->fetch();
    }

    public function add_address()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $type = input('type');
        $type = !empty($type) ? input('type') : 0;
        $this->assign('type', $type);


        if (request()->isAjax()) {
            $param = input('post.', '', 'trim');
            $result = $this->validate($param, 'FormValidate.address');
            if (true !== $result) {
                return json(["code" => -1, "msg" => $result]);
            } else {
                $addressModel = new AddressModel();
                $param = injectChk($param);
                $param['user_id'] = $user_id;
                $param['create_time'] = time();
                $address_num = $addressModel->getAddressCount(['user_id'=>$user_id]);
                if(!$address_num) {
                    $param['is_default'] = 1;
                }
                if ($param['id']) {
                    $flag = $addressModel->editAddress($param);
                } else {
                    $flag = $addressModel->insertAddress($param);
                }
                if ($flag['code'] > 0) {
                    if ($param['is_default'] > 0) {
                        $addressModel->updateAddress(['user_id' => $user_id, 'id' => ['neq', $flag['data']]], ['is_default' => 0]);
                    }
                    if ($param['id']) {
                        return json(['code' => 1, 'msg' => $flag['msg']]);
                    } else {
                        return json(['code' => 1, 'msg' => $flag['msg']]);
                    }
                } else {
                    return json(['code' => 0, 'msg' => 'Wrong,try again later']);
                }
            }

        }
        $this->assign('menucur', 4);

        $this->assign([
            'web_site_title' => 'New address' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],
        ]);
        return $this->fetch();

    }

    public function edit_address()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
            $this->redirect('mobile/index/index');
        }
        $type = input('type');
        $type = !empty($type) ? input('type') : 0;
        $this->assign('type', $type);


        $addressModel = new AddressModel();
        if (request()->isAjax()) {

            $param = input('post.', '', 'trim');
            $result = $this->validate($param, 'FormValidate.address');
            if (true !== $result) {
                return json(["code" => -1, "msg" => $result]);
            } else {

                $param = injectChk($param);
                $flag = $addressModel->editAddress($param);
                if ($flag['code'] > 0) {
                    if ($param['is_default'] > 0) {
                        $addressModel->updateAddress(['user_id' => $user_id, 'id' => ['neq', $param['id']]], ['is_default' => 0]);
                    }
                    return json(['code' => 1, 'msg' => 'Edit successfully']);
                } else {
                    return json(['code' => 0, 'msg' => 'Edit failed，try again later']);
                }
            }

        }
        $id = input('id');
        $info = $addressModel->getOneAddress(['id' => $id]);


        $this->assign('menucur', 4);

        $this->assign([
            'web_site_title' => 'Edit address' . ' - ' . $this->config['web_site_title'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],
            'info' => $info,
        ]);
        return $this->fetch();

    }

    public function del_address()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $id = input('id');
        $addressModel = new AddressModel();
        $flag = $addressModel->delAddress(['id' => $id]);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    public function set_default()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $id = input('id');
        $addressModel = new AddressModel();
        $info = $addressModel->getOneAddress(['id' => $id]);
        if (!$info) {
            return json(['code' => -1, 'msg' => '该记录不存在']);
        }
        $flag = $addressModel->editAddress(['id' => $id, 'is_default' => 1]);
        if ($flag['code'] > 0) {
            $addressModel->updateAddress(['user_id' => $user_id, 'id' => ['neq', $id]], ['is_default' => 0]);
        }

        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);

    }

    public function confirm()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $cartList = $this->getcartList($user_id);
        if (!$cartList['cartlist']) {
            $this->error('Please select products', url('mobile/member/shopping'));
        }
        $addressmodel = new AddressModel();

        $address = $addressmodel->getOneAddress(['user_id' => $user_id, 'is_default' => 1]);


        $this->assign('address', $address);


        $this->assign('cartList', $cartList);
//        dump($cartList['t_num']);


        $this->assign('menucur', 1);

        $web_site_keyword = $this->config['web_site_keyword'];
        $web_site_description = $this->config['web_site_description'];
        $web_site_title = 'Place order - ' . $this->config['web_site_title'];
        $this->assign([
            'web_site_title' => $web_site_title,
            'web_site_keyword' => $web_site_keyword,
            'web_site_description' => $web_site_description,
        ]);
        return $this->fetch();
    }


    public function create_order()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $param = input('param.', '', 'trim');
        $plist = $this->getcartList($user_id);
        $add = new AddressModel();
        $address = $add->getOneAddress(['is_default' => 1,'user_id'=>$user_id]);
        if (!$plist['cartlist']) {
            return json(['code' => -1, 'msg' => 'Cart is empty']);
        }
        if (empty($address)) {
            return json(['code' => -1, 'msg' => 'Address cannot be empty']);
        }
        $datas['user_id'] = $user_id;
        $datas['address'] = json_encode($address);
        $datas['product_ids'] = $plist['product_id'];
        $datas['cart_ids'] = $plist['cart_id'];
        $datas['status'] = 0;
        $datas['order_num'] = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $datas['create_time'] = time();
        $datas['total'] = $plist['total'];//总价
        $flag = OrdersModel::insertOrders($datas);
        if ($flag['code'] > 0) {
            $cartmodel = new CartModel();
            $cartmodel->updateCart(['user_id' => $user_id], ['status' => 1]);
        }
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    public function del_orders()
    {
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $id = input('id');
        $flag = OrdersModel::delOrders(['id' => $id]);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    public function del_collect()
    {
        $user_id = session('web_userId');
        if (!$this->isLogin()) {
            return json(['code' => -1, 'msg' => 'Please login']);
        }
        $id = input('id');
        $collectmodel= new CollectionModel();
        $flag = $collectmodel->delCollection(['product_id' => $id,'user_id'=>$user_id]);
        return json(['code' => $flag['code'], 'msg' => $flag['msg']]);
    }

    public function getMessage(){
        $think_email=input('email');
        $think_pass=input('pass');

        $email=think_decrypt($think_email);
        $pass=think_decrypt($think_pass);


        $model=new MemberModel();
        $info=$model->getCount(['email'=>$email]);

        if($info<=0){
            echo 'The email does not exist';
            exit;
        }


        $map['password']=md5(md5($pass) . config('auth_key'));
        $map['id']=$info['id'];
        $model->editMember($map);

        echo '密码修改成功';
        exit;

    }

}


