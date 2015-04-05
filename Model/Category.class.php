<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 分类模型
 */
class Category extends \Core\Model\Model {

    private static $li = 1, $selected, $topCategory, $model = array(), $modelID;

    /**
     * 用于特殊的条件筛选查找
     * @var type 
     */
    public static $where = '', $tree = '', $categoryPath;

    /**
     * 清空where条件记录
     * 避免脚本执行出错
     */
    private static function clearWhere() {
        self::$where = '';
    }

    /**
     * 查找指定的分类（动态方法）
     * @param type $value 查询的值
     * @param type $field 字段名称 |默认依据分类ID查找
     * @return type 返回查询结果
     */
    public static function findCategory($value, $field = 'category_id') {
        return self::db('category')->where("{$field} = :{$field}")->find(array($field => $value));
    }

    /**
     * 获取获取分类
     * @param type $value 查找的值 | 提交参数为空时，返回二维数组。参数不为空则返回一维数组。没有结果则返回false;
     * @param type $type 查找的类型|默认为ID
     * @return boolean 
     */
    public static function listCategory($value = "", $type = "category_id") {
        if (empty($value)) {
            $result = self::db('category AS c')->field('c.*, m.model_name, m.lang_key')->join(self::$prefix . 'model AS m ON m.model_id = c.model_id')->where(self::$where)->order('category_listsort asc, category_id asc')->select();
            self::clearWhere();
            return $result;
        } else {
            $data[$type] = $value;
            //拼合条件
            if (empty(self::$where)) {
                self::$where = "c.{$type} = :{$type}";
            } else {
                self::$where .= "and c.{$type} = :{$type}";
            }
            $result = self::db('category AS c')->field('c.*, m.model_name, m.lang_key')->join(self::$prefix . 'model AS m ON m.model_id = c.model_id')->where(self::$where)->find($data);
            self::clearWhere();
            if (empty($result)) {
                return false;
            }
            return $result;
        }
    }

    /**
     * 输出分类列表
     */
    public static function outPutListCate() {
        $list = self::listCategory();
        self::setListCate($list, $list);
        return self::$tree;
    }

