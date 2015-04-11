<?php

namespace App\Team\DELETE;

/**
 * 删除部门
 */
class Department extends Content {

    public function delete() {
        if (in_array($_GET['id'], array('1', '2'))) {
            $this->error('本部门不允许删除');
        }
        parent::delete();
    }

}
