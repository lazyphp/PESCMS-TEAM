<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class User extends \App\Team\Common {

    public function action() {
        $this->db()->transaction();
        $updateResult = \Model\User::update();
        if ($updateResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($updateResult['mes']);
        }
        $this->db()->commit();

        $this->success($GLOBALS['_LANG']['USER']['UPDATE_USER_SUCCESS'], $this->url('Team-User-index'));
    }

    /**
     * 更新用户头像
     */
    public function setHead() {
        if (empty($_FILES['file']['tmp_name'])) {
            $this->error('请选择您要裁剪的头像');
        }

        $width = $this->isP('width', '请选择您要裁剪的高度');
        $height = $this->isP('height', '请选择您要裁剪的高度');
        $x = $this->p('x');
        $y = $this->p('y');

        $allowFormat = json_decode(\Model\Option::findOption('upload_img')['value'], true);
        $extension = pathinfo($_FILES['file']['name'])['extension'];
        if (!in_array($extension, $allowFormat)) {
            $this->error('图片格式不被支持');
        }

        $uploadPath = PES_PATH . $this->loadConfig('UPLOAD_PATH');
        if (is_dir($uploadPath) === false) {
            mkdir($uploadPath);
            fopen("{$uploadPath}/index.html", 'w');
        }

        $savePath = $uploadPath . date('/Ymd/');
        if (is_dir($savePath) === false) {
            mkdir($savePath);
            fopen("{$savePath}/index.html", 'w');
        }

        $name = uniqid() . ".{$extension}";


        switch (strtolower($extension)) {
            case 'jpg':
            case'jpeg':
                $image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
                break;
            case 'gif':
                $image = imagecreatefromgif($_FILES['file']['tmp_name']);
                break;
            case 'png':
                $image = imagecreatefrompng($_FILES['file']['tmp_name']);
                break;
        }

        $cutimg = imagecreatetruecolor($width, $height);
        $alpha = imagecolorallocatealpha($cutimg, 0, 0, 0, 127);
        imagefill($cutimg, 0, 0, $alpha);

        imagecopyresampled($cutimg, $image, 0, 0, $x, $y, $width, $height, $width, $height);

        imagepng($cutimg, $savePath . $name);
        imagedestroy($cutimg);
        imagedestroy($back);

        $updateHeadPath = str_replace(PES_PATH, "", $savePath . $name);
        $setHeadResult = $this->db('user')->where('user_id = :user_id')->update(array('noset' => array('user_id' => $_SESSION['team']['user_id']), 'user_head' => $updateHeadPath));
        if ($setHeadResult == false) {
            $this->error('设置头像失败');
        }
        $_SESSION['team']['user_head'] = $updateHeadPath;

        $this->success('设置成功!', $this->url('Team-Index-dynamic'));
    }

}
