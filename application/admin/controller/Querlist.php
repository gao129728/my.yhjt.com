<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 17:11
 */

namespace app\admin\controller;
use app\admin\model\ArticleCateModel;
use QL\QueryList;
use think\Db;

class Querlist  extends Base
{
   public function index(){
       $tree = new \org\Leftnav;
       $cateModel = new ArticleCateModel();
       $cateList = $cateModel->getAllCate();
       $arr = $tree::get_cate_tree($cateList);
       $this->assign('cateList',$arr);
       return  $this->fetch();
   }

    public function get(){
        $param=input();
        $url = $param['link'];
        $page=$param['page'];
        $domin=explode('/',$url)[2];

        //抓取列表页规则
        $rules = [
            'title' =>   [$param['title'],'text'],
            'href' =>    [$param['href'],'href'],
            'photo' =>   [$param['photo'],'src'],
            'content' => [$param['content'],'html']
        ];
        $data=array();
        if($page>0){             //多页抓取
            for($i=1;$i<=$page;$i++){
                $urls[$i]=$url.'&pageIndex='.$i;            //多页链接   不同网站要更改
                $mm[$i] = QueryList::Query($urls[$i],$rules)->data;

            }
            //把抓取到的多页内容 放到data里面
            foreach($mm as $v){
                foreach($v as $mv){
                    $ruless=[
                        'content' => [$param['content'],'html']
                    ];
                    $displayurl='http://'.$domin.'/'.$mv['href'];
                    $mv['content']= QueryList::Query($displayurl,$ruless)->data[0]['content'];

                    $data[]=$mv;
                }
            }
        }else{                    //单独页抓取
            $data = QueryList::Query($url,$rules)->data;
            foreach($data as $mv){
                    if($mv['href']){
                        $ruless=[
                            'content' => [$param['content'],'html']
                        ];
                        $displayurl='http://'.$domin.'/'.$mv['href'];
                        $mv['content']= QueryList::Query($displayurl,$ruless)->data[0]['content'];

                        $data[]=$mv;
                    }
                    
                }
        }

dump($data);

        foreach($data as $lk=>&$kl){
            //获取内容页的图片地址
            preg_match_all('/<img [^>]*src=\"(.+?)\"/',$kl['content'],$matches);
            //根据内容页的图片地址  把下载到服务器内 并更改内容页的图片链接
            foreach($matches[1] as $oo){
                $lll=getImage('http://'.$domin.$oo,ROOT_PATH . 'public' . DS . 'ueditor/php/upload/image/');
                $kl['content']=str_replace($oo,'/ueditor/php/upload/image/'.$lll['file_name'],$kl['content']);
            }
            if($param['photo']!=''){
                $llls=getImage('http://'.$domin.$kl['photo'],ROOT_PATH . 'public' . DS . 'upload/images/');
                $kl['photo']='/upload/images/'.$llls['file_name'];
            }
            //网站数据
            $datas[]=array(
                'title'=>$kl['title'],
                'photo'=>$kl['photo'],
                'content'=>$kl['content'],
                'cate_id'=>$param['cate_id'],
                'sortnum'=>$lk,
                'status'=>1,
                'create_time'=>time()
            );
        }



dump($datas);
exit;

        //插入数据
        $result=Db::name('article')->strict(false)->insertAll($datas);
        if($result){
            return json(['code'=>1,'num'=>$result]);
        }else{
            return json(['code'=>-1]);
        }
    }
}