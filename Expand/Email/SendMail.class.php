<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Expand\Email;

/**
 * 邮件发送扩展
 * 注意：由于网站拥有两种邮件触发方式
 * 因此请务必在本方法中实现邮件发送的业务逻辑！
 */
class SendMail {

    public $mail, $trigger;

    public function __construct() {
        require dirname(dirname(__FILE__)) . '/Email/PHPMailerAutoload.php';
        $this->mail = new \PHPMailer;
        $siteTitle = \Model\Content::findContent('option', 'sitetitle', 'option_name')['value'];
        $mailSetting = json_decode(\Model\Content::findContent('option', 'mail', 'option_name')['value'], true);
        $this->trigger = $mailSetting['trigger'];
        $this->mail->CharSet = "utf-8";
        $this->mail->isSMTP();
        $this->mail->Host = $mailSetting['address'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $mailSetting['account'];
        $this->mail->Password = $mailSetting['passwd'];
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = $mailSetting['port'];
        $this->mail->From = $mailSetting['account'];
        $this->mail->FromName = $siteTitle;
    }

    /**
     * 将任务消息以邮件形式发送
     */
    public function sendNotice() {
        $mailList = \Model\Notice::listNoticeWaitMail();
        foreach ($mailList as $key => $value) {
            switch ($value['notice_type']) {
                case '1':
                    $title = "收到一个新任务《{$value['task_title']}》";
                    break;
                case '2':
                    $title = "收到一个新指派审核任务《{$value['task_title']}》";
                    break;
                case '3':
                    $title = "任务《{$value['task_title']}》已经提交审核";
                    break;
                case '4':
                    $title = "任务《{$value['task_title']}》需要修改";
                    break;
                case '5':
                    $title = "您的部门有一个待指派任务《{$value['task_title']}》";
                    break;
                case '6':
                    $title = "任务《{$value['task_title']}》已经完成";
                    break;
            }

            $this->mail->addAddress($value['user_mail']);

            $this->mail->WordWrap = 50;
            $this->mail->isHTML(true);

            $this->mail->Subject = $title;
            $this->mail->Body = $title;

            if (!$this->mail->send()) {
                echo '邮件发送失败!';
            }
            $this->mail->ClearAddresses();
            \Model\Notice::updateNoticeMailSend($value['notice_id']);
        }
    }

}
