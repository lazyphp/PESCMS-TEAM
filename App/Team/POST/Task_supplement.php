<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Team\POST;

/**
 * 追加任务内容
 */
class Task_supplement extends Content {

    public function action($jump = FALSE, $commit = TRUE) {
        parent::action($jump, $commit);
        \Model\Notice::accordingTaskUserToaddNotice($this->p('task_id'), '2', '5');

        $this->success('追加任务内容成功!');

    }

}