<?php

namespace App\Team\POST;

/**
 * 公用内容插入
 */
class Content extends \App\Team\Common {

    /**
     * 添加内容
     */
    public function action() {
        $this->db()->transaction();
        $addResult = \Model\Content::addContent();
        if ($addResult['status'] == false) {
            $this->db()->rollBack();
            $this->error($addResult['mes']);
        }
        $this->db()->commit();

        if (!empty($_POST['back_url'])) {
            $url = $_POST['back_url'];
        } else {
            $url = $this->url('Team-' . MODULE . '-index');
        }

        $this->success($GLOBALS['_LANG']['CONTENT']['ADD_CONTENT_SUCCESS'], $url);
    }

}
