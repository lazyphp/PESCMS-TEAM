<?php

/**
 * Pes for PHP 5.3+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

class Index extends \App\Team\Common {

    public function index() {
//        $this->assign('menu', \Model\Menu::menu());
        $this->layout();
    }

    /**
     * 获取系统信息
     */
    public function systemInfo() {
        if (false != ($sendmail_path = ini_get('sendmail_path'))) {
            $sysMail = 'Unix Sendmail ( Path: ' . $sendmail_path . ')';
        } elseif (false != ($SMTP = ini_get('SMTP'))) {
            $sysMail = 'SMTP ( Server: ' . $SMTP . ')';
        } else {
            $sysMail = 'Disabled';
        }
        $db = $this->db('option');
        $version = $db->where('id = 13')->find();
        $mysqlVersion = $db->query("select version() as version");
        $sysinfo = array(
            'wind_version' => $version['value'],
            'php_version' => PHP_VERSION,
            'server_software' => $_SERVER['SERVER_SOFTWARE'],
            'mysql_version' => $mysqlVersion[0]['version'],
            'max_upload' => ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'Disabled',
            'max_excute_time' => intval(ini_get('max_execution_time')) . ' seconds',
            'sys_mail' => $sysMail);

        $this->assign('sysinfo', $sysinfo);
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 后台菜单
     */
    public function menuList() {
        $this->assign('menu', \Model\Menu::menu());
        $this->assign('title', \Model\Menu::getTitleWithMenu());
        $this->layout();
    }

    /**
     * 添加/编辑菜单
     */
    public function menuAction() {
        $menuId = $this->g('id');
        if (empty($menuId)) {
            $this->assign('title', $GLOBALS['_LANG']['COMMON']['ADD']);
            $this->routeMethod('POST');
        } else {
            if (!$content = \Model\Menu::findMenu($menuId)) {
                $this->error($GLOBALS['_LANG']['MENU']['NOT_EXITS_MENU']);
            }
            $this->assign($content);
            $this->assign('title', $GLOBALS['_LANG']['COMMON']['EDIT']);
            $this->routeMethod('PUT');
        }
        $this->assign('topMenu', \Model\Menu::topMenu());
        $this->assign('menu_id', $menuId);
        $this->assign('url', $this->url('Team-Index-menuAction'));
        $this->layout();
    }

    /**
     * 清空换成
     * @param type $dirName
     */
    public function clear($dirName = 'Temp') {
        if ($handle = opendir("$dirName")) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dirName/$item")) {
                        $this->clear("$dirName/$item");
                    } else {
                        if (!unlink("$dirName/$item")) {
                            $this->error("{$GLOBALS['_LANG']['INDEX']['REMOVE_FAILE_FAILE']}： $dirName/$item");
                        }
                    }
                }
            }
            closedir($handle);
            if ($dirName == 'Temp') {
                $this->success($GLOBALS['_LANG']['INDEX']['CLEAR_CACHE_SUCCESS'], $this->url('Team-Index-systemInfo'));
            }
            if (!rmdir($dirName)) {
                $this->error("{$GLOBALS['_LANG']['INDEX']['REMOVE_DIR_FAIL']}： $dirName");
            }
        }
    }

    /**
     * 注销帐号
     */
    public function logout() {
        session_destroy();
        $this->success($GLOBALS['_LANG']['INDEX']['LOGOUT'], $this->url('Team-Login-index'));
    }

}
