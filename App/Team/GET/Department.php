<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2015 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */
namespace App\Team\GET;

class Department extends Content{

    public function __init(){
        $this->assign('user', json_encode(\Model\Content::listContent([
            'table' => 'user',
            'field' => 'user_id, user_name',
            'condition' => 'user_status = 1'
        ])));
        parent::__init();
    }

    /**
     * 部门数据分析
     */
    public function analyze(){
        $this->assign('title', '部门数据分析');
        $this->assign('list', \Model\UserAndDepartment::analyze([
            'field' => 'd.department_id AS id, d.department_name AS name, t.task_status, COUNT(t.task_status) AS total ',
            'group' => 'd.department_id, t.task_status'
        ]));
        $this->layout('User/User_analyze');
    }

}