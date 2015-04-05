<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

class Theme extends \App\Team\Common {

    private $enableTheme;

    /**
     * 主题列表
     */
    public function index() {
        $this->enableTheme = \Model\Option::findOption('theme');
        $list = $this->getThemeList();
        $this->assign('list', $list);
        $this->assign('title', $GLOBALS['_LANG']['MENU_LIST'][\Model\Menu::getTitleWithMenu()]);
        $this->layout();
    }

    /**
     * 获取主题列表
     * @param type $dir 主题目录
     */
    private function getThemeList() {
        //获取当前使用的主题名称
        $dir = "./Theme/Home/";
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    //获取主题列表
                    if (is_dir($dir . $file) && $file != "." && $file != "..") {
                        //获取主题信息
                        if (is_file($dir . $file . '/README.md')) {
                            $content = file($dir . $file . '/README.md');
                            foreach ($content as $key => $value) {
                                $cut = explode(':', $value);
                                if ($cut[0] == 'url') {
                                    $theme[$file]['readme'][$cut[0]] = substr($value, 4);
                                } else {
                                    $theme[$file]['readme'][$cut[0]] = $cut[1];
                                }
                            }
                        } else {
                            $theme[$file]['readme'] = '';
                        }
                        //获取主题版权地址
                        if (is_file($dir . $file . '/LICENSE.txt')) {
                            $theme[$file]['license'] = substr($dir . $file . '/LICENSE.txt', 1);
                        } else {
                            $theme[$file]['license'] = '/LICENSE';
                        }
                        //获取主题截图
                        if (is_file($dir . $file . '/screenshot.png')) {
                            $theme[$file]['thumb'] = substr($dir . $file . '/screenshot.png', 1);
                        } else {
                            $theme[$file]['thumb'] = '/img/lose.png';
                        }
                        //主题是否被启用
                        if ($file == $this->enableTheme['value']) {
                            $theme[$file]['status'] = 1;
                        } else {
                            $theme[$file]['status'] = 0;
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $theme;
    }

}