    /**
     * 设置列表输出格式
     * @param $array 数组一
     * @param $array_2 数组二
     * @param $id 父类产品ID
     * @param $depth 用于判断递归深度
     * @return
     */
    private static function setListCate($array, $array_2, $id = '0', $depth = '0') {
        $count = count($array_2);
        if ($depth < 3) {
            for ($i = 0; $i < $count; $i++) {
                $nav = $array[$i]['category_nav'] == '1' ? "<font color='green'>{$GLOBALS['_LANG']['COMMON']['DISPLAY']}</font>" : '<font color="red">' . $GLOBALS['_LANG']['COMMON']['HIDDEN'] . '</font>';
                $modelName = $array[$i]['model_id'] == '-1' ? $GLOBALS['_LANG']['CATEGORY']['EXTERNAL_LINK'] : $GLOBALS['_LANG']['MENU_LIST'][$array[$i]['lang_key']];
                $html = $array[$i]['category_html'] == '1' ? "<font color='blue'>{$GLOBALS['_LANG']['COMMON']['YES']}</font>" : $GLOBALS['_LANG']['COMMON']['NO'];
                //记录第一层数据
                if ($id == 0 && $array[$i]['category_parent'] == 0) {
                    self::$tree .= '<tr><td><input class="input length_0" type="text" name="id[' . $array[$i]['category_id'] . ']" value="' . $array[$i]['category_listsort'] . '" /></td><td>' . $array[$i]['category_name'] . '</td><td>' . $modelName . '</td><td>' . $nav . '</td><td>' . $html . '</td><td>';
                    self::$tree .= self::catHtml($array[$i]['category_id']);
                    self::$tree .= '</td></tr>';
                }
                //第二层数据
                foreach ($array as $key => $value) {
                    $nav = $value['category_nav'] == '1' ? "<font color='green'>{$GLOBALS['_LANG']['COMMON']['DISPLAY']}</font>" : '<font color="red">' . $GLOBALS['_LANG']['COMMON']['HIDDEN'] . '</font>';
                    $modelName = $value['model_id'] == '-1' ? $GLOBALS['_LANG']['CATEGORY']['EXTERNAL_LINK'] : $GLOBALS['_LANG']['MENU_LIST'][$value['lang_key']];
                    $html = $value['category_html'] == '1' ? "<font color='blue'>{$GLOBALS['_LANG']['COMMON']['YES']}</font>" : $GLOBALS['_LANG']['COMMON']['NO'];
                    self::$li = 0;
                    if ($array[$i]['category_id'] == $value['category_parent'] && $array[$i]['category_parent'] == 0) {
                        self::$tree .= '<tr><td><input class="input length_0" type="text" name="id[' . $value['category_id'] . ']" value="' . $value['category_listsort'] . '" /></td><td>' . self::plus_none_icon(self::$li) . '<span class="plus_icon plus_end_icon"></span>' . $value['category_name'] . '</td><td>' . $modelName . '</td><td>' . $nav . '</td><td>' . $html . '</td><td>';
                        self::$tree .= self::catHtml($value['category_id']);
                        self::setListCate($array[$i], $array_2, $value['category_id'], 3);
                        self::$tree .= '</td></tr>';
                    }
                }
            }
            //三层及以上的数据进行单独的排序
        } elseif ($depth >= 3) {
            foreach ($array_2 as $depth_key => $depth_value) {
                $nav = $depth_value['category_nav'] == '1' ? "<font color='green'>{$GLOBALS['_LANG']['COMMON']['DISPLAY']}</font>" : '<font color="red">' . $GLOBALS['_LANG']['COMMON']['HIDDEN'] . '</font>';
                $modelName = $depth_value['model_id'] == '-1' ? $GLOBALS['_LANG']['CATEGORY']['EXTERNAL_LINK'] : $GLOBALS['_LANG']['MENU_LIST'][$depth_value['lang_key']];
                $html = $depth_value['category_html'] == '1' ? "<font color='blue'>{$GLOBALS['_LANG']['COMMON']['YES']}</font>" : $GLOBALS['_LANG']['COMMON']['NO'];
                if ($id == $depth_value['category_parent'] && $id > 0) {
                    self::$li++;
                    self::$tree .= '<tr><td><input class="input length_0" type="text" name="id[' . $depth_value['category_id'] . ']" value="' . $depth_value['category_listsort'] . '" /></td><td>' . self::plus_none_icon(self::$li) . '<span class="plus_icon plus_end_icon"></span>' . $depth_value['category_name'] . '</td><td>' . $modelName . '</td><td>' . $nav . '</td><td>' . $html . '</td><td>';
                    self::$tree .= self::catHtml($depth_value['category_id']);
                    self::setListCate($array[$i], $array_2, $depth_value['category_id'], 3);
                    self::$tree .= '</td></tr>';
                    self::$li--;
                }
            }
        }
    }

    /**
     * 创建分类的操作按钮
     * @param type $id 分类ID
     * @return type 返回设置好的字符串
     */
    private static function catHtml($id) {
        $func = new \Core\Func\CoreFunc();
        $edit = '<a href="' . $func->url('Admin-Category-action', array('id' => $id)) . '" class="blue-button" id="' . $id . '" >' . $GLOBALS['_LANG']['COMMON']['EDIT'] . '</a>';
        $add = ' <a href="' . $func->url('Admin-Category-action', array('parent' => $id)) . '" class="blue-button" id="' . $id . '" >' . $GLOBALS['_LANG']['CATEGORY']['ADD_CHILD'] . '</a>';
        $delete = ' <a href="' . $func->url('Admin-Category-action', array('id' => $id)) . '" class="blue-button" id="' . $id . '" onclick="return del(this)" >' . $GLOBALS['_LANG']['COMMON']['DELETE'] . '</a>';
        return $edit . $add . $delete;
    }

