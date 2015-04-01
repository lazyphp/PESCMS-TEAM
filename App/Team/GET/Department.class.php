<?php

namespace App\Team\GET;

/**
 * 部门方法
 */
class Department extends Content {

    /**
     * 部门添加/编辑
     */
    public function action() {
        $userList = \Model\Content::listContent('user');
        $this->assign('user', $userList);
        foreach ($userList as $key => $value) {
            $findUser[$value['user_id']] = $value['user_name'];
        }
        $this->assign('findUser', $findUser);
        parent::action();
    }

}
