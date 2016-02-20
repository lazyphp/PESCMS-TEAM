<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 2.0
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