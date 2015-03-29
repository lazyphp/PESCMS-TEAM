<?php

namespace App\Team\GET;

/**
 * 公用内容删除方法
 */
class Slideshow extends Content {

    /**
     * 幻灯片图片列表
     */
    public function index() {
        $typeId = $this->isG('type_id', $GLOBALS['_LANG']['SLIDESHOW']['SELECT_TYPE_ID']);
        if(!\Model\SlideShow::findSlideshowType($typeId)){
            $this->error($GLOBALS['_LANG']['SLIDESHOW']['NOT_EXIST_TYPE_TITLE']);
        }
        $page = new \Expand\Team\Page;
        $total = count($this->db('slideshow')->where('slideshow_type_id = :slideshow_type_id')->select(array('slideshow_type_id' => $typeId)));
        $count = $page->total($total);
        $page->handle();
        $list = $this->db('slideshow')->where('slideshow_type_id = :slideshow_type_id')->order("slideshow_listsort asc, slideshow_id desc")->limit("{$page->firstRow}, {$page->listRows}")->select(array('slideshow_type_id' => $typeId));
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', $GLOBALS['_LANG']['MENU_LIST']['SLIDESHOW_LIST']);

        $this->layout('Slideshow_index');
    }

}
