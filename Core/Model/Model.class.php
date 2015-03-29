<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Model;

/**
 * 模型核心
 */
abstract class Model {

    protected static $prefix;

    /**
     * 初始化数据库
     * @param str $name 表名
     * @return obj 返回数据库对象
     */
    protected static function db($name = '') {
        static $db;

        if (empty($db)) {
            $db = \Core\Db\Db::__init();
        }

        $db->tableName($name);
        self::$prefix = $db->prefix;
        return $db;
    }

    /**
     * 安全过滤GET提交的数据
     * @param string $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     * @return string 返回处理完的数据
     */
    protected static function g($name, $htmlentities = TRUE) {
        if (is_array($_GET[$name])) {
            return $_GET[$name];
        }
        if ((bool) $htmlentities) {
            $name = htmlspecialchars(trim($_GET[$name]));
        } else {
            $name = trim($_GET[$name]);
        }

        return $name;
    }

    /**
     * 安全过滤POST提交的数据
     * @param string $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     * @return string 返回处理完的数据
     */
    protected static function p($name, $htmlentities = TRUE) {
        if (is_array($_POST[$name])) {
            return $_POST[$name];
        }
        if ((bool) $htmlentities) {
            $name = htmlspecialchars(trim($_POST[$name]));
        } else {
            $name = trim($_POST[$name]);
        }
        return $name;
    }

    /**
     * 判断GET是否有数据提交
     * @param sting $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     */
    protected static function isG($name, $htmlentities = TRUE) {
        //当为0时，直接返回
        if ($_GET[$name] == '0') {
            return self::g($name, $htmlentities);
        } elseif (is_array($_GET[$name])) {
            return $_GET[$name];
        }
        if (empty($_GET[$name]) || !trim($_GET[$name]) || !is_string($_GET[$name])) {
            return false;
        } elseif (empty($_GET[$name]) && is_array($_GET[$name])) {
            return false;
        }
        return self::g($name, $htmlentities);
    }

    /**
     * 判断POST是否有数据提交
     * @param sting $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     */
    protected static function isP($name, $htmlentities = TRUE) {
        //当为0时，直接返回
        if ($_POST[$name] == '0') {
            return self::p($name, $htmlentities);
        } elseif (is_array($_POST[$name])) {
            return $_POST[$name];
        }
        if (empty($_POST[$name]) || !trim($_POST[$name]) || !is_string($_POST[$name])) {
            return false;
        } elseif (empty($_POST[$name]) && is_array($_POST[$name])) {
            return false;
        }
        return self::p($name, $htmlentities);
    }

    /**
     * 执行失败，返回错误信息
     * @param type $mes
     */
    protected static function error($mes) {
        return array('status' => false, 'mes' => $mes);
    }

    /**
     * 执行成功
     * @return type
     */
    protected static function success($mes = "") {
        return array('status' => true, 'mes' => $mes);
    }

    /**
     * 生成URL链接
     * @param type $controller 链接的控制器
     * @param array $param 参数
     * @return type 返回URL
     */
    protected static function url($controller, array $param = array()) {
        return \Core\Func\CoreFunc::url($controller, $param);
    }

}
