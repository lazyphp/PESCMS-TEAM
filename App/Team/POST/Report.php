<?php

namespace App\Team\POST;

/**
 * 插入报表
 */
class Report extends \Core\Controller\Controller {

    /**
     * 添加新报表
     */
    public function action() {
        $this->checkToken();
        $contnt = $this->isP('content', '请填写您要提交的内容');
        if (!\Model\Report::addReport($contnt)) {
            $this->error('提交报表失败');
        }
        $this->success('提交报表成功', $this->url('Team-Report-my'));
    }

}
