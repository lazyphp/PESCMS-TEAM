<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace App\Team\GET;

class Notice extends Content {

    public function index($display = true) {
        $condition = "";
        $param = ['notice_user_id' => $this->session()->get('team')['user_id']];

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
                WHERE notice_user_id = :notice_user_id {$condition}
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

        \Model\Notice::readNotice($condition, [
            'notice_read' => '1',
            'noset' => $param
        ]);

        $this->layout();
    }
}