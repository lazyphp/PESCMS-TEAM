<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Team\GET;

class Index extends \Core\Controller\Controller {

    /**
     * 系统首页
     */
    public function index() {
        $this->statistics();
        $this->tasks();
        //公告栏
        $this->assign('bulletin', \Model\Content::listContent(['table' => 'bulletin', 'order' => 'bulletin_listsort ASC, bulletin_id DESC', 'limit' => '8']));
        $this->layout();

    }

    /**
     * 基础统计信息
     * @return void
     */
    private function statistics() {
        $today = strtotime(date('Y-m-d') . ' 00:00:00');
        $statistics = [];

        $yesterday = $today - 86400;
        foreach (
            [
                'total'     => ' AND t.task_status < 10',
                'today'     => " AND t.task_submit_time >= {$today}",
                'yesterday' => " AND t.task_submit_time BETWEEN {$yesterday}  AND {$today} ",
                'overdue'   => ' AND t.task_status < 2 AND t.task_end_time < ' . time(),
                'complete'  => ' AND t.task_status = 3',
            ] as $key => $condition) {
            $result = $this->db('task AS t')->field('count(t.task_id) AS statistics')->join("{$this->prefix}task_user AS tu ON tu.task_id = t.task_id")->where("tu.user_id = :user_id AND task_user_type = 2 {$condition}")->find([
                'user_id' => $this->session()->get('team')['user_id']
            ]);
            $statistics[$key] = $result['statistics'];
        }


        $this->assign('statistics', $statistics);
    }

    private function tasks() {
        \Model\Task::getUserTask($this->session()->get('team')['user_id']);
        \Model\Task::$order = 'ORDER BY t.task_priority DESC, t.task_submit_time DESC';
        $tasks = [];

        $initCondition =  \Model\Task::$condtion;
        $initParam = \Model\Task::$param;

        $condition = [
            '逾期任务' => function () use($initCondition, $initParam) {
                \Model\Task::$condtion = $initCondition;
                \Model\Task::$param = $initParam;

                \Model\Task::$condtion .= ' AND t.task_end_time < :time AND t.task_status < 2';
                \Model\Task::$param['time'] = time();

            },
            '我的任务'  => function () use($initCondition, $initParam) {
                \Model\Task::$condtion = $initCondition;
                \Model\Task::$param = $initParam;
                \Model\Task::$condtion .= ' AND t.task_status < 2';

            }
        ];
        foreach ($condition as $name => $func){
            $func();
            $tasks[$name] = \Model\Task::getTaskList()['list'] ?? [];
        }

        $this->assign('tasks', $tasks);

    }

    /**
     * 注销帐号
     */
    public function logout() {
        $this->session()->destroy();
        $this->jump($this->url('Team-Login-index'));
    }

    /**
     * 发送通知
     */
    public function notice() {
        $system = \Core\Func\CoreFunc::$param['system'];
        if (in_array($system['notice_way'], ['1', '3'])) {
            \Model\Notice::actionNoticeSend();
        }
    }

}
