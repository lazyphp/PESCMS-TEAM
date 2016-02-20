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

class Index extends \Core\Controller\Controller {

    /**
     * 全体动态主页
     */
    public function index() {
        $this->jump($this->url('Team-Task-index'));
    }

    /**
     * 注销帐号
     */
    public function logout() {
        session_destroy();
        $this->jump($this->url('Team-Login-index'));
    }

}
