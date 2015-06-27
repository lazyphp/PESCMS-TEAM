<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Controller;

/**
 * PES控制器
 * @author LuoBoss
 * @version 1.0
 */
class Controller {

    protected $prefix, $param = array();

    public final function __construct() {
        $this->prefix = \Core\Func\CoreFunc::loadConfig('DB_PREFIX');
        $this->__init();
    }
    
    /**
     * 实现自定义构造函数
     */
    public function __init(){
        
    }

    /**
     * 获取系统配置信息
     * @param type $name 配置信息 | 为空则获取所有
     * @return type 返回配置信息
     */
    protected function loadConfig($name = NULL) {
        return \Core\Func\CoreFunc::loadConfig($name);
    }

    /**
     * 初始化数据库
     * @param str $name 表名
     * @return obj 返回数据库对象
     */
    protected function db($name = '') {
        static $db;

        if (empty($db)) {
            $db = \Core\Db\Db::__init();
        }

        $db->tableName($name);
        return $db;
    }

    /**
     * 安全过滤GET提交的数据
     * @param string $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     * @return string 返回处理完的数据
     */
    protected function g($name, $htmlentities = TRUE) {
        if (is_array($_GET[$name])) {
            return $_GET[$name];
        }
        if ((bool) $htmlentities) {
            $name = htmlspecialchars(trim($_GET[$name]));
        } else {
            $name = trim($_GET[$name]);
        }

        return $name;
    }

    /**
     * 安全过滤POST提交的数据
     * @param string $name 名称
     * @param boolean $htmlentities 是否转义HTML标签
     * @return string 返回处理完的数据
     */
    protected function p($name, $htmlentities = TRUE) {
        if (is_array($_POST[$name])) {
            return $_POST[$name];
        }
        if ((bool) $htmlentities) {
            $name = htmlspecialchars(trim($_POST[$name]));
        } else {
            $name = trim($_POST[$name]);
        }
        return $name;
    }

    /**
     * 判断GET是否有数据提交
     * @param sting $name 名称
     * @param sting $message 返回的提示信息
     * @param boolean $htmlentities 是否转义HTML标签
     */
    protected function isG($name, $message, $htmlentities = TRUE) {
        //当为0时，直接返回
        if ($_GET[$name] == '0') {
            return $this->g($name, $htmlentities);
        } elseif (is_array($_GET[$name])) {
            return $_GET[$name];
        }
        if (empty($_GET[$name]) || !trim($_GET[$name]) || !is_string($_GET[$name])) {
            $this->error($message);
        } elseif (empty($_GET[$name]) && is_array($_GET[$name])) {
            $this->error($message);
        }
        return $this->g($name, $htmlentities);
    }

    /**
     * 判断POST是否有数据提交
     * @param sting $name 名称
     * @param sting $message 返回的提示信息
     * @param boolean $htmlentities 是否转义HTML标签
     */
    protected function isP($name, $message, $htmlentities = TRUE) {
        //当为0时，直接返回
        if ($_POST[$name] == '0') {
            return $this->p($name, $htmlentities);
        } elseif (is_array($_POST[$name])) {
            return $_POST[$name];
        }
        if (empty($_POST[$name]) || !trim($_POST[$name]) || !is_string($_POST[$name])) {
            $this->error($message);
        } elseif (empty($_POST[$name]) && is_array($_POST[$name])) {
            $this->error($message);
        }
        return $this->p($name, $htmlentities);
    }

    /**
     * 模板变量赋值
     */
    protected function assign($name, $value = '') {
        if (is_array($name)) {
            $this->param = array_merge($this->param, $name);
        } elseif (is_object($name)) {
            foreach ($name as $key => $val)
                $this->param[$key] = $val;
        } else {
            $this->param[$name] = $value;
        }
    }

    /**
     * 加载页眉
     * @param type $theme 页眉名称
     */
    protected function header($theme = 'header') {
        $this->display($theme);
    }

    /**
     * 加载页脚
     * @param type $theme 页脚名称
     */
    protected function footer($theme = 'footer') {
        $this->display($theme);
    }

    /**
     * 加载项目主题
     * @param string $themeFile 为空时，则调用 控制器名称_方法.php 的模板(参数不带.php后缀)。
     */
    protected function display($themeFile = '') {

        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }

        $themeName = $this->chooseTheme();

