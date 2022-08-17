<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
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