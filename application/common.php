<?php
use think\Db;
use taobao\AliSms;
use phpmailer\phpmailer;


/**
 * 清空/删除 文件夹
 * @param string $dirname 文件夹路径
 * @param bool $self 是否删除当前文件夹
 * @return bool
 */
function del_dir($dirname, $self = true) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    if ($dir) {
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            del_dir($dirname . '/' . $entry);
        }
    }
    $dir->close();
    $self && rmdir($dirname);
}


function sendEmail($Host,$Password,$Subject,$From,$FromName,$data = []) {

   

  Vendor('phpmailer.phpmailer');

  $mail = new PHPMailer(); //实例化

  $mail->IsSMTP(); // 启用SMTP

  $mail->Host = 'smtp.'.$Host.'.com'; //SMTP服务器 以126邮箱为例子

  $mail->Port = 465;  //邮件发送端口

  $mail->SMTPAuth = true;  //启用SMTP认证

  $mail->SMTPSecure = "ssl";   // 设置安全验证方式为ssl

  $mail->CharSet = "UTF-8"; //字符集

  $mail->Encoding = "base64"; //编码方式

  $mail->Username = $From;  //你的邮箱

  $mail->Password = $Password;  //你的密码

  $mail->Subject = $Subject; //邮件标题 

  $mail->From = $From;  //发件人地址（也就是你的邮箱）

  $mail->FromName = $FromName;  //发件人姓名

  if($data && is_array($data)){

    foreach ($data as $k=>$v){

      $mail->AddAddress($v['user_email'], "亲"); //添加收件人（地址，昵称）

      $mail->IsHTML(true); //支持html格式内容

      $mail->Body = $v['content']; //邮件主体内容

      //发送成功就删除

      if ($mail->Send()) {

       return true;

      }else{

          return "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息 

      }

    }

  }          

}

/**
 * 字符串截取，支持中文和其他编码
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		$slice = iconv_substr($str, $start, $length, $charset);
		if (false === $slice) {
			$slice = '';
		}
	} else {
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice . '...' : $slice;
}

function getFileExt($filename = "")
{
    $dot = strrpos($filename, ".");
    return substr($filename, $dot + 1);
}
function getTmpName()
{
    list($a, $b) = explode(" ", microtime());
    return (string)$b . (string)substr($a, 2);
}
/**
 * 读取配置
 * @return array 
 */
function load_config(){
    $list = Db::name('config')->select();
    $config = [];
    foreach ($list as $k => $v) {
        $config[trim($v['name'])]=$v['value'];
    }

    return $config;
}



/**
 * 发送短信(参数：签名,模板（数组）,模板ID，手机号)
 */
function sms($signname='',$param=[],$code='',$phone)
{
    $alisms = new AliSms();
    $result = $alisms->sign($signname)->data($param)->code($code)->send($phone);
    return $result['info'];
}


//获取装备类别名称
function getLeiBieName($id)
{
    if(empty($id)){
        return "";
    }
    $info = Db::name('zb_lb')->where('id='.$id)->field('name')->find();
    if($info){
       return $info['name'] ;
    }else{
        return "";
    }
}

//获取装备品牌名称
function getPinPeiName($id)
{
    if(empty($id)){
        return "";
    }
    $info = Db::name('zb_pp')->where('id='.$id)->field('name')->find();
    if($info){
       return $info['name'] ;
    }else{
        return "";
    }
}


//生成网址的二维码 返回图片地址
function Qrcode($token, $url, $size = 8){ 

    $md5 = md5($token);
    $dir = date('Ymd'). '/' . substr($md5, 0, 10) . '/';
    $patch = 'qrcode/' . $dir;
    if (!file_exists($patch)){
        mkdir($patch, 0755, true);
    }
    $file = 'qrcode/' . $dir . $md5 . '.png';
    $fileName =  $file;
    if (!file_exists($fileName)) {

        $level = 'L';
        $data = $url;
        QRcode::png($data, $fileName, $level, $size, 2, true);
    }
    return $file;
}



