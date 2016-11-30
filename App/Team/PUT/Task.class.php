<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2015 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 2.0
 */

namespace App\Team\PUT;

class Task extends Content {

    /**
     * 更新任务内容
     */
    public function action($jump = FALSE, $commit = TRUE) {
        $taskid = $this->isP('id', '请提交您要编辑内容的任务');
        $checkTask = \Model\Content::findContent('task', $taskid, 'task_id');
        if (empty($checkTask)) {
            $this->error('任务不存在');
        }
        $auth = \Model\Task::actionAuth($taskid);
        if ($auth['check'] === false) {
            $this->error('您没有权限操作本任务');
        }

        //预设值
        $_POST['submit_time'] = (string) date('Y-m-d H:i:s', $checkTask['task_submit_time']);
        $_POST['multiplayer'] = (string)$checkTask['task_multiplayer'];
        $_POST['create_id'] = (string)$checkTask['task_create_id'];
        $_POST['content'] = empty($_POST['content']) ? '发布者非常懒！还没填写详细说明！' : $_POST['content'];

        parent::action($jump, $commit);

        //生成系统通知
        \Model\Notice::accordingTaskUserToaddNotice($taskid, '2', '5');

        $this->success('更新任务内容成功!');
    }

    /**
     * 更新任务条目
     */
    public function taskListAction() {
        $taskListID = $this->isG('listid', '请选您要标记的任务条目');
        $update = $this->db('task_list')->where('task_list_id = :task_list_id')->update([
            'task_user_id' => $_SESSION['team']['user_id'],
            'task_list_time' => time(),
            'noset' => [
                'task_list_id' => $taskListID
            ]
        ]);

        if ($update === false) {
            $this->error('该条目标记失败！可能已经被标记或者已删除。');
        }

        $this->success('标记任务条目成功!');

    }

    /**
     * 更改任务状态
     */
    public function status() {
        $data['noset']['task_id'] = $this->isG('task_id', '请提交您要编辑内容的任务');
        $data['task_status'] = $this->isG('status', '请选择您要变更的任务状态');
        if ($data['task_status'] == '3') {
            $data['task_complete_time'] = time();
        }

        //@todo PHP 5.5 empty() now supports expressions, rather than only variables.
        $statusMark = \Model\Task::getTaskStatusMark($data['task_status']);
        if (empty($statusMark)) {
            $this->error('不存在的状态');
        }
        $auth = \Model\Task::actionAuth($data['noset']['task_id']);

        //@todo 此处在下一个版本中将依据自定义状态进行判断 begin
        if ($auth['action'] === FALSE && $auth['check'] === FALSE) {
            $this->error('您没有更改本任务状态的权限');
        }

        if (in_array($data['task_status'], ['3', '10']) && $auth['check'] === FALSE) {
            $this->error('您没有设置任务完成或者关闭任务的权限');
        }
        //@todo end

        $update = $this->db('task')->where('task_id = :task_id')->update($data);
        if ($update === false) {
            $this->error('更改任务状态失败!任务状态可能没有变更或者任务不存在');
        }

        //生成系统通知
        if ($data['task_status'] == '2') {
            \Model\Notice::accordingTaskUserToaddNotice($data['noset']['task_id'], '1', '3');
        }

        //自动生成报表
        if ($auth['action'] === TRUE) {
            $task = \Model\Content::findContent('task', $data['noset']['task_id'], 'task_id');
            $url = $this->url('Team-Task-view', ['id' => $task['task_id']]);
            \Model\Report::addReport("{$_SESSION['team']['user_name']}将任务<a href=\"{$url}\">《{$task['task_title']}》</a>状态变更为：{$statusMark['task_status_name']}。");
        }

        $this->success('更改任务状态成功!');

    }

    /**
     * 任务的部门成员指派
     * @description 指派部门成员后，部门负责人会自动成为任务的审核者。而部门指派的能力将被移除
     */
    public function department() {
        $taskid = $this->isP('task_id', '请提交您要编辑内容的任务');
        $user = $this->isP('user', '请提交您要指派的部门成员');

        $auth = \Model\Task::actionAuth($taskid);
        if ($auth['department'] === false) {
            $this->error('您没有指派部门成员的权限');
        }

        //获取部门负责人
        $department = \Model\Content::findContent('department', $_SESSION['team']['user_department_id'], 'department_id');

        $this->db()->transaction();

        $removeDepart = $this->db('task_user')->where(' task_id = :taskid AND user_id = :department AND task_user_type = 3')->delete(['taskid' => $taskid, 'department' => $_SESSION['team']['user_department_id']]);
        if ($removeDepart === false) {
            $this->db()->rollback();
            $this->error('移出部门指派权限出错');
        }

        \Model\Notice::$taskid = $taskid;
        //部门负责人成为本任务的审核者
        foreach (explode(',', $department['department_header']) as $value) {
            $department_header = trim($value);
            $this->db('task_user')->insert([
                'task_id' => $taskid,
                'user_id' => $department_header,
                'task_user_type' => '1'
            ]);
            \Model\Notice::newNotice($value, '2');
        }

        //被指派的人员成为本任务的执行者。
        foreach ($user as $value) {
            $this->db('task_user')->insert([
                'task_id' => $taskid,
                'user_id' => $value,
                'task_user_type' => '2'
            ]);
            \Model\Notice::newNotice($value, '1');
        }

        $this->db()->commit();

        $this->success('完成部门指派!');


    }
}