<?php

/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace Model;

/**
 * 会员模型
 */
class User extends \Core\Model\Model {

    private static $userWithID = [];

    /**
     * 设置EY值
     * @param type $uid 用户ID
     * @param type $num 设置数组
     */
    public static function setEy($uid, $num) {
        $sql = "UPDATE " . self::$modelPrefix . "user SET `user_ey` = `user_ey` + :num WHERE user_id = :user_id ";
        return self::db()->query($sql, array('user_id' => $uid, 'num' => $num));
    }

    /**
     * 通过ID来查询账户信息
     * @param $id 为空则返回全部
     */
    public static function getUserWithID($id = NULL, $field = '*'){
        if(empty(self::$userWithID)){
            $list = \Model\Content::listContent(['table' => 'user', 'field' => $field]);
            foreach ($list as $item){
                self::$userWithID[$item['user_id']] = $item;
            }
        }

        if(empty($id)){
            return self::$userWithID;
        }else{
            return self::$userWithID[$id];
        }


    }

}
