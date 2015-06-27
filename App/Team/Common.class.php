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

    public function __init() {
        $login = $this->checkLogin();

        if ($login == FALSE && MODULE != 'Login') {
            $this->jump($this->url('Team-Login-index'));
        }

        //触发邮件发送
        $mail = new \Expand\Email\SendMail();
        if (in_array($mail->trigger, array('1', '3')) && METHOD == 'GET') {
            $mail->sendNotice();
        }
        $this->checkNode();
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

    /**
     * 验证用户节点
     * @todo 若没有添加节点，是否需要严重权限呢？
     * 应该在设置中添加一个选项，开启严格的权限检测和欢送检测。
     */
    protected function checkNode() {
        //登录，上传，下载文件为权限验证特例。以后看需要再更改吧
        if (in_array(MODULE, array('Login', 'Upload', 'SaveFile'))) {
            return true;
        }
        $findNode = \Model\Content::findContent('node', GROUP . METHOD . MODULE . ACTION, 'node_check_value');
        $nodeType = \Model\Content::findContent('option', 'node_type', 'option_name');
        //没加节点，则表示不验证权限
        if (empty($findNode) && $nodeType['value'] == '0') {
            return true;
        }
        $checkNode = $this->db('node_group')->where('user_group_id = :user_group_id AND node_id = :node_id')->find(array('user_group_id' => $_SESSION['team']['user_group_id'], 'node_id' => $findNode['node_id']));
        if (empty($checkNode)) {
            $this->error(empty($findNode['node_msg']) ? '您的权限不足' : $findNode['node_msg']);
        }
    }

}
