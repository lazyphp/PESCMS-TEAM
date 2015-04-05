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

class Setting extends \App\Team\Common {

    /**
     * 系统基础设置
     */
    public function action() {
        $list = \Model\Option::getOptionRange('setting');
        foreach ($list as $key => $value) {
            $setting[$value['option_name']] = $value['value'];
        }

        $this->assign($setting);
        $this->assign('title', $GLOBALS['_LANG']['MENU_LIST'][\Model\Menu::getTitleWithMenu()]);
        $this->layout();
    }

    /**
     * 扩展变量设置
     */
    public function expandAction() {
        $list = \Model\Option::findOption('system');
        $this->assign('list', json_decode($list['value'], true));
        $this->layout();
    }

    /**
     * 上传格式设置
     */
    public function uploadFormAction() {
        $result = \Model\Option::getOptionRange('upload');
        foreach ($result as $key => $value) {
            $list[$value['option_name']] = implode(',', json_decode($value['value']));
        }
        $this->assign('list', $list);
        $this->layout();
    }

    /**
     * URL显示模式设置
     */
    public function urlModelAction() {
        $list = \Model\Option::findOption('urlModel');
        $this->assign(json_decode($list['value'], true));
        $this->layout();
    }

    /**
     * 幻灯片管理
     * 理论上，一个中小站不会存在多个幻灯片
     * 所以没有必要编写分页功能
     */
    public function slideshowList() {
        $this->assign('title', $GLOBALS['_LANG']['MENU_LIST'][\Model\Menu::getTitleWithMenu()]);
        $this->assign('list', \Model\SlideShow::slideshowType());
        $this->layout();
    }

    /**
     * 幻灯片添加/编辑
     */
    public function slideshowAction() {
        $id = $this->g('id');
        if (empty($id)) {
            $this->assign('method', 'POST');
            $this->assign('title', $GLOBALS['_LANG']['SLIDESHOW']['ADD_SLIDESHOW_TYPE']);
        } else {
            $content = \Model\SlideShow::findSlideshowType($id);
            if (empty($content)) {
                $this->error($GLOBALS['_LANG']['CONTENT']['NOT_EXIST_CONTENT']);
            }
            $this->assign($content);
            $this->assign('method', 'PUT');
            $this->assign('id', $id);
            $this->assign('title', $GLOBALS['_LANG']['SLIDESHOW']['EDIT_SLIDESHOW_TYPE']);
        }

        $this->layout();
    }

}
