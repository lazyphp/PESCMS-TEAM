<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Team;

/**
 * 系统通知
 */
class Notice extends \Core\Slice\Slice{

    public function before() {

    }

    public function after() {
        $notice = $this->db('notice')->field('count(notice_type) AS number, notice_type')->where('notice_user_id = :user_id AND notice_read = 0')->group('notice_type')->order('notice_type ASC')->select(['user_id' => $this->session()->get('team')['user_id']]);
        $this->assign('notice', $notice);
    }


}