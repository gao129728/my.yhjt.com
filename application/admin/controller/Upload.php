<?php

namespace app\admin\controller;
use think\Controller;
use think\File;

class Upload extends Base
{
    //图片上传
    public function uploadImage($file){
        if($file){
            $info  = $file->validate(['size'=>config('upload_img.size'),'ext'=>config('upload_img.ext')])->move(ROOT_PATH . 'public' . DS . config('upload_img.path'));
            if($info){
                return $info->getSaveName();
            }else{
                return '';
            }
        }

    }

    //头像上传
    public function uploadFace($file){
        if($file){
            $info  = $file->validate(['size'=>config('upload_face.size'),'ext'=>config('upload_face.ext')])->move(ROOT_PATH . 'public' . DS . config('upload_face.path'));
            if($info){
                return $info->getSaveName();
            }else{
                return '';
            }
        }

    }


    //文件上传
    public function uploadAnnex($file){
        if($file){
            $info  = $file->validate(['size'=>config('upload_annex.size'),'ext'=>config('upload_annex.ext')])->move(ROOT_PATH . 'public' . DS . config('upload_annex.path'));
            if($info){
                return $info->getSaveName();
            }else{
                return '';
            }
        }

    }

    //多图上传
    public function multi_upload(){
        @set_time_limit(5 * 60);

        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . config('upload_img.path'));
        if($info){
            return json(['code' => 1, 'data' => $info->getSaveName(), 'msg' => '上传成功']);
        }else{
            return json(['code' => 0, 'data' => '', 'msg' => $file->getError()]);
        }
    }



    /**
     * 文件上传（支持大文件分片上传）
     * @param $productId
     * @param $uid
     */
    public function chunkUpload()
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit;
        }

        if ( !empty($_REQUEST[ 'debug' ]) ) {
            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
            if ( $random === 0 ) {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
            }
        }

        @set_time_limit(5 * 60);

        $uploadRoot = ROOT_PATH . 'public' . DS .config('upload_file_path');
        $ym = date("Y-m");

        $uploadDir  = $uploadRoot.$ym;
        $targetDir  = $uploadRoot.'upload_tmp';

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create uploadDir
        if (!is_dir($uploadDir))
        {
            if (!mkdir($uploadDir))
            {
                exit('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "无法建立保存文件的目录！"}, "id" : "id"}');
            }
        }

        // Create targetDir
        if (!is_dir($targetDir))
        {
            if (!mkdir($targetDir))
            {
                exit('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "无法建立保存文件的目录！"}, "id" : "id"}');
            }
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        //$fileName = iconv('UTF-8', 'GB2312', $fileName);//转编码
        //echo $fileName;
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }
        if ( $done ) {

            list($a, $b)= explode(" ", microtime());
            $fileTmpName= (string)$b . (string)substr($a, 2);
            $fileExt    = substr($fileName, strrpos($fileName, ".") + 1);

            $docutem    = $fileTmpName . "." . strToLower($fileExt);
            $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $docutem;

            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);

            $docPath = $ym . "/" .$docutem;
            $docRoot = "/".config('upload_file_path').$docPath;

            die('{"result" : "success", "name" : "'.$docPath.'", "path" : "'.$docRoot.'", "id" : "id"}');
        }
    }

}