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
     * 更新文件名称
     * @var type 
     */
    private $updateFileName = '';

    /**
     * 更新数据库文件名称
     * @var type 
     */
    private $updateDbFileName = '';

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

    /**
     * 安装更新文件
     */
    public function installUpdateFile() {
        $version = \Model\Option::findOption('version')['value'];
        $findUpdate = \Model\Content::findContent('update_list', $version, 'update_list_pre_version');
        if (empty($findUpdate['update_list_file'])) {
            $this->success('本次更新没有文件需要更新');
        }
        $uploadPath = PES_PATH . \Core\Func\CoreFunc::loadConfig('UPLOAD_PATH') . "/update";
        $updateFileName = "{$uploadPath}/" . pathinfo($findUpdate['update_list_file'])['basename'];

        require PES_PATH . '/Expand/pclzip.lib.php';
        $archive = new \PclZip($updateFileName);
        $list = $archive->extract(PCLZIP_OPT_PATH, PES_PATH . "/", PCLZIP_OPT_REPLACE_NEWER);
        foreach ($list as $v) {
            if ($v['status'] != "ok" && $v['status'] != 'already_a_directory') {
                $this->error("File:{$v['filename']}, Status:{$v['status']}");
            }
        }

        unlink($updateFileName);

        $this->success('文件更新完毕!');
    }

    /**
     * 安装更新数据库
     */
    public function installUpdateSql() {
        $version = \Model\Option::findOption('version')['value'];
        $findUpdate = \Model\Content::findContent('update_list', $version, 'update_list_pre_version');
        if (empty($findUpdate['update_list_sql'])) {
            $this->success('本次更新没有数据库需要更新');
        }
    }

    /**
     * 安装结束，移除下载的更新文件
     */
    public function installEnd() {
        $version = \Model\Option::findOption('version')['value'];
        $findUpdate = \Model\Content::findContent('update_list', $version, 'update_list_pre_version');
        //设置系统版本
        $this->db('option')->where('option_name = :option_name')->update(array('noset' => array('option_name' => 'version'), 'value' => $findUpdate['update_list_version']));

        //设置版本为已读.
        $this->db('update_list')->where('update_list_version = :update_list_version')->update(array('noset' => array('update_list_version' => $findUpdate['update_list_version']), 'update_list_read' => '1'));
        $this->success('系统更新已完成');
    }

    /**
     * 下载文件
     * @param type $url 下载文件的地址
     */
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
