<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Expand;

/**
 * 模版标签函数
 * 说明：建议本类中的所有方法尽量使用return形式。
 * 统一使用return，可以方便前台代码的调用。
 * 此外，也尽量勿在方法进行终止类操作。
 * 以免对程序的运行产生影响。
 */
class Label {

    /**
     * 生成URL链接
     * @param type $controller 链接的控制器
     * @param array $param 参数
     * @param type $filterHtmlSuffix 是否强制过滤HTML后缀 | 由于ajax GET请求中，若不过滤HTML，将会引起404的问题
     * @return type 返回URL
     */
    public function url($controller, array $param = array(), $filterHtmlSuffix = false) {
        $url = \Core\Func\CoreFunc::url($controller, $param);
        if ($filterHtmlSuffix == true) {
            if (substr($url, '-5') == '.html') {
                return substr($url, '0', '-5');
            }
        }

        return $url;
    }

    /**
     * 生成令牌
     */
    public function token() {
        list($usec, $sec) = explode(" ", microtime());
        $token = md5(substr($usec, 2) * rand(1, 100));
        $_SESSION['token'] = $token;
        return "<input type=\"hidden\" name=\"token\" value=\"{$token}\" />";
    }

    /**
     * 标准状态输出
     * 0 禁用
     * 1 启用
     */
    public function status($type) {
        switch ($type) {
            case '0':
                return "<font color=\"red\">{$GLOBALS['_LANG']['COMMON']['DISABLE']}</font>";
            case '1':
                return "<font color=\"green\">{$GLOBALS['_LANG']['COMMON']['ENABLE']}</font>";
            default:
                return $GLOBALS['_LANG']['COMMON']['UNKNOW'];
        }
    }

    /**
     * 是否搜索
     */
    public function isSearch($type) {
        switch ($type) {
            case '0':
                return "<font color=\"red\">{$GLOBALS['_LANG']['COMMON']['BAN']}</font>";
            case '1':
                return "<font color=\"green\">{$GLOBALS['_LANG']['COMMON']['ALLOW']}</font>";
            default:
                return $GLOBALS['_LANG']['COMMON']['UNKNOW'];
        }
    }

    /**
     * 是否必填
     */
    public function isQequired($type) {
        switch ($type) {
            case '0':
                return "<font color=\"red\">{$GLOBALS['_LANG']['COMMON']['NO']}</font>";
            case '1':
                return "<font color=\"green\">{$GLOBALS['_LANG']['COMMON']['YES']}</font>";
            default:
                return $GLOBALS['_LANG']['COMMON']['UNKNOW'];
        }
    }

    /**
     * 模型属性
     * @param type $attr 属性值
     */
    public function modelAttr($attr) {
        switch ($attr) {
            case '1':
                return "<font color=\"green\">{$GLOBALS['_LANG']['MODEL']['RECEPTION']}</font>";
            case '2':
                return "<font color=\"#E7790E\">{$GLOBALS['_LANG']['MODEL']['BACKSTAGE']}</font>";
            default:
                return $GLOBALS['_LANG']['COMMON']['UNKNOW'];
        }
    }

    /**
     * 字段类型
     * @param type $type
     */
    public function fieldType($type) {
        switch ($type) {
            case 'category':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_CATEGORTS'];

            case 'text':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_TEXT'];

            case 'select':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_SELECT'];

            case 'checkbox':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_CHECKBOX'];

            case 'radio':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_RADIO'];

            case 'textarea':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_TEXTAREA'];

            case 'thumb':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_THUMB'];

            case 'editor':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_EDITOR'];

            case 'img':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_IMG'];

            case 'file':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_FILE'];

            case 'date':
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_DATE'];

            default:
                return $GLOBALS['_LANG']['FIELD_TYPE']['FIELD_UNKNOW'];
        }
    }

    /**
     * 返回字段选项值的内容
     * @param type $option
     */
    public function fieldOption($option) {
        if (empty($option) || $option == '{"":null}') {
            return NULL;
        }
        $array = json_decode($option, true);
        $str = "";
        foreach ($array as $key => $value) {
            $str .="{$key}|{$value}\n";
        }
        return trim($str);
    }

    /**
     * 
     * 查找组名称
     * @param type $groupID 用户组ID
     * @return type 返回处理好的一维用户组数组
     */
    public function findGroup($groupID) {
        static $group;
        if (empty($group)) {
            $list = \Model\User::userGroupList();
            foreach ($list as $value) {
                $group[$value['user_group_id']] = $value['user_group_name'];
            }
        }
        return $group[$groupID];
    }

    /**
     * 根据父类ID查找数据
     * @param type $parent_id 分类父类ID
     * @param type $is_nav 是否为导航
     * @return array 返回二维数组
     */
    public function getCate($category_parent = '0', $category_nav = '') {
        return \Model\Category::getCat($category_parent, $category_nav);
    }

    /**
     * 单页标签
     */
    public function page($id) {
        return \Model\Content::findContent('page', $id, 'page_id');
    }

    /**
     * 幻灯片
     */
    public function slideShow($slideshow_type_id, $limit = '99') {
        return \Model\SlideShow::slideShowList($slideshow_type_id, $limit);
    }

    /**
     * 列出内容（动态条件）
     * @param type $table 内容表名
     * @param array $param 绑定参数
     * @param type $where 查找条件
     * @param type $order 排序
     * @param type $limit 限制输出
     * @return type
     */
    public function listContent($table, array $param = array(), $where = '', $order = '', $limit = '') {
        return \Model\Content::listContent($table, $param, $where, $order, $limit);
    }

    /**
     * 字符串截断
     * @param type $sourcestr 字符串
     * @param type $cutlength 截断的长度
     * @param type $suffix 截断后显示的内容
     * @return string 返回一个截断后的字符串
     */
    function strCut($sourcestr, $cutlength, $suffix = '...') {
        $str_length = strlen($sourcestr);
        if ($str_length <= $cutlength) {
            return $sourcestr;
        }
        $returnstr = '';
        $n = $i = $noc = 0;
        while ($n < $str_length) {
            $t = ord($sourcestr[$n]);
            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $i = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223) {
                $i = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t <= 239) {
                $i = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247) {
                $i = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251) {
                $i = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253) {
                $i = 6;
                $n += 6;
                $noc += 2;
            } else {
                $n++;
            }
            if ($noc >= $cutlength) {
                break;
            }
        }
        if ($noc > $cutlength) {
            $n -= $i;
        }
        $returnstr = substr($sourcestr, 0, $n);


        if (substr($sourcestr, $n, 6)) {
            $returnstr = $returnstr . $suffix; //超过长度时在尾处加上省略号
        }
        return $returnstr;
    }

}