/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name) {
    $result = false;
    if(is_dir($dir_name)){
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}



//时间格式化1
function formatTime($time) {
    $now_time = time();
    $t = $now_time - $time;
    $mon = (int) ($t / (86400 * 30));
    if ($mon >= 1) {
        return '一个月前';
    }
    $day = (int) ($t / 86400);
    if ($day >= 1) {
        return $day . '天前';
    }
    $h = (int) ($t / 3600);
    if ($h >= 1) {
        return $h . '小时前';
    }
    $min = (int) ($t / 60);
    if ($min >= 1) {
        return $min . '分钟前';
    }
    return '刚刚';
}

//时间格式化2
function pincheTime($time) {
     $today  =  strtotime(date('Y-m-d')); //今天零点
      $here   =  (int)(($time - $today)/86400) ; 
      if($here==1){
          return '明天';  
      }
      if($here==2) {
          return '后天';  
      }
      if($here>=3 && $here<7){
          return $here.'天后';  
      }
      if($here>=7 && $here<30){
          return '一周后';  
      }
      if($here>=30 && $here<365){
          return '一个月后';  
      }
      if($here>=365){
          $r = (int)($here/365).'年后'; 
          return   $r;
      }
     return '今天';
}

//判断指定日期是周几
function getWeek($date){
    $week = date("w",strtotime($date));
    $weekArr = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
    return $weekArr[$week];
}

//获取最近一周的日期
function getDateList(){
    $dateArr = array();
    for($i=0;$i<=6;$i++){
        if($i==0){
            $date = date("Y-m-d");
            $date_name = date("m月d日");
            $week = '今天';
        }else{
            $date      = date("Y-m-d", strtotime("+".$i." day"));
            $date_name = date("m月d日", strtotime($date));
            $week = getWeek($date);
        }
        $dateArr[$i]['date'] = $date;
        $dateArr[$i]['week'] = $week;
        $dateArr[$i]['date_name'] = $date_name;
    }

    return $dateArr;
}

/*
 *	功能：删除单个文件
 *	$path 文件路径, 可为相对路径或绝对路径
*/
function deleteFile($file, $path)
{
    if (empty($file))
    {
        return;
    }

    $file = $path . $file;

    if (file_exists($file))
    {
        @unlink($file);
    }
}

/*
 *	功能：删除多个文件
 *	$path 文件路径, 可为相对路径或绝对路径
 *	多个文件间以逗号“,”隔开
*/
function deleteFiles($file, $path)
{
    if (empty($file))
    {
        return;
    }

    if (is_string($file))
    {
        $file = explode(",", $file);
    }

    if (is_array($file))
    {
        foreach($file as $value)
        {
            if ($value != "" && file_exists($path . $value))
            {
                @unlink($path . $value);
            }
        }
    }
}

/*
 *	创建文件夹
*/
function mkFolder($path) {
    if(!is_readable($path)) {
        is_file($path) or mkdir($path,0777,true);
    }
}

//生成唯一订单号
function build_order_no()
{
    return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

function random($length = 6, $numeric = 0)
{
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if ($numeric) {
        $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = '0123456789';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

/**
 * 字符串截取，截取标题
 */
function leftstr($str, $len=0, $from = 0, $ellipsis = '…')
{
    if($len<1){
        return $str;
    }else{
        $string = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
            '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str);
        if(count($string) > $len){
            $string .= $ellipsis;
        }
        return $string;
    }
}

/**
 * 内容截取，去除html标签
 */
function leftstr_html($string, $length = 0, $ellipsis = '…')
{
    $string = strip_tags($string);
    $string = preg_replace('/\n/is', '', $string);
    $string = preg_replace('/ |　/is', '', $string);
    $string = preg_replace('/&nbsp;/is', '', $string);
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $string);
    if (is_array($string) && !empty($string[0])) {
        if (is_numeric($length) && $length) {
            if(count($string[0]) <= $length){
                $string = join('', array_slice($string[0], 0));
            }
            else
            {
                $string = join('', array_slice($string[0], 0, $length)).$ellipsis;
            }
        } else {
            $string = implode('', $string[0]);
        }
    } else {
        $string = '';
    }
    return $string;
}


function injectChk($sql_str) { //防止注入
    $aa="/select|insert|update|CR|document|LF|eval|delete|script|alert|union|into|load_file|outfile/";
    if($sql_str && is_array($sql_str)){
        foreach($sql_str as $key=>$val){
            if($val){
                if (preg_match( $aa, $sql_str[$key])){
                    $result = array(
                        'code' => -1,
                        'msg' => $val.'非法字符串'
                    );
                    echo json_encode($result);
                    exit ();
                }
            }
        }
        return $sql_str;
    }else{
        if (preg_match( $aa, $sql_str)) {

            $result = array(
                'code' => -1,
                'msg' => '非法字符串'
            );
            echo json_encode($result);

            exit ();
        } else {
            return $sql_str;
        }
    }

}

function injectChks($sql_str) { //防止注入
    $aa="/select|insert|update|CR|document|LF|eval|delete|script|alert|union|into|load_file|outfile/";
    if($sql_str && is_array($sql_str)){
        foreach($sql_str as $key=>$val){
            if($val){
                if (preg_match( $aa, $sql_str[$key])){
                    return 0;
                }
            }
        }
        return 1;
    }else{
        if (preg_match( $aa, $sql_str)) {

            return 0;
        } else {
            return 1;
        }
    }

}


/**
 * 获取客户端IP地址
 * @return string
 */
function get_client_ip() {
    if(getenv('HTTP_CLIENT_IP')){
        $client_ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
        $client_ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR')) {
        $client_ip = getenv('REMOTE_ADDR');
    } else {
        $client_ip = $_SERVER['REMOTE_ADDR'];
    }
    return $client_ip;
}
/**
 * 获取服务器端IP地址
 * @return string
 */
function get_server_ip() {
    if (isset($_SERVER)) {
        if($_SERVER['SERVER_ADDR']) {
            $server_ip = $_SERVER['SERVER_ADDR'];
        } else {
            $server_ip = $_SERVER['LOCAL_ADDR'];
        }
    } else {
        $server_ip = getenv('SERVER_ADDR');
    }
    return $server_ip;
}
