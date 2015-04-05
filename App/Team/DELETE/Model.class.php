<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\DELETE;

/**
 * 模型管理
 */
class Model extends \App\Team\Common {

    /**
     * 删除模型
     */
    public function action() {
        $modelId = $this->isG('id', $GLOBALS['_LANG']['COMMON']['DELETE_ID']);

        $model = \Model\Model::findModel($modelId);
        if (empty($model)) {
            $this->error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
        }

        $this->db()->transaction();

        $deleteModelResult = \Model\Model::deleteModel($modelId);
        if (empty($deleteModelResult)) {
            $this->db()->rollBack();
            $this->error($GLOBALS['_LANG']['COMMON']['DELETE_ERROR']);
        }

        $deleteModelField = \Model\Field::deleteModelField($modelId);
        if (empty($deleteModelField)) {
            $this->db()->rollBack();
            $this->error($GLOBALS['_LANG']['MODEL']['DELETE_MODEL_FIELD_FAIL']);
        }

        $deleteMenuResult = \Model\Menu::deleteMenu(strtoupper($model['model_name']) . "_LIST");
        if (empty($deleteMenuResult)) {
            $this->db()->rollBack();
            $this->error($GLOBALS['_LANG']['MENU']['DELETE_MENU_FAIL']);
        }

        $this->db()->commit();

        $alterTableResult = \Model\Model::alterTable(strtolower($model['model_name']));
        if (empty($alterTableResult)) {

            $log = new \Expand\Log();
            $failLog = "Alter Model Table Field: {$this->prefix}{$model['model_name']}" . date("Y-m-d H:i:s");
            $log->creatLog('modelError', $failLog);

            $this->error($GLOBALS['_LANG']['MODEL']['ALTER_TABLE_ERROR']);
        }

        $this->success($GLOBALS['_LANG']['COMMON']['DELETE_SUCCESS']);
    }

    /**
     * 删除字段
     */
    public function fieldAction() {
        $id = $this->isG('id', $GLOBALS['_LANG']['COMMON']['DELETE_ID']);

        $field = \Model\Field::findField($id);

        if (empty($field)) {
            $this->error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_FIELD']);
        }

        $removeFieldResult = \Model\Field::removeField($id);
        if (empty($removeFieldResult)) {
            $this->error($GLOBALS['_LANG']['COMMON']['DELETE_ERROR']);
        }

        $model = \Model\Model::findModel($field['model_id']);

        $alertTableFieldResult = \Model\Field::alertTableField($model['model_name'], $field['field_name']);
        if (empty($alertTableFieldResult)) {

            $log = new \Expand\Log();
            $failLog = "Delete Field: " . strtolower($model['model_name']) . "_{$field['field_name']}, Model:{$model['model_name']}  " . date("Y-m-d H:i:s");
            $log->creatLog('fieldError', $failLog);

            $this->error($GLOBALS['_LANG']['MODEL']['ALERT_TABLE_FIELD_ERROR']);
        }

        $this->success($GLOBALS['_LANG']['COMMON']['DELETE_SUCCESS']);
    }

}
