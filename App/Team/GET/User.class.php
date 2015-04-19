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

class User extends \App\Team\Common {

    public function index() {

        $condition = "";
        $param = array();

        $search = $this->g('search');
        if (!empty($search)) {
            $condition = " user_account LIKE :user_account OR user_mail LIKE :user_mail OR user_name LIKE :user_name ";
            $param['user_account'] = "%{$search}%";
            $param['user_mail'] = "%{$search}%";
            $param['user_name'] = "%{$search}%";
        }

        $page = new \Expand\Team\Page;
        $total = count($this->db('user')->where($condition)->select($param));
        $count = $page->total($total);
        $page->handle();
        $list = $this->db('user')->where($condition)->order("user_id desc")->limit("{$page->firstRow}, {$page->listRows}")->select($param);
        $show = $page->show();
        foreach (\Model\Content::listContent('department') as $key => $value) {
            $findDepartment[$value['department_id']] = $value['department_name'];
        }
        $this->assign('findDepartment', $findDepartment);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 添加/编辑会员
     */
    public function action() {
        $userId = $this->g('id');
        if (empty($userId)) {
            $this->assign('title', $GLOBALS['_LANG']['USER']['ADD']);
            $this->routeMethod('POST');
        } else {
            if (!$content = \Model\User::findUser($userId)) {
                $this->error($GLOBALS['_LANG']['MENU']['NOT_EXITS_MENU']);
            }
            $this->assign($content);
            $this->assign('title', $GLOBALS['_LANG']['USER']['EDIT']);
            $this->routeMethod('PUT');
        }
        $this->assign('groupList', \Model\User::userGroupList());
        $this->assign('department', \Model\Content::listContent('department'));
        $this->assign('user_id', $userId);
        $this->assign('url', $this->url('Team-User-action'));
        $this->layout();
    }

    /**
     * 更改个人资料
     */
    public function my() {
        $this->assign('title', '修改资料');
        $_SESSION['team'] = $myInfo = \Model\User::findUser($_SESSION['team']['user_id']);

        $this->assign($myInfo);
        $this->assign('method', 'PUT');
        $this->layout('User_action');
    }

    /**
     * 更换头像
     */
    public function head() {
        $this->assign('title', '更换头像');
        $this->layout();
    }

}
