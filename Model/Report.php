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
 * 报表
 */
class Report extends \Core\Model\Model {

    /**
     * 添加报表
     * @param type $content 表报内容
     * @return type
     */
    public static function addReport($content) {
        $today = strtotime(date('Y-m-d').'00:00:00');

        $findReport = self::db('report')->where('report_date = :report_date AND user_id = :user_id')->find(array('report_date' => $today, 'user_id' => self::session()->get('team')['user_id']))['report_id'];

        //为空时，先创建当天报表的基础内容
        if (empty($findReport)) {
            $findReport = self::db('report')->insert(array('report_date' => $today, 'user_id' => self::session()->get('team')['user_id'], 'department_id' => self::session()->get('team')['user_department_id']));
        }

        $data['report_id'] = $findReport;
        $data['report_content'] = $content;

        //每插入一条报表，EY值将增加1点
        \Model\User::setEy(self::session()->get('team')['user_id'], '1');

        return self::db('report_content')->insert($data);
    }

}
