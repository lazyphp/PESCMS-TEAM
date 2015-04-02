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
 * 内容模型
 */
class Content extends \Core\Model\Model {

    private static $table, $fieldPrefix, $model;

    /**
     * 查找指定内容（动态条件）
     * @param type $table 内容表名
     * @param type $value 内容值
     * @param type $field 查找的字段
     * @return type
     */
    public static function findContent($table, $value, $field) {
        return self::db($table)->where("{$field} = :$field")->find(array($field => $value));
    }

    /**
     * 列出内容（动态条件）
     * @param type $table 内容表名
     * @param array $param 绑定参数
     * @param type $where 查找条件
     * @param type $order 排序
     * @param type $limit 限制输出
     * @return type
     */
    public static function listContent($table, array $param = array(), $where = '', $order = '', $limit = '') {
        return self::db($table)->where($where)->order($order)->limit($limit)->select($param);
    }

    /**
     * 添加内容
     */
    public static function addContent() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }
        $addResult = self::db(self::$table)->insert($data['mes']);
        if (empty($addResult)) {
            return self::error($GLOBALS['_LANG']['CONTENT']['ADD_CONTENT_FAIL']);
        }

        $setUrl = self::setUrl($addResult);
        if (empty($setUrl)) {
            return self::error($GLOBALS['_LANG']['CONTENT']['SET_URL_FAIL']);
        }

        return self::success($addResult);
    }

    /**
     * 更新内容
     */
    public static function updateContent() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }

        $condition = self::$fieldPrefix . 'id';
        $updateResult = self::db(self::$table)->where("{$condition} = :{$condition}")->update($data['mes']);
        if (empty($updateResult)) {
            return self::error($GLOBALS['_LANG']['CONTENT']['UPDATE_CONTENT_FAIL']);
        }

        $setUrl = self::setUrl($data['mes']['noset'][$condition]);
        if (empty($setUrl) && !is_numeric($setUrl)) {
            return self::error($GLOBALS['_LANG']['CONTENT']['SET_URL_FAIL']);
        }

        return self::success();
    }

    /**
     * 基础表单
     */
    public static function baseFrom() {
        self::$table = strtolower(MODULE);
        self::$fieldPrefix = self::$table . "_";
        self::$model = \Model\Model::findModel(self::$table, 'model_name');
        $field = \Model\Field::fieldList(self::$model['model_id'], '1');

        if (self::p('method') == 'PUT') {
            if (!$data['noset'][self::$fieldPrefix . 'id'] = self::isP('id')) {
                return self::error($GLOBALS['_LANG']['MODEL']['LOST_MODEL_ID']);
            }
            if (!self::findContent(self::$table, $data['noset'][self::$fieldPrefix . 'id'], self::$fieldPrefix . 'id')) {
                return self::error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
            }
        }

        foreach ($field as $value) {

            /**
             * 判断提交的字段是否为数组
             */
            if (is_array($_POST[$value['field_name']])) {
                $_POST[$value['field_name']] = implode(',', $_POST[$value['field_name']]);
            }

            /**
             * 时间转换为时间戳
             */
            if ($value['field_type'] == 'date') {
                $_POST[$value['field_name']] = strtotime($_POST[$value['field_name']]);
            }

            if ($value['field_required'] == '1') {
                if (!($data[self::$fieldPrefix . $value['field_name']] = self::isP($value['field_name'])) && !is_numeric($data[self::$fieldPrefix . $value['field_name']])) {
                    return self::error($value['display_name'] . $GLOBALS['_LANG']['COMMON']['REQUIRED']);
                }
            } else {
                if (!$data[self::$fieldPrefix . $value['field_name']] = self::p($value['field_name'])) {
                    $data[self::$fieldPrefix . $value['field_name']] = $value['field_default'];
                }
            }
        }

        return self::success($data);
    }

    /**
     * 设置URL
     * @param type $id 需要更新的ID
     */
    private static function setUrl($id) {
        $url = self::url(MODULE . '-view', array('id' => $id));
        return self::db(self::$table)->where(self::$fieldPrefix . 'id = :id')->update(array(self::$fieldPrefix . 'url' => $url, 'noset' => array('id' => $id)));
    }

    /**
     * 列出对应分类
     * @param type $table 表名
     * @param type $cid 分类ID
     */
    public static function listCategoryContent($table, $cid) {
        return self::db($table)->where("{$table}_catid = :cid")->select(array('cid' => $cid));
    }

    /**
     * 设置对应内容的静态URL地址
     * @param type $table 表名
     * @param type $id 修改的内容ID
     * @param type $url 静态URL地址
     */
    public static function setContentHtmlUrl($table, $id, $url) {
        return self::db($table)->where("{$table}_id = :id")->update(array("{$table}_url" => $url, 'noset' => array('id' => $id)));
    }

}
