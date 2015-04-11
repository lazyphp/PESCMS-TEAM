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

        $list = \Model\Content::listContent('option');
        foreach($list as $key => $value){
            $setting[$value['option_name']] = $value; 
        }
        $this->assign('setting', $setting);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 更新系统
     */
    public function upgrade() {
        $version = \Model\Option::findOption('version')['value'];
        $content = \Model\Content::findContent('update_list', $version, 'update_list_pre_version');
        $this->assign($content);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

}
