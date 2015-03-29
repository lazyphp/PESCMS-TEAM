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

class Index extends \App\Team\Common {

    /**
     * 更新菜单
     */
    public function menuAction() {
        $result = \Model\Menu::updateMenu();
        if ($result['status'] == false) {
            $this->error($result['mes']);
        }
        $this->success($GLOBALS['_LANG']['MENU']['UPDATE_MENU_SUCCESS'], $this->url('Team-Index-menuList'));
    }

}
