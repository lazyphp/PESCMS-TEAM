<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Team\GET;

/**
 * 部门方法
 */
class Task extends Content {

    private $statusMark, $sidebar = ['search'];

    public function __init() {
        parent::__init();
        //任务状态，因为切片已经赋值了模板状态变量，此处直接从模板变量借来的
        $this->statusMark = \Core\Func\CoreFunc::$param['statusMark'];
        if (empty($_GET['status'])) {
            $_GET['status'] = '0';
        }
        if (in_array($_GET['status'], array_keys($this->statusMark))) {
            \Model\Task::$condtion .= ' AND t.task_status = :task_status ';
            \Model\Task::$param['task_status'] = $_GET['status'];
            if($_GET['status'] == 3){
                \Model\Task::$order = 'ORDER BY task_complete_time DESC';
            }

        }
        //状态为666的，表示任务逾期的
        if ($_GET['status'] == '666') {
            \Model\Task::$condtion .= ' AND t.task_end_time < :time AND t.task_status < 2';
            \Model\Task::$param['time'] = time();
        }

        if (!empty($_GET['k'])) {
            \Model\Task::$condtion .= ' AND (t.task_title LIKE :task_title OR t.task_id LIKE :task_id)';
            \Model\Task::$param['task_title'] = \Model\Task::$param['task_id'] = '%' . $this->g('k') . '%';
        }

        //依据时间搜索
        if (!empty($_GET['begin']) && !empty($_GET['end'])) {
            if ((int)$_GET['time_type'] == '2') {
                $timeField = 'task_start_time';
            } elseif ((int)$_GET['time_type'] == '3') {
                $timeField = 'task_end_time';
            } elseif ((int)$_GET['time_type'] == '4') {
                $timeField = 'task_complete_time';
            } else {
                $timeField = 'task_submit_time';
            }

            \Model\Task::$condtion .= " AND t.{$timeField} BETWEEN :search_begin AND :search_end ";
            \Model\Task::$param['search_begin'] = strtotime($_GET['begin'] . '00:00:00');
            \Model\Task::$param['search_end'] = strtotime($_GET['end'] . '23:59:59');
        }

        $this->assign('sidebar', $this->sidebar);

        $this->assign('title_icon', \Model\Menu::getTitleWithMenu()['menu_icon'] ?? null);

    }

