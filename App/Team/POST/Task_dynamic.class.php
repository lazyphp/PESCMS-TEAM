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
 * 任务动态
 */
class Task_dynamic extends Content {

    public function action($jump = FALSE, $commit = TRUE) {
        $taskid = $this->isP('task_id', '请选择您要提交的任务');
        $task = \Model\Content::findContent('task', $taskid, 'task_id');
        if(empty($task)){
            $this->error('任务不存在');
        }
        $auth = \Model\Task::actionAuth($taskid);
        if($auth['action'] === false){
            $this->error('您没有权限发表本任务动态');
        }
        $_POST['user_id'] = (string) $_SESSION['team']['user_id'];
        $_POST['createtime'] = (string) date('Y-m-d H:i');
        parent::action($jump, $commit);

        $content = $this->p('content');
        $url = $this->url('Team-Task-view', ['id' => $task['task_id']]);
        \Model\Report::addReport("{$_SESSION['team']['user_name']}填写了任务<a href=\"{$url}\">《{$task['task_title']}》</a>的动态：{$content}");

        $this->success('发表任务动态成功!');

    }

}