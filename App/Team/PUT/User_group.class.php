<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class User_group extends Content {

    /**
     * 设置菜单
     */
    public function setMenu() {
        $id = $this->isP('id', '请选择用户组');
        $group = \Model\Content::findContent('user_group', $id, 'user_group_id');
        if (empty($group)) {
            $this->error('用户组不存在');
        }
        $updateResult = $this->db('user_group')->where('user_group_id = :user_group_id')->update(array('user_group_menu' => implode(',', $_POST['menu']), 'noset' => array('user_group_id' => $id)));
        if (empty($updateResult)) {
            $this->error('设置用户组菜单失败');
        }
        $this->success('设置用户组菜单成功!', $this->url('Team-User_group-index'));
    }

    public function setNode() {
        $id = $this->isP('id', '请选择用户组');
        if (empty($_POST['node'])) {
            $this->error('请选择该用户组的权限节点');
        }
        $group = \Model\Content::findContent('user_group', $id, 'user_group_id');
        if (empty($group)) {
            $this->error('用户组不存在');
        }

        //移除所有节点
        $this->db('node_group')->where('user_group_id = :user_group_id')->delete(array('user_group_id' => $id));

        foreach ($_POST['node'] as $key => $value) {
            $this->db('node_group')->insert(array('user_group_id' => $id, 'node_id' => $value));
        }

        $this->success('设置用户组权限节点成功!', $this->url('Team-User_group-index'));
    }

}
