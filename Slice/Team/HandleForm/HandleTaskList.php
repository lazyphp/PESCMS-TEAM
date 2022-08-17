<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace Slice\Team\HandleForm;

/**
 * 处理 任务条目的权限
 */
class HandleTaskList extends \Core\Slice\Slice {

    /**
     * 验证条目权限
     */
    public function before() {
        if(empty($_REQUEST['task_id'])){
            $this->error('请选择任务');
        }
        $auth = \Model\Task::actionAuth($_REQUEST['task_id']);
        if($auth['check'] === false && $auth['action'] === false){
            $this->error('您没有权限操作本任务');
        }
    }

    public function after() {
    }


}