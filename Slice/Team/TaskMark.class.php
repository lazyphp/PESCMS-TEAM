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
 * 赋予模板任务状态的变量
 */
class TaskMark extends \Core\Slice\Slice{

    public function before() {
        foreach(\Model\Content::listContent(['table' => 'priority', 'order' => 'priority_listsort ASC, priority_id DESC']) as $key => $value){
            $priority[$value['priority_id']] = $value;
        }
        $this->assign('taskPriority', $priority);
        $this->assign('statusMark', \Model\Task::getTaskStatusMark());
    }

    public function after() {
    }


}