<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Abnormal;

use Core\Func\CoreFunc as CoreFunc;

/**
 * 错误机制
 */
class Error {

    private static $prompt = '', $language;

    public function __construct() {
        $this->language = require PES_PATH . "Language/{$_SESSION['language']}/Core/lang.php";
    }

    /**
     * 自定义错误提示
     * @param type $errno 错误等级|值
     * @param type $errstr 错误类型
     * @param type $errfile 错误文件
     * @param type $errline 错误行数
     */
    public static function getError($errno, $errstr, $errfile, $errline) {
        if (empty(self::$prompt) && $errno >= self::loadConfig('ERROR_RANK') && self::loadConfig('ERROR_MES') == 'ON' && DEBUG == true) {
            echo "<font color=red>若要屏蔽此错误信息，请在配置文件关闭ERROR选项</font><br />";
            self::$prompt = 'set';
        }
        if ($errno >= self::loadConfig('ERROR_RANK') && self::loadConfig('ERROR_MES') == 'ON') {
            echo "<b>发现等级为 [{$errno}] 的错误提示:</b> {$errstr}<br />";
            echo "<b>出现于文件</b>：{$errfile} <b>第{$errline}行</b><br />";
        }
    }

    /**
     * 自定义脚本停止执行提示
     */
    public static function getShutdown() {
        $error = error_get_last();
        if ($error) {
            $db = \Core\Db\Db::__init();
            if (!empty($db->errorInfo)) {
                self::recordLog(implode("\r", $db->errorInfo), false);
            }
            //记录日志
            self::recordLog($error);
            if (DEBUG == true) {
                $message = $error['message'];
                $file = $error['file'];
                $line = $error['line'];
                //由于能力有限，目前仅显示致命错误和解析错误。
                switch ($error['type']) {
                    case '1':
                        $type = 'Fatal error';
                        break;
                    case '4';
                        $type = 'Parse error';
                        break;
                    default :
                        $type = 'PHP error';
                }

                /**
                 * 处理最后一次执行的 SQL
                 */
                if (!empty($db->getLastSql)) {
                    foreach ($db->param as $key => $value) {
                        $placeholder[] = ":{$key}";
                        $paramValue[] = "'{$value['value']}'";
                    }
                    $sql = str_replace($placeholder, $paramValue, $db->getLastSql);
                }
                if (!empty($db->errorInfo)) {
                    $errorSql = "<b>Sql Run Error</b>: {$db->errorInfo['message']}";
                    $errorSqlString = "<b>Sql Error String</b>:<br/> " . implode("<br/>", explode("\n", $db->errorInfo['string']));
                }
                $errorMes = "<b>{$type}: </b>{$message}";
                $errorFile = "<b>File: </b>{$file} <b>Line: </b>{$line}";
            } else {
                $errorMes = "There was an error. Please try again later.";
                $errorFile = "That's all we know.";
            }
            header("HTTP/1.1 500 Internal Server Error");
            $title = "500 Internal Server Error";
            require self::promptPage();
            exit;
        }
    }

    /**
     * 记录错误日志
     * @param type $error 错误信息
     */
    private static function recordLog($error, $extract = true) {
        $fileName = 'error_' . md5(self::loadConfig('PRIVATE_KEY') . date("Ymd"));

        if ($extract == true) {
            $mes = "Rank[{$error['type']}] PHP error: {$error['message']}\rFile:{$error['file']};Line:{$error['line']}\r\r";
        } else {
            $mes = "{$error}\r";
        }


        $loadLogPath = self::loadConfig('LOG_PATH');
        $logPath = empty($loadLogPath) ? PES_PATH . './log' : PES_PATH . $loadLogPath;
        if (!is_dir($logPath)) {
            if (!mkdir($logPath)) {
                header("HTTP/1.1 500 Internal Server Error");
                $title = "500 Internal Server Error";
                $errorMes = "Can not create log path.";
                $errorFile = "That's all we know.";
                require self::promptPage();
                exit;
            }
        }
        fopen("{$logPath}/index.html", 'w');
        $time = date("Ymd");
        $timePath = "{$logPath}/{$time}";
        if (!is_dir($timePath)) {
            if (!mkdir($timePath)) {
                header("HTTP/1.1 500 Internal Server Error");
                $title = "500 Internal Server Error";
                $errorMes = "Can not create time path.";
                $errorFile = "That's all we know.";
                require self::promptPage();
                exit;
            }
        }
        fopen("{$timePath}/index.html", 'w');
        $fp = fopen("{$timePath}/$fileName.txt", 'a');

        fwrite($fp, $mes);
        fclose($fp);
    }

    /**
     * 获取提示页
     * @return type 返回模板
     */
    private static function promptPage() {
        return PES_PATH . self::loadConfig('ERROR_PROMPT');
    }

    /**
     * 获取系统配置信息
     * @param type $name 配置信息 | 为空则获取所有
     * @return type 返回配置信息
     */
    private static function loadConfig($name = NULL) {
        return \Core\Func\CoreFunc::loadConfig($name);
    }

}
