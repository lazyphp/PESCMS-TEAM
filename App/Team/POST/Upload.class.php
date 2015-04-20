<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\POST;

class Upload extends \App\Team\Common {

    private $uploadPath, $recordPath, $uploadFileType, $savePath, $saveName, $newWidth, $newHeight;

    public function __construct() {
        parent::__construct();

        if (empty($_FILES)) {
            $this->callBack($GLOBALS['_LANG']['UPLOAD']['EMPTY_UPLOAD'], '0');
        }

        /**
         * 获取允许上传的文件格式
         */
        $result = \Model\Option::getOptionRange('upload');
        foreach ($result as $key => $value) {
            $this->allowFormat[$value['option_name']] = json_decode($value['value'], true);
        }

        /**
         * 获取配置文件的上传目录
         */
        $this->uploadPath = PES_PATH . $this->loadConfig('UPLOAD_PATH');

        /**
         * 分析上传目录
         */
        $this->uploadFileType = pathinfo($_FILES['file']['name']);

        /**
         * 存储路径
         */
        $this->savePath = $this->uploadPath . date('/Ymd/');

        /**
         * 移除完整的目录信息
         * 以便记录入库
         */
        $this->recordPath = DOCUMENT_ROOT.str_replace(PES_PATH, "", $this->savePath);


        /**
         * 判断上传目录是否存在
         */
        if (is_dir($this->uploadPath) === false) {
            mkdir($this->uploadPath);
            fopen("{$this->uploadPath}/index.html", 'w');
        }

        /**
         * 创建以日期形式存储目录
         */
        if (is_dir($this->savePath) === false) {
            mkdir($this->savePath);
            fopen("{$this->savePath}/index.html", 'w');
        }
    }

    /**
     * 上传缩略图
     * 默认生成两种格式
     */
    public function img() {
        if (!empty($_POST['imgSize'])) {
            $imgSize = explode(',', $_POST['imgSize']);
            $this->newWidth = $imgSize['0'];
            $this->newHeight = $imgSize['1'];
        }


        $this->checkType($this->allowFormat['upload_img'], $GLOBALS['_LANG']['UPLOAD']['IMG_TIPS']);

        if ($this->setSize()) {

            $this->callBack($this->recordPath);
        } else {
            $this->callBack($GLOBALS['_LANG']['UPLOAD']['UPLOAD_FAIL'], '0');
        }
    }

    /**
     * 上传文件
     */
    public function file() {
        $this->checkType($this->allowFormat['upload_file'], $GLOBALS['_LANG']['UPLOAD']['FILE_TIPS']);

        $name = uniqid() . ".{$this->uploadFileType['extension']}";

        $this->saveName = $this->savePath . $name;

        $this->recordPath .= $name;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $this->saveName)) {
            $this->callBack($this->recordPath);
        } else {
            $this->callBack($GLOBALS['_LANG']['UPLOAD']['UPLOAD_FAIL'], '0');
        }
    }

    /**
     * 检测上传类型
     * @param array $fileType 检测类型的数组
     * @param type $tips 提示信息
     * @todo 此处是否应该添加后台设置上传类型呢？
     */
    private function checkType(array $fileType, $tips) {
        if (!in_array(strtolower($this->uploadFileType['extension']), $fileType)) {
            $this->callBack($tips, '0');
        }
    }

    /**
     * 设置图片格式
     */
    private function setSize() {
        $filename = $_FILES["file"]["tmp_name"];

        $name = uniqid() . ".{$this->uploadFileType['extension']}";

        $this->saveName = $this->savePath . $name;

        $this->recordPath .= $name;

        if (empty($this->newHeight)) {
            return move_uploaded_file($_FILES["file"]["tmp_name"], $this->saveName);
        }

        $extension = strtolower($this->uploadFileType['extension']);

        switch ($extension) {
            case 'jpg':
            case'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
            case 'png':
                header("Content-Type: image/png");
                break;
            default :
                $data['status'] = 0;
                $data['info'] = "文件类型不正确";
                exit(json_encode($data));
        }

        /**
         * 获取原图的宽高
         */
        list($width, $height) = getimagesize($filename);

        $image_p = imagecreatetruecolor($this->newWidth, $this->newHeight);

        switch ($extension) {
            case 'jpg':
            case'jpeg':
                $image = imagecreatefromjpeg($filename);
                break;
            case 'gif':
                $image = imagecreatefromgif($filename);
                break;
            case 'png':
                $image = imagecreatefrompng($filename);
                break;
        }

        $alpha = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
        imagefill($image_p, 0, 0, $alpha);
        /**
         * 压缩图片
         */
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $width, $height);
        imagesavealpha($image_p, true);

        /**
         * 保存图片
         */
        switch ($extension) {
            case 'jpg':
            case'jpeg':
                return imagejpeg($image_p, $this->saveName);
            case 'gif':
                return imagegif($image_p, $this->saveName);
            case 'png':
                return imagepng($image_p, $this->saveName);
        }
    }

    /**
     * 回调状态
     * @param type $info 包含的信息
     * @param type $status 状态，默认为200
     */
    private function callBack($info, $status = '200') {
        $data['status'] = $status;
        $data['info'] = $info;
        if (!empty($_GET['editorid'])) {

            $content = json_encode(array(
                "originalName" => $_FILES['file']['name'],
                "name" => $info,
                "url" => $info,
                "size" => $_FILES['file']['size'],
                "type" => '.' . strtolower($this->uploadFileType['extension']),
                "state" => 'SUCCESS'
            ));
            exit($content);
        }
        exit(json_encode($data));
    }

}
