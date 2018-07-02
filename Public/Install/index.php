<?php

/**
 * 项目入口
 * @author LuoBoss
 * @copyright ©2013-2014 PESCMS
 * @license http://www.pescms.com/license
 * @version 1.0
 */
define('PES_PATH', dirname(dirname(__FILE__)) . '/');
define('ITEM', 'Install\App');
define('CONFIG_PATH', '../Install/');
define('THEME', dirname(__FILE__).'/Theme');
define('DEBUG', TRUE);
require dirname(dirname(__FILE__)) . '/Core/index.php';
