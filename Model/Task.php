<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Task extends \Core\Model\Model {

    public static $condtion = 'WHERE 1 = 1', $join = '', $param = [], $group = '', $order = 'ORDER BY t.task_submit_time DESC', $page = '10';

    /**
     * 转换条目
     * @param $taskid 任务ID
     * @return string
     */
    public static function changeTaskList($taskid) {
        if (empty($_POST['tasklist'])) {
            return true;
        }

        foreach (explode("\n", $_POST['tasklist']) as $value) {
            if (empty(trim($value))) {
                continue;
            }

            self::db('task_list')->insert(['task_id' => $taskid, 'task_list_content' => htmlspecialchars($value)]);
        }
    }


    /**
     * 插入任务审核人和执行人
     * @param $taskid 任务ID
     * @param $sendNotice 是否发送通知
     */
    public static function insertTaskUser($taskid, $sendNotice = TRUE) {
        //预清除任务审核人/执行人列表
        self::db('task_user')->where('task_id = :task_id')->delete([
            'task_id' => $taskid,
        ]);

        foreach (['1' => 'checkuser', '2' => 'actionuser', '3' => 'actiondepartment'] as $type => $name) {

            foreach (explode(',', $_POST[$name]) as $value) {
                if (empty($value)) {
                    continue;
                }
                if ($type == '3') {
                    $department = \Model\Content::findContent('department', $value, 'department_id');
                    if (empty($department['department_header'])) {
                        self::db()->rollback();
                        self::error("指派给<{$department['department_name']}>部门目前没有负责人，请添加该部门的负责任后再指派。");
                    }
                }

                $result = self::db('task_user')->insert(['task_id' => $taskid, 'user_id' => $value, 'task_user_type' => $type]);

                if ($result === false) {
                    self::db()->rollback();
                    self::error('记录审核人/执行人时出错');
                }

                //生成系统消息
                if ($sendNotice === false) {
                    continue;
                }
                \Model\Notice::$taskid = $taskid;
                switch ($type) {
                    case '1':
                        \Model\Notice::newNotice($value, $taskid, '2');
                        break;
                    case '2':
                        \Model\Notice::newNotice($value, $taskid, '1');
                        break;
                    case '3':
                        foreach (explode(',', $department['department_header']) as $userid) {
                            \Model\Notice::newNotice($userid, $taskid, '4');
                        }
                        break;
                }
            }
        }

    }

    /**
     * 获取当前用户的执行权限
     * @param $taskid 任务ID
     * @return array 返回一个数组 check => 是否更改/审核任务的权限 action => 是否有操作/回复任务的权限
     */
    public static function actionAuth($taskid) {
        $auth = ['check' => false, 'action' => false, 'department' => false];
        $authList = \Model\Content::listContent(['table' => 'task_user', 'condition' => 'task_id = :task_id', 'param' => ['task_id' => $taskid]]);
        if (empty($authList)) {
            return $auth;
        }

        $userid = self::session()->get('team')['user_id'];
        foreach ($authList as $value) {
            if ($value['task_user_type'] == '1' && $value['user_id'] == $userid) {
                $auth['check'] = true;
            } elseif ($value['task_user_type'] == '2' && $value['user_id'] == $userid) {
                $auth['action'] = true;
            } elseif ($value['task_user_type'] == '3' && $value['user_id'] == self::session()->get('team')['user_department_id']) {

                $department = \Model\Content::findContent('department', self::session()->get('team')['user_department_id'], 'department_id');
                if (in_array(self::session()->get('team')['user_id'], explode(',', $department['department_header']))) {
                    $auth['department'] = true;
                }

            }
        }

        return $auth;

    }


    /**
     * 获取任务状态的标记 默认输出所有
     * @param $status 要查看的状态。
     */
    public static function getTaskStatusMark($status = '') {
        static $statusList = [];
        if (empty($statusList)) {
            $list = \Model\Content::listContent(['table' => 'task_status', 'group' => 'task_status_type', 'order' => 'task_status_type ASC',]);
            foreach ($list as $value) {
                $statusList[$value['task_status_type']] = $value;
            }
        }
        if (empty($status)) {
            return $statusList;
        } else {
            return $statusList[$status];
        }

    }

    /**
     * 获取任务列表
     * @return array
     */
    public static function getTaskList() {
        //@todo 任务排序日后再修复
        $sqlVariable = ['prefix' => self::$modelPrefix, 'join' => self::$join, 'condtion' => self::$condtion, 'group' => self::$group, 'order' => self::$order];
        $sql = "SELECT %s
                FROM {$sqlVariable['prefix']}task AS t
                {$sqlVariable['join']}
                {$sqlVariable['condtion']}
                {$sqlVariable['group']}
                {$sqlVariable['order']}
                ";
        return \Model\Content::quickListContent(['count' => sprintf($sql, 'count(*)'), 'normal' => sprintf($sql, '*'), 'param' => self::$param, 'page' => self::$page, 'style' => ['total' => '', 'first' => '', 'last' => ''], 'LANG' => ['pre' => '&laquo;', 'next' => '&raquo;']]);
    }

    /**
     * 设置获取我的任务筛选条件
     */
    public static function getUserTask($userid) {
        self::$join = " LEFT JOIN " . self::$modelPrefix . "task_user AS tu ON tu.task_id = t.task_id";
        self::$condtion .= ' AND tu.user_id = :user_id AND tu.task_user_type = 2';
        self::$param['user_id'] = $userid;
    }

    /**
     * 对应的任务时效图。主要快速展示整体、个人、项目的新任务与完成任务的时效
     * 本功能，结合任务
     * @param string $day 时效日期，默认为30天
     * @return array
     */
    public static function taskAgingGapFigureLineChart($day = '30') {
        $param = self::$param;

        if (!empty($_GET['begin']) && !empty($_GET['end'])) {
            $param['start'] = strtotime($_GET['begin'] . '00:00:00');
            $param['end'] = strtotime($_GET['end'] . '23:59:59');
        } else {
            $param['start'] = time() - ($day * 86400);
            $param['end'] = time();
        }

        $prefix = self::$modelPrefix;

        $field = ['task_submit_time', 'task_complete_time'];
        $list = [];
        //组装基础的内容
        foreach ($field as $color => $timeField) {
            $sql = "SELECT t.*
                FROM
                {$prefix}task AS t
                " . self::$join . "
                " . self::$condtion . " AND (t.{$timeField} BETWEEN :start AND :end)
                " . self::$group . "
                ORDER BY t.{$timeField} ASC
              ";
            $result = self::db()->getAll($sql, $param);
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    $list['date'][$date] = $date = date('Y-m-d', $value[$timeField]);

                    if (empty($array[$timeField][$date])) {
                        $array[$timeField][$date] = 0;
                    }
                    $array[$timeField][$date]++;
                }
            }
        }

        if (empty($list)) {
            return false;
        }

        /**
         * 重组一次数据，让数据可以直接用于图表
         */
        foreach ($list['date'] as $date) {
            foreach ($field as $key => $timeField) {
                if (empty($array[$timeField][$date])) {
                    $list['list'][$key]['data'][] = 0;
                } else {
                    $list['list'][$key]['data'][] = $array[$timeField][$date];
                }

                switch ($timeField) {
                    case 'task_submit_time':
                        $list['list'][$key]['color'] = '#dd514c';
                        $list['list'][$key]['name'] = '新任务';
                        break;
                    case 'task_complete_time':
                        $list['list'][$key]['color'] = '#5eb95e';
                        $list['list'][$key]['name'] = '已完成任务';
                        break;
                }

            }
        }

        return $list;
    }

}