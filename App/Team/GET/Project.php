<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Team\GET;

class Project extends Content{


    /**
     * 项目数据分析
     */
    public function analyze(){

        $param = [];
        if(empty($_GET['begin']) && empty($_GET['end']) ){
            $param['begin'] = time() - 86400 * 30;
            $param['end'] = time();
        }else{
            $param['begin'] = strtotime(self::g('begin'). '00:00:00');
            $param['end'] = strtotime(self::g('end'). '23:59:59');
        }

        $result = self::db('project AS p')
            ->field('p.project_id AS id, p.project_title AS name, t.task_status, COUNT(t.task_status) AS total ')
            ->join("{$this->prefix}task AS t ON t.task_project_id = p.project_id")
            ->where("t.task_submit_time BETWEEN :begin AND :end")
            ->group('p.project_id, t.task_status')
            ->select($param);


        $list = [];
        $project = \Model\Content::listContent(['table' => 'project', 'order' => 'project_listsort ASC, project_id DESC']);
        foreach ($project as $item){
            $list[$item['project_id']]['name'] = $item['project_title'];
        }


        if(!empty($result)){
            foreach ($result as $value){
                if(empty($list[$value['id']]['total'])){
                    $list[$value['id']]['total'] = 0;
                }
                $list[$value['id']]['total'] += $value['total'];
                $list[$value['id']]['task_status'][$value['task_status']] = $value['total'];
            }
        }

        $this->assign('title', '项目数据分析');
        $this->assign('list', $list);
        $this->layout('User/User_analyze');
    }

}