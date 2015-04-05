<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team;

abstract class Common extends \Core\Controller\Controller {

    /**
     * 后台管理员信息
     */
    protected $team;

    public function __construct() {
        $login = $this->checkLogin();

        if ($login == FALSE && MODULE != 'Login') {
            $this->jump($this->url('Team-Login-index'));
        }
    }

    /**
     * 验证是否已登录
     */
    protected function checkLogin() {
        $this->team = $_SESSION['team'];

        if (empty($this->team['user_id'])) {
            return false;
        } else {
            return true;
        }
    }

}
