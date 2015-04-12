<?php

namespace App\Team\DELETE;

/**
 * 删除用户
 */
class User extends Content {

    public function delete() {
        if (in_array($_GET['id'], array('1'))) {
            $this->error('初始用户不允许删除');
        }

        /**
         * 将被删除用户的任务设置为删除状态
         * 这样做是为了保留数据统计的完整性
         */
        $this->db('task')->where('task_user_id = :task_user_id')->update(array('noset' => array('task_user_id' => $_GET['id']), 'task_delete' => '1'));

        parent::delete();
    }

}
