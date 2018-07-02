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


namespace Slice\Team\HandleForm;

/**
 * 处理 任务补充说明
 * @package Slice\Ticket
 */
class HandleTaskSupplement extends \Core\Slice\Slice {

    /**
     * 验证补充任务内容的权限
     */
    public function before() {
        if(empty($_REQUEST['task_id'])){
            $this->error('请选择任务');
        }
        $auth = \Model\Task::actionAuth($_REQUEST['task_id']);
        if($auth['check'] === false){
            $this->error('您没有权限操作本任务');
        }
        $_POST['user_id'] = (string) $_SESSION['team']['user_id'];
        $_POST['createtime'] = (string) date('Y-m-d H:i');
    }

    public function after() {
    }


}