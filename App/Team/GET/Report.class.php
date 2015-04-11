<?php

namespace App\Team\GET;

/**
 * 插入报表
 */
class Report extends \App\Team\Common {

    /**
     * 我的报表
     */
    public function my() {
        $page = new \Expand\Team\Page;
        $total = count(\Model\Content::listContent('report', array('user_id' => $_SESSION['team']['user_id']), 'user_id = :user_id'));
        $count = $page->total($total);
        $page->handle();
        $list = \Model\Content::listContent('report', array('user_id' => $_SESSION['team']['user_id']), 'user_id = :user_id', 'report_id DESC', "{$page->firstRow}, {$page->listRows}");
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout('Report_index');
    }

    /**
     * 查找报表内容
     */
    public function view() {
        $id = $this->isG('id', '请选择报表ID');
        $content = \Model\Content::findContent('report', $id, 'report_id');
        if (empty($content) || $content['user_id'] != $_SESSION['team']['user_id']) {
            $this->error('不存在的报表或者您无权查找别人的报表');
        }
        $list = \Model\Content::listContent('report_content', array('report_id' => $id), 'report_id = :report_id', 'content_id DESC');

        $this->assign($content);
        $this->assign('list', $list);
        $this->layout();
    }

    /**
     * 提取报表
     */
    public function extract() {
        
    }

}
