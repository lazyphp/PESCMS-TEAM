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
     * @todo 后台设置是一个败笔之处。部分设置使用了JSON处理，部分没有。
     * 本方法弱处理，成功与否都提示设置完毕。以后情况严重再修改吧。 2015-04-11
     */
    public function action() {
        $sitetitle = $this->isP('sitetitle', '请填写程序标题');
        $upload_img = $this->isP('upload_img', '请填写上传图片格式');
        $upload_file = $this->isP('upload_file', '请填写上传文件的格式');
        $signup = in_array($_POST['signup'], array('0', '1')) ? $_POST['signup'] : $this->error('请选择是否开启注册');

        $mail = $this->p('mail');

        \Model\Option::update('sitetitle', $sitetitle);
        \Model\Option::update('signup', $signup);
        \Model\Option::update('upload_img', json_encode(explode(',', $upload_img)));
        \Model\Option::update('upload_file', json_encode(explode(',', $upload_file)));
        \Model\Option::update('mail', json_encode($mail));

        $this->success('设置完毕!', $this->url('Team-Setting-action'));
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
