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

class Category extends \App\Team\Common {

    /**
     * 分类列表
     */
    public function index() {
        $tree = \Model\Category::outPutListCate();
        $this->assign('tree', $tree);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 添加/编辑分类
     */
    public function action() {
        $categoryId = $this->g('id');
        if (empty($categoryId)) {
            $this->assign('method', 'POST');

            if ($parent = $this->g('parent')) {
                $this->assign('parent', $parent);
                $this->assign('title', $GLOBALS['_LANG']['CATEGORY']['ADD_CHILD']);
            } else {
                $this->assign('title', $GLOBALS['_LANG']['CATEGORY']['ADD_CATEGORY']);
            }
            $tree = \Model\Category::getSelectCate(array($parent));
        } else {
            $category = \Model\Category::listCategory($categoryId);
            if(empty($category)){
                $this->error($GLOBALS['_LANG']['CATEGORY']['NOT_EXIST_CATEGORY']);
            }
            
            $tree = \Model\Category::getSelectCate(array($category['category_parent']));
            $this->assign('method', 'PUT');
            $this->assign($category);
            $this->assign('title', $GLOBALS['_LANG']['CATEGORY']['EDIT_CATEGORY']);
        }
        
        $this->assign('model', \Model\Model::modelList());

        $this->assign('tree', $tree);
        $this->layout();
    }

}
