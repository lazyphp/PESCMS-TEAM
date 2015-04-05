<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class Html extends \App\Team\Common {

    /**
     * 生成首页静态
     */
    public function index() {
        $this->createIndex();
        $this->success($GLOBALS['_LANG']['HTML']['CREATE_INDEX_SUCCESS'], $this->url('Team-Html-index'));
    }

    /**
     * 生成列表页
     */
    public function listAction() {
        $num = empty($_GET['num']) ? '0' : $_GET['num'];
        $inc = empty($_GET['inc']) ? '0' : $_GET['inc'];
        \Model\Category::$where = "c.category_html = 1";
        $list = \Model\Category::listCategory();
        foreach ($list as $key => $value) {
            if ($key == $num) {
                /**
                 * 当前分类若不是顶层分类，需要保留自身别名的目录
                 */
                if ($value['category_parent'] > 0) {
                    \Model\Category::$categoryPath[] = $value['category_aliases'];
                }
                \Model\Category::findTopCategory($value['category_parent'], $value['category_id']);
                $path = $this->createPath(\Model\Category::$categoryPath);
                $model = \Model\Model::findModel($value['model_id']);

                if (!empty($_GET['c'])) {
                    if ($model['model_name'] == 'Page' || $value['model_id'] == '-1') {
                        header('Location:' . $this->url('Team-Html-listAction', array('method' => 'PUT', 'num' => $num + 1, 'c' => 1)));
                        exit;
                    }
                    $table = strtolower($model['model_name']);
                    $view = \Model\Content::listCategoryContent($table, $value['category_id']);
                    foreach ($view as $door => $item) {
                        if ($door == $inc) {
                            $url = ucfirst($model['model_name']) . "-view";
                            $content = file_get_contents("http://{$_SERVER['SERVER_NAME']}" . $this->url($url, array('id' => $item["{$table}_id"])));
                            $fp = fopen("{$path}{$item["{$table}_id"]}.html", 'w');
                            fwrite($fp, $content);
                            \Model\Content::setContentHtmlUrl($table, $item["{$table}_id"], str_replace(PES_PATH, "/", $path) . "{$item["{$table}_id"]}.html");
                            $this->success("{$item["{$table}_title"]}生成内容页中", $this->url('Team-Html-listAction', array('method' => 'PUT', 'num' => $num, 'c' => 1, 'inc' => $inc + 1)));
                        }
                    }
                    $this->success("{$item["{$table}_title"]}生成内容页中", $this->url('Team-Html-listAction', array('method' => 'PUT', 'num' => $num + 1, 'c' => 1)));
                } else {
                    if ($model['model_name'] == 'Page') {
                        $url = 'Page-view';
                    } else {
                        $url = ucfirst($model['model_name']) . "-list";
                    }
                    $content = file_get_contents("http://{$_SERVER['SERVER_NAME']}" . $this->url($url, array('id' => $value['category_id'])));
                    $fp = fopen("{$path}index.html", 'w');
                    fwrite($fp, $content);
                    \Model\Category::setCategoryHtmlUrl($value['category_id'], str_replace(PES_PATH, "/", $path) . "index.html");
                    $this->success("{$value['category_name']}生成列表中", $this->url('Team-Html-listAction', array('method' => 'PUT', 'num' => $num + 1)));
                }
            }
        }
        $this->createIndex();
        if (empty($_GET['c'])) {
            $this->success('列表页生成结束', $this->url('Team-Html-listAction'));
        } else {
            $this->success('内容页生成结束', $this->url('Team-Html-contentAction'));
        }
    }

    /**
     * 更新URL地址
     */
    public function updateUrl() {
        $catNum = empty($_GET['catNum']) ? '0' : $_GET['catNum'];
        $idNum = empty($_GET['idNum']) ? '0' : $_GET['idNum'];
        //初次进入，获取所有前台模型的分类
        $firstCategory = $this->db('category AS c')->join("{$this->prefix}model AS m ON m.model_id = c.model_id")->where('m.model_attr = 1')->select();
        foreach ($firstCategory as $key => $value) {
            if ($catNum == $key) {
                $modelName = strtolower($value['model_name']);
                if ($modelName == 'page') {
                    //先更新分类URL
                    $pageUrl = $this->url('Page-view', array('id' => $value['category_id']));
                    $this->updateCategoryUrl($value['category_id'], $pageUrl);
                    //更新单页URL
                    $this->db('page')->where('page_id = :page_id')->update(array('noset' => array('page_id' => $value['category_id']), 'page_url' => $pageUrl));
                    $this->success("{$value['category_name']}{$GLOBALS['_LANG']['HTML']['CATEGORY_UPDATE_COMPLETE']}", $this->url('Team-Html-updateUrl', array('method' => 'put', 'catNum' => $catNum + 1, 'idNum' => '0')));
                } else {
                    $fieldList = \Model\Field::fieldList($value['model_id'], '1');
                    $catFieldArray = $this->findCatAttrField($fieldList);
                    $modelListUrl = $this->url(ucfirst($modelName) . '-list', array('id' => $value['category_id']));
                    if ($catFieldArray == false) {
                        $this->updateCategoryUrl($value['category_id'], $modelListUrl);
                        $this->success("{$value['category_name']}{$GLOBALS['_LANG']['HTML']['CATEGORY_UPDATE_COMPLETE']}", $this->url('Team-Html-updateUrl', array('method' => 'put', 'catNum' => $catNum + 1, 'idNum' => '0')));
                    }
                    $catidCondition = "1 = 1";
                    foreach ($catFieldArray as $catKey => $catValue) {
                        if ($catKey == '0') {
                            $catidCondition .= " AND  {$modelName}_{$catValue} =:{$catValue}{$catKey} ";
                        } else {
                            $catidCondition .= " OR {$modelName}_{$catValue} =:{$catValue}{$catKey} ";
                        }

                        $paramArray[$catValue . $catKey] = $value['category_id'];
                    }
                    $contentList = $this->db($modelName)->where($catidCondition)->select($paramArray);
                    if ($this->updateContentUrl($contentList, $modelName) == false) {
                        $this->updateCategoryUrl($value['category_id'], $modelListUrl);
                        $this->success("{$value['category_name']}{$GLOBALS['_LANG']['HTML']['CATEGORY_UPDATE_COMPLETE']}", $this->url('Team-Html-updateUrl', array('method' => 'put', 'catNum' => $catNum + 1, 'idNum' => '0')));
                    }
                }
            }
        }
        $this->success($GLOBALS['_LANG']['HTML']['URL_UPDATE_COMPLETE'], $this->url('Team-Html-updateUrl'));
    }

    /**
     * 创建首页
     * 因为列表页和内容页会涉及到首页，
     * 生成首页方法需要公用出来。
     */
    private function createIndex() {
        $content = file_get_contents("http://{$_SERVER['SERVER_NAME']}/index.php");
        $fp = fopen(PES_PATH . 'index.html', 'w');
        fwrite($fp, $content);
    }

    /**
     * 创建目录
     */
    private function createPath($path) {
        krsort($path);
        $str = PES_PATH;
        foreach ($path as $value) {
            $str .= $value . "/";
            if (!is_dir($str)) {
                mkdir($str);
            }
        }
        return $str;
    }

    /**
     * 查找给定的字段数组中，所有属于分类类型的字段名称
     * @param array $data 字段数组
     * @return boolean|array 存在则返回对应的分类字段数组，否则返回false
     */
    private function findCatAttrField(array $data) {
        foreach ($data as $key => $value) {
            if ($value['field_type'] == 'category') {
                $array[] = $value['field_name'];
            }
        }
        if (empty($array)) {
            return false;
        } else {
            return $array;
        }
    }

    /**
     * 更新分类URL
     * @param type $catid 分类
     * @param type $url
     */
    private function updateCategoryUrl($catid, $url) {
        return $this->db('category')->where('category_id = :category_id')->update(array('noset' => array('category_id' => $catid), 'category_url' => $url));
    }

    private function updateContentUrl(array $data, $modelName) {
        foreach ($data as $key => $value) {
            if ($key == $_GET['idNum']) {
                $url = $this->url(ucfirst($modelName) . "-view", array('id' => $value[$modelName . '_id']));
                $this->db($modelName)->where("{$modelName}_id = :id")->update(array("{$modelName}_url" => $url, 'noset' => array('id' => $value[$modelName . '_id'])));
                $this->success("{$value["{$modelName}_title"]}{$GLOBALS['_LANG']['HTML']['CONTENT_UPDATE_COMPLETE']}", $this->url('Team-Html-updateUrl', array('method' => 'put', 'catNum' => $_GET['catNum'], 'idNum' => $_GET['idNum'] + 1)));
            }
        }
        return FALSE;
    }

}
