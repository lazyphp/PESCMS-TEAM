<?php

namespace App\Team\POST;

/**
 * 公用内容插入
 */
class Task extends \App\Team\Common {

    public function action() {
        //创建任务的uid,此处必须注意，$_POST的信息必定是字符串
        $_POST['create_id'] = (string) $_SESSION['team']['user_id'];
        //进行一些基础表单信息入库
        $this->db()->transaction();
        $addResult = \Model\Content::addContent();
        if ($addResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($addResult['mes']);
        }

        //生成任务站内通知,accept_id为1表示本部门，反之需要部门责任人审核任务
        if ($_POST['accept_id'] == '1') {
            $sendNoticeResult = \Model\Notice::addNotice($_POST['user_id'], $addResult['mes'], '1', $_POST['mail']);
            if ($sendNoticeResult == false) {
                $this->db()->rollBack();
                $this->error('生成新任务通知失败');
            }
        } else {
            $department = \Model\Content::findContent('department', $_POST['department_id'], 'department_id');
            if (empty($department['department_header'])) {
                $this->db()->rollBack();
                $this->error('该部门没有负责人，无法创建任务');
            }
            $department_header = explode(',', $department['department_header']);

            foreach ($department_header as $v) {
                $sendNoticeResult = \Model\Notice::addNotice($v, $addResult['mes'], '5', $_POST['mail']);
                if ($sendNoticeResult == false) {
                    $this->db()->rollBack();
                    $this->error('生成部门审核通知失败');
                }
            }
        }

        //添加任务审核人，不论是否设置对应的审核人，部门审核人都将成为审核人之一。
        $checkUserList = empty($department_header) ? explode(',', $_POST['check_user_id']) : array_unique(array_merge_recursive(explode(',', $_POST['check_user_id']), $department_header));

        foreach ($checkUserList as $v) {
            $addCheckResult = $this->db('task_check')->insert(array('task_id' => $addResult['mes'], 'check_user_id' => $v));
            if ($addCheckResult == false) {
                $this->db()->rollBack();
                $this->error('添加审核人失败');
            }

            $sendNoticeResult = \Model\Notice::addNotice($v, $addResult['mes'], '2', $_POST['mail']);
            if ($sendNoticeResult == false) {
                $this->db()->rollBack();
                $this->error('生成指派通知失败');
            }

            \Model\User::setEy($v, '1');
        }

        $addDynamic = \Model\Dynamic::addDynamic($_SESSION['team']['user_id'], $addResult['mes'], '1');
        if (empty($addDynamic)) {
            $this->db()->rollBack();
            $this->error('更新用户动态失败');
        }

        $this->db()->commit();

        if (!empty($_POST['back_url'])) {
            $url = $_POST['back_url'];
        } else {
            $url = $this->url('Team-' . MODULE . '-index');
        }

        $this->success($GLOBALS['_LANG']['CONTENT']['ADD_CONTENT_SUCCESS'], $url);
    }

}
