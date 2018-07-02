<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2015 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */
namespace App\Team\GET;

class Department extends Content{

    public function __init(){
        $this->assign('user', json_encode(\Model\Content::listContent([
            'table' => 'user',
            'field' => 'user_id, user_name',
            'condition' => 'user_status = 1'
        ])));
        parent::__init();
    }

}