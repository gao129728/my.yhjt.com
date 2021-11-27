<?php

namespace org;

class ImageAction
{
    /*
     * author: meizhenyu
     * date  : 2018-03
     * 根据大图片，自动压缩、裁剪生成小图片，仅支持jpg、gif、png
     * $image 原图片文件, $small_image 新生成的图片文件
     * $small_width、$small_height 新生成文件宽高
     * $style 生成新图片样式, 0:原图片大小、1:固定宽和高、2:固定宽度、3:固定高度、4:左上裁剪、5:居中裁剪
     * 若没有加载GD库，返回原图片
    */
    public function makeSmallImage($image, $small_image, $small_width = 100, $small_height = 100, $style)
    {
        if (!extension_loaded('gd'))
        {
            copy($image, $small_image);
            return false;
        }

        $size   = getImageSize($image);
        $width  = $size[0];
        $height = $size[1];
        $type   = $size[2];

        if ($type != 1 && $type != 2 && $type != 3)
        {
            copy($image, $small_image);
            return false;
        }

        $width_ratio = $small_width / $width;
        $height_ratio = $small_height / $height;

        if ($style == 0)    //原图片大小
        {
            $new_width  = $width;
            $new_height = $height;
        }
        else if ($style == 1)  //固定宽和高
        {
            //如果原图片的大小 小于 指定的小图片，直接拷贝并返回
            if ($width_ratio >= 1 && $height_ratio >= 1)
            {
                copy($image, $small_image);
                return false;
            }
            $new_width  = $small_width;
            $new_height = $small_height;

        }
        else if ($style == 2)  //固定宽度
        {
            if($width_ratio >= 1)
            {
                copy($image, $small_image);
                return false;
            }
            $new_width  = $small_width;
            $ratio      = $width / $height; // 宽高比
            $new_height = $new_width / $ratio;

        }
        else if($style == 3) //固定高度
        {
            if($height_ratio >= 1)
            {
                copy($image, $small_image);
                return false;
            }
            $new_height = $small_height;
            $ratio      = $width / $height; // 宽高比
            $new_width  = $new_height * $ratio;
        }
        else
        {
            $src_left_x    = 0;  //左上裁剪坐标
            $src_left_y    = 0;

            $src_center_x  = 0;  //居中裁剪坐标，初始坐标
            $src_center_y  = 0;

            //如果原图片的大小 小于 指定的小图片，直接拷贝并返回
            if ($width_ratio >= 1 && $height_ratio >= 1)
            {
                copy($image, $small_image);
                return false;
            }
            else if($width_ratio >= 1)
            {
                $new_width  = $width;
                $new_height = $small_height;

                $src_center_y    = ($height - $small_height)/2;
            }
            else if($height_ratio >= 1)
            {
                $new_width  = $small_width;
                $new_height = $height;

                $src_center_x    = ($width - $small_width)/2;
            }
            else
            {
                $new_width  = $small_width;
                $new_height = $small_height;

                $src_center_x    = ($width - $small_width)/2;
                $src_center_y    = ($height - $small_height)/2;
            }

            if($style == 4)
            {
                $src_x = $src_left_x;  //左上裁剪坐标
                $src_y = $src_left_y;
            }
            else
            {
                $src_x = $src_center_x;  //居中裁剪坐标
                $src_y = $src_center_y;
            }
        }

        switch($type)
        {
            case 1: //gif -> gif
                $im    = imageCreateFromGif($image);
                break;
            case 2: //jpg -> jpg
                $im    = imageCreateFromJpeg($image);
                break;
            case 3: //png -> png
                $im    = imageCreateFromPng($image);
                break;
            default:
                return false;
                break;
        }

        $newim = imageCreateTrueColor($new_width, $new_height);
        /* --- 用以处理缩放gif和png图透明背景变黑色问题 开始 --- */
        if($type==1 || $type==3){
            $alpha = imagecolorallocatealpha($newim, 0, 0, 0, 127);
            imagefill($newim, 0, 0, $alpha);
        }
        /* --- 用以处理缩放gif和png图透明背景变黑色问题 结束 --- */

        if ($style < 4)
        {
            imageCopyResampled($newim, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  //压缩图片
        }
        else
        {
            imagecopy($newim, $im, 0, 0, $src_x, $src_y, $new_width, $new_height); //裁剪图片
        }

        switch($type)
        {
            case 1:
                imageGif($newim, $small_image);
                break;
            case 2:
                imageJpeg($newim, $small_image);
                break;
            case 3:
                imagesavealpha($newim, true);
                imagePng($newim, $small_image);
                break;
            default:
                return false;
                break;
        }
        imageDestroy($newim);
        imageDestroy($im);
    }

    /*
     * author: meizhenyu
     * date  : 2015-12
     *
     * 添加文字水印，仅支持jpg、gif、png
     * $image 原图片文件
     * $wm_text 水印文字
     * $wm_fontsize 文字大小, $wm_fontfamily 文字字体, $wm_color 文字颜色, $wm_quality 生成图片质量
     * $position 水印添加位置, 1:顶部居左、2:顶部居右、3:居中、4:底部居左、5:底部居右
     * 若没有加载GD库，返回false
    */

    public function textWaterMark($image, $wm_text, $wm_fontsize, $wm_fontfamily, $wm_color, $wm_quality, $position = 5)
    {
        if (!extension_loaded('gd') || !file_exists($image)) //是否开启GD库，原图片是否存在
        {
            return false;
        }

        $srcImage = @getimagesize($image);

        $src_im   = $this->image_create_from_ext($image);

        //$box = imagettfbbox($wm_fontsize,0,$wm_fontfamily,$wm_text);
        $rect = imagettfbbox($wm_fontsize,0,$wm_fontfamily,$wm_text);
        $minX = min($rect[0],$rect[2],$rect[4],$rect[6]);
        $maxX = max($rect[0],$rect[2],$rect[4],$rect[6]);
        $minY = min($rect[1],$rect[3],$rect[5],$rect[7]);
        $maxY = max($rect[1],$rect[3],$rect[5],$rect[7]);

        $text_wd   = $maxX - $minX;  // 水印文字宽度
        $text_hg   = $maxY - $minY;  // 水印文字高度

        $text_left = abs($minX)+5;
        $text_top  = abs($minY)+5;

        switch ($position)
        {
            case 1:       //顶部居左
                $x = $text_left;
                $y = $text_top;
                break;
            case 2:       //顶部居右
                $x = $srcImage[0]-$text_wd-6;
                $y = $text_top;
                break;
            case 3:       //居中
                $x = ($srcImage[0]-$text_wd)/2;
                $y = ($srcImage[1] - $text_hg)/2 + $text_hg;
                break;
            case 4:       //底部居左
                $x = $text_left;
                $y = $srcImage[1]-5;
                break;
            case 5:       //底部居右
                $x = $srcImage[0]-$text_wd-6;
                $y = $srcImage[1]-5;
                break;
            default:
                $x = $text_left;
                $y = $text_top;
        }

        $R = hexdec(substr($wm_color,1,2));
        $G = hexdec(substr($wm_color,3,2));
        $B = hexdec(substr($wm_color,5));
        $imgcolor = imagecolorallocate($src_im, $R,$G,$B);

        imagefttext($src_im, $wm_fontsize, 0, $x, $y, $imgcolor, $wm_fontfamily, $wm_text);

        switch ($srcImage[2])
        {
            case 1:
                imagegif($src_im, $image);
                break;
            case 2:
                imagejpeg($src_im, $image, $wm_quality);
                break;
            case 3:
                imagepng($src_im, $image);
                break;
            default:
                return false;
        }

        imagedestroy($src_im);

    }

    /*
     * 添加图片水印，仅支持jpg、gif、png
     * $image 原图片文件
     * $wm_image 水印图片文件
     * $alpha 水印透明度, 0:完全透明、100:完全不透明
     * $wm_quality 生成图片质量, 仅对jpg图片
     * $position 水印添加位置, 1:顶部居左、2:顶部居右、3:居中、4:底部居左、5:底部居右
     * 若没有加载GD库，返回false
    */

    public function imageWaterMark($image, $wm_image, $wm_alpha, $wm_quality, $position = 5)
    {
        if (!extension_loaded('gd') || !file_exists($image) || !file_exists($wm_image)) //是否开启GD库，原图片是否存在, 水印图片是否存在
        {
            return false;
        }

        $srcImage = @getimagesize($image);
        $wmImage  = @getimagesize($wm_image);

        if($wmImage[0] > $srcImage[0] || $wmImage[1] > $srcImage[1]) // 水印图片宽高要小于原图宽高
        {
            return false;
        }

        $src_im = $this->image_create_from_ext($image);
        $wm_im  = $this->image_create_from_ext($wm_image);

        switch ($position)
        {
            case 1:       //顶部居左
                $x=$y=4;
                break;
            case 2:       //顶部居右
                $x = $srcImage[0]-$wmImage[0]-4;
                $y = 4;
                break;
            case 3:       //居中
                $x = ($srcImage[0]-$wmImage[0])/2;
                $y = ($srcImage[1]-$wmImage[1])/2;
                break;
            case 4:       //底部居左
                $x = 4;
                $y = $srcImage[1]-$wmImage[1]-4;
                break;
            case 5:      //底部居右
                $x = $srcImage[0]-$wmImage[0]-4;
                $y = $srcImage[1]-$wmImage[1]-4;
                break;
            default:
                $x=$y=0;
        }

        $this->imagecopymerge_alpha($src_im, $wm_im, $x, $y, 0, 0, $wmImage[0], $wmImage[1], $wm_alpha);

        switch ($srcImage[2])
        {
            case 1:
                imagegif($src_im, $image);
                break;
            case 2:
                imagejpeg($src_im, $image, $wm_quality);
                break;
            case 3:
                imagepng($src_im, $image);
                break;
            default:
                return false;  //保存失败
        }

        imagedestroy($src_im);
        imagedestroy($wm_im);
    }

    public function image_create_from_ext($imgfile)
    {
        $info = getimagesize($imgfile);
        $im = null;
        switch ($info[2]) {
            case 1:
                $im=imagecreatefromgif($imgfile);
                break;
            case 2:
                $im=imagecreatefromjpeg($imgfile);
                break;
            case 3:
                $im=imagecreatefrompng($imgfile);
                imagesavealpha($im,true);
                break;
            default:
                return false;
                break;
        }
        return $im;
    }
    /*
     * 支持png图片原始透明拷贝
    */
    public function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);

        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        //3.设置透明
        $color=imagecolorallocate($cut,255,255,255);
        imagecolortransparent($cut,$color);
        imagefill($cut,0,0,$color);

        // copying that section of the background to the cut
        //imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        // inverting the opacity
        //$opacity = 100 - $opacity;

        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
    }
}