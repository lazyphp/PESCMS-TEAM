<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

class Html extends \App\Team\Common {

    /**
     * 生成首页静态
     */
    public function index() {
        $this->assign('buttomName', $GLOBALS['_LANG']['HTML']['CREATE_INDEX']);
        $this->layout('Html_action');
    }

    /**
     * 生成列表页
     */
    public function listAction() {
        $this->assign('buttomName', $GLOBALS['_LANG']['HTML']['CREATE_LIST']);
        $this->layout('Html_action');
    }

    /**
     * 生成内容页
     */
    public function contentAction() {
        $this->assign('url', $this->url('Team-Html-listAction', array('c' => '1')));
        $this->assign('buttomName', $GLOBALS['_LANG']['HTML']['CREATE_CONTENT']);
        $this->layout('Html_action');
    }

    /**
     * 更新URL地址
     */
    public function updateUrl() {
        $this->assign('buttomName', $GLOBALS['_LANG']['HTML']['UPDATE_URL']);
        $this->layout('Html_action');
    }

}
