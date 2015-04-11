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
    }

}
