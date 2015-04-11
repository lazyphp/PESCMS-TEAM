<?php

/**
 * PESCMS for PHP 5.4+
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
        $checkAccount = $this->db('user')->where('user_account = :account AND user_password = :password AND user_status = 1')->find($data);
        if (empty($checkAccount)) {
            $this->error($GLOBALS['_LANG']['LOGIN']['LOGIN_ERROR']);
        }
        $this->setLogin($checkAccount);
        $this->success($GLOBALS['_LANG']['LOGIN']['LOGIN_SUCCESS'], $this->url('Team-Index-index'));
    }

    /**
     * 注册帐号
     */
    public function signup() {
        if (\Model\Option::findOption('signup')['value'] == '0') {
            $this->error('本系统没有开启注册。');
        }
        $data['user_account'] = $this->isP('account', '请填写帐号');
        $existAccount = \Model\Content::findContent('user', $data['user_account'], 'user_account');
        if (!empty($existAccount)) {
            $this->error('帐号已存在');
        }

        $data['user_password'] = \Core\Func\CoreFunc::generatePwd($data['user_account'] . $this->isP('password', '请填写密码'), 'PRIVATE_KEY');
        $repwd = \Core\Func\CoreFunc::generatePwd($data['user_account'] . $this->isP('repassword', '请填写密码'), 'PRIVATE_KEY');
        if ($data['user_password'] != $repwd) {
            $this->error('两次密码不一致');
        }
        $data['user_mail'] = $this->isP('mail', '请填写帐号');
        $existEmail = \Model\Content::findContent('user', $data['user_mail'], 'user_mail');
        if (!empty($existEmail)) {
            $this->error('邮箱地址已存在');
        }

        \Core\Func\CoreFunc::$defaultPath = false;
        require PES_PATH . '/Expand/Identicon/autoload.php';
        $identicon = new \Identicon\Identicon();
        $imageDataUri = $identicon->getImageDataUri($data['user_mail']);

        $data['user_name'] = $this->isP('name', '请填写帐号');
        $data['user_status'] = '1';
        $data['user_createtime'] = time();
        $data['user_department_id'] = '2'; //人事部
        $data['user_group_id'] = '2'; //普通用户
        $data['user_head'] = $imageDataUri;

        $addResult = $this->db('user')->insert($data);
        if (empty($addResult)) {
            $this->error('注册失败');
        }

        unset($data['user_password']);
        $data['user_id'] = $addResult;
        $this->setLogin($data);
        $this->success('注册成功!', $this->url('Team-Index-index'));
    }

    /**
     * 设置登录信息
     * @param type $content 帐号内容
     */
    private function setLogin($content) {
        $_SESSION['team'] = $content;
    }

}
