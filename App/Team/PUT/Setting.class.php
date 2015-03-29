<?php

/**
 * Pes for PHP 5.3+
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
     * 更新扩展变量
     */
    public function expandAction() {
        $totalKey = count($_POST['key']);
        if ($totalKey != count($_POST['value'])) {
            $this->error($GLOBALS['_LANG']['SETTING']['SUBMIT_KEY_LENGTH_NO_SAME_VALUE']);
        }
        for ($i = 0; $i < $totalKey; $i++) {
            $newArray[$_POST['key'][$i]] = $_POST['value'][$i];
        }

        $updateResult = \Model\Option::update('system', json_encode($newArray));
        $this->determineSqlExecResult($updateResult, $GLOBALS['_LANG']['SETTING']['UPDATE_EXPAND_FAIL']);
        $this->success($GLOBALS['_LANG']['SETTING']['UPDATE_EXPAND_SUCCESS'], $this->url('Team-Setting-expandAction'));
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
     * 更新幻灯片类型
     */
    public function slideshowAction() {
        $data['noset']['slideshow_type_id'] = $this->isP('id', $GLOBALS['_LANG']['SLIDESHOW']['LOSE_SLIDESHOW_TYPE_ID']);
        $data['slideshow_type_name'] = $this->isP('slideshow_type_name', $GLOBALS['_LANG']['SLIDESHOW']['ENTER_SLIDESHOW_TYPE_TITLE']);
        if (!\Model\SlideShow::findSlideshowType($data['noset']['slideshow_type_id'])) {
            $this->error($GLOBALS['_LANG']['SLIDESHOW']['NOT_EXIST_TYPE_TITLE']);
        }
        $this->db('slideshow_type')->where('slideshow_type_id = :slideshow_type_id')->update($data);
        $this->success($GLOBALS['_LANG']['SLIDESHOW']['UPDATE_SLIDESHOW_TYPE_SUCCESS'], $this->url('Team-Setting-slideshowList'));
    }

}
