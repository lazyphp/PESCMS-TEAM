<?php
/**
 * ��Ȩ���� 2021 PESCMS (https://www.pescms.com)
 * ������Ȩ��������Э�����Ķ�Դ���Ŀ¼�µ�LICENSE�ļ���
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

require 'Core.php';

class SendNotice extends Core {
    
    public function index() {
        $noticeWay = \Model\Content::findContent('option', 'notice_way', 'option_name')['value'];
        if (in_array($noticeWay, ['2', '3'])) {
            \Model\Notice::actionNoticeSend();
        }
    }

}

(new SendNotice())->index();