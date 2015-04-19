<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class Task extends \App\Team\Common {

    /**
     * 部门负责人指派内部人员任务
     */
    public function accept() {
        $data['noset']['task_id'] = $this->isP('task_id', '请选择任务');
        $task = \Model\Content::findContent('task', $data['noset']['task_id'], 'task_id');
        if (empty($task) || $task['task_delete'] == '1') {
            $this->error('任务不存在');
        }

        $label = new \Expand\Label();
        if (!in_array($_SESSION['team']['user_id'], explode(',', $label->findDepartment('department', 'department_id', $task['task_department_id'])['department_header']))) {
            $this->error('您不是部门负责人，不能进行指派');
        }

        $data['task_user_id'] = $this->isP('task_user_id', '请选择指派的人');
        $this->db()->transaction();
        $setAccept = $this->db('task')->where('task_id = :task_id')->update($data);
        if (empty($setAccept)) {
            $this->db()->rollBack();
            $this->error('设置指派失败');
        }
        $addNotice = \Model\Notice::addNotice($data['task_user_id'], $data['noset']['task_id'], '1', $task['task_mail']);
        if (empty($addNotice)) {
            $this->db()->rollBack();
            $this->error('生成新任务通知出错');
        }

        $this->db()->commit();

        $this->success('设置指派成功!', $this->url('Team-Task-view', array('id' => $data['noset']['task_id'])));
    }

    /**
     * 执行任务
     */
    public function begin() {
        $data['noset']['task_id'] = $this->isP('task_id', '请选择任务');
        $task = \Model\Content::findContent('task', $data['noset']['task_id'], 'task_id');
        if (empty($task) || $_SESSION['team']['user_id'] != $task['task_user_id'] || $task['task_delete'] == '1') {
            $this->error('任务不存在或者您不是本任务执行人');
        }

        $data['task_estimatetime'] = strtotime($this->isP('task_estimatetime', '请选择任务预计时间'));
        $data['task_status'] = '1';
        $this->db()->transaction();

        $result = $this->db('task')->where('task_id = :task_id')->update($data);
        if (empty($result)) {
            $this->db()->rollBack();
            $this->error('设置任务开始失败');
        }

        $addDynamic = \Model\Dynamic::addDynamic($_SESSION['team']['user_id'], $data['noset']['task_id'], '2');
        if (empty($addDynamic)) {
            $this->db()->rollBack();
            $this->error('更新用户动态失败');
        }

        \Model\User::setEy($_SESSION['team']['user_id'], '1');

        $this->db()->commit();

        $this->success('任务已开始，请在指定时间内完成!', $this->url('Team-Task-view', array('id' => $data['noset']['task_id'])));
    }

    /**
     * 提交任务日志
     */
    public function diary() {
        $data['task_id'] = $this->isP('task_id', '请选择任务');
        $task = \Model\Content::findContent('task', $data['task_id'], 'task_id');

        if (empty($task) || $_SESSION['team']['user_id'] != $task['task_user_id'] || $task['task_delete'] == '1') {
            $this->error('任务不存在或者您不是本任务执行人');
        }

        $data['diary_content'] = $this->isP('content', '请填写任务日志');
        $data['diary_time'] = time();

        $this->db()->transaction();
        $addResult = $this->db('task_diary')->insert($data);
        if (empty($addResult)) {
            $this->db()->rollBack();
            $this->error('添加日志失败');
        }

        //追加为报表

        if (!\Model\Report::addReport($data['diary_content'], $task['task_id'])) {
            $this->db()->rollBack();
            $this->error('添加报表失败');
        }

        $this->db()->commit();

        $this->success('发表任务日志成功!', $this->url('Team-Task-view', array('id' => $data['task_id'])));
    }

    /**
     * 更改任务状态
     */
    public function check() {
        $data['noset']['task_id'] = $this->isP('task_id', '请选择任务');
        $task = $this->db('task AS t')->field("t.*, group_concat(tc.check_user_id) AS check_user_id ")->join("{$this->prefix}task_check AS tc ON tc.task_id = t.task_id")->where('t.task_id = :task_id ')->group('t.task_id')->find(array('task_id' => $data['noset']['task_id']));

        if (empty($task) || $task['task_delete'] == '1') {
            $this->error('任务不存在');
        }

        $checker = explode(',', $task['check_user_id']);
        $data['task_status'] = empty($_POST['task_status']) ? '2' : $this->p('task_status');

        $this->db()->transaction();
        switch ($data['task_status']) {
            case '2':
                if ($_SESSION['team']['user_id'] != $task['task_user_id']) {
                    $this->error('您不是本任务执行人');
                }
                $noticeUser = $checker;
                $noticeType = '3';
                $dynamicType = '3';
                //提交审核，增加EY值
                \Model\User::setEy($_SESSION['team']['user_id'], '1');
                break;
            case '3':
            case '4':
                if (!in_array($_SESSION['team']['user_id'], $checker)) {
                    $this->error('您没有权限处理本任务');
                }
                $noticeUser = array($task['task_user_id']);
                $noticeType = $data['task_status'] == '3' ? '4' : '6';
                $dynamicType = $data['task_status'] == '3' ? '' : '4';

                $eyValue = $data['task_status'] == '3' ? '-2' : '1';
                \Model\User::setEy($task['task_user_id'], $eyValue);

                break;
            default :
                $this->error('未知的任务状态');
        }

        //每个状态变更，都表示一个完成时间
        $data['task_completetime'] = time();
        $updateResultt = $this->db('task')->where('task_id = :task_id')->update($data);
        if (empty($updateResultt)) {
            $this->db()->rollBack();
            $this->error('提交任务失败');
        }

        //状态为3需要判断是否有任务补充说明提交
        if ($data['task_status'] == 3) {
            $supplement['task_id'] = $data['noset']['task_id'];
            $supplement['task_supplement_content'] = $this->p('content');
            $supplement['task_supplement_file'] = !empty($_POST['file']) && is_array($_POST['file']) ? implode(',', $_POST['file']) : '';
            $supplement['task_supplement_time'] = time();
            if (!empty($supplement['task_supplement_content']) || !empty($supplement['task_supplement_file'])) {
                $addSupplement = $this->db('task_supplement')->insert($supplement);
                if (empty($addSupplement)) {
                    $this->db()->rollBack();
                    $this->error('添加任务补充说明失败');
                }
            }
        }

        //生成系统消息
        foreach ($noticeUser as $value) {
            $sendNotice = \Model\Notice::addNotice($value, $data['noset']['task_id'], $noticeType, $task['task_mail']);
            if (empty($sendNotice)) {
                $this->db()->rollBack();
                $this->error('生成系统消息出错!');
            }
        }

        //生成个人动态
        if (!empty($dynamicType)) {
            $addDynamic = \Model\Dynamic::addDynamic($task['task_user_id'], $data['noset']['task_id'], $dynamicType);
            if (empty($addDynamic)) {
                $this->db()->rollBack();
                $this->error('更新用户动态失败');
            }
        }


        $this->db()->commit();
        $this->success('任务状态已更新!', $this->url('Team-Task-view', array('id' => $data['noset']['task_id'])));
    }

}
