<?php
namespace app\api\controller;
use app\admin\model\RechargeModel;
use app\admin\model\MemberGroupModel;
use think\Db;

class Recharge extends Base
{
    public function getList()
    {
        $cateId = input('param.cateId');
        $field1 = config('ball')[$cateId]['amount'];
        $field2 = config('ball')[$cateId]['pre'];
        $groupModel = new MemberGroupModel();
        $map['status'] = 1;
        $map[$field1] = ['>',0];
        $lists = $groupModel->getGroup($map);
        $recharge = [];
        foreach($lists as $key => $val){
            $recharge[$key]['id'] = $val['id'];
            $recharge[$key]['amount'] = $val[$field1];
            $recharge[$key]['pre'] = $val[$field2];
            $recharge[$key]['checked'] = $key == 0? true : false;
        }

        return json($recharge);
    }

    public function createRecharge()
    {
        $param = input('post.');
        $cateId = $param['cateId'];
        $member = $this->getMemberInfo($param['openId'], $cateId);

        $map['userId'] = $member['id'];
        $map['cateId'] = $cateId;
        $map['pay_status'] = 0;
        Db::name('recharge')->where($map)->delete();

        $data['order_sn'] = build_order_no();
        $data['userId'] = $member['id'];
        $data['cateId'] = $cateId;
        $data['pay_status'] = 0;
        $data['create_time'] = time();
        $field1 = config('ball')[$cateId]['pre'];
        $field2 = config('ball')[$cateId]['group'];
        $field3 = config('ball')[$cateId]['amount'];
        if($param['reType'] > 0){
            $groupModel = new MemberGroupModel();
            $group = $groupModel->getOne($param['reType']);
            $data['amount'] = $group[$field3];
            if($member[$field1] > 0){
                $data['groundId'] = $member[$field1] > $group[$field1]? $group['id']:$member[$field2];
            }else{
                $data['groundId'] = $group['id'];
            }
        }else{
            $data['amount'] = $param['amount'];
            $map1['status'] = 1;
            $map1[$field1] = ['>',0];
            $lists = Db::name('member_group')->where($map1)->order($field1.' asc')->select();
            $data['groundId'] = $member[$field2];
            foreach($lists as $key => $val){
                if($param['amount'] >= $val[$field3]){
                    if($member[$field1] > 0){
                        $data['groundId'] = $member[$field1] > $val[$field1]? $val['id']:$member[$field2];
                    }else{
                        $data['groundId'] = $val['id'];
                    }
                    break;
                }
            }
        }

        $result = Db::name('recharge')->insert($data);
        if($result > 0){
            return json(['code'=>1,'msg'=>'提交成功','order_sn'=>$data['order_sn']]);
        }else{
            return json(['code'=>0,'msg'=>'提交失败，请稍后再试']);
        }
    }

    public function payInfo(){
        $order_sn = input('order_sn');
        $rechargeModel = new RechargeModel();
        $recharge = $rechargeModel->getOneRecharge(['order_sn'=>$order_sn]);
        if($recharge){
            $cate_name = Db::name('ground_cate')->where('id', $recharge['cateId'])->value('name');
            return json(['code'=>1, 'payPrice'=>$recharge['amount'], 'cate_name'=>$cate_name]);
        }else{
            return json(['code'=>0,'msg'=>'请求失败，请稍后再试']);
        }
    }

}
