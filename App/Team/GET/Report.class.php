<?php

namespace App\Team\GET;

/**
 * 插入报表
 */
class Report extends \App\Team\Common {

    /**
     * 我的报表
     */
    public function my() {
        $page = new \Expand\Team\Page;
        $total = count(\Model\Content::listContent('report', array('user_id' => $_SESSION['team']['user_id']), 'user_id = :user_id'));
        $count = $page->total($total);
        $page->handle();
        $list = \Model\Content::listContent('report', array('user_id' => $_SESSION['team']['user_id']), 'user_id = :user_id', 'report_id DESC', "{$page->firstRow}, {$page->listRows}");
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout('Report_index');
    }

    /**
     * 查找报表内容
     */
    public function view() {
        $id = $this->isG('id', '请选择报表ID');
        $content = \Model\Content::findContent('report', $id, 'report_id');
        if (empty($content) || $content['user_id'] != $_SESSION['team']['user_id']) {
            $this->error('不存在的报表或者您无权查找别人的报表');
        }
        $list = \Model\Content::listContent('report_content', array('report_id' => $id), 'report_id = :report_id', 'content_id DESC');

        $this->assign($content);
        $this->assign('list', $list);
        $this->layout();
    }

    /**
     * 提取报表
     */
    public function extract() {

        $head = explode(',', \Model\Content::findContent('department', $_SESSION['team']['user_department_id'], 'department_id')['department_header']);
        if (!in_array($_SESSION['team']['user_id'], $head)) {
            $this->error('您不是部门负责人，无权访问');
        }

        $condition = "r.department_id = :department_id AND r.report_date BETWEEN :begin AND :end ";
        $param = array('department_id' => $_SESSION['team']['user_department_id'], 'report_date' => date('Y-m-d'));

        if (!empty($_GET['begin']) && !empty($_GET['end'])) {
            $param['begin'] = $_GET['begin'];
            $param['end'] = $_GET['end'];
        } else {
            $param['begin'] = date('Y-m-d');
            $param['end'] = date('Y-m-d');
        }

        if (!empty($_GET['user'])) {
            $condition .= " AND r.user_id = :user_id";
            $param['user_id'] = $this->g('user');
        }


        $result = $this->db('report AS r ')->join("{$this->prefix}report_content AS rc ON rc.report_id = r.report_id")->where($condition)->order('report_date DESC')->select($param);
        //是否导出excel
        if (!empty($_GET['excel'])) {
            $label = new \Expand\Label();
            $excelTitle = array('日期/用户', '报表内容');

            foreach ($result as $key => $value) {
                $list[$value['report_date']][$value['report_date']] = $value['report_date'];
                $list[$value['report_date'].$value['user_id']][$value['user_id']] = $label->findUser('user', 'user_id', $value['user_id'])['user_name'];
                $list[$value['report_date'].$value['user_id']][] = strip_tags(htmlspecialchars_decode($value['report_content']));
            }

            $excel = new \Expand\Excel\Excel();
            $excel->export('test', $excelTitle, $list);
        } else {
            foreach ($result as $key => $value) {
                $list[$value['report_date']][$value['user_id']][] = $value;
            }
        }

        $this->assign('list', $list);

        $userList = \Model\Content::listContent('user');
        $this->assign('user', $userList);
        $this->assign('begin', $param['begin']);
        $this->assign('end', $param['end']);
        $this->assign('title', '提取报表');
        $this->layout();
    }

}
