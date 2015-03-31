<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 菜单模型
 */
class Menu extends \Core\Model\Model {

    /**
     * 生成后台菜单
     */
    public static function menu() {
        $result = self::db('menu AS m')->field("m.*, IF(parent.top_id IS NULL, m.menu_id, parent.top_id) AS top_id, IF(parent.top_listsort IS NULL, '0', parent.top_listsort) AS top_listsort, IF(parent.top_name IS NULL, m.menu_name, top_name) AS top_name, menu_icon")->join("(SELECT `menu_id` AS top_id, `menu_name` AS top_name, `menu_pid` AS top_pid, `menu_listsort` AS top_listsort FROM `" . self::$prefix . "menu` where menu_pid = 0) AS parent ON parent.top_id = m.menu_pid")->order('top_listsort desc, m.menu_listsort desc, m.menu_id asc')->select();
        foreach ($result as $key => $value) {
            if ($value['menu_pid'] == 0) {
                $menu[$value['top_name']]['menu_id'] = $value['top_id'];
                $menu[$value['top_name']]['menu_name'] = $value['top_name'];
                $menu[$value['top_name']]['menu_icon'] = $value['menu_icon'];
                $menu[$value['top_name']]['menu_listsort'] = $value['menu_listsort'];
            }
        }
        foreach ($result as $key => $value) {
            if (!empty($menu[$value['top_name']]) && $value['menu_pid'] != 0) {
                $menu[$value['top_name']]['menu_child'][] = $value;
            }
        }
        return $menu;
    }

    /**
     * 根据菜单获取标题
     */
    public static function getTitleWithMenu() {
        $result = self::db('menu')->field('menu_name')->where('menu_url = :menu_url')->find(array('menu_url' => 'Admin-' . MODULE . "-" . ACTION));
        return $result['menu_name'];
    }

    /**
     * 顶级菜单
     */
    public static function topMenu() {
        return self::db('menu')->where('menu_pid = 0')->order('menu_listsort desc, menu_id asc')->select();
    }

    /**
     * 查找菜单
     * @param type $menuId 菜单ID
     */
    public static function findMenu($menuId) {
        return self::db('menu')->where('menu_id = :menu_id')->find(array('menu_id' => $menuId));
    }

    /**
     * 添加菜单
     */
    public static function addMenu() {
        $data = self::baseForm();
        if ($data['status'] == false) {
            return $data;
        }
        $addResult = self::db('menu')->insert($data['mes']);

        if ($addResult == false) {
            return self::error($GLOBALS['_LANG']['MENU']['ADD_MENU_FAIL']);
        }
        return self::success();
    }

    /**
     * 更新菜单
     */
    public static function updateMenu() {
        $data = self::baseForm();
        if ($data['status'] == false) {
            return $data;
        }
        $updateResult = self::db('menu')->where('menu_id = :menu_id')->update($data['mes']);

        if ($updateResult == false) {
            return self::error($GLOBALS['_LANG']['MENU']['UPDATE_MENU_FAIL']);
        }
        return self::success();
    }

    /**
     * 菜单基础表单
     */
    public static function baseForm() {

        if (!(self::isP('menu_id')) && self::p('method') == 'PUT') {
            return self::error($GLOBALS['_LANG']['MENU']['LOST_MENU_ID']);
        } elseif (self::p('method') == 'PUT') {

            $data['noset']['menu_id'] = self::isP('menu_id');
            if (!self::findMenu($data['noset']['menu_id'])) {
                return self::error($GLOBALS['_LANG']['MENU']['NOT_EXITS_MENU']);
            }
        }

        if ($_POST['menu_pid'] < '0') {
            return self::error($GLOBALS['_LANG']['MENU']['SELECT_TOP_MENU']);
        } elseif ($_POST['menu_pid'] > '0') {

            if (!self::findMenu($_POST['menu_pid'])) {
                return self::error($GLOBALS['_LANG']['MENU']['NOT_EXITS_MENU']);
            }

            if (!$data['menu_url'] = self::isP('menu_url')) {
                return self::error($GLOBALS['_LANG']['MENU']['ENTER_MENU_URL']);
            }
        }
        $data['menu_pid'] = (int) $_POST['menu_pid'];

        if (!$data['menu_name'] = self::isP('menu_name')) {
            return self::error($GLOBALS['_LANG']['MENU']['ENTER_MENU_NAME']);
        }

        $data['menu_listsort'] = (int) self::p('menu_listsort');
        return self::success($data);
    }

    /**
     * 添加模型的菜单
     * @param type $name 菜单语言键值
     * @param type $pid 菜单父类ID
     * @param type $url 菜单URL
     * @return type 返回插入结果
     */
    public static function insertModelMenu($name, $pid, $url) {
        return self::db('menu')->insert(array('menu_name' => $name, 'menu_pid' => $pid, 'menu_url' => $url));
    }

    /**
     * 设置菜单语言包
     * @param type $langKey
     * @param type $langValue
     */
    public static function setMenuLang($langKey, $langValue) {
        $GLOBALS['_LANG']['MENU_LIST'][$langKey] = $langValue;
        $file = PES_PATH . "Language/{$_COOKIE['language']}/Admin/menu.php";
        $fp = fopen($file, "w");
        $str = "<?php\n";
        $str .= "return array(\n";
        $str .= "       'MENU_LIST' => array(\n";
        foreach ($GLOBALS['_LANG']['MENU_LIST'] as $key => $value) {
            $str .= "       '{$key}' => '{$value}',\n";
        }
        $str .= "       )\n";
        $str .= ");\n";
        fwrite($fp, $str);
        fclose($fp);
    }
    
    /**
     * 删除菜单
     */
    public static function deleteMenu($menuName){
        return self::db('menu')->where('menu_name = :menu_name')->delete(array('menu_name' => strtoupper($menuName)));
    }

}
