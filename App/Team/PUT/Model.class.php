<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

/**
 * 模型管理
 */
class Model extends \App\Team\Common {

    /**
     * 更新模型
     */
    public function action() {
        $model = \Model\Model::findModel($_POST['model_id']);
        $result = \Model\Model::updateModel();
        if ($result['status'] == false) {
            $this->error($result['mes']);
        }

        //更新菜单
        $this->db('menu')->where('menu_name = :old_name')->update(array('menu_name' => $this->p('display_name'), 'noset' => array('old_name' => $model['lang_key'])));

        $this->success($GLOBALS['_LANG']['MODEL']['UPDATE_MODEL_SUCCESS'], $this->url('Team-Model-index'));
    }

    /**
     * 更新字段
     */
    public function fieldAction() {
        $result = \Model\Field::updateField();
        if ($result['status'] == false) {
            $this->error($result['mes']);
        }

        $this->success($GLOBALS['_LANG']['MODEL']['UPDATE_FIELD_SUCCESS'], $this->url('Team-Model-fieldList', array('id' => $result['mes']['model_id'])));
    }

}
