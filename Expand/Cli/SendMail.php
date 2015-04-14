<?php

require 'Core.php';

class SendMail extends Core {

    /**
     * 发送邮件
     */
    public function index() {
        $mail = new \Expand\Email\SendMail();
        if (in_array($mail->trigger, array('2', '3'))) {
            $mail->sendNotice();
        }
    }

}

$obj = new SendMail;
$obj->index();
