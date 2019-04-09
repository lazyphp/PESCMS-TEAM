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
        $condition = '';
        $param = [];
        if(!empty($_GET['id'])){
            $condition .= ' AND user_department_id = :user_department_id ';
            $param['user_department_id'] = $this->g('id');
        }

        $this->assign('user', json_encode(\Model\Content::listContent([
            'table' => 'user',
            'field' => 'user_id, user_name',
            'condition' => "user_status = 1 {$condition} ",
            'param' => $param
        ])));
        parent::__init();
    }

    /**
     * 部门数据分析
     */
    public function analyze(){
        $this->assign('title', '部门数据分析');

        $list = [];
        $department = \Model\Content::listContent(['table' => 'department', 'order' => 'department_listsort ASC, department_id DESC']);
        foreach ($department as $item){
            $list[$item['department_id']]['name'] = $item['department_name'];
        }


        $this->assign('list', \Model\UserAndDepartment::analyze([
            'field' => 'd.department_id AS id, d.department_name AS name, t.task_status, COUNT(t.task_status) AS total ',
            'group' => 'd.department_id, t.task_status'
        ], $list));
        $this->layout('User/User_analyze');
    }

}