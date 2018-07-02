<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2016 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
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

}