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
