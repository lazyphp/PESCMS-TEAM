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

class User_group extends Content {

    /**
     * 设置菜单
     */
    public function setMenu() {
        $id = $this->isG('id', '请选择用户组');
        $group = \Model\Content::findContent('user_group', $id, 'user_group_id');
        if (empty($group)) {
            $this->error('用户组不存在');
        }
        $this->assign($group);
        $this->assign('menu', \Model\Menu::menu());
        $this->assign('title', "设置'{$group['user_group_name']}'用户组菜单");
        $this->layout();
    }

}
