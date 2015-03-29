<?php

namespace App\Team\PUT;

/**
 * 公用内容更新
 */
class Content extends \App\Team\Common {

    /**
     * 更新内容
     */
    public function action() {
        $this->db()->transaction();
        $updateResult = \Model\Content::updateContent();
        if ($updateResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($updateResult['mes']);
        }
        $this->db()->commit();

        if (!empty($_POST['back_url'])) {
            $url = $_POST['back_url'];
        } else {
            $url = $this->url('Team-' . MODULE . '-index');
        }

        $this->success($GLOBALS['_LANG']['CONTENT']['UPDATE_CONTENT_SUCCESS'], $url);
    }

    /**
     * 内容排序
     */
    public function listsort() {
        foreach ($_POST['id'] as $key => $value) {
            \Model\Model::updateSortFromModel(MODULE, $key, $value);
        }

        if (!empty($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
        } else {
            $url = "";
        }
        $this->success($GLOBALS['_LANG']['COMMON']['SORT_SUCCESS'], $url);
    }

}
