<?php
namespace app\home\controller;
use app\home\model\BaseModel;
use app\home\model\GenealogyModel;
use app\home\model\ArticleModel;
use think\Db;

class Genealogy extends Base
{
    private $fid;
    private $second_id;
    public function _initialize()
    {

        parent::_initialize();
        $baseModel = new BaseModel();
        $artic=new ArticleModel();


        $id=input('param.id');
        $id=1;
        $action = strtolower(request()->action());

        if($action=='detail'){
            $child=$artic->getOneArticle(['id'=>$id]);
            $ids=$child['cate_id'];
        }else{
            $ids=$id;
        }


        $nav=$this->getNavId($ids);
        $this->assign('fid',$nav['fid']);
        $this->assign('fname',$nav['fname']);
        $this->assign('secondid',$nav['secondId']);
        $this->assign('secondname',$nav['secondname']);
        $this->assign('menu',$nav['cateList']);
        $this->fid=$nav['fid'];
        $this->second_id=$nav['secondId'];
        $fInfo=$artic->getOneCate(['id'=> $this->fid]);
        if(!empty($fInfo['photo'])){
            $banner=$fInfo['photo'];
        }else{
            $banner = $baseModel->getAdverOne(['status'=>1,'ad_position_id'=>25],2);

        }
        $this->assign('banner',$banner);

        /*所有族人*/
        $keys=input('keys');
        $type=input('type');

        if($keys){
            $map['name']=['like','%'.$keys.'%'];
        }
        $map['gid']=1;
        $map['sex']=1;
        $model=new GenealogyModel();

        if($action=='index'){//链接为内容
            $list=$model->getGenealogyList($map,15);
        }elseif($action=='zspic'||$action=='iframe'||$action=='ajax'){
            $list=$model->getGenealogyList2($map,15);
        }else{
            $this->error('参数错误',url('home/index/index'));
        }



        $this->assign('list',$list);
        $this->assign('keys',$keys);

    }

    public function index()
    {
        $gid=input('gid');
        $gid=empty($gid)?1:$gid;
        $model=new GenealogyModel();
        $map['gid']=$gid;
        $param=input();
        if($param['id']){
            $map['id']=(int)$param['id'];
        }

        $info=$model->getOneGenealogy($map);
        if($info['is_lock']==2){
            if(!$this->isLogin()){
                $this->error('请登录',url("home/member/login"));

            }
        }

        if($info['fid']!=''||$info['fid']!=0){
            $finfo=$model->getOneGenealogy(['id'=>$info['fid']]);
            $info['fname']=$finfo['g_no'].'-'.$finfo['name'];
            $gx['fname']=$finfo['g_no'].'-'.$finfo['name'];
            $gx['fname_url']=url('home/genealogy/index',['id'=>$finfo['id'],'gid'=>$gid]);
        }else{
            $info['fname']='';
            $gx['fname']='';
        }
        if($info['mid']!=''){
            $minfo=$model->getOneGenealogy(['id'=>$info['mid']]);
            $info['mname']=$minfo['g_no'].'-'.$minfo['name'];

            $gx['mname']=$minfo['g_no'].'-'.$minfo['name'];
            $gx['mname_url']=url('home/genealogy/index',['id'=>$minfo['id'],'gid'=>$gid]);
        }else{
            $info['mname']='';
        }


        if($param['id']){
            $id=$param['id'];
        }else{
            $id=$info['id'];
        }


        /*子女*/
        $znlist=$model->getGeneaLists(['fid'=>$param['id']]);
        foreach ($znlist as &$v){
            $v['url']=url('home/genealogy/index',['id'=>$v['id'],'gid'=>$gid]);
        }
        $gx['zn']=$znlist;

        $this->assign('gx',$gx);
        $this->assign('info',$info);
        $this->assign('id',$id);
        $this->assign('gid',$gid);

        $this->assign([
            'web_site_title'  => $info['name'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],

        ]);

        return $this->fetch();
    }

