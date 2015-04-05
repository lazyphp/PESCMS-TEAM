<?php

namespace App\Team\GET;

/**
 * 部门方法
 */
class Task extends Content {

    /**
     * 部门添加/编辑
     */
    public function action() {
        //列出用户
        $userList = \Model\Content::listContent('user');
        $this->assign('user', $userList);
        foreach ($userList as $key => $value) {
            //获取本部门的用户
            if ($value['user_department_id'] == $_SESSION['team']['user_department_id']) {
                $localUser[$value['user_id']] = $value['user_name'];
            }
            //将所有用户放到一个以用户ID的一维数组，方便查找
            $findUser[$value['user_id']] = $value['user_name'];
        }
        $this->assign('localUser', $localUser);
        $this->assign('findUser', $findUser);
        //列出部门
        foreach (\Model\Content::listContent('department') as $key => $value) {
            $department[$value['department_id']] = $value['department_name'];
        }
        $this->assign('department', $department);

        //列出项目
        $project = \Model\Content::listContent('project', array(), '', 'project_listsort ASC, project_id DESC');
        $this->assign('project', $project);

        parent::action();
    }

    /**
     * 查看个人任务列表
     */
    public function my() {
        \Model\Notice::readNotice('1');
        $page = new \Expand\Team\Page;
        $total = count(\Model\Content::listContent('task', array('task_user_id' => $_SESSION['team']['user_id']), 'task_user_id = :task_user_id'));
        $count = $page->total($total);
        $page->handle();
        $list = \Model\Content::listContent('task', array('task_user_id' => $_SESSION['team']['user_id']), 'task_user_id = :task_user_id', 'task_id desc', "{$page->firstRow}, {$page->listRows}");
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 查看任务
     */
    public function view() {
        $task_id = $this->isG('id', '请选择您要查看的任务');
        $content = $this->db('task AS t')->field("t.*, group_concat(tc.check_user_id) AS check_user_id ")->join("{$this->prefix}task_check AS tc ON tc.task_id = t.task_id")->where('t.task_id = :task_id ')->group('t.task_id')->find(array('task_id' => $task_id));

        /**
         * 合并任务所有关于用户的ID
         * task_user_id 不一定存在记录(部门审核)。因此，为空则设置为-1，避免空用户可以查看(尽管不可能有未登录的用户)
         */
        $checkers = explode(',', $content['check_user_id']);
        $eligible = array_unique(array_merge_recursive(array($content['task_create_id'], empty($content['task_user_id']) ? '-1' : $content['task_user_id']), $checkers));

        //开启权限验证，验证发布人，审核人，执行人是否属于本任务
        if ($content['task_read_permission'] == '1' && !in_array($_SESSION['team']['user_id'], $eligible)) {
            $this->error('您没有权限查看本任务');
        }

        //列出所有用户，用于处理外部任务的指派
        $userList = \Model\Content::listContent('user');
        $this->assign('user', $userList);

        //列出任务日志
        $diary = \Model\Content::listContent('task_diary', array('task_id' => $task_id), 'task_id = :task_id', 'diary_id DESC');

        //列出任务补调整充说明
        $supplement = \Model\Content::listContent('task_supplement', array('task_id' => $task_id), 'task_id = :task_id', 'task_supplement_id asc');

        $this->assign('supplement', $supplement);
        $this->assign('diary', $diary);
        $this->assign('checkers', $checkers);
        $this->assign('eligible', $eligible);
        $this->assign($content);
        $this->assign('title', $content['task_title']);
        $this->layout();
    }

}
