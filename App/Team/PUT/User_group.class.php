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

}
