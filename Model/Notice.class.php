<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 消息模型
 */
class Notice extends \Core\Model\Model {

    /**
     * 添加新的系统信息
     * @param type $uid 接收消息的用户
     * @param type $taskId 任务ID
     * @param type $type 通知类型 
     * 1:收到新任务 
     * 2.指派审核任务 
     * 3.待审核任务 
     * 4.待修改的任务 
     * 5.部门待审核指派任务 
     * 6.完成的任务
     * @todo 本方法还需要添加邮件通知记录。
     */
    public static function addNotice($uid, $taskId, $type) {
        return self::db('notice')->insert(array('user_id' => $uid, 'task_id' => $taskId, 'notice_type' => $type));
    }

    /**
     * 登记系统消息已阅读
     * @param type $type
     */
    public static function readNotice($type) {
        return self::db('notice')->where('user_id = :user_id AND notice_type = :notice_type ')->update(array('noset' => array('user_id' => $_SESSION['team']['user_id'], 'notice_type' => $type), 'notice_read' => '1'));
    }

}
