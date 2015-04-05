<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 选项模型
 */
class SlideShow extends \Core\Model\Model {

    /**
     * 依据幻灯片ID输出列表
     * @param type $slideshow_type_id 幻灯片ID
     * @param type $limit 输出条数
     * @return type
     */
    public static function slideShowList($slideshow_type_id, $limit = '99') {
        return self::db('slideshow')->where('slideshow_type_id = :slideshow_type_id')->order('slideshow_listsort asc, slideshow_id desc')->limit($limit)->select(array('slideshow_type_id' => $slideshow_type_id));
    }
    
    /**
     * 幻灯片类型列表
     * @return type
     */
    public static function slideshowType() {
        return self::db('slideshow_type')->select();
    }
    
    /**
     * 依据ID查找对应的幻灯片类型
     * @param type $id 幻灯片类型ID
     * @return type
     */
    public static function findSlideshowType($id){
        return self::db('slideshow_type')->where('slideshow_type_id = :slideshow_type_id')->find(array('slideshow_type_id' => $id));
    }

}
