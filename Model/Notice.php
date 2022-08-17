<?php

/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

/**
 * 消息模型
 */
class Notice extends \Core\Model\Model {

    public static $taskid;

    /**
     * 生成系统通知
     * @param $userid 接收通知的用户ID
     * @param $taskID 任务ID
     * @param $type 通知类型
     * @return mixed
     */
    public static function newNotice($userid, $taskID, $type) {
        $text = self::noticeText($type);

        //如果等于1，则执行邮件发送
        if ($text['mail'] == '1') {
            \Model\Extra::insertSend(
                \Model\Content::findContent('user', $userid, 'user_id')['user_mail'],
                strip_tags($text['title']),
                str_replace('href="', 'href="' . \Model\Content::findContent('option', 'domain', 'option_name')['value'], $text['title']),
                '1'
            );
        }

        return self::db('notice')->insert([
            'notice_task_id' => $taskID,
            'notice_user_id' => $userid,
            'notice_type' => $type,
            'notice_title' => $text['title'],
            'notice_content' => $text['content'],
            'notice_time' => time()
        ]);
    }

    /**
     * 消息文本
     * @param $type 消息类型
     * @return array
     */
    private static function noticeText($type) {
        $task = \Model\Content::findContent('task', self::$taskid, 'task_id');

        $title = '<a href="' . self::url('Team-User-view', ['id' => self::session()->get('team')['user_id']]) . '">' . self::session()->get('team')['user_name'] . '</a> 在任务 <a href="' . self::url('Team-Task-view', ['id' => self::$taskid]) . '">' . $task['task_title'] . '</a> 中';
        $content = '<p>任务计划开始时间:' . date('Y-m-d H:i', $task['task_start_time']) . '</p><p>任务计划结束时间:' . date('Y-m-d H:i', $task['task_end_time']) . '</p>' . $task['task_content'];

        switch ($type) {
            case '1':
                $title .= '指派给您执行任务的需求';
                break;
            case '2':
                $title .= '赋予您审核的权限';
                break;
            case '3':
                $title .= '提交了审核，请您对该任务进行验证审核';
                break;
            case '4':
                $title .= '指派了您的部门';
                break;
            case '5':
                $title .= "对内容进行修改和补充说明，请您留意该变动";
                //任务的修改和补充，他的内容字段名称都为content.
                $content = self::p('content');
                break;

        }
        return ['title' => $title, 'content' => $content, 'mail' => $task['task_mail']];
    }

    /**
     * 依据任务操作者进行生成系统消息
     * @param $taskid 任务ID
     * @param $taskUserType 任务操作者类型
     * @param $noticeType 消息类型
     */
    public static function accordingTaskUserToaddNotice($taskid, $taskUserType, $noticeType) {
        self::$taskid = $taskid;
        $userList = \Model\Content::listContent([
            'table' => 'task_user',
            'condition' => 'task_id = :task_id AND task_user_type = :task_user_type',
            'param' => [
                'task_id' => $taskid,
                'task_user_type' => $taskUserType
            ]
        ]);
        foreach ($userList as $value) {
            self::newNotice($value['user_id'], $taskid, $noticeType);
        }
    }

    /**
     * 消息触发器
     */
    public static function trigger( array $type) {
        $noticeWay = \Model\Content::findContent('option', 'notice_way', 'option_name')['value'];
        if (in_array($noticeWay, $type)) {
            self::actionNoticeSend();
        }
    }

    /**
     * 执行通知发送
     */
    public static function actionNoticeSend(){
        $sendList = \Model\Content::listContent([
            'table' => 'send',
            'condition' => "send_time <= :time AND send_status < 2 AND send_sequence < 5 ",
            'param' => [
                'time' => time()
            ]
        ]);
        if(!empty($sendList)){
            foreach ($sendList as $value) {
                //@todo 目前仅有邮件发送，日后再慢慢完善其他通知方式
                switch ($value['send_type']) {
                    case '1':
                        (new \Expand\Notice\Mail())->send($value);
                        break;
                }
            }
            //发送成功，删除过去7天的待发送列表
            \Core\Func\CoreFunc::db('send')->where('send_time > 0 AND send_time <= :send_time')->delete([
                'send_time' => time() - 86400 * 7
            ]);
        }
    }

    /**
     * 阅读通知消息
     * @param $userid
     * @return void
     */
    public static function readNotice($condition, $param){
        self::db('notice')->where("notice_user_id = :notice_user_id {$condition}")->update($param);
    }

}
