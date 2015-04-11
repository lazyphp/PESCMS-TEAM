<?php

namespace App\Team\GET;

/**
 * 公用内容删除方法
 */
class Content extends \App\Team\Common {

    private $model, $table, $fieldPrefix, $theme;

    public function __construct() {
        parent::__construct();

        $this->table = strtolower(MODULE);
        $this->fieldPrefix = $this->table . "_";
        $this->model = \Model\Model::findModel($this->table, 'model_name');

        if (empty($this->model)) {
            $this->error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
        }

        $this->assign('fieldPrefix', $this->fieldPrefix);

        $this->theme = \Model\Option::findOption('theme');
    }

    /**
     * 内容列表
     */
    public function index() {
        $page = new \Expand\Team\Page;
        $total = count($this->db($this->table)->select());
        $count = $page->total($total);
        $page->handle();
        $list = $this->db($this->table)->order("{$this->fieldPrefix}listsort asc, {$this->fieldPrefix}id desc")->limit("{$page->firstRow}, {$page->listRows}")->select();
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', $this->model['lang_key']);

        $this->layout(is_file(THEME . '/' . GROUP . "/{$this->theme['value']}/" . MODULE . "_index.php") ? MODULE . "_index" : 'Content_index');
    }

    /**
     * 添加/编辑内容
     */
    public function action() {
        $field = \Model\Field::fieldList($this->model['model_id'], '1');

        $id = $this->g('id');
        if (empty($id)) {
            $this->assign('method', 'POST');
            $this->assign('title', "{$GLOBALS['_LANG']['CONTENT']['ADD']} - {$this->model['lang_key']}");
        } else {
            $content = \Model\Content::findContent($this->table, $id, "{$this->fieldPrefix}id");
            if (empty($content)) {
                $this->error($GLOBALS['_LANG']['CONTENT']['NOT_EXIST_CONTENT']);
            }
            $this->assign($content);
            $this->assign('method', 'PUT');
            $this->assign('id', $id);
            $this->assign('title', "{$GLOBALS['_LANG']['CONTENT']['EDIT']} - {$this->model['lang_key']}");

            foreach ($field as $key => $value) {
                $field[$key] = $value;
                $field[$key]['value'] = $content["{$this->fieldPrefix}{$value['field_name']}"];
            }
        }

        $this->assign('field', $field);
        $this->assign('form', new \Expand\Form\Form());

        $this->layout(is_file(THEME . '/' . GROUP . "/{$this->theme['value']}/" . MODULE . "_action.php") ? MODULE . "_action" : 'Content_action');
    }

}
