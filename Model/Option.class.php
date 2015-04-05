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
 * 选项模型
 */
class Option extends \Core\Model\Model {

    /**
     * 查找选项
     * @param type $optionName 选项名称
     */
    public static function findOption($optionName) {
        return self::db('option')->where('option_name = :option_name')->find(array('option_name' => $optionName));
    }

    /**
     * 获取特定范围的选项设置
     * @return type 返回数组
     */
    public static function getOptionRange($optionRange) {
        return self::db('option')->where('option_range = :option_range')->select(array('option_range' => $optionRange));
    }

    /**
     * 更新设置
     * @param type $condition 更新设置的选项名称
     * @param type $value 更新设置的内容值 
     * @return type 返回执行结果
     */
    public static function update($optionName, $value) {
        return self::db('option')->where("option_name = :option_name")->update(array('value' => $value, 'noset' => array('option_name' => $optionName)));
    }

}
