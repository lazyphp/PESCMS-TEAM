<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
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