    /**
     * 输出分类表单
     * @return type
     */
    public static function getSelectCate($value = array(), $model = false) {
        self::$selected = $value;
        $list = self::listCategory();

        if ($model == true) {
            foreach ($list as $key => $value) {
                self::$modelID = $value['model_id'];
                self::findTopCategory($value['category_parent'], $value['category_id']);
                $array[self::$topCategory] = self::listChildId(self::$topCategory);
            }

            if(!empty($value)){
               $list = self::db('category')->where('category_id in ( :' . implode(', :', $array) . ')')->select($array);
            }
        }
        self::setInputOption($list, $list);
        return self::$tree;
    }

    /**
     * 用于option表单输出
     * @param $array 数组一
     * @param $array_2 数组二
     * @param $id 父类产品ID
     * @param $depth 用于判断递归深度
     */
    private static function setInputOption($array, $array_2, $id = '0', $depth = '0') {
        $count = count($array_2);
        if ($depth < 3) {
            for ($i = 0; $i < $count; $i++) {
                if ($id == 0 && $array[$i]['category_parent'] == 0) {
                    $selected = in_array($array[$i]['category_id'], self::$selected) ? 'selected="selected"' : '';
                    $disabled = !empty(self::$modelID) && self::$modelID != $array[$i]['model_id'] ? 'disabled = "disabled"' : '';
                    self::$tree .= '<option ' . $disabled . ' value="' . $array[$i]['category_id'] . '"' . $selected . '>' . $array[$i]['category_name'] . '</option>';
                }
                foreach ($array as $key => $value) {
                    self::$li = 1;
                    if ($array[$i]['category_id'] == $value['category_parent'] && $array[$i]['category_parent'] == 0) {
                        $selected = in_array($value['category_id'], self::$selected) ? 'selected="selected"' : '';
                        $disabled = !empty(self::$modelID) && self::$modelID != $value['model_id'] ? 'disabled = "disabled"' : '';
                        self::$tree .= '<option ' . $disabled . ' value="' . $value['category_id'] . '"' . $selected . '>' . self::nbsp(self::$li) . '└─' . $value['category_name'] . '</option>';
                        self::setInputOption($array[$i], $array_2, $value['category_id'], 3);
                    }
                }
            }
        } elseif ($depth >= 3) {
            foreach ($array_2 as $depth_key => $depth_value) {
                if ($id == $depth_value['category_parent'] && $id > 0) {
                    $selected = in_array($depth_value['category_id'], self::$selected) ? 'selected="selected"' : '';
                    $disabled = !empty(self::$modelID) && self::$modelID != $depth_value['model_id'] ? 'disabled = "disabled"' : '';
                    self::$li++;
                    self::$tree .= '<option ' . $disabled . ' value="' . $depth_value['category_id'] . '"' . $selected . '>' . self::nbsp(self::$li) . '└─' . $depth_value['category_name'] . '</option>';
                    self::setInputOption($array[$i], $array_2, $depth_value['category_id'], 3);
                    self::$li--;
                }
            }
        }
    }

    /**
     * 列出所有子类的ID(含父类)
     * @param type $id 父类的ID
     */
    public static function listChildId($id) {
        self::$tree = $id;
        self::findChildId($id);
        return self::$tree;
    }

