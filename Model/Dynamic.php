<?php

/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

/**
 * 人物动态模型
 */
class Dynamic extends \Core\Model\Model {

    /**
     * 添加新的动态记录
     * @param type $userId 用户ID
     * @param type $taskId 任务ID
     * @param type $type 动态类型
     * 1 发起新的任务 
     * 2 执行了新任务 
     * 3 提交了任务 
     * 4 完成了任务
     */
    public static function addDynamic($userId, $taskId, $type) {
        return self::db('dynamic')->insert(array('user_id' => $userId, 'task_id' => $taskId, 'dynamic_type' => $type, 'dynamic_time' => time()));
    }

}
