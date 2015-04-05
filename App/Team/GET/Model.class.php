<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

/**
 * 模型管理
 */
class Model extends \App\Team\Common {

    /**
     * 模型列表
     */
    public function index() {
        $this->assign('list', \Model\Model::modelList());
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 模型添加/编辑
     */
    public function action() {
        $modelId = $this->g('id');
        if (empty($modelId)) {
            $this->assign('method', 'POST');
            $this->assign('title', $GLOBALS['_LANG']['MODEL']['ADD_MODEL']);
        } else {
            $model = \Model\Model::findModel($modelId);
            if (empty($model)) {
                $this->error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
            }
            $this->assign($model);
            $this->assign('method', 'PUT');
            $this->assign('modelId', $modelId);
            $this->assign('title', "{$GLOBALS['_LANG']['MODEL']['EDIT_MODEL']} - {$model['model_name']}");
        }
        $this->layout();
    }

    /**
     * 检查模型内容
     */
    public function checkModelValue() {
        $modelName = ucfirst(strtolower($this->isG('name', $GLOBALS['_LANG']['MODEL']['ENTER_MODEL_NAME'])));
        $field = $this->isG('field', $GLOBALS['_LANG']['MODEL']['ENTER_FIELD_NAME']);
        if (\Model\Model::findModelValue($field, $modelName)) {
            $this->error($GLOBALS['_LANG']['MODEL']['EXIST_MODEL']);
        } else {
            $this->success($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
        }
    }

    /**
     * 模型字段管理
     */
    public function fieldList() {
        $modelId = $this->isG('id', $GLOBALS['_LANG']['MODEL']['SELECT_MODEL_ID']);
        $model = \Model\Model::findModel($modelId);
        $this->assign('title', "{$GLOBALS['_LANG']['MODEL']['FIELD_MANAGE']} - {$model['lang_key']}");
        $this->assign('list', \Model\Field::fieldList($modelId));
        $this->assign('modelId', $modelId);
        $this->layout();
    }

    /**
     * 字段添加/编辑
     */
    public function fieldAction() {
        $fieldId = $this->g('id');
        $modelId = $this->isG('model', $GLOBALS['_LANG']['MODEL']['SELECT_MODEL_ID']);
        $model = \Model\Model::findModel($modelId);

        if (empty($fieldId)) {
            $this->assign('method', 'POST');
            $this->assign('title', $GLOBALS['_LANG']['MODEL']['FIELD_ADD'] . " - {$GLOBALS['_LANG']['MENU_LIST'][$model['lang_key']]}");
        } else {
            $field = \Model\Field::findField($fieldId);
            if (empty($field)) {
                $this->error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_FIELD']);
            }
            $this->assign($field);
            $this->assign('method', 'PUT');
            $this->assign('title', "{$GLOBALS['_LANG']['MODEL']['FIELD_EDIT']} - {$GLOBALS['_LANG']['MENU_LIST'][$model['lang_key']]}");
        }

        $fieldTypeOption = \Model\Option::findOption('fieldType');
        $this->assign('fieldTypeList', json_decode($fieldTypeOption['value'], true));

        $this->assign('modelId', $modelId);
        $this->layout();
    }

    /**
     * 验证字段是否
     */
    public function checkFieldName() {
        $name = $this->isG('name', $GLOBALS['_LANG']['MODEL']['ENTER_FIELD_NAME']);
        $modelId = $this->isG('model', $GLOBALS['_LANG']['MODEL']['SELECT_MODEL_ID']);
        $model = \Model\Model::findModel($modelId);
        if (\Model\Field::findTableField($model['model_name'], $name)) {
            $this->error($GLOBALS['_LANG']['MODEL']['EXIST_FIELD']);
        } else {
            $this->success($GLOBALS['_LANG']['MODEL']['NOT_EXIST_FIELD']);
        }
    }

}