    /**
     * 任务列表
     * @param string $theme 调用的模板
     */
    public function index($display = true) {
        $result = \Model\Task::getTaskList();

        $this->sidebar[] = 'bulletin';

        //状态为所有时，将显示时效图
        if ($_GET['status'] == '233') {
            $this->sidebar[] = 'aging';
            $this->assign('aging', \Model\Task::taskAgingGapFigureLineChart());
        }

        $this->assign('bulletin', \Model\Content::listContent(['table' => 'bulletin', 'order' => 'bulletin_listsort ASC, bulletin_id DESC', 'limit' => '5']));

        $this->assign('sidebar', $this->sidebar);


        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);
        $this->layout('Task_index');
    }

    /**
     * 个人任务
     */
    public function my() {
        \Model\Task::getUserTask($this->session()->get('team')['user_id']);
        $this->index();
    }

    /**
     * 我创建的项目
     * @return void
     */
    public function create(){
        \Model\Task::$condtion .= ' AND t.task_create_id = :task_create_id ';
        \Model\Task::$param['task_create_id'] = $this->session()->get('team')['user_id'];
        $this->index();
    }

    /**
     * 查看指定项目的任务列表
     */
    public function project() {
        $id = $this->isG('id', '请选择您要查看的项目');
        $project = \Model\Content::findContent('project', $id, 'project_id');
        if (empty($project)) {
            $this->error('该项目不存在');
        }
        $this->sidebar[] = 'project';
        $this->assign($project);
        \Model\Task::$condtion .= ' AND task_project_id = :task_project_id';
        \Model\Task::$param['task_project_id'] = $id;
        $this->assign('title', "{$project['project_title']}的项目信息");
        $this->index();
    }


    /**
     * 任务看板
     */
    public function myCard() {
        //@todo 默认输出9999条，详细应该没人达到这么可怕的地步吧？
        \Model\Task::$page = 9999;
        $list = [];
        foreach ($this->statusMark as $statusid => $value) {

            \Model\Task::$condtion = 'WHERE t.task_status = :task_status';
            \Model\Task::$param = ['task_status' => $statusid];

            //完成状态的任务看板，仅列出当天完成的。
            if ($statusid == '3') {
                \Model\Task::$condtion .= ' AND task_complete_time >= :today';
                \Model\Task::$param['today'] = strtotime(date('Y-m-d 00:00:00'));
            }

            //@todo 排序需要进一步优化
            \Model\Task::$order = 'ORDER BY task_submit_time DESC';

            \Model\Task::getUserTask($this->session()->get('team')['user_id']);
            $list[$statusid] = $value;
            $list[$statusid]['task'] = \Model\Task::getTaskList()['list'];
        }

        $this->assign('list', $list);

        $this->display();
    }

    /**
     * 等待审核的任务列表
     */
    public function check() {
        \Model\Task::$condtion = '';
        \Model\Task::$join = " LEFT JOIN {$this->prefix}task_user AS tu ON tu.task_id = t.task_id";
        \Model\Task::$condtion = 'WHERE t.task_status = 2 AND tu.user_id = :user_id AND tu.task_user_type = 1';
        \Model\Task::$param = ['user_id' => $this->session()->get('team')['user_id']];

        $result = \Model\Task::getTaskList();
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);
        $this->layout('Task_index');
    }

    /**
     * 重复任务管理
     */
    public function repeat() {
        \Model\Task::$condtion = '';
        \Model\Task::$join = " LEFT JOIN {$this->prefix}task_user AS tu ON tu.task_id = t.task_id";
        \Model\Task::$condtion = 'WHERE t.task_status NOT IN (3, 10) AND tu.user_id = :user_id AND tu.task_user_type = 1 AND t.task_repeat > 0';
        \Model\Task::$param = ['user_id' => $this->session()->get('team')['user_id']];

        $result = \Model\Task::getTaskList();
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);
        $this->assign('sidebar', ['bulletin']);
        $this->layout();
    }

    /**
     * 部门指派列表
     */
    public function department() {
        $department = \Model\Content::findContent('department', $this->session()->get('team')['user_department_id'], 'department_id');

        if (empty($department['department_header'])) {
            $this->error('您的部门还没有指派负责人，联系管理员进行设置');
        }

        if (!in_array($this->session()->get('team')['user_id'], explode(',', $department['department_header']))) {
            $this->error('您不是本部门的负责人，无法访问本页面');
        }

        \Model\Task::$condtion = '';
        \Model\Task::$join = " LEFT JOIN {$this->prefix}task_user AS tu ON tu.task_id = t.task_id";
        \Model\Task::$condtion = 'WHERE tu.user_id = :department AND tu.task_user_type = 3';
        \Model\Task::$param = ['department' => $this->session()->get('team')['user_department_id']];
        $result = \Model\Task::getTaskList();
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);
        $this->layout('Task_index');
    }

    /**
     * 查看任务
     */
    public function view() {
        $taskid = $this->isG('id', '请选择您要查看的任务ID');
        $task = \Model\Content::findContent('task', $taskid, 'task_id');
        if (empty($task)) {
            $this->error('任务不存在');
        }

        //验证权限
        $actionAuth = \Model\Task::actionAuth($taskid);
        if ($task['task_read_permission'] == '1' && $actionAuth['check'] == FALSE && $actionAuth['action'] == FALSE && $actionAuth['department'] == FALSE) {
            $this->error('当前任务您没有查阅的权限');
        }

        $param['task_id'] = $taskid;

        //任务追加内容
        $supplement = \Model\Content::listContent(['table' => 'task_supplement', 'condition' => 'task_supplement_task_id = :task_id', 'param' => $param]);

        //任务条目
        $taskList = \Model\Content::listContent(['table' => 'task_list', 'condition' => 'task_id = :task_id', 'param' => $param]);

        //任务动态
        $dynamice = \Model\Content::listContent(['table' => 'task_dynamic', 'condition' => 'task_dynamic_task_id = :task_id', 'order' => 'task_dynamic_createtime DESC', 'param' => $param]);

        $this->assign('supplement', $supplement);
        $this->assign('dynamice', $dynamice);
        $this->assign('taskList', $taskList);

        //获取审核人和执行人的信息
        $userAccessList = \Model\Content::listContent([
            'table' => 'task_user AS t',
            'field' => 't.*, u.user_name, u.user_head',
            'join' => "{$this->prefix}user AS u ON u.user_id = t.user_id",
            'condition' => 't.task_id = :task_id AND t.task_user_type in (1,2)',
            'param' => $param
        ]);


        $userAccessList = array_merge($userAccessList, \Model\Content::listContent([
            'table' => 'task_user AS t',
            'field' => 't.*, d.department_name',
            'join' => "{$this->prefix}department AS d ON d.department_id = t.user_id",
            'condition' => 't.task_id = :task_id AND t.task_user_type = 3',
            'param' => $param
        ]));
        //将与指派部门合并为一个数组输出
        $this->assign('userAccessList', $userAccessList);

        //审核人显示编辑模式的必要信息
        if ($actionAuth['check'] == true) {

            $actionUser = [];
            foreach ($userAccessList as $key => $value) {
                $actionUser[$value['task_user_type']][] = $value['user_id'];
            }
            $this->assign('actionUser', $actionUser);

            parent::action(FALSE);
        }

        $this->formDate();



        //更新已读状态
        \Model\Notice::readNotice('AND notice_task_id = :notice_task_id', [
            'notice_read' => '1',
            'noset' => [
                'notice_task_id' => $taskid,
                'notice_user_id' => $this->session()->get('team')['user_id']
            ]
        ]);

        $this->assign('actionAuth', $actionAuth);

        $this->assign('project', \Model\Content::listContent(['table' => 'project', 'order' => 'project_id DESC, project_listsort ASC']));
        $this->assign($task);
        $this->assign('title', $task['task_title']);
        $this->layout();
    }


    /**
     * 发表任务
     */
    public function action($display = true) {
        //任务发表后，不允许进入编辑页面
        if (!empty($_GET['id'])) {
            header('Location:' . $this->url('Team-Task-action'));
        }
        $this->formDate();
        parent::action();
    }

    /**
     * 表单数据
     */
    private function formDate() {
        $userList = \Model\Content::listContent([
            'table' => 'user AS u',
            'field' => 'u.user_id, u.user_name, u.user_department_id, d.department_name',
            'join' => "{$this->prefix}department AS d ON d.department_id = u.user_department_id",
            'condition' => 'u.user_status = 1',
            'order' => 'd.department_listsort DESC, u.user_id ASC'
        ]);
        $user = [];
        foreach ($userList as $value) {
            $user['list'][$value['user_id']] = "{$value['department_name']} - {$value['user_name']}";
            if ($value['user_department_id'] == $this->session()->get('team')['user_department_id']) {
                $user['department'][$value['user_id']] = $value['user_name'];
            }
        }

        $this->assign('user', $user);

        $department = \Model\Content::listContent(['table' => 'department', 'order' => 'department_listsort ASC, department_id DESC']);
        $this->assign('department', $department);
    }


}
