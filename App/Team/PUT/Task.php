<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Team\PUT;

class Task extends Content {

    /**
     * 更新任务内容
     */
    public function action($jump = FALSE, $commit = FALSE) {
        $taskid = $this->isP('id', '请提交您要编辑内容的任务');
        $checkTask = \Model\Content::findContent('task', $taskid, 'task_id');
        if (empty($checkTask)) {
            $this->error('任务不存在');
        }
        $auth = \Model\Task::actionAuth($taskid);
        if ($auth['check'] === FALSE) {
            $this->error('您没有权限操作本任务');
        }
        if (empty($_POST['actionuser']) && empty($_POST['actiondepartment'])) {
            $this->error('任务不能没有执行者，请选择');
        }

        //预设值
        $_POST['submit_time'] = (string)date('Y-m-d H:i:s', $checkTask['task_submit_time']);
        $_POST['multiplayer'] = (string)$checkTask['task_multiplayer'];
        $_POST['create_id'] = (string)$checkTask['task_create_id'];
        $_POST['content'] = empty($_POST['content']) ? '发布者非常懒！还没填写详细说明！' : $_POST['content'];

        parent::action($jump, $commit);

        //更新执行人、审核人、部门指派
        \Model\Task::insertTaskUser($taskid, FALSE);

        $this->db()->commit();

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
            'task_user_id'   => $this->session()->get('team')['user_id'],
            'task_list_time' => time(),
            'noset'          => [
                'task_list_id' => $taskListID,
            ],
        ]);

        if ($update === FALSE) {
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
        $task = \Model\Content::findContent('task', $data['noset']['task_id'], 'task_id');

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
        } elseif (in_array($data['task_status'], ['3', '10']) && $auth['check'] === TRUE) {
            //触发重复任务属性
            $this->repeatTask($task);
        }
        //@todo end


        $update = $this->db('task')->where('task_id = :task_id')->update($data);


        if ($update === FALSE) {
            $this->error('更改任务状态失败!任务状态可能没有变更或者任务不存在');
        }

        //生成系统通知
        if ($data['task_status'] == '2') {
            \Model\Notice::accordingTaskUserToaddNotice($data['noset']['task_id'], '1', '3');
        }

        //自动生成报表
        if ($auth['action'] === TRUE) {
            $url = $this->url('Team-Task-view', ['id' => $task['task_id']]);
            \Model\Report::addReport("{$this->session()->get('team')['user_name']}将任务<a href=\"{$url}\">《{$task['task_title']}》</a>状态变更为：{$statusMark['task_status_name']}。");
        }

        $this->success('更改任务状态成功!');

    }

    /**
     * 执行重复任务动作
     * @description 重复的任务是不会重复生成任务条目和追加内容
     * @param array $task
     */
    private function repeatTask(array $task) {
        if ($task['task_repeat'] <= 0) {
            return TRUE;
        }
        $data = [];
        foreach ($task as $key => $value) {
            if (in_array($key, ['task_id', 'task_status', 'task_delete', 'task_complete_time'])) {
                continue;
            } elseif ($key == 'task_submit_time' || $key == 'task_start_time') {
                $data[$key] = $task['task_end_time'] < time() ? time() : $task['task_end_time'];
            } elseif ($key == 'task_end_time') {
                $data[$key] = $task['task_end_time'] < time() ? time() + 86400 * $task['task_repeat'] : $task['task_end_time'] + 86400 * $task['task_repeat'];
            } else {
                $data[$key] = $value;
            }
        }
        $newTaskid = $this->db('task')->insert($data);

        $taskUser = $this->db('task_user')->where('task_id = :task_id')->select([
            'task_id' => $task['task_id'],
        ]);

        foreach ($taskUser as $value) {
            $this->db('task_user')->insert([
                'task_id'        => $newTaskid,
                'user_id'        => $value['user_id'],
                'task_user_type' => $value['task_user_type'],
            ]);
        }

    }

    /**
     * 任务的部门成员指派
     * @description 指派部门成员后，部门负责人会自动成为任务的审核者。而部门指派的能力将被移除
     */
    public function department() {
        $taskid = $this->isP('task_id', '请提交您要编辑内容的任务');
        $user = $this->isP('user', '请提交您要指派的部门成员');

        $auth = \Model\Task::actionAuth($taskid);
        if ($auth['department'] === FALSE) {
            $this->error('您没有指派部门成员的权限');
        }

        //获取部门负责人
        $department = \Model\Content::findContent('department', $this->session()->get('team')['user_department_id'], 'department_id');

        $this->db()->transaction();

        $removeDepart = $this->db('task_user')->where(' task_id = :taskid AND user_id = :department AND task_user_type = 3')->delete(['taskid' => $taskid, 'department' => $this->session()->get('team')['user_department_id']]);
        if ($removeDepart === FALSE) {
            $this->db()->rollback();
            $this->error('移出部门指派权限出错');
        }

        \Model\Notice::$taskid = $taskid;
        //部门负责人成为本任务的审核者
        foreach (explode(',', $department['department_header']) as $value) {
            $department_header = trim($value);
            $this->db('task_user')->insert([
                'task_id'        => $taskid,
                'user_id'        => $department_header,
                'task_user_type' => '1',
            ]);
            \Model\Notice::newNotice($value, $taskid, '2');
        }

        //被指派的人员成为本任务的执行者。
        foreach ($user as $value) {
            $this->db('task_user')->insert([
                'task_id'        => $taskid,
                'user_id'        => $value,
                'task_user_type' => '2',
            ]);
            \Model\Notice::newNotice($value, $taskid, '1');
        }

        $this->db()->commit();

        $this->success('完成部门指派!');


    }
}