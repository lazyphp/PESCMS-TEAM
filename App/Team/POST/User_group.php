<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2015 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.8
 * @version 1.0
 */
namespace App\Team\POST;

class User_group extends Content {

    public function action($jump = FALSE, $commit = FALSE) {
        parent::action($jump, $commit);

        //给予新增用户组最小登录权限
        $id = $this->db()->getLastInsert;

        $this->db('user_group')->where('user_group_id = :user_group_id')->update([
            'noset' => [
                'user_group_id' => $id
            ],
            'user_group_menu' => '41,66,42,59,62,64'
        ]);

        foreach (['2','23','24'] as $item){
            $this->db('node_group')->insert([
                'user_group_id' => $id,
                'node_id' => $item
            ]);
        }

        $this->db()->commit();

        $this->success('新增用户组完成!', 'Team-'.MODULE.'-index');

    }
}