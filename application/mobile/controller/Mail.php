<?php

namespace app\mobile\controller;


use PHPMailer\PHPMailer\PHPMailer;
use app\mobile\model\MemberModel;

class Mail extends Base
{

//发送邮箱验证码
    public function email()
    {
        $email=input('email');
        $model=new MemberModel();
        $toemail = $email;//定义收件人的邮箱

        $mail = new PHPMailer();
        $info=$model->getCount(['email'=>$email]);

        if($info<=0){
            return json(['code'=>-1,'msg'=>'The email does not exist']);
        }
        $info=$model->getOneMember(['a.email'=>$email]);
        $pass=rand(100000,999999);

        $mail->isSMTP();// 使用SMTP服务
        $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host = "smtp.exmail.qq.com";// 发送方的SMTP服务器地址
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Username = "cc@hfcfwl.com";// 发送方的QQ邮箱用户名，就是自己的邮箱名
        $mail->Password = "Che576733974";// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
        //$mail->SMTPSecure = "ssl";// 使用ssl协议方式,
        $mail->Port = 25;// QQ邮箱的ssl协议方式端口号是465/587

        $mail->setFrom("cc@hfcfwl.com","宇寰");// 设置发件人信息，如邮件格式说明中的发件人,
        $mail->addAddress($toemail,'会员用户');// 设置收件人信息，如邮件格式说明中的收件人
       // $mail->addReplyTo("xxxxx@qq.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
//$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
//$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
//$mail->addAttachment("bug0.jpg");// 添加附件

        $encrypt_email=think_encrypt($toemail);
        $encrypt_pass=think_encrypt($pass);

        $mail->Subject = "找回密码";// 邮件标题
        $mail->Body = "尊敬的宇寰会员,您的密码已经修改为：".$pass.",请点击下方链接确认密码http://yhjt.cfsite4.ahcfkj.com/mobile/member/getMessage?email=".$encrypt_email."&pass=".$encrypt_pass.",若不是本人操作，请忽略！";// 邮件正文
//$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

        if(!$mail->send()){// 发送邮件

            return json(['code'=>-1,'msg'=>$mail->ErrorInfo]);
        }else{

            $map['password']=md5(md5($pass) . config('auth_key'));
            $map['id']=$info['id'];
            $model->editMember($map);

            return json(['code'=>1,'msg'=>'Send successfully']);

        }
    }
}
