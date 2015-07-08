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
 * PES数据库链接抽象类
 * @author LuoBoss
 * @version 1.0
 */
abstract class Connect {

    /**
     * 记录PDO链接信息
     */
    protected $dbh;

    /**
     * 初始化PDO链接
     */
    public function __construct() {
        $this->__initialization();
    }

    /**
     * 初始化PDO连接
     */
    protected function __initialization() {
        $dsn = CoreFunc::loadConfig('DB_TYPE') . ":host=" . CoreFunc::loadConfig('DB_HOST') . ";dbname=" . CoreFunc::loadConfig('DB_NAME') . ";port=" . CoreFunc::loadConfig('DB_PORT');
        try {
            $this->dbh = new \PDO($dsn, CoreFunc::loadConfig('DB_USER'), CoreFunc::loadConfig('DB_PWD'));
            $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->dbh->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            if (DEBUG == true) {
                die("Error!: {$e->getMessage()} <br/>");
            } else {
                die("Error!: DB ERROR <br/>");
            }
        }
    }

}
