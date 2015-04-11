<?php

namespace App\Team\DELETE;

/**
 * 公用内容删除方法
 */
class User_group extends Content {

    public function delete() {
        if (in_array($_GET['id'], array('1', '2', '3'))) {
            $this->error('本用户组不允许删除');
        }
        parent::delete();
    }

}
