<?php
/**
 * PSE核心引入文件
 * @author LuoBoss
 * @copyright ©2013-2014 PESCMS
 * @license http://www.pescms.com/license
 * @version 1.0
 */
//PES已经自定义错误功能，因此禁用系统的错误信息
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
header("Content-type: text/html; charset=utf-8");
session_start();
//调试模式
defined('DEBUG') or define('DEBUG', FALSE);
//项目目录
defined('ITEM') or define('ITEM', dirname(__FILE__) . '/');
//项目模板
defined('THEME') or define('THEME', dirname(__FILE__) . '/');
//项目配置文件
defined('CONFIG_PATH') or define('CONFIG_PATH', dirname(dirname(__FILE__)) . '/');

defined('PES_PATH') or define('PES_PATH', dirname(dirname(__FILE__)) . '/');

defined('PES_CORE') or define('PES_CORE', dirname(__FILE__) . '/');

defined('DOCUMENT_ROOT') or define('DOCUMENT_ROOT', str_ireplace($_SERVER['DOCUMENT_ROOT'], "", str_replace("\\", "/", PES_PATH)));

require PES_CORE . 'App.class.php';

use Core\App as App;

$autoloader = new App();