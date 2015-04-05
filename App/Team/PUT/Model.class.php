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
        $result = \Model\Model::updateModel();
        if ($result['status'] == false) {
            $this->error($result['mes']);
        }

        /**
         * 设置当前语言的模型菜单
         */
        $displayName = $this->isP('display_name', $GLOBALS['_LANG']['MODEL']['ENTER_DISPLAY_NAME']);
        $setMenuResult = \Model\Menu::setMenuLang($result['mes']['lang_key'], $displayName);

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
