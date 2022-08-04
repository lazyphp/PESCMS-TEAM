<?php

namespace App\Team\GET;

/**
 * 报表
 */
class Report extends \Core\Controller\Controller {

    /**
     * 我的报表
     */
    public function my() {
        $sql = "SELECT %s FROM {$this->prefix}report WHERE user_id = :user_id ORDER BY report_id DESC";

        $result = \Model\Content::quickListContent([
            'count' => sprintf($sql, 'count(*)'),
            'normal' => sprintf($sql, '*'),
            'param' => [
                'user_id' => $this->session()->get('team')['user_id']
            ],
            'style' => ['total' => '', 'first' => '', 'last' => ''],
            'LANG' => ['pre' => '&laquo;', 'next' => '&raquo;']
        ]);
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);

        $this->assign('title', \Model\Menu::getTitleWithMenu()['menu_name']);
        $this->layout('Report_index');
    }

    /**
     * 查找报表内容
     */
    public function view() {
        $id = $this->isG('id', '请选择报表ID');
        $content = \Model\Content::findContent('report', $id, 'report_id');
        if (empty($content) || $content['user_id'] != $this->session()->get('team')['user_id']) {
            $this->error('不存在的报表或者您无权查找别人的报表');
        }
        $list = \Model\Content::listContent([
            'table' => 'report_content',
            'condition' => 'report_id = :report_id',
            'param' => ['report_id' => $id],
            'order' => 'content_id DESC'
        ]);

        $this->assign('title', date('Y-m-d', $content['report_date']).'我的报表详细内容');
        $this->assign($content);
        $this->assign('list', $list);
        $this->layout();
    }

    /**
     * 提取报表
     */
    public function extract() {

        $head = explode(',', \Model\Content::findContent('department', $this->session()->get('team')['user_department_id'], 'department_id')['department_header']);
        if (!in_array($this->session()->get('team')['user_id'], $head) && ACTION == 'extract') {
            $this->error('您不是部门负责人，无权访问');
        }

        $condition = "r.report_date BETWEEN :begin AND :end ";
        $param = array();
        //allExtract将移除此限制
        if (ACTION == 'extract') {
            $condition .= " AND r.department_id = :department_id";
            $param['department_id'] = $this->session()->get('team')['user_department_id'];
        }

        if (!empty($_GET['begin']) && !empty($_GET['end'])) {
            $param['begin'] = strtotime($_GET['begin']. ' 00:00:00');
            $param['end'] = strtotime($_GET['end']. ' 23:59:59');
        } else {
            $param['begin'] = strtotime(date('Y-m-d 00:00:00'));
            $param['end'] = strtotime(date('Y-m-d 23:59:59'));
        }

        if (!empty($_GET['user'])) {
            $condition .= " AND r.user_id = :user_id";
            $param['user_id'] = $this->g('user');
        }


        $result = $this->db('report AS r ')->join("{$this->prefix}report_content AS rc ON rc.report_id = r.report_id")->where($condition)->order('report_date DESC')->select($param);
        //是否导出excel
        $list = [];
        
        $users = \Model\User::getUserWithID(null, 'user_id, user_name');



        if (!empty($_GET['excel'])) {
            
            
            
            foreach ($result as $key => $value) {

                $reportDate = date('Y-m-d', $value['report_date']);

                $list[$reportDate][$value['user_id']]['name'] = $users[$value['user_id']]['user_name'];
                $list[$reportDate][$value['user_id']]['report'][] = strip_tags(htmlspecialchars_decode($value['report_content']));
            }

            header('Content-type: text/xml');
            header('Content-Disposition: attachment; filename="导出表报'.date('Y-m-d - ', $param['begin']).date('Y-m-d', $param['end']).'.xls"');
            require_once THEME_PATH.'/Report/Report_export.php';
            exit;
            
        } else {
            foreach ($result as $key => $value) {
                $list[$value['report_date']][$value['user_id']][] = $value;
            }
        }


        $this->assign('list', $list);

        $this->assign('users', $users);
        $this->assign('begin', $param['begin']);
        $this->assign('end', $param['end']);
        $this->assign('title', \Model\Menu::getTitleWithMenu()['menu_name']);
        $this->layout('Report_extract');
    }

    /**
     * 提取所有人报表
     */
    public function allExtract() {
        $this->extract();
    }

}
