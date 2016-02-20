<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2016 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */


namespace App\Team\GET;

class Notice extends Content {

    public function index() {
        $condition = "";
        $param = ['user_id' => $_SESSION['team']['user_id']];

        if (!empty($_GET['type'])) {
            $condition .= " AND notice_type = :type";
            $param['type'] = $this->g('type');
        }
        if (!empty($_GET['read'])) {
            $condition .= " AND  notice_read = :read";
            $param['read'] = $this->g('read');
        }

        $sql = "SELECT %s
                FROM {$this->prefix}notice
                WHERE notice_user_id = :user_id {$condition}
                ORDER BY notice_time DESC, notice_id DESC
                ";
        $result = \Model\Content::quickListContent([
            'count' => sprintf($sql, 'count(*)'),
            'normal' => sprintf($sql, '*'),
            'param' => $param,
            'page' => '30'
        ]);
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);

        $this->db('notice')->where("notice_user_id = :user_id {$condition}")->update([
            'notice_read' => '1',
            'noset' => $param
        ]);

        $this->layout();
    }
}