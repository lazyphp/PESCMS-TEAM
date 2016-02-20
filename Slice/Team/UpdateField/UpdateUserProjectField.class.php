<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Team\UpdateField;

/**
 * 执行更新用户组字段的动作
 * Class Login
 * @package Slice\Ticket
 */
class UpdateUserProjectField extends \Core\Slice\Slice{

    public function before() {
    }

    /**
     * 更新模型字段中，绑定了项目ID的字段选项
     */
    public function after() {
        $projectList = \Model\Content::listContent(['table' => 'project', 'order' => 'project_listsort ASC, project_id DESC']);
        $project = ['请选择' => ''];
        foreach($projectList as $value){
            $project[$value['project_title']] = $value['project_id'];
        }

        $this->db('field')->where('field_name = :field_name')->update(['field_option' => json_encode($project), 'noset' => ['field_name' => 'project_id'] ]);
    }


}