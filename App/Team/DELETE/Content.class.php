<?php

namespace App\Team\DELETE;

/**
 * 公用内容删除方法
 */
class Content extends \App\Team\Common {

    /**
     * 魔术方法，执行删除
     * @param type $name
     * @param type $arguments
     */
    public function __call($name, $arguments) {
        $this->delete();
    }

    /**
     * 执行删除动作
     */
    public function delete() {
        $id = $this->isG('id', $GLOBALS['_LANG']['COMMON']['DELETE_ID']);
        $result = \Model\Model::deleteFromModelId(MODULE, $id);
        if (empty($result)) {
            $this->error($GLOBALS['_LANG']['COMMON']['DELETE_ERROR']);
        } else {
            $this->success($GLOBALS['_LANG']['COMMON']['DELETE_SUCCESS']);
        }
    }

}
