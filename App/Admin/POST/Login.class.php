<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\POST;

class Login extends \App\Team\Common {

    public function dologin() {
        $data['account'] = $this->isP('account', $GLOBALS['_LANG']['COMMON']['LOGIN']['ACCOUNT_LOST']);
        $data['password'] = \Core\Func\CoreFunc::generatePwd($data['account'] . $this->isP('password', $GLOBALS['_LANG']['LOGIN']['PASSWORD_LOST']), 'PRIVATE_KEY');
        $checkAccount = $this->db('user')->where('user_account = :account and user_password = :password')->find($data);
        if (empty($checkAccount)) {
            $this->error($GLOBALS['_LANG']['LOGIN']['LOGIN_ERROR']);
        }
        $this->setLogin($checkAccount);
        $this->success($GLOBALS['_LANG']['LOGIN']['LOGIN_SUCCESS'], $this->url('Team-Index-index'));
    }

    /**
     * 设置登录信息
     * @param type $content 帐号内容
     */
    private function setLogin($content) {
        $_SESSION['team'] = $content;
    }

}
