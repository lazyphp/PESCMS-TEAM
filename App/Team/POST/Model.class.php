<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\POST;

/**
 * 模型管理
 */
class Model extends \App\Team\Common {

    /**
     * 添加模型
     */
    public function action() {
        $this->db()->transaction();
        /**
         * 插入模型信息
         */
        $addModelresult = \Model\Model::addModel();
        if ($addModelresult['status'] == false) {
            $this->db()->rollBack();
            $this->error($addModelresult['mes']);
        }

        /**
         * 插入模型菜单
         */
        $addMenuResult = \Model\Menu::insertModelMenu($addModelresult['mes']['lang_key'], '9', "Team-{$addModelresult['mes']['model_name']}-index");
        if ($addMenuResult == false) {
            $this->db()->rollBack();
            $this->error($GLOBALS['_LANG']['MENU']['ADD_MENU_FAIL']);
        }

        /**
         * 插入初始化的字段
         */
        $setFieldResult = \Model\Model::setInitField($addModelresult['mes']['model_id']);

        if ($setFieldResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($setFieldResult['mes']);
        }

        $this->db()->commit();

        $initResult = \Model\Model::initModelTable($addModelresult['mes']['model_name']);
        if ($setFieldResult['status'] == false) {

            $log = new \Expand\Log();
            $failLog = "Create Model Table Field: {$setFieldResult['mes']}" . date("Y-m-d H:i:s");
            $log->creatLog('modelError', $failLog);

            $this->error($GLOBALS['_LANG']['MODEL']['CREATE_TABLE_ERROR']);
        }

        $this->success($GLOBALS['_LANG']['MODEL']['ADD_MODEL_SUCCESS'], $this->url('Team-Model-index'));
    }

    /**
     * 添加字段
     */
    public function fieldAction() {
        $result = \Model\Field::addField();
        if ($result['status'] == false) {
            $this->error($result['mes']);
        }

        $this->success($GLOBALS['_LANG']['MODEL']['ADD_FIELD_SUCCESS'], $this->url('Team-Model-fieldList', array('id' => $result['mes']['model_id'])));
    }

}
