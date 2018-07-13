<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

class Index extends \Core\Controller\Controller {

    /**
     * 系统首页
     */
    public function index() {
        $today = strtotime(date('Y-m-d') . ' 00:00:00');
        $statistics = [];

        $yesterday = $today - 86400;
        foreach ([
                     'total' => ' AND t.task_status < 10',
                     'today' => " AND t.task_submit_time >= {$today}",
                     'yesterday' => " AND t.task_submit_time BETWEEN {$yesterday}  AND {$today} ",
                     'overdue' => ' AND t.task_status < 2 AND t.task_end_time < ' . time(),
                     'complete' => ' AND t.task_status = 3',
                 ] as $key => $condition) {
            $result = $this->db('task AS t')->field('count(t.task_id) AS statistics')->join("{$this->prefix}task_user AS tu ON tu.task_id = t.task_id")->where("tu.user_id = :user_id AND task_user_type = 2 {$condition}")->find([
                'user_id' => $this->session()->get('team')['user_id']
            ]);
            $statistics[$key] = $result['statistics'];
        }

        //添加时效图
        \Model\Task::getUserTask($this->session()->get('team')['user_id']);
        $this->assign('aging', \Model\Task::taskAgingGapFigureLineChart());
        $this->assign('statistics', $statistics);

        //公告栏
        $this->assign('bulletin', \Model\Content::listContent(['table' => 'bulletin', 'order' => 'bulletin_listsort ASC, bulletin_id DESC', 'limit' => '8']));
        $this->layout();

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
    public function notice(){
        $system = \Core\Func\CoreFunc::$param['system'];
        if (in_array($system['notice_way'], ['1', '3'])) {
            \Model\Notice::actionNoticeSend();
        }
    }

}
