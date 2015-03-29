<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class Theme extends \App\Team\Common {

    /**
     * 更新主题
     */
    public function action() {
        $theme = $this->isP('theme', $GLOBALS['_LANG']['THEME']['SELECT_THEME']);
        $updateResult = \Model\Option::update('theme', $theme);
        if ($updateResult == false) {
            $this->error($GLOBALS['_LANG']['THEME']['SET_THEME_FAIL']);
        }

        $this->success($GLOBALS['_LANG']['THEME']['SET_THEME_SUCCESS']);
    }

}
