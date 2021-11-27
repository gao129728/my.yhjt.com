<?php

namespace app\admin\controller;
use app\admin\model\ArticleModel;
use app\admin\model\ArticleCateModel;
use app\admin\model\ArticleImageModel;
use think\Db;

class Article extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $action = strtolower(request()->action());
        $auth_action =array('index', 'index_cate');
        if(in_array($action,$auth_action)){
            $this->CheckAuth();
        }
    }

    /**
     * [index 文章列表]
     *
     */
    public function index(){

        $key = input('key');
        $cate_id = (int)input('cate_id');
        $map = [];
        if($key&&$key!==""){
            $map['a.title'] = ['like',"%" . $key . "%"];
        }
        if($cate_id > 0){
            $map['a.cate_id'] = $cate_id;
        }
        if(session('groupid')>1){
            $map['a.admin_id'] = session('uid');
        }
        $map['a.status'] = ['>=', 0];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 获取总条数
        $article = new ArticleModel();
        $count = $article->getArticleCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $article->getArticleByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['create_time'] = date('Y-m-d', $v['create_time']);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); //总条数
        $this->assign('val', $key);
        $this->assign('cate_id', $cate_id);
        if(input('get.page')){

            return json($lists);
        }
        $tree = new \org\Leftnav;
        $cateModel = new ArticleCateModel();
        $cate = $cateModel->getAllCate();
        $arr = $tree::get_cate_tree($cate);
        $this->assign('cate',$arr);
        return $this->fetch();
    }


    /**
     * [add_article 添加文章]
     */
    public function add_article()
    {
        $fields=DB::name('add_field')->select();
        $this->assign('fields', $fields);
        if(request()->isAjax()){
            $param = input('post.');
            $upload = new Upload();
            $file  = request()->file('photo');
            if($file){

                $param['photo'] = $upload->uploadImage($file);
            }

            $file1  = request()->file('bigpic');
            if($file1){

                $param['bigpic'] = $upload->uploadImage($file1);
            }

            $file2  = request()->file('annex');
            if($file2){

                $param['annex'] = $upload->uploadAnnex($file2);
            }

            $file3  = request()->file('wap_photo');
            if($file3){

                $param['wap_photo'] = $upload->uploadImage($file3);
            }

            $cnt=DB::name("article_cate")->where(['id'=>$param['cate_id']])->value('classification_ids');
     
            if($cnt){
       
                $param['attribute_ids']=arr2str($param['attribute_id']);
            }else{
                $param['attribute_ids']='';
            }
 		    $param['ip'] = get_client_ip();
            $param['admin_id'] =session('uid');
            $param['create_time'] = strtotime($param['create_time']);
            $article = new ArticleModel();
            $flag = $article->insertArticle($param);
            if($flag['code']>0){
                $ids=$flag['data'];
                if(isset($param['img_src']) && count($param['img_src']) > 0){
                    $i = 1;
                    foreach($param['img_src'] as $k => $arr){
                        $data[$k]['article_id'] = $ids;
                        $data[$k]['pic'] = $arr;
                        $data[$k]['sortnum'] = $i;
                        $data[$k]['title'] = $param['img_name'][$k];
                        //$data[$k]['title'] = '图片';
                        $data[$k]['url'] = $param['img_url'][$k];
                        if(isset($param['img_id'][$k]) && $param['img_id'][$k] > 0){
                            $data[$k]['id'] = $param['img_id'][$k];
                            $article->updateImage($data[$k]);
                        }else{
                            $article->insertImage($data[$k]);
                        }
                        $i+=1;
                    }
                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $cate_id = input('param.cate_id');
        $tree = new \org\Leftnav;
        $cateModel = new ArticleCateModel();
        $cateList = $cateModel->getAllCate();
        $arr = $tree::get_cate_tree($cateList);
        $map['status'] = ['>=', 0];
        if($cate_id){
            $map['cate_id'] = $cate_id;
        }
        $sortnum = Db::name('article')->where($map)->max('sortnum') + 10;
        $backUrl = url('index',['cate_id'=>$cate_id,'key'=>input('param.key')]);


        $fields_value=$cateModel->getOneCate($cate_id);
        $this->assign('fields_value',$fields_value['fields']);
        $this->assign('cate_info',$fields_value);
        /*********配置start**********/
        $list=Db::name('cate_config')->select();
        $configs = [];
        foreach ($list as $k => $v) {
            $configs[trim($v['name'])] = $v['value'];
        }
        $this->assign('cate_config',$configs);

        if($fields_value['classification_ids']){
            $classifications_list=DB::name("classification")->where(['id'=>['in',$fields_value['classification_ids']]])->order('sortnum asc')->select();
            foreach ($classifications_list as $key => &$value) {
                $value['list']=Db::name('attribute')->where(['class_id'=>$value['id'],'status'=>1])->order("sortnum asc,id asc")->select();
            }
            
        }else{
            $classifications_list='';
        }
        $this->assign('classifications_list',$classifications_list);

        /*********配置end**********/

        $this->assign('cateList',$arr);
        $this->assign('backUrl',$backUrl);
        $this->assign('sortnum', $sortnum);
        $this->assign('cate_id', $cate_id);
        $this->assign('create_time', date('Y-m-d H:i:s'));
        return $this->fetch();
    }


    /**
     * [edit_article 编辑文章]
     */
    public function edit_article()
    {
        $fields=DB::name('add_field')->select();
        $this->assign('fields', $fields);
        $articleModel = new ArticleModel();
        if(request()->isAjax()){
            $param = input('post.');
            $file  = request()->file('photo');
            if($file || (isset($param['delPhoto']) && $param['delPhoto'] == 1)){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
                $photo = Db::name('article')->where('id',$param['id'])->value('photo');
            }else{
                unset($param['photo']);
            }
            $file1  = request()->file('bigpic');
            if($file1 || (isset($param['delbigpic']) && $param['delbigpic'] == 1)){
                $upload = new Upload();
                $param['bigpic'] = $upload->uploadImage($file1);
                $bigpic = Db::name('article')->where('id',$param['id'])->value('bigpic');
            }else{
                unset($param['bigpic']);
            }

            $file2  = request()->file('annex');

            if($file2 || (isset($param['delannex']) && $param['delannex'] == 1)){
                $upload = new Upload();
                $param['annex'] = $upload->uploadAnnex($file2);
                $annex = Db::name('article')->where('id',$param['id'])->value('annex');
            }else{
                unset($param['annex']);
            }

            $file3  = request()->file('wap_photo');
            if($file3 || (isset($param['delwap_photo']) && $param['delwap_photo'] == 1)){
                $upload = new Upload();
                $param['wap_photo'] = $upload->uploadImage($file3);
                $wap_photo = Db::name('article')->where('id',$param['id'])->value('wap_photo');
            }else{
                unset($param['wap_photo']);
            }

            $cnt=DB::name("article_cate")->where(['id'=>$param['cate_id']])->value('classification_ids');
            if($cnt){
       
                $param['attribute_ids']=arr2str($param['attribute_id']);
            }else{
                $param['attribute_ids']='';
            }

            $param['admin_id'] =session('uid');
            $param['create_time'] = strtotime($param['create_time']);
            $flag = $articleModel->updateArticle($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
                if(!empty($wap_photo)) deleteFile($wap_photo, config('upload_img.path'));
                if(!empty($bigpic)) deleteFile($bigpic, config('upload_img.path'));
                if(!empty($annex)) deleteFile($annex, config('upload_img.path'));
                if(isset($param['img_src']) && count($param['img_src']) > 0){
                    $i = 1;
                    foreach($param['img_src'] as $k => $arr){

                        $data[$k]['article_id'] = $param['id'];
                        $data[$k]['pic'] = $arr;
                        $data[$k]['sortnum'] = $i;
                        $data[$k]['title'] = $param['img_name'][$k];
                        //$data[$k]['title'] = '图片';
                        $data[$k]['url'] = $param['img_url'][$k];
                        if(isset($param['img_id'][$k]) && $param['img_id'][$k] > 0){
                            $data[$k]['id'] = $param['img_id'][$k];
                            $articleModel->updateImage($data[$k]);
                        }else{
                            $articleModel->insertImage($data[$k]);
                        }
                        $i+=1;
                    }
                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $tree = new \org\Leftnav;
        $cateModel = new ArticleCateModel();
        $cateList = $cateModel->getAllCate();
        $arr = $tree::get_cate_tree($cateList);
        $this->assign('cateList',$arr);
        $article = $articleModel->getOneArticle($id);
        $backUrl = url('index',['cate_id'=>input('param.cate_id'),'key'=>input('param.key'),'cur_page'=>input('param.cur_page')]);
        $this->assign('imageList',$articleModel->getAllImage(['article_id'=>$article['id']]));
        $this->assign('article',$article);
        $this->assign('backUrl',$backUrl);


        $fields_value=$cateModel->getOneCate($article['cate_id']);
        $this->assign('fields_value',$fields_value['fields']);
        $this->assign('cate_info',$fields_value);
        $list=Db::name('cate_config')->select();
        $configs = [];
        foreach ($list as $k => $v) {
            $configs[trim($v['name'])] = $v['value'];
        }
        $this->assign('cate_config',$configs);


        if($fields_value['classification_ids']){
            $classifications_list=DB::name("classification")->where(['id'=>['in',$fields_value['classification_ids']]])->order('sortnum asc')->select();
            foreach ($classifications_list as $key => &$value) {
                $value['list']=Db::name('attribute')->where(['class_id'=>$value['id'],'status'=>1])->order("sortnum asc,id asc")->select();
            }
            
        }else{
            $classifications_list='';
        }
        $this->assign('classifications_list',$classifications_list);



        return $this->fetch();
    }



    /**
     * [del_article 删除文章]
     */
    public function del_article()
    {
        $param['id'] = input('param.id');
        $param['status'] = -1;
        $cate = new ArticleModel();
        $flag = $cate->updateArticle($param);
        if($flag['code'] > 0){
            return json(['code' => 1, 'msg' => '删除成功']);
        }else{
            return json(['code' => 0, 'msg' => $flag['msg']]);
        }
    }
    public function all_delete()
    {
        if(request()->isAjax()){
            $ids = input('param.ids');
            $param['status'] = -1;
            $map['id'] = ['in', ''.$ids.''];
            $flag = Db::name('article')->where($map)->update($param);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '批量删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '批量删除失败']);
            }
        }
    }

    /**
     * [回收站]
     */
    public function article_recycle(){
        $key = input('key');
        $cate_id = (int)input('cate_id');
        $map['a.status'] = ['<', 0];
        if($key&&$key!==""){
            $map['title'] = ['like',"%" . $key . "%"];
        }
        if($cate_id > 0){
            $map['cate_id'] = $cate_id;
        }

        $Nowpage = input('get.page') ? input('get.page'):1;
        $cur_page = input('param.cur_page') ? input('param.cur_page'):1;
        $limits = config('list_rows');// 获取总条数
        $article = new ArticleModel();
        $count = $article->getArticleCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));
        $lists = $article->getArticleByWhere($map, $Nowpage, $limits);
        foreach($lists as $k => $v){
            $v['create_time'] = date('Y-m-d', $v['create_time']);
            $v['page'] = $Nowpage;
            $lists[$k] = $v;
        }
        if($cur_page > $allpage) $cur_page = $allpage;
        $this->assign('cur_page', $cur_page); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('val', $key);
        $this->assign('cate_id', $cate_id);

        $tree = new \org\Leftnav;
        $cateModel = new ArticleCateModel();
        $cate = $cateModel->getAllCate();
        $arr = $tree::get_cate_tree($cate);
        $this->assign('cate',$arr);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * [回收站删除]
     */
    public function del_recycle()
    {
        if(request()->isAjax()){
            $param = input('param.');
            $articleModel = new ArticleModel();

            $map['status'] = -1;
            if(!empty($param['id'])){
                $map['id'] = $map_img['articleId'] = $param['id'];
            }else if(!empty($param['ids'])){
                $map['id'] = $map_img['articleId'] = ['in', ''.$param['ids'].''];
            }else{
                $article_id_arr = Db::name('article')->where($map)->column('id');
                $article_id_str = implode(',', $article_id_arr);
                $map_img['articleId'] = ['in', ''.$article_id_str.''];
            }

            $photo_arr = Db::name('article')->where($map)->column('photo');
            $bigpic_arr = Db::name('article')->where($map)->column('bigpic');
            $annex_arr = Db::name('article')->where($map)->column('annex');

            $flag = $articleModel->delArticle($map);
            if($flag['code'] > 0){
                if(count($photo_arr) > 0){
                    deleteFiles($photo_arr, config('upload_img.path'));
                }
                if(count($bigpic_arr) > 0){
                    deleteFiles($bigpic_arr, config('upload_img.path'));
                }
                if(count($annex_arr) > 0){
                    deleteFiles($annex_arr, config('upload_img.path'));
                }
                if(!empty($param['id'])){
                    $id = $param['id'];
                    $piclist=$articleModel->getAllImage(['article_id'=>$id]);
                    if($piclist){
                        foreach ($piclist as $v){
                            deleteFile($v['pic'], config('upload_img.path'));
                        }
                        $articleModel->delImage(['article_id'=>$id]);
                    }

                }else if(!empty($param['ids'])){
                    $ids = explode(',',$param['ids']);
                    foreach ($ids as $vs){
                        $piclist=$articleModel->getAllImage(['article_id'=>$vs]);
                        if($piclist){
                            foreach ($piclist as $v){
                                deleteFile($v['pic'], config('upload_img.path'));
                            }
                            $articleModel->delImage(['article_id'=>$vs]);
                        }

                    }
                }else{
                    $article_id_arr = Db::name('article')->where($map)->column('id');
                    $article_id_str = implode(',', $article_id_arr);
                    $atid = explode(',',$article_id_str);
                    foreach ($atid as $vs){
                        $piclist=$articleModel->getAllImage(['article_id'=>$vs]);
                        if($piclist){
                            foreach ($piclist as $v){
                                deleteFile($v['pic'], config('upload_img.path'));
                            }
                            $articleModel->delImage(['article_id'=>$vs]);
                        }

                    }

                }
                return json(['code' => 1, 'msg' => '删除成功']);
            }else{
                return json(['code' => 0, 'msg' => $flag['msg']]);
            }
        }
    }

    /**
     * [回收站恢复]
     */
    public function regain_recycle()
    {
        if(request()->isAjax()){
            $param = input('param.');
            $map['status'] = -1;
            if(!empty($param['id'])){
                $map['id'] = $param['id'];
            }else if(!empty($param['ids'])){
                $map['id'] = ['in', ''.$param['ids'].''];
            }
            $flag = Db::name('article')->where($map)->update(['status'=>1]);
            if($flag > 0){
                return json(['code' => 1, 'msg' => '恢复成功']);
            }else{
                return json(['code' => 0, 'msg' => '恢复失败']);
            }
        }
    }



    //*********************************************分类管理*********************************************//

    /**
     * [index_cate 分类列表]
     * @return [type] [description]
     *
     */
    public function index_cate(){
        $cateModel = new ArticleCateModel();
        $list = $cateModel->getAllCate();
        $allRoutes   = [];
        $mobileRoutes   = [];
        $wap_site_state = Db::name('config')->where('name','wap_site_state')->value('value');
        $wap_site_domain = Db::name('config')->where('name','wap_site_domain')->value('value');
        $mobile_pre = empty($wap_site_domain)? 'mobile/': '';
        foreach($list as $key=>$val){
            $cnt = $cateModel->getCateCount(['parent_id'=>$val['id']]);
            //$val['cateStyle_name'] =config('cate_style')[$val['cateStyle']]['style'];
            $val['hasChild'] = $cnt > 0? 1 : 0;
            $list[$key] = $val;
            if(!empty(htmlspecialchars(trim($val['catedir'])))){
                $allRoutes[$val['catedir'].'$'] = ['home/category/index?id='.$val['id'], [],['id'=>'\d+']];
                $allRoutes[$val['catedir'].'/:id$'] = ['home/category/detail', [],['id'=>'\d+']];
                if($wap_site_state == 1){
                    $mobileRoutes[$mobile_pre.$val['catedir'].'$'] = ['mobile/category/index?id='.$val['id'], [],['id'=>'\d+']];
                    $mobileRoutes[$mobile_pre.$val['catedir'].'/:id$'] = ['mobile/category/detail', [],['id'=>'\d+']];
                }
            }
        }

        /*获取栏目目录 写入路由规则*/
        if (!empty($allRoutes) && is_array($allRoutes)) {
            $route_dir = ROOT_PATH . "data/route/";
            if (!file_exists($route_dir)) {
                mkdir($route_dir);
            }

            $route_file = $route_dir . "home.php";
            file_put_contents($route_file, "<?php\treturn " . stripslashes(var_export($allRoutes, true)) . ";");
            if($wap_site_state == 1){
                $mobile_route_file = $route_dir . "mobile.php";
                file_put_contents($mobile_route_file, "<?php\treturn " . stripslashes(var_export($mobileRoutes, true)) . ";");
            }
        }

        $zlist=Db::name('cate_config')->select();
        $configs = [];
        foreach ($zlist as $k => $v) {
            $configs[trim($v['name'])] = $v['value'];
        }
        $this->assign('cate_config',$configs);

        $tree = new \org\Leftnav;
        $arr = $tree::get_cate_tree($list,'','4');
        $this->assign('cate_tree',$arr);
        return $this->fetch();
    }


    /**
     * [add_cate 添加分类]
     * @return [type] [description]
     *
     */
    public function add_cate()
    {
        $fields=DB::name('add_field')->select();
        $this->assign('fields', $fields);
        $cate = new ArticleCateModel();
        if(request()->isAjax()){
            $param = input('post.');
            $param['admin_id'] =session('uid');
            $file = request()->file('photo');
            if ($file) {
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
            }
            $file1 = request()->file('pic');
            if ($file1) {
                $upload = new Upload();
                $param['pic'] = $upload->uploadImage($file1);
            }
            $file3  = request()->file('wap_photo');
            if($file3){

                $param['wap_photo'] = $upload->uploadImage($file3);
            }
            if($param['fields']){
                $param['fields']=implode(',',$param['fields']);
            }else{
                $param['fields']='';
            }

            if($param['classification_id']){
                $param['classification_ids']=implode(',',$param['classification_id']);
            }else{
                $param['classification_ids']='';
            }
            $flag = $cate->insertCate($param);
            if($flag['code']>0){
                if(isset($param['img_src']) && count($param['img_src']) > 0){
                    $i = 1;
                    $ids=$flag['data'];
                    foreach($param['img_src'] as $k => $arr){
                        $data[$k]['article_id'] = $ids;
                        $data[$k]['pic'] = $arr;
                        $data[$k]['sortnum'] = $i;
                        $data[$k]['title'] = $param['img_name'][$k];
                        //$data[$k]['title'] = '图片';
                        $data[$k]['url'] = $param['img_url'][$k];
                        if(isset($param['img_id'][$k]) && $param['img_id'][$k] > 0){
                            $data[$k]['id'] = $param['img_id'][$k];
                            $cate->updateImage($data[$k]);
                        }else{
                            $cate->insertImage($data[$k]);
                        }
                        $i+=1;
                    }
                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        if ($id > 0) {
            $map['parent_id'] = $id;
        } else {
            $map['parent_id'] = 0;
        }



        $list=Db::name('cate_config')->select();
        $configs = [];
        foreach ($list as $k => $v) {
            $configs[trim($v['name'])] = $v['value'];
        }
        $this->assign('cate_config',$configs);

        $orderby = Db::name('article_cate')->where($map)->max('orderby') + 10;
        $tree = new \org\Leftnav;
        $cate = $cate->getAllCate();
        $arr = $tree::get_cate_tree($cate);
        $this->assign('cate_tree', $arr);
        $this->assign('cate_id', $id);
        $this->assign('orderby', $orderby);


        $classifications=DB::name("classification")->where(['status'=>1])->order('sortnum asc,id asc')->select();
        $this->assign('classifications', $classifications);

        return $this->fetch();
    }


    /**
     * [edit_cate 编辑分类]
     * @return [type] [description]
     *
     */
    public function edit_cate()
    {
        $fields=DB::name('add_field')->select();
        $this->assign('fields', $fields);
        $cateModel = new ArticleCateModel();
        $tree = new \org\Leftnav;
        $cate = $cateModel->getAllCate();
        if(request()->isAjax()){
            $param = input('post.');
            $param['admin_id'] =session('uid');
            if($param['parent_id'] == $param['id']){
                return json(['code' => 0, 'data' =>'', 'msg' => '所属父级不能为当前分类']);
            }
            $child_arr = $tree::get_cate_id($cate, $param['id']);
            if(in_array($param['parent_id'], $child_arr)){
                return json(['code' => 0, 'data' => '', 'msg' => '所属父级不能为当前分类的下级']);
            }

            $file  = request()->file('photo');
            if($file || (isset($param['delPhoto']) && $param['delPhoto'] == 1)){
                $upload = new Upload();
                $param['photo'] = $upload->uploadImage($file);
                $photo = Db::name('article_cate')->where('id',$param['id'])->value('photo');
            }else{
                unset($param['photo']);
            }

            $file1  = request()->file('pic');
            if($file1 || (isset($param['delpic']) && $param['delpic'] == 1)){
                $upload = new Upload();
                $param['pic'] = $upload->uploadImage($file1);
                $pic = Db::name('article_cate')->where('id',$param['id'])->value('pic');
            }else{
                unset($param['pic']);
            }

            $file3  = request()->file('wap_photo');
            if($file3 || (isset($param['delwap_photo']) && $param['delwap_photo'] == 1)){
                $upload = new Upload();
                $param['wap_photo'] = $upload->uploadImage($file3);
                $wap_photo = Db::name('article_cate')->where('id',$param['id'])->value('wap_photo');
            }else{
                unset($param['wap_photo']);
            }

            if($param['fields']){
                $param['fields']=implode(',',$param['fields']);
            }else{
                $param['fields']='';
            }
            if($param['classification_id']){
                $param['classification_ids']=implode(',',$param['classification_id']);
            }else{
                $param['classification_ids']='';
            }
            $param['is_bigpic']=!empty($param['is_bigpic'])?1:0;
            $param['is_annex']=!empty($param['is_annex'])?1:0;
            $param['is_piclist']=!empty($param['is_piclist'])?1:0;
            $param['is_intro']=!empty($param['is_intro'])?1:0;
            $flag = $cateModel->editCate($param);
            if($flag['code'] > 0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
                if(!empty($pic)) deleteFile($pic, config('upload_img.path'));
                if(!empty($wap_photo)) deleteFile($wap_photo, config('upload_img.path'));
                if(isset($param['img_src']) && count($param['img_src']) > 0){

                    $i = 1;
                    foreach($param['img_src'] as $k => $arr){

                        $data[$k]['article_id'] = $param['id'];
                        $data[$k]['pic'] = $arr;
                        $data[$k]['sortnum'] = $i;
                        $data[$k]['title'] = $param['img_name'][$k];
                        //$data[$k]['title'] = '图片';
                        $data[$k]['url'] = $param['img_url'][$k];
                        if(isset($param['img_id'][$k]) && $param['img_id'][$k] > 0){
                            $data[$k]['id'] = $param['img_id'][$k];
                            $cateModel->updateImage($data[$k]);
                        }else{
                            $cateModel->insertImage($data[$k]);
                        }
                        $i+=1;
                    }
                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $list=Db::name('cate_config')->select();
        $configs = [];
        foreach ($list as $k => $v) {
            $configs[trim($v['name'])] = $v['value'];
        }
        $this->assign('cate_config',$configs);
        $id = input('param.id');
        $arr = $tree::get_cate_tree($cate);
        $cate_info = $cateModel->getOneCate($id);
        $this->assign('imageList',$cateModel->getAllImage(['article_id'=>$cate_info['id']]));
        $this->assign('cate',$cate_info);
        $this->assign('cate_tree',$arr);

        $classifications=DB::name("classification")->where(['status'=>1])->order('sortnum asc,id asc')->select();
        $this->assign('classifications', $classifications);

        return $this->fetch();
    }


    /**
     * [del_cate 删除分类]
     * @return [type] [description]
     *
     */
    public function del_cate()
    {
        $id = input('param.id');
        $cate = new ArticleCateModel();

        $c_count = $cate->getCateCount(['parent_id'=>$id]);
        $a_count = Db::name('article')->where('cate_id',$id)->count(); //判断分类下是否有文章
        if($c_count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '分类下有子类，请先删除子类！']);
        }else if($a_count > 0){
            return json(['code' => 0, 'data' => "", 'msg' => '分类下有文章，请先删除分类下的文章！']);
        }else{
            $photo = Db::name('article_cate')->where('id',$id)->value('photo');
            $pic = Db::name('article_cate')->where('id',$id)->value('pic');
            $flag = $cate->delCate($id);
            if($flag['code']>0){
                if(!empty($photo)) deleteFile($photo, config('upload_img.path'));
                if(!empty($pic)) deleteFile($pic, config('upload_img.path'));
                if(!empty($param['id'])){
                    $id = $param['id'];
                    $piclist=$cate->getAllImage(['article_id'=>$id]);
                    if($piclist){
                        foreach ($piclist as $v){
                            deleteFile($v['pic'], config('upload_img.path'));
                        }
                        $cate->delImage(['article_id'=>$id]);
                    }

                }
            }
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

    }


    public function del_banner_img()
    {
        $img_id = input('param.img_id');
        $img_src = input('param.img_src');
        if($img_id) {
            $bannerModel = new ArticleModel();
            if ($bannerModel->delImage(['id'=>$img_id])) {
                deleteFile($img_src, config('upload_img.path'));
                return json(['code' => 1, 'msg' => '删除成功']);
            } else {
                return json(['code' => 0, 'msg' => '删除失败']);
            }
        }else{
            deleteFile($img_src, config('upload_img.path'));
            return json(['code' => 1, 'msg' => '删除成功']);
        }
    }
    public function del_banner_imgs()
    {
        $img_id = input('param.img_id');
        $img_src = input('param.img_src');
        if($img_id) {
            $bannerModel = new ArticleCateModel();
            if ($bannerModel->delImage(['id'=>$img_id])) {
                deleteFile($img_src, config('upload_img.path'));
                return json(['code' => 1, 'msg' => '删除成功']);
            } else {
                return json(['code' => 0, 'msg' => '删除失败']);
            }
        }else{
            deleteFile($img_src, config('upload_img.path'));
            return json(['code' => 1, 'msg' => '删除成功']);
        }
    }
    public function uploadannex(){

        $id=input('id');
        $oldannex=Db::name('article')->where('id',$id)->value('annex');

        $articleModel=new ArticleModel();
        $param['id']=$id;
        $param['annex']=input('annex');
        $flag = $articleModel->updateArticle($param);
        if($flag['code'] > 0){
            if($oldannex){
                deleteFile($oldannex, config('upload_file_path'));
            }
        }
    }

    public function upload(){
        $id=input('id');
        $page=input('page');
        $cate_id=input('cate_id');
        $this->assign('id',$id);
        $this->assign('cate_id',$cate_id);
        $this->assign('page',$page);
        return $this->fetch();
    }


    public function upload_file()
    {
        $param = input('param.');
        $this->assign('info', $param);
        return $this->fetch();
    }

    /**
     * 删除上传视频
     */
    public function del_upload_file()
    {
        $param = input('param.');
        if($param['id']){
            $data['id'] = $param['id'];
            $data[$param['field']] = '';
            $model = new ArticleModel();
            $flag = $model->updateArticle($data);
            if($flag){
                deleteFile($param['file_path'], config('upload_file_path'));
                return json(['code' => 1, 'msg' => '删除成功']);
            }else{
                return json(['code' => 0, 'msg' => '删除失败']);
            }
        }else{
            deleteFile($param['file_path'], config('upload_file_path'));
            return json(['code' => 1, 'msg' => '删除成功']);
        }
    }

    /**
     * 取消上传视频
     */
    public function cancel_upload_file()
    {
        //删除分片文件
        $tmp_dir = config('upload_file_path').'upload_tmp';
        del_dir($tmp_dir, false);
        return;
    }


}