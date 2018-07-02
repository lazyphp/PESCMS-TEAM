<?php
/**
 * 项目入口
 * @author LuoBoss
 * @copyright ©2013-2014 PESCMS
 * @license http://www.pescms.com/license
 * @version 1.0
 */
//控制器入口
define('ITEM', 'App');
//项目配置文件
defined('CONFIG_PATH') or define('CONFIG_PATH', dirname(__FILE__) . '/');
//项目目录
defined('PES_PATH') or define('PES_PATH', dirname(__FILE__) . '/');
//模板地址
define('THEME', dirname(__FILE__).'/Theme');
//调试模式
define('DEBUG', FALSE);

require dirname(__FILE__).'/Core/index.php';