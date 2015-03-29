<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Db;

use Core\Func\CoreFunc as CoreFunc;

/**
 * PES初始化数据库
 * @author LuoBoss
 * @version 1.0
 */
class Db {

    /**
     * 初始化数据库选项
     * @return \Core\Db\Mysql
     */
    public static function __init() {
        static $db;
        
        if (empty($db)) {
            $dbType = CoreFunc::loadConfig('DB_TYPE');
            switch ($dbType) {
                case 'mysql':
                    $db = new Mysql();
                    break;
//            扩展其他数据库连接类型
//            case '':
//                break;
                //默认为数据库选择mysql
                default:
                    $db = new Mysql();
                    break;
            }
        }

        return $db;
    }

}
