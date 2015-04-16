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

class Index extends \App\Team\Common {

    /**
     * 删除菜单
     */
    public function menuAction() {
        $id = $this->isG('id', $GLOBALS['_LANG']['COMMON']['DELETE_ID']);
        $result = \Model\Model::deleteFromModelId('menu', $id);
        if (empty($result)) {
            $this->error($GLOBALS['_LANG']['COMMON']['DELETE_ERROR']);
        } else {
            $this->success($GLOBALS['_LANG']['COMMON']['DELETE_SUCCESS']);
        }
    }

}
