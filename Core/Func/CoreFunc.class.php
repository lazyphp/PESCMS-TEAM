<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Func;

/**
 * PES系统函数
 * @author LuoBoss
 * @license http://www.pescms.com/license
 * @version 1.0
 */
class CoreFunc {

    /**
     * 引用第三方库是否使用默认路径
     * @var type true开启 | false 关闭
     */
    public static $defaultPath = true;

    /**
     * 获取系统配置信息
     * @param type $name
     * @return type
     */
    final public static function loadConfig($name = NULL) {
        $config = require CONFIG_PATH . 'Config/config.php';
        if (empty($name)) {
            return $config;
        } else {
            return $config[$name];
        }
    }

    /**
     * 生成URL链接
     * @param type $controller 链接的控制器
     * @param array $param 参数
     * @return type 返回URL
     */
    final public static function url($controller, array $param = array()) {
        $db = \Core\Db\Db::__init();
        $db->tableName('option');
        $result = $db->where('option_name = "urlModel"')->find();
        $urlModel = json_decode($result['value'], true);
        $url = '';

        if ($urlModel['index'] == '0') {
            $url .= '/index.php/';
        } else {
            $url .= '/';
        }

        $dismantling = explode('-', $controller);
        $totalDismantling = count($dismantling);

        if ($totalDismantling == 2) {
            switch ($urlModel['urlModel']) {
                case '2':
                    $url .= implode('-', $dismantling);
                    $url .= self::urlLinkStr($param, '-');
                    break;
                case '3':
                    $url .= implode('/', $dismantling);
                    $url .= self::urlLinkStr($param, '/');
                    break;
                case '1':
                default:
                    $url = $urlModel['index'] == '0' ? '/index.php' : '/';
                    $url .= "?m={$dismantling[0]}&a={$dismantling[1]}";
                    $url .= self::urlLinkStr($param);
            }
        } else {
            switch ($urlModel['urlModel']) {
                case '2':
                    $url .= implode('-', $dismantling);
                    $url .= self::urlLinkStr($param, '-');
                    break;
                case '3':
                    $url .= implode('/', $dismantling);
                    $url .= self::urlLinkStr($param, '/');
                    break;
                case '1':
                default:
                    $url = $urlModel['index'] == '0' ? '/index.php' : '/';
                    $url .= "?g={$dismantling[0]}&m={$dismantling[1]}&a={$dismantling[2]}";
                    $url .= self::urlLinkStr($param);
            }
        }

        /**
         * 正常模式不会生成HTML后缀
         */
        if ($urlModel['suffix'] == '1' && $urlModel['urlModel'] != '1') {
            $url .= ".html";
        }
        return DOCUMENT_ROOT . $url;
    }

    /**
     * URL的链接字符串格式
     * @param type $param 参数内容
     * @param type $str 连接符的格式
     */
    private static function urlLinkStr($param, $str = '') {
        if (!empty($str)) {
            foreach ($param as $key => $value) {
                $url .= "{$str}{$key}{$str}{$value}";
            }
        } else {
            foreach ($param as $key => $value) {
                $url .= "&{$key}={$value}";
            }
        }
        return $url;
    }

    /**
     * 生成密码
     * @param type $pwd 密码
     * @param type $key 混淆配置
     */
    public static function generatePwd($pwd, $key) {
        return md5(md5($pwd . self::loadConfig($key)));
    }

}
