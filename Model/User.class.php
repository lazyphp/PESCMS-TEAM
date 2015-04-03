<?php

/**
 * Pes for PHP 5.3+
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
     * 依据会员ID查找会员信息
     * @param type $uid 会员ID
     */
    public static function findUser($uid) {
        return self::db('user')->where('user_id = :user_id')->find(array('user_id' => $uid));
    }

    /**
     * 依据用户组ID查找组信息
     * @param type $groupId 用户组ID
     */
    public static function findUserGroup($groupId) {
        return self::db('user_group')->where('user_group_id = :user_group_id')->find(array('user_group_id' => $groupId));
    }
    
    /**
     * 输出所有用户
     */
    public static function userList(){
        return self::db('user')->select();
    }

    /**
     * 输出用户组
     */
    public static function userGroupList() {
        return self::db('user_group')->select();
    }

    /**
     * 添加内容
     */
    public static function add() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }
        $addResult = self::db('user')->insert($data['mes']);
        if (empty($addResult)) {
            return self::error($GLOBALS['_LANG']['USER']['ADD_CONTENT_FAIL']);
        }

        return self::success();
    }

    /**
     * 更新内容
     */
    public static function update() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }

        $updateResult = self::db('user')->where("user_id = :user_id")->update($data['mes']);
        if (empty($updateResult)) {
            return self::error($GLOBALS['_LANG']['USER']['UPDATE_USER_FAIL']);
        }

        return self::success();
    }

    /**
     * 菜单基础表单
     */
    public static function baseFrom() {
        $fieldPrefix = "user_";
        $model = \Model\Model::findModel('user', 'model_name');
        $field = \Model\Field::fieldList($model['model_id'], '1');

        if (self::p('method') == 'PUT') {
            if (!$data['noset']['user_id'] = self::isP('user_id')) {
                return self::error($GLOBALS['_LANG']['USER']['LOST_USER_ID']);
            }
            if (!self::findUser($data['noset']['user_id'])) {
                return self::error($GLOBALS['_LANG']['USER']['NOT_EXITS_USER']);
            }
        } elseif (self::p('method') == 'POST') {
            $data['user_createtime'] = time();
        }

        foreach ($field as $value) {

            /**
             * 判断提交的字段是否为数组
             */
            if (is_array($_POST[$value['field_name']])) {
                $_POST[$fieldPrefix . $value['field_name']] = implode(',', $_POST[$fieldPrefix . $value['field_name']]);
            }

            /**
             * 时间转换为时间戳
             */
            if ($value['field_type'] == 'date') {
                $_POST[$fieldPrefix . $value['field_name']] = strtotime($_POST[$fieldPrefix . $value['field_name']]);
            }

            if ($value['field_required'] == '1') {
                if (!($data[$fieldPrefix . $value['field_name']] = self::isP($fieldPrefix . $value['field_name'])) && !is_numeric($data[$fieldPrefix . $value['field_name']])) {
                    return self::error($value['display_name'] . $GLOBALS['_LANG']['COMMON']['REQUIRED']);
                }
            } else {
                if (!$data[$fieldPrefix . $value['field_name']] = self::p($fieldPrefix . $value['field_name'])) {
                    $data[$fieldPrefix . $value['field_name']] = $value['field_default'];
                }
            }
        }

        /**
         * 先移除密码
         */
        unset($data['user_password']);
        if (self::p('user_password')) {
            $password = self::p('user_password');
            if ($password != self::p('confirm_password')) {
                return self::error($GLOBALS['_LANG']['USER']['CONFIRM_PASSWORD_ERROR']);
            }

            $data['user_password'] = \Core\Func\CoreFunc::generatePwd($data['user_account'] . $password, 'PRIVATE_KEY');
        } elseif (self::p('method') == 'POST' && !self::p('user_password')) {
            return self::error($GLOBALS['_LANG']['USER']['ENTER_PASSWORD']);
        }

        return self::success($data);
    }

}
