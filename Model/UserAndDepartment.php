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
 * 用户与部门模型
 */
class UserAndDepartment extends \Core\Model\Model {

    public static function analyze($array, $list){
        $param = [];
        if(empty($_GET['begin']) && empty($_GET['end']) ){
            $param['begin'] = time() - 86400 * 30;
            $param['end'] = time();
        }else{
            $param['begin'] = strtotime(self::g('begin'). '00:00:00');
            $param['end'] = strtotime(self::g('end'). '23:59:59');
        }

        $result = self::db('user AS u')
            ->field($array['field'])
            ->join(self::$modelPrefix."task_user AS tu ON tu.user_id = u.user_id")
            ->join(self::$modelPrefix."task AS t ON t.task_id = tu.task_id")
            ->join(self::$modelPrefix."department AS d ON d.department_id = u.user_department_id")
            ->where("tu.task_user_type = 2 AND t.task_submit_time BETWEEN :begin AND :end")
            ->group($array['group'])
            ->select($param);

        if(!empty($result)){
            foreach ($result as $value){
                if(empty($list[$value['id']]['total'])){
                    $list[$value['id']]['total'] = 0;
                }
                $list[$value['id']]['total'] += $value['total'];
                $list[$value['id']]['task_status'][$value['task_status']] = $value['total'];
            }
        }


        return $list;
    }

}