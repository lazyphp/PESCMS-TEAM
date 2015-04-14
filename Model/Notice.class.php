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
    public static function addNotice($uid, $taskId, $type, $mail) {
        return self::db('notice')->insert(array('user_id' => $uid, 'task_id' => $taskId, 'notice_type' => $type, 'task_mail' => $mail));
    }

    /**
     * 登记系统消息已阅读
     * @param type $type 通知类型 
     * 1:收到新任务 
     * 2.指派审核任务 
     * 3.待审核任务 
     * 4.待修改的任务 
     * 5.部门待审核指派任务 
     * 6.完成的任务
     */
    public static function readNotice($type) {
        return self::db('notice')->where('user_id = :user_id AND notice_type = :notice_type ')->update(array('noset' => array('user_id' => $_SESSION['team']['user_id'], 'notice_type' => $type), 'notice_read' => '1'));
    }

    /**
     * 列出等待发送邮件通知的5条消息
     */
    public static function listNoticeWaitMail() {
        return self::db('notice AS n')->field('n.*, u.user_mail, u.user_name, t.task_title')->join(self::$prefix . "user AS u ON u.user_id = n.user_id")->join(self::$prefix . "task AS t ON t.task_id = n.task_id")->where('n.task_mail = 1 AND n.mail_send = 0 AND t.task_delete = 0 ')->select();
    }

    /**
     * 更新消息提示为已发送
     * @param type $noticeId 消息提示ID
     */
    public static function updateNoticeMailSend($noticeId) {
        return self::db('notice')->where('notice_id = :notice_id')->update(array('noset' => array('notice_id' => $noticeId), 'mail_send' => '1'));
    }

}
