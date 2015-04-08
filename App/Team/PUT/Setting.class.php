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

class Setting extends \App\Team\Common {

    /**
     * 更新系统设置
     */
    public function action() {
        $data['sitestatus'] = is_numeric($_POST['sitestatus']) ? $_POST['sitestatus'] : $GLOBALS['_LANG']['SETTING']['SELECT_SITE_STATUS'];
        if ($data['sitestatus'] == '0') {
            $data['closeReason'] = $this->isP('closeReason', $GLOBALS['_LANG']['SETTING']['ENTER_CLOSE_REASON']);
        }
        $data['sitetitle'] = $this->isP('sitetitle', $GLOBALS['_LANG']['SETTING']['ENTER_SITE_TITLE']);
        $data['siteurl'] = $this->isP('siteurl', $GLOBALS['_LANG']['SETTING']['ENTER_SITE_URL']);
        $data['logo'] = $this->isP('logo', $GLOBALS['_LANG']['SETTING']['UPLOAD_SITE_LOGO']);
        $data['seo_keyword'] = $this->p('seo_keyword');
        $data['seo_description'] = $this->p('seo_description');
        //因为提交的会有JS代码，所以不进行转义
        $data['footerCode'] = $this->p('footerCode', FALSE);

        foreach ($data as $key => $value) {
            \Model\Option::update($key, $value);
        }
        $this->success($GLOBALS['_LANG']['SETTING']['UPDATE_SITE_SETTING'], $this->url('Team-Setting-action'));
    }

    /**
     * 更新上传格式设置
     */
    public function uploadFormAction() {
        foreach ($_POST['key'] as $key => $value) {
            if ($key == '0') {
                $optionName = 'upload_img';
            } elseif ($key == '1') {
                $optionName = 'upload_file';
            }
            \Model\Option::update($optionName, json_encode(explode(',', $value)));
        }
        $this->success($GLOBALS['_LANG']['SETTING']['UPDATE_UPLOAD_SUCCESS'], $this->url("Team-Setting-uploadFormAction"));
    }

    /**
     * URL显示模式设置
     */
    public function urlModelAction() {
        $index = $this->p('index');
        $urlModel = $this->p('urlModel');
        $suffix = $this->p('suffix');
        $url = json_encode(array('index' => $index, 'urlModel' => $urlModel, 'suffix' => $suffix));

        $result = \Model\Option::update('urlModel', $url);
        $this->determineSqlExecResult($result, $GLOBALS['_LANG']['SETTING']['UPDATE_URL_FAILE']);
        $this->success($GLOBALS['_LANG']['SETTING']['UPDATE_URL_SUCCESS'], $this->url('Team-Setting-urlModelAction'));
    }

    /**
     * 下载更新文件
     */
    public function downloadUpgradeFile() {
        $version = \Model\Option::findOption('version')['value'];
        $update = \Model\Extra::getUpdate($version);
        if ($update['status'] == '-1') {
            $this->error($update['mes']);
        }
        //下载更新文件
        if (!empty($update['info']['file'])) {
            $this->getFile($update['info']['file']);
        }
        //下载更新SQL文件
        if (!empty($update['info']['sql'])) {
            $this->getFile($update['info']['sql']);
        }
        
        $this->success('下载成功');
    }

    private function getFile($url) {
        $uploadPath = PES_PATH . \Core\Func\CoreFunc::loadConfig('UPLOAD_PATH');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath);
        }

        $downLoadpath = "{$uploadPath}/update";
        if (!is_dir($downLoadpath)) {
            mkdir($downLoadpath);
        }

        $fileInfo = pathinfo($url);

        $newfname = "{$downLoadpath}/{$fileInfo['basename']}";
        //防止多次下载，引起主站负担过重.
        if (is_file($newfname)) {
            return true;
        }

        $file = fopen($url, "rb");

        if ($file) {
            $newf = fopen($newfname, "wb");
            if ($newf)
                while (!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
        } else {
            $this->error('文件下载失败');
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
        }
    }

}
