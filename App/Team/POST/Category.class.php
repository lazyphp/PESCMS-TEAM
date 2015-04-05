<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\POST;

class Category extends \App\Team\Common {

    /**
     * 添加分类
     */
    public function action() {
        $this->db()->transaction();
        $addResult = \Model\Category::addCategory();
        if ($addResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($addResult['mes']);
        }
        $this->db()->commit();
        $this->success($GLOBALS['_LANG']['CATEGORY']['ADD_CATEGORY_SUCCESS'], $this->url('Team-Category-index'));
    }

}
