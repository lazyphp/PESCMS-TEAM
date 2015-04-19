<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Install\App\Install\GET;

abstract class Common extends \Core\Controller\Controller {

    /**
     * 加载项目主题
     * @param string $themeFile 为空时，则调用 控制器名称_方法.php 的模板(参数不带.php后缀)。
     */
    protected function display($themeFile = '') {
        
        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }
        if (empty($themeFile)) {
            $file = THEME . '/' . MODULE . '_' . ACTION . '.php';
            $this->checkThemeFileExist($file, MODULE . '_' . ACTION . '.php');
            include $file;
        } else {
            $file = THEME . '/' . $themeFile . '.php';

            $this->checkThemeFileExist($file, "{$themeFile}.php");
            include $file;
        }
    }

    /**
     * @param type $themeFile 模板名称 为空时，则调用 控制器名称_方法.php 的模板(参数不带.php后缀)。
     * @param string $layout 布局模板文件名称 | 默认调用 layout(参数不带.php后缀)
     */
    protected function layout($themeFile = '', $layout = "layout") {

        if (empty($themeFile)) {
            $file = THEME . "/" . MODULE . '_' . ACTION . '.php';
            $this->checkThemeFileExist($file, MODULE . '_' . ACTION . '.php');
        } else {
            $file = THEME . "/" . $themeFile . '.php';
            $this->checkThemeFileExist($file, "{$themeFile}.php");
        }

        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }

        //检查布局文件是否存在
        $layout = THEME . "/{$layout}.php";

        $this->checkThemeFileExist($layout, "layout");
        require $layout;
    }

}
