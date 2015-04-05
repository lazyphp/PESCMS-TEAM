<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\DELETE;

class Category extends \App\Team\Common {

    /**
     * 删除分类
     */
    public function action() {
        $this->db()->transaction();
        $deletResult = \Model\Category::deleteCategory();
        if ($deletResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($deletResult['mes']);
        }

        $this->db()->commit();
        $this->success($GLOBALS['_LANG']['COMMON']['DELETE_SUCCESS']);
    }

}
