<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
define('PES_RUN_TIME', microtime(true));
//PES已经自定义错误功能，因此禁用系统的错误信息
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
header("Content-type: text/html; charset=utf-8");
//调试模式
defined('DEBUG') or define('DEBUG', FALSE);
//核心文件当前的路径
defined('PES_CORE') or define('PES_CORE', dirname(dirname(__FILE__)) . '/');
//项目默认控制器所在目录
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__)). '/');
//项目默认的配置文件所在目录
defined('CONFIG_PATH') or define('CONFIG_PATH', PES_CORE . 'Config/');
//vendor目录
defined('VENDOR_PATH') or define('VENDOR_PATH', PES_CORE . 'vendor');

define('PESCMS_URL', 'https://www.pescms.com');

//解决目录的问题
$_temp = explode('.php', $_SERVER['SCRIPT_NAME']);
define('PHP_FILE', rtrim(str_replace($_SERVER['HTTP_HOST'], '', $_temp[0] . '.php'), '/'));
$_root = rtrim(dirname(PHP_FILE), '/');
define('DOCUMENT_ROOT', (($_root == '/' || $_root == '\\') ? '' : $_root));

require PES_CORE . '/Core/App.php';
require PES_CORE . '/vendor/autoload.php';

use Core\App as App;

$autoloader = new App();