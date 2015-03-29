<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\POST;

class Setting extends \App\Team\Common {

    /**
     * 添加幻灯片类型
     */
    public function slideshowAction() {
        $data['slideshow_type_name'] = $this->isP('slideshow_type_name', $GLOBALS['_LANG']['SLIDESHOW']['ENTER_SLIDESHOW_TYPE_TITLE']);
        $this->db('slideshow_type')->insert($data);
        $this->success($GLOBALS['_LANG']['SLIDESHOW']['INSERT_SLIDESHOW_TYPE_SUCCESS'], $this->url('Team-Setting-slideshowList'));
    }

}
