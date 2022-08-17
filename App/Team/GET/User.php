<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace App\Team\GET;

class User extends Content {

    /**
     * 查看用户
     */
    public function view(){
        $id = $this->isG('id', '请选择您要查看的用户');
        $user = \Model\Content::findContent('user', $id, 'user_id');
        if(empty($user)){
            $this->error('不存在的用户');
        }
        $this->assign($user);
        $this->assign('sidebar', [
            'user',
            'aging'
        ]);

        \Model\Task::getUserTask($id);

        $this->assign('aging', \Model\Task::taskAgingGapFigureLineChart());

        $taskResult = \Model\Task::getTaskList();
        $this->assign('list', $taskResult['list']);
        $this->assign('page', $taskResult['page']);
        $this->assign('title', "{$user['user_name']}的用户信息");

        $this->layout('Task/Task_index');
    }

    /**
     * 个人设置
     */
    public function setting(){
        $info = \Model\Content::findContent('user', $this->session()->get('team')['user_id'], 'user_id');
        $this->assign($info);
        $this->assign('title', '账号');
        $this->layout();
    }

    /**
     * 用户数据分析
     */
    public function analyze(){
        $this->assign('title', '用户数据分析');

        $list = [];
        $user = \Model\Content::listContent([
            'table' => 'user AS u',
            'field' => 'u.user_id, u.user_name, d.department_name',
            'join' => "{$this->prefix}department AS d ON d.department_id = u.user_department_id"
        ]);
        foreach ($user as $item){
            $list[$item['user_id']]['name'] = "{$item['user_name']} - {$item['department_name']}";
        }

        $this->assign('list', \Model\UserAndDepartment::analyze([
            'field' => 'u.user_id AS id, t.task_status, COUNT(t.task_status) AS total ',
            'group' => 'u.user_id, t.task_status'
        ], $list));
        $this->layout();
    }

}