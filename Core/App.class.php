<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core;

use Core\Abnormal\Abnormal as Abnormal,
    Core\Route\Route as Route;

/**
 * 初始化系统控制层
 * @author LuoBoss
 * @version 1.0
 */
class App {

    public function __construct() {

        //自动注册类
        spl_autoload_register(array($this, 'loader'));
        //自定义报错机制
        set_error_handler("Core\Abnormal\Error::getError");
        register_shutdown_function('Core\Abnormal\Error::getShutdown');
        //实体化控制层
        $this->start();
    }

    /**
     * 设置语言
     */
    private function setLanguage() {
        /**
         * 设置语言
         */
        if (empty($_COOKIE['language'])) {
            $lang = $_SESSION['language'] = \Core\Func\CoreFunc::loadConfig('LANGUAGE');
            setcookie('language', $lang, time() + 604800, '/');
        } else {
            $lang = $_SESSION['language'] = $_COOKIE['language'];
        }

        /**
         * 定义全局语言包
         * @name $_LANG 语言包
         */
        $GLOBALS['_CORELANG'] = require PES_PATH . "Language/{$lang}/Core/lang.php";
        if (file_exists(PES_PATH . "Language/{$lang}/" . GROUP . "/lang.php")) {
            $GLOBALS['_LANG'] = require PES_PATH . "Language/{$lang}/" . GROUP . "/lang.php";
        }
    }

    /**
     * 执行指定模块
     */
    public function start() {
        $route = new Route();
        $route->index();
        unset($route);
        $this->setLanguage();

        try {
            $class = "\\" . ITEM . "\\" . GROUP . "\\" . METHOD . "\\" . MODULE;
            $unixPath = str_replace("\\", "/", $class);
            /**
             * 当前执行的类文件不存在
             * 则调用Content类。
             */
            if (!file_exists(PES_PATH . $unixPath . '.class.php')) {
                $class = ITEM . "\\" . GROUP . "\\" . METHOD . "\\Content";
                $obj = new $class();
                throw new Abnormal($GLOBALS['_CORELANG']['404']);
            }

            $obj = new $class();

            if (!method_exists($obj, ACTION)) {
                throw new Abnormal($GLOBALS['_CORELANG']['404']);
            }
            $a = ACTION;
            $obj->$a();
            unset($a);
        } catch (Abnormal $e) {
            try {
                //让魔术方法可以调用
                if (!is_callable(array($obj, ACTION))) {
                    throw new Abnormal($GLOBALS['_CORELANG']['404']);
                }
                $a = ACTION;
                $obj->$a();
                unset($a);
            } catch (Abnormal $e) {
                /* 无法侦测到 */
                try {
                    if (file_exists(THEME . '/' . GROUP . '/' . METHOD . '/' . MODULE . '_' . ACTION . '.php')) {
                        include THEME . '/' . GROUP . '/' . METHOD . '/' . MODULE . '_' . ACTION . '.php';
                    } else {
                        throw new Abnormal('404 Not found!');
                    }
                } catch (Abnormal $e) {
                    header('HTTP/1.1 404');
                    if (DEBUG == true) {
                        $title = "404 Page Not Found";
                        $errorMes = "<b>Debug route info:</b><br /> Group:" . GROUP . ", Model:" . MODULE . ", Method:" . METHOD . ", Action:" . ACTION;
                        $errorFile = "<b>File loaded:</b><br />" . PES_PATH . "{$unixPath}.class.php";
                    } else {
                        $title = $GLOBALS['_CORELANG']['404'];
                        $errorMes = $GLOBALS['_CORELANG']['ERROR_MES'];
                        $errorFile = $GLOBALS['_CORELANG']['ERROR_FILE'];
                    }
                    require $this->promptPage();
                    exit;
                }
            }
        }
    }

    /**
     * 加载必须的类名
     * @param type $className 加载类名
     */
    private function loader($className) {
        $unixPath = str_replace("\\", "/", $className);
        if (file_exists(PES_PATH . $unixPath . '.class.php')) {
            require PES_PATH . $unixPath . '.class.php';
        } else {
            if (\Core\Func\CoreFunc::$defaultPath == false) {
                return true;
            } else {
                header('HTTP/1.1 404');
                if (DEBUG == true) {
                    $title = $GLOBALS['_CORELANG']['CLASS_LOST'];
                    $errorMes = "<b>Debug info:</b><br /> Class undefined.";
                    $errorFile = "<b>File :</b> <br />" . PES_PATH . "{$unixPath}.class.php";
                } else {
                    $title = $GLOBALS['_CORELANG']['404'];
                    $errorMes = $GLOBALS['_CORELANG']['ERROR_MES'];
                    $errorFile = $GLOBALS['_CORELANG']['ERROR_FILE'];
                }
                require $this->promptPage();
                exit;
            }
        }
    }

    /**
     * 获取提示页
     * @return type 返回模板
     */
    private function promptPage() {
        if (file_exists(THEME . '/' . GROUP . '/404.php')) {
            return THEME . '/' . GROUP . '/404.php';
        } else {
            return PES_CORE . 'Theme/error.php';
        }
    }

}
