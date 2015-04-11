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

class Login extends \App\Team\Common {

    public function __construct() {
        parent::__construct();
        $this->assign('sitetile', \Model\Option::findOption('sitetitle')['value']);
        $this->assign('signup', \Model\Option::findOption('signup')['value']);
    }

    public function index() {
        $login = $this->checkLogin();
        if ($login) {
            $this->jump($this->url('Team-Index-index'));
        }
        $this->display();
    }

    /**
     * 注册帐号
     */
    public function signup() {
        $this->display();
    }

}
