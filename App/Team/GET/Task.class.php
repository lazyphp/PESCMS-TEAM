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
     * 全体任务列表
     */
    public function index() {
        $condition = "task_delete = 0 ";
        $param = array();
        $title = "全体任务列表";
        //筛选任务状态类型
        $type = $this->g('type');
        if ($type >= '0') {
            $condition .= " AND task_status = :task_status";
            $param['task_status'] = $type;
        }

        //筛选任务项目
        $project = $this->g('project');
        if ($project > '0') {
            $condition .= " AND task_project = :task_project ";
            $param['task_project'] = $project;
            $title = "项目[" . \Model\Content::findContent('project', $project, 'project_id')['project_title'] . "]任务列表";
        }

        //筛选任务部门
        $departmengt = $this->g('department');
        if ($departmengt > '0') {
            $condition .= " AND task_department_id = :task_department_id ";
            $param['task_department_id'] = $departmengt;
            $title = "部门" . \Model\Content::findContent('department', $departmengt, 'department_id')['department_name'] . "任务列表";
        }

        //筛选任务执行人
        $user = $this->g('user');
        if ($user > '0') {
            $condition .= " AND task_user_id = :task_user_id ";
            $param['task_user_id'] = $user;
            $title = "用户" . \Model\Content::findContent('user', $user, 'user_id')['user_name'] . "的任务列表";
        }

        //搜索 
        if (!empty($_GET['search'])) {
            $condition .= " AND task_title LIKE :task_title";
            $param['task_title'] = '%' . $this->g('search') . '%';
        }

        //审核和完成的任务，按照ID倒序则可
        if (in_array($type, array('2', '4'))) {
            $order = "task_id DESC";
        } else {
            $order = "task_priority ASC, task_status ASC, task_id DESC";
        }

        $page = new \Expand\Team\Page;
        $total = count(\Model\Content::listContent('task', $param, $condition));
        $count = $page->total($total);
        $page->handle();
        $list = \Model\Content::listContent('task', $param, $condition, $order, "{$page->firstRow}, {$page->listRows}");
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', $title);
        $this->layout('Task_index');
    }

    /**
     * 查看个人任务列表
     */
    public function my() {
        $condition = "task_user_id = :task_user_id AND task_delete = 0 ";
        $param = array('task_user_id' => $_SESSION['team']['user_id']);
        $type = $this->g('type');
        if ($type >= '0') {
            $condition .= " AND task_status = :task_status";
            $param['task_status'] = $type;
        }

        //搜索
        if (!empty($_GET['search'])) {
            $condition .= " AND task_title LIKE :task_title";
            $param['task_title'] = '%' . $this->g('search') . '%';
        }

        //设置系统消息已读
        switch ($type) {
            case '0':
                \Model\Notice::readNotice('1');
                break;
            case '3':
                \Model\Notice::readNotice('4');
                break;
            case '4':
                \Model\Notice::readNotice('6');
                break;
        }

        //审核和完成的任务，按照ID倒序则可
        if (in_array($type, array('2', '4'))) {
            $order = "task_id DESC";
        } else {
            $order = "task_priority ASC, task_status ASC, task_id DESC";
        }

        $page = new \Expand\Team\Page;
        $total = count(\Model\Content::listContent('task', $param, $condition));
        $count = $page->total($total);
        $page->handle();
        $list = \Model\Content::listContent('task', $param, $condition, $order, "{$page->firstRow}, {$page->listRows}");
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout('Task_index');
    }

    /**
     * 待我审核/指派的任务
     */
    public function check() {
        $condition = "t.task_delete = 0 AND tc.check_user_id = :check_user_id ";
        $param = array('check_user_id' => $_SESSION['team']['user_id']);

        $type = $this->g('type');
        if ($type >= '0') {
            $condition .= " AND t.task_status = :task_status";
            $param['task_status'] = $type;
            $order = "t.task_priority ASC, t.task_status ASC, t.task_id DESC";
        }
        
        //搜索
        if (!empty($_GET['search'])) {
            $condition .= " AND t.task_title LIKE :task_title";
            $param['task_title'] = '%' . $this->g('search') . '%';
        }

        //设置系统消息已读
        switch ($type) {
            case '0':
                \Model\Notice::readNotice('2');
                break;
            case '2':
                \Model\Notice::readNotice('3');
                break;
        }

        //待指派的任务执行人ID为空且是当前用户部门的
        if (!empty($_GET['user_type'])) {
            $condition .= " AND t.task_user_id = '' AND t.task_department_id = :task_department_id ";
            $param['task_department_id'] = $_SESSION['team']['user_department_id'];
            \Model\Notice::readNotice('5');
        }

        $page = new \Expand\Team\Page;
        $total = count($this->db('task AS t')->field("t.*")->join("{$this->prefix}task_check AS tc ON tc.task_id = t.task_id")->where($condition)->order($order)->group('t.task_id')->select($param));
        $count = $page->total($total);
        $page->handle();
        $list = $this->db('task AS t')->field("t.*")->join("{$this->prefix}task_check AS tc ON tc.task_id = t.task_id")->where($condition)->order($order)->group('t.task_id')->limit("{$page->firstRow}, {$page->listRows}")->select($param);
        $show = $page->show();

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout('Task_index');
    }

    /**
     * 查看任务
     */
    public function view() {
        $task_id = $this->isG('id', '请选择您要查看的任务');
        $content = $this->db('task AS t')->field("t.*, group_concat(tc.check_user_id) AS check_user_id ")->join("{$this->prefix}task_check AS tc ON tc.task_id = t.task_id")->where('t.task_id = :task_id AND task_delete = 0 ')->group('t.task_id')->find(array('task_id' => $task_id));
        if (empty($content)) {
            $this->error('任务不存在');
        }

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