    public function zspic(){
        $id=input('id');
        $gid=input('gid');
        $gid=empty($gid)?1:$gid;
        $level=input('level');
        if(request()->isAjax()){

            $gid=input('gid');
            $gid=empty($gid)?1:$gid;
            $level=input('level');
            $level=empty($level)?5:$level;
            $ids=input('ids');
            $aa=Db::name('genealogy')->where(['gid'=>$gid])->order('fid asc')->select();
            $cc=Db::name('genealogy')->where(['id'=>$ids])->order('fid asc')->find();

            foreach ($aa as $v){
                if($ids==$v['id']){
                    $list[0]=array(
                        'name'=>$v['name'],
                        'title'=>$v['name'],
                        'fid'=>$v['fid'],
                        'id'=>$v['id'],
                        'dai'=>'第'.$v['dai'].'代',
                    );
                }
                if($v['fid']>=$ids){
                    $list[$v['id']]=array(
                        'name'=>$v['name'],
                        'title'=>$v['name'],
                        'fid'=>$v['fid'],
                        'id'=>$v['id'],
                        'dai'=>'第'.$v['dai'].'代',

                    );
                }

            }

            $bb=getMenuTree($list,$ids,$level);


            $bb=genTrees($bb);

            if($ids>1){
                $bb[0]=$bb[$cc['fid']];
            }

            $bb=json_encode($bb);

            return $bb;



        }
        $this->assign('id',$id);
        $this->assign('gid',$gid);
        $this->assign('level',$level);
        $info=Db::name('genealogy')->where(['id'=>$id])->find();
        $this->assign([
            'web_site_title'  => $info['name'],
            'web_site_keyword' => $this->config['web_site_keyword'],
            'web_site_description' => $this->config['web_site_description'],

        ]);
        return $this->fetch();
    }

    public function iframe(){
        $id=input('id');
        $level=input('level');
        $gid=input('gid');
        $gid=empty($gid)?1:$gid;
        $this->assign('gid',$gid);
        $this->assign('id',$id);
        $this->assign('level',$level);
        $cc=Db::name('genealogy')->where(['id'=>$id])->order('fid asc')->find();
        $this->assign('info',$cc);
        return $this->fetch();

    }



    /*根据id来进行判断是一级的  还是二级
    */
    public function getNavId($cid){
        $artic=new ArticleModel();
        $cate=$artic->getOneCate(['id'=>$cid]);
        if(!$cate){
            $this->error('参数错误');
        }
        if($cate['parent_id']==0){                     //$cid  如果是一级
            $result['fid']=$cate['id'];
            $result['fname']=$cate['name'];
                $childId=$artic->getOneCate(['parent_id'=> $result['fid']]);   //获取父亲id下面  id最小的分类  做当前的二级分类
            $result['secondId']=$childId['id'];
            $result['secondname']=$childId['name'];
        }else{                                  //$cid  为二级分类ID
            $finfo=$artic->getOneCate(['id'=>$cate['parent_id']]);
            $result['fid']=$cate['parent_id'];
            $result['fname']=$finfo['name'];
            $result['secondId']=$cate['id'];
            $result['secondname']=$cate['name'];
        }

        $result['cateList']=$artic->getCateList(['parent_id'=>$result['fid']]);  //获取所有的fid  下面的  二级分类
        foreach ($result['cateList'] as &$v){
            $v['url']=url('home/category/index',['id'=>$v['id']]);
        }

        return $result;


    }


    public function check_cate_auth($cate_id)
    {
        if($this->config['web_site_member'] == 1){
            $map[]=["exp","FIND_IN_SET($cate_id,group_cate)"];
            $map['status'] = 1;
            $group_cate_arr = Db::name('member_group')->where($map)->column('group_cate');
            if($group_cate_arr){
                $member = $this->isLogin();
                if(!$member){
                    $this->error('您还没有登录，请登录后查看相关内容',url('home/member/login'));
                }elseif(!in_array($member['group_id'], $group_cate_arr)){
                    $this->error('会员没有权限，无法查看相关内容');
                }
            }
        }
    }

}
