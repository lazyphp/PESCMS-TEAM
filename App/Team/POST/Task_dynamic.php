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
        $_POST['user_id'] = (string) $this->session()->get('team')['user_id'];
        $_POST['createtime'] = (string) date('Y-m-d H:i');
        parent::action($jump, $commit);

        $content = $this->p('content');
        $url = $this->url('Team-Task-view', ['id' => $task['task_id']]);
        \Model\Report::addReport("{$this->session()->get('team')['user_name']}填写了任务<a href=\"{$url}\">《{$task['task_title']}》</a>的动态：{$content}");

        $this->success('发表任务动态成功!');

    }

}