        if (empty($themeFile)) {
            $file = THEME . '/' . GROUP . '/' . $themeName . "/" . MODULE . '_' . ACTION . '.php';
            $this->checkThemeFileExist($file, MODULE . '_' . ACTION . '.php');
            include $file;
        } else {
            $file = THEME . '/' . GROUP . '/' . $themeName . "/" . $themeFile . '.php';

            $this->checkThemeFileExist($file, "{$themeFile}.php");
            include $file;
        }
    }

    /**
     * @param type $themeFile 模板名称 为空时，则调用 控制器名称_方法.php 的模板(参数不带.php后缀)。
     * @param string $layout 布局模板文件名称 | 默认调用 layout(参数不带.php后缀)
     */
    protected function layout($themeFile = '', $layout = "layout") {

        $themeName = $this->chooseTheme();

        if (empty($themeFile)) {
            $file = THEME . '/' . GROUP . '/' . $themeName . "/" . MODULE . '_' . ACTION . '.php';
            $this->checkThemeFileExist($file, MODULE . '_' . ACTION . '.php');
        } else {
            $file = THEME . '/' . GROUP . '/' . $themeName . "/" . $themeFile . '.php';
            $this->checkThemeFileExist($file, "{$themeFile}.php");
        }

        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }

        //检查布局文件是否存在
        $layout = THEME . '/' . GROUP . "/{$themeName}/{$layout}.php";

        $this->checkThemeFileExist($layout, "layout");
        require $layout;
    }

    /**
     * 选择前后台主题名称
     */
    private function chooseTheme() {
        if (GROUP == 'Admin') {
            $themeName = \Model\Option::findOption('backstagetheme');
        } else {
            $themeName = \Model\Option::findOption('theme');
        }
        return $themeName['value'];
    }

    /**
     * 检查主题文件是否存在
     */
    protected function checkThemeFileExist($path, $fileName) {
        if (!is_file($path)) {
            $this->error("The theme file {$fileName} not exist!");
        }
    }

    /**
     * 执行成功提示信息
     * @param string $message 信息
     * @param string $url 跳转地址|默认为返回上一页
     * @param int $waitSecond 跳转等待时间
     */
    protected function success($message, $jumpUrl = 'javascript:history.go(-1)', $waitSecond = '3') {
        self::isAjax(200, $message);

        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }
        require $this->promptPage();
        exit;
    }

    /**
     * 执行失败提信息
     * @param string $message 信息
     * @param string $url 跳转地址|默认为返回上一页
     * @param int $waitSecond 跳转等待时间
     */
    protected function error($error, $jumpUrl = 'javascript:history.go(-1)', $waitSecond = '3') {
        self::isAjax(0, $error);

        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty($this->param)) {
            extract($this->param, EXTR_OVERWRITE);
        }
        require $this->promptPage();
        exit;
    }

    /**
     * 以302方式跳转页面
     */
    protected function jump($url) {
        header("Location:{$url}");
        exit;
    }

    /**
     * 获取提示页
     * @return type 返回模板
     */
    private function promptPage() {
        $theme = $this->loadConfig(strtoupper(GROUP) . '_MES_PROMPT');
        return empty($theme) ? PES_CORE . 'Theme/jump.php' : $theme;
    }

    /**
     * 返回ajax数据
     * @param type $data 调用数据
     * @param type $code 状态码|默认200
     */
    protected function ajaxReturn($data, $code = '200') {
        self::isAjax($code, $data);
    }

    /**
     * 判断是否ajax提交
     * @param str $code 状态码
     * @param str $info 信息
     * @return boolean|json|xml|str 返回对应的数据类型 
     */
    private static function isAjax($code, $info) {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return FALSE;
        }
        $type = explode(',', $_SERVER['HTTP_ACCEPT']);
        $status['status'] = $code;
        $status['info'] = $info;
        switch ($type[0]) {
            case 'application/json':
                exit(json_encode($status));
                break;
            case 'text/javascript':
                // javascript 或 JSONP 格式  需要扩展
                exit();
                break;
            case 'text/html':
                exit($status);
                break;
            case 'application/xml':
                //  XML 格式  需要扩展
                exit();
                break;
        }
    }

    /**
     * 确定SQL语句执行是否成功
     * @param bool $result SQL的执行结果
     * @param string $messages 提示信息
     * @param Description string $url 跳转地址
     * @return bool
     */
    protected function determineSqlExecResult($result, $messages, $url = 'javascript:history.go(-1)') {
        if ($result == false) {
            $this->error($messages, $url);
        }
    }

    /**
     * 验证令牌
     */
    protected function chedkToken() {
        if (empty($_REQUEST['token'])) {
            $this->error($GLOBALS['_LANG']['TOKEN_LOST']);
        }

        if ($_REQUEST['token'] != $_SESSION['token']) {
            $this->error($GLOBALS['_LANG']['TOKEN_ERROR']);
        }
        unset($_SESSION['token']);
    }

    /**
     * 生成URL链接
     * @param type $controller 链接的控制器
     * @param array $param 参数
     * @return type 返回URL
     */
    protected function url($controller, array $param = array()) {
        return \Core\Func\CoreFunc::url($controller, $param);
    }

    /**
     * restful方法
     */
    protected function routeMethod($type) {
        $this->assign('method', $type);
    }

}
