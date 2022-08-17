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
 * 更新任务模型中任务优先度的字段选项值
 */
class UpdateTaskPriorityField extends \Core\Slice\Slice{

    public function before() {
    }

    /**
     * 更新模型字段中，绑定了项目ID的字段选项
     */
    public function after() {
        $priority = ['请选择' => ''];
        foreach(\Model\Content::listContent(['table' => 'priority', 'order' => 'priority_listsort ASC, priority_id DESC']) as $value){
            $priority[$value['priority_name']] = $value['priority_id'];
        }

        $this->db('field')->where('field_name = :field_name')->update(['field_option' => json_encode($priority), 'noset' => ['field_name' => 'priority'] ]);
    }


}