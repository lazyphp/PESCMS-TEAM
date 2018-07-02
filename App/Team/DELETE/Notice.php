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

/**
 * 公用内容删除方法
 */
class Notice extends Content {

    public function delete() {
        $notice = \Model\Content::findContent('notice', $_GET['id'], 'notice_id');

        if($notice['user_id'] != $this->session()->get('team')['user_id']){
            $this->error('您无法删除本消息');
        }
        parent::delete();
    }

}