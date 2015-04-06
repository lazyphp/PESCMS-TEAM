<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 报表
 */
class Report extends \Core\Model\Model {

    /**
     * 添加报表
     * @param type $content 表报内容
     * @param type $taskId 任务ID | 主要用于任务日志追加为报表
     * @return type
     */
    public static function addReport($content, $taskId = '') {
        $findReport = \Model\Content::findContent('report', date('Y-m-d'), 'report_date')['report_id'];
        if (empty($findReport)) {
            $findReport = self::db('report')->insert(array('report_date' => date('Y-m-d'), 'user_id' => $_SESSION['team']['user_id'], 'department_id' => $_SESSION['team']['user_department_id']));
        }

        if (!empty($taskId)) {
            $task = \Model\Content::findContent('task', $taskId, 'task_id');
            $data['task_id'] = $task['task_id'];
            $data['task_title'] = $task['task_title'];
            $data['task_status'] = $task['task_status'];
        }

        $data['report_id'] = $findReport;
        $data['report_content'] = $content;
        return $report_content = self::db('report_content')->insert($data);
    }

}
