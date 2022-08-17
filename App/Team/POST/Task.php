<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Team\POST;

class Task extends Content {

    /**
     * 创建普通类型的任务
     * @param bool|FALSE $jump
     * @param bool|FALSE $commit
     */
    public function action($jump = FALSE, $commit = FALSE) {

        $_POST['create_id'] = (string)$this->session()->get('team')['user_id'];
        $_POST['submit_time'] = (string)date('Y-m-d H:i');

        $this->isP('checkuser', '任务不能没有审核者，请选择');
        if (empty($_POST['actionuser']) && empty($_POST['actiondepartment'])) {
            $this->error('任务不能没有执行者，请选择');
        }


        //多人指派的话，multiplayer值将会为1
        if (
            (is_array($_POST['actionuser']) && count($_POST['actionuser']) > 1) ||
            (is_array($_POST['actiondepartment']) && count($_POST['actiondepartment']) > 1 )
        ) {
            $_POST['multiplayer'] = 1;
        }else{
            $_POST['multiplayer'] = 0;
        }

        parent::action($jump, $commit);

        $taskid = $this->db()->getLastInsert;

        \Model\Task::changeTaskList($taskid);
        \Model\Task::insertTaskUser($taskid);

        $this->db()->commit();

        //跳转至任务列表
        $this->success('新增任务成功！', $this->url('Team-Task-index'));
    }

    /**
     * 添加任务条目
     */
    public function taskListAction(){
        $this->isP('tasklist', '请填写条目内容');
        \Model\Task::changeTaskList($this->p('task_id'));
        $this->success('添加条目成功!');
    }

}