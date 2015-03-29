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
 * 模型(Model)模型
 */
class Model extends \Core\Model\Model {

    /**
     * 模型列表
     */
    public static function modelList() {
        return self::db('model')->select();
    }

    /**
     * 查找模型(动态条件)
     * @param type $value 查询值
     * @param type $condition 查询条件
     */
    public static function findModel($value, $condition = 'model_id') {
        return self::db('model')->where("{$condition} = :$condition")->find(array($condition => $value));
    }

    /**
     * 依据字段查找模型表的内容
     * @param type $field 匹配的字段
     * @param type $value 查找的内容
     */
    public static function findModelValue($field, $value) {
        return self::db('model')->where("{$field} = :{$field}")->find(array($field => $value));
    }

    /**
     * 依据模型 + 字段：模型_id 进行删除内容动作
     * @param type $model 模型名称
     * @param type $id 待删除的ID
     * @return type 返回执行结果
     */
    public static function deleteFromModelId($model, $id) {
        $model = strtolower($model);
        return self::db($model)->where("{$model}_id = :{$model}_id")->delete(array("{$model}_id" => $id));
    }

    /**
     * 依据模型 + 字段:模型_id 进行排序动作
     * @param type $model 模型名称
     * @param type $id 待排序的ID
     * @param type $sortValue 排序的值
     */
    public static function updateSortFromModel($model, $id, $sortValue) {
        $model = strtolower($model);
        return self::db($model)->where("{$model}_id = :{$model}_id")->update(array("{$model}_listsort" => $sortValue, 'noset' => array("{$model}_id" => $id)));
    }

    /**
     * 添加模型
     */
    public static function addModel() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return $data;
        }
        $data['mes']['lang_key'] = strtoupper($data['mes']['model_name']) . "_LIST";
        $addResult = self::db('model')->insert($data['mes']);
        $data['mes']['model_id'] = $addResult;
        if ($addResult == FALSE) {
            return self::error($GLOBALS['_LANG']['MODEL']['ADD_MODEL_FAIL']);
        } else {
            return self::success($data['mes']);
        }
    }

    /**
     * 更新模型
     */
    public static function updateModel() {
        $data = self::baseFrom();
        if ($data['status'] == false) {
            return $data;
        }
        $updateResult = self::db('model')->where('model_id = :model_id')->update($data['mes']);
        if ($updateResult == false && !is_numeric($updateResult)) {
            return self::error($GLOBALS['_LANG']['MODEL']['UPDATE_MODEL_FAIL']);
        } else {
            return self::success($data['mes']);
        }
    }

    /**
     * 基础表单
     */
    public static function baseFrom() {
        if (self::p('method') == 'PUT') {
            if (!$data['noset']['model_id'] = self::isP('model_id')) {
                return self::error($GLOBALS['_LANG']['MODEL']['LOST_MODEL_ID']);
            }
            if (!$model = self::findModel($data['noset']['model_id'])) {
                return self::error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
            }
            $data['lang_key'] = $model['lang_key'];
        } else {
            if (!$data['model_name'] = ucfirst(strtolower(self::isP('model_name')))) {
                return self::error($GLOBALS['_LANG']['MODEL']['ENTER_MODEL_NAME']);
            }
        }
        if (!($data['is_search'] = self::isP('is_search')) && !is_numeric($data['is_search'])) {
            return self::error($GLOBALS['_LANG']['MODEL']['SELECT_MODEL_SEARCH']);
        }
        
        if (!($data['model_attr'] = self::isP('model_attr')) && !is_numeric($data['model_attr'])) {
            return self::error($GLOBALS['_LANG']['MODEL']['SELECT_MODEL_ATTR']);
        }
        
        if (!($data['status'] = self::isP('status')) && !is_numeric($data['status'])) {
            return self::error($GLOBALS['_LANG']['MODEL']['SELECT_MODEL_STATUS']);
        }

        return self::success($data);
    }

    /**
     * 设置预设的模型字段
     */
    public static function setInitField($modelId) {
        $setStatus = self::db('field')->insert(array('model_id' => $modelId, 'field_name' => 'status', 'display_name' => $GLOBALS['_LANG']['COMMON']['STATUS'], 'field_type' => 'radio', 'field_option' => '{"\u7981\u7528":"0","\u542f\u7528":"1"}', 'field_default' => '1', 'field_required' => '1', 'field_listsort' => '100', 'field_status' => '1'));
        if ($setStatus == false) {
            return self::error($GLOBALS['_LANG']['MODEL']['ADD_FIELD_FAIL']);
        }

        $setListsort = self::db('field')->insert(array('model_id' => $modelId, 'field_name' => 'listsort', 'display_name' => $GLOBALS['_LANG']['COMMON']['SORT'], 'field_type' => 'text', 'field_listsort' => '98', 'field_status' => '1'));
        if ($setListsort == false) {
            return self::error($GLOBALS['_LANG']['MODEL']['ADD_FIELD_FAIL']);
        }

        $setCreatetime = self::db('field')->insert(array('model_id' => $modelId, 'field_name' => 'createtime', 'display_name' => $GLOBALS['_LANG']['COMMON']['CREATETIME'], 'field_type' => 'date', 'field_listsort' => '99', 'field_status' => '1'));
        if ($setCreatetime == false) {
            return self::error($GLOBALS['_LANG']['MODEL']['ADD_FIELD_FAIL']);
        }

        return self::success();
    }

    /**
     * 初始化模型表
     * 基础字段：模型_id,模型_listsort,模型_lang,模型_url,模型_status,模型_createtime
     */
    public static function initModelTable($model) {
        $model = strtolower($model);
        $table = self::$prefix . $model;

        $initResult = self::db()->alter("CREATE TABLE IF NOT EXISTS `{$table}` (`{$model}_id` int(11) NOT NULL AUTO_INCREMENT, `{$model}_listsort` int(11) NOT NULL,`{$model}_status` tinyint(4) NOT NULL, `{$model}_lang` tinyint(4) NOT NULL, `{$model}_url` VARCHAR( 255 ) NOT NULL, `{$model}_createtime` int(11) NOT NULL, PRIMARY KEY (`{$model}_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
        if ($initResult == false) {
            return self::error($table);
        } else {
            return self::success();
        }
    }

    /**
     * 删除模型
     */
    public static function deleteModel($modelId) {
        return self::db('model')->where('model_id = :model_id')->delete(array('model_id' => $modelId));
    }

    /**
     * 删除模型表
     * @param type $tableName 表名
     */
    public static function alterTable($tableName) {
        $prefix = self::$prefix;
        return self::db()->alter("DROP TABLE {$prefix}{$tableName}");
    }

}
