<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace Slice\Team\UpdateField;

/**
 * 执行更新用户组字段的动作
 */
class UpdateUserDepartmentField extends \Core\Slice\Slice{

    public function before() {
    }

    /**
     * 更新模型字段中，绑定了部门ID的字段选项
     */
    public function after() {
        $departmentList = \Model\Content::listContent(['table' => 'department', 'order' => 'department_listsort ASC, department_id DESC']);
        $department = ['请选择' => ''];
        foreach($departmentList as $value){
            $department[$value['department_name']] = $value['department_id'];
        }

        $this->db('field')->where('field_name = :field_name')->update(['field_option' => json_encode($department), 'noset' => ['field_name' => 'department_id'] ]);
    }


}