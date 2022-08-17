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