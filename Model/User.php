<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 会员模型
 */
class User extends \Core\Model\Model {

    /**
     * 设置EY值
     * @param type $uid 用户ID
     * @param type $num 设置数组
     */
    public static function setEy($uid, $num) {
        $sql = "UPDATE " . self::$modelPrefix . "user SET `user_ey` = `user_ey` + :num WHERE user_id = :user_id ";
        return self::db()->query($sql, array('user_id' => $uid, 'num' => $num));
    }

}
