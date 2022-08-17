<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
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