    /**
     * 查找符合的子分类
     */
    private static function findChildId($id) {
        $result = self::db('category')->where('category_parent = :category_parent')->select(array('category_parent' => $id));
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                self::$tree .= ',' . $value['category_id'];
                self::findChildId($value['category_id']);
            }
        }
    }

    /**
     * 放置分类的排版空间
     * @param type $frequency 级别
     * @return string 返回设置好的字符串
     */
    private static function plus_none_icon($frequency) {
        $str = '';
        for ($i = 0; $i < $frequency; $i++) {
            $str .='<span class="plus_icon plus_none_icon"></span>';
        }
        return $str;
    }

    /**
     * 放置空格排版
     * @param type $frequency 级别
     * @return string 返回设置好的字符串
     */
    private static function nbsp($li) {
        for ($i = 0; $i < $li; $i++) {
            $str .='&nbsp;&nbsp;&nbsp;';
        }
        return $str;
    }

    /**
     * 添加分类
     */
    public static function addCategory() {
        $data = self::baseForm();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }

        $addResult = self::db('category')->insert($data['mes']);
        if (empty($addResult)) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['ADD_CATEGORY_FAIL']);
        }

        self::findTopCategory($data['mes']['category_parent'], $addResult);
        self::setChild();
        self::setUrl($addResult, $data['mes']['category_url']);
        self::insertOrUpdatePage($addResult, $data['mes']);

        return self::success($data['mes']);
    }

    /**
     * 更新分类
     */
    public static function updateCategory() {
        $data = self::baseForm();
        if ($data['status'] == false) {
            return self::error($data['mes']);
        }

        /**
         * 更新之前必须先获取原分类的信息
         * 接下来依次更新其原有最顶层的所有子类
         * 和新的父类所有子类
         */
        $category = self::findCategory($data['mes']['noset']['category_id']);

        if (empty($category)) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['NOT_EXIST_CATEGORY']);
        }

        $updateResult = self::db('category')->where('category_id = :category_id')->update($data['mes']);
        if ($updateResult == false && !is_numeric($updateResult)) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['UPDATE_CATEGORY_FAIL']);
        }

        self::findTopCategory($data['mes']['category_parent'], $data['mes']['noset']['category_id']);
        self::setChild();

        if ($data['mes']['category_parent'] != $category['category_parent']) {
            self::findTopCategory($category['category_parent'], $data['mes']['noset']['category_id']);
            self::setChild();
        }

        self::setUrl($data['mes']['noset']['category_id'], $data['mes']['category_url']);
        self::insertOrUpdatePage($data['mes']['noset']['category_id'], $data['mes']);

        return self::success($data['mes']);
    }

    /**
     * 删除分类
     */
    public static function deleteCategory() {
        if (!$data['category_id'] = self::isG('id')) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['LOST_CATEGORY_ID']);
        }

        $category = self::findCategory($data['category_id']);
        if (empty($category)) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['NOT_EXIST_CATEGORY']);
        }

        $deleteResult = self::db('category')->where('category_id = :category_id')->delete(array('category_id' => $data['category_id']));
        if (empty($deleteResult)) {
            return self::error($GLOBALS['_LANG']['COMMON']['DELETE_ERROR']);
        }

        $moveChild = self::db('category')->where('category_parent = :parent')->update(array('noset' => array('parent' => $data['category_id']), 'category_parent' => '0'));

        self::findTopCategory($category['category_parent'], $category['category_id']);
        self::setChild();

        return self::success();
    }

    /**
     * 基础表单
     */
    public static function baseForm() {

        if (!($data['category_parent'] = self::isP('category_parent')) && !is_numeric($data['category_parent'])) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['SELECT_CATEGORY_PARENT']);
        }
        if (!(self::findCategory($data['category_parent'])) && !is_numeric($data['category_parent'])) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['NOT_EXIST_CATEGORY']);
        }

        if (!$data['model_id'] = self::isP('model_id')) {
            return self::error($GLOBALS['_LANG']['MODEL']['LOST_MODEL_ID']);
        }
        if (!(self::$model = \Model\Model::findModel($data['model_id'])) && $data['model_id'] != '-1') {
            return self::error($GLOBALS['_LANG']['MODEL']['NOT_EXIST_MODEL']);
        }

        if ($data['model_id'] == '-1') {
            if (!$data['category_url'] = self::isP('category_url')) {
                return self::error($GLOBALS['_LANG']['CATEGORY']['ENERT_CATEGORY_EXTERNAL_LINK']);
            }
        }

        if (self::p('method') == 'PUT') {
            if (!$data['noset']['category_id'] = self::isP('category_id')) {
                return self::error($GLOBALS['_LANG']['CATEGORY']['LOST_CATEGORY_ID']);
            }
        }

        if (!$data['category_name'] = self::isP('category_name')) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['ENTER_CATEGORY_NAME']);
        }

        if (!$data['category_aliases'] = self::isP('category_aliases')) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['ENTER_CATEGORY_ALIASES']);
        }

        if (!($data['category_nav'] = self::isP('category_nav')) && !is_numeric($data['category_nav'])) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['SELECT_IS_NAV']);
        }

        if (!($data['category_html'] = self::isP('category_html')) && !is_numeric($data['category_html'])) {
            return self::error($GLOBALS['_LANG']['CATEGORY']['SELECT_CREATE_HTML']);
        }

        $data['category_keyword'] = self::p('category_keyword');
        $data['category_description'] = self::p('category_description');
        $data['category_thumb'] = self::p('category_thumb');
        $data['category_listsort'] = self::p('category_listsort');

        return self::success($data);
    }

    /**
     * 依据提供的分类ID，递归获取最顶层的父类ID
     * @param type $id
     * @param type $catId
     */
    public static function findTopCategory($pid, $cid) {
        if ($pid > 0) {
            $result = self::findCategory($pid);

            if ($result['category_parent'] == 0) {
                self::$categoryPath[] = $result['category_aliases'];
                self::$topCategory = $result['category_id'];
            } else {
                self::$categoryPath[] = $result['category_aliases'];
                self::findTopCategory($result['category_parent']);
            }
        } else {

            $result = self::findCategory($cid);
            self::$categoryPath[] = $result['category_aliases'];

            self::$topCategory = $cid;
        }
    }

    /**
     * 进行递归地设置每层分类对应的子类
     */
    private static function setChild() {

        $topCat = self::db('category')->where("category_parent = 0 and category_id = :category_id")->select(array('category_id' => self::$topCategory));
        if (!empty($topCat)) {
            foreach ($topCat as $key => $value) {
                $child = explode(',', self::listChildId($value['category_id']));
                self::$tree = '';

                foreach ($child as $_key => $_value) {
                    $data['noset']['category_id'] = $_value;
                    $data['category_child'] = self::listChildId($_value);
                    $updateChild = self::db('category')->where('category_id = :category_id')->update($data);
                    self::$tree = '';
                }
            }
        }
    }

    /**
     * 设置分类的链接
     * @param type $categoryID
     * @param type $externalUrl
     */
    private static function setUrl($categoryID, $externalUrl) {
        if (empty(self::$model)) {
            $url = $externalUrl;
        } else {
            if (self::$model['model_name'] == 'Page') {
                $controller = 'Page-view';
            } else {
                $controller = ucfirst(strtolower(self::$model['model_name'])) . '-list';
            }
            $url = self::url($controller, array('id' => $categoryID));
        }

        return self::db('category')->where('category_id = :category_id')->update(array('noset' => array('category_id' => $categoryID), 'category_url' => $url));
    }

    /**
     * 依据父类ID列出旗下的分类
     * @param type $category_parent 父类ID
     * @param type $category_nav 是否为导航
     * @return type
     */
    public static function getCat($category_parent = '0', $category_nav = '') {
        $where = 'category_parent = :category_parent';
        if (!empty($category_nav)) {
            $where .= ' and category_nav = 1';
        }
        $data['category_parent'] = $category_parent;
        return self::db('category')->where($where)->order('category_listsort asc, category_id asc')->select($data);
    }

    /**
     * 设置分类静态URL
     * @param type $cid 更新的分类
     * @param type $url 设置的URL
     * @return type
     */
    public static function setCategoryHtmlUrl($cid, $url) {
        return self::db('category')->where('category_id = :category_id')->update(array('noset' => array('category_id' => $cid,), 'category_url' => $url));
    }

    /**
     * 新增或者更新单页的名称
     * @param type $id 单页ID
     * @param array $content 单页内容数组
     * 本功能主要插入单页的基础内容
     */
    private static function insertOrUpdatePage($id, array $content) {
        if (self::$model['model_name'] != 'Page') {
            return true;
        }
        $result = \Model\Content::findContent('page', $id, 'page_id');
        $data = array('page_status' => '1', 'page_url' => self::url('Page-view', array('id' => $id)), 'page_title' => $content['category_name'], 'page_thumb' => $content['category_thumb'], 'page_keyword' => $content['category_keyword'], 'page_description' => $content['category_description']);
        if (empty($result)) {
            $data['page_createtime'] = time();
            $data['page_id'] = $id;
            return self::db('page')->insert($data);
        } else {
            $data['noset']['page_id'] = $id;
            return self::db('page')->where('page_id = :page_id')->update($data);
        }
    }

}
