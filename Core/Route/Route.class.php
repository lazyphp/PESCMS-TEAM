<?php

/**
 * PESCMS run in PHP 5.3+
 *
 * Copyright (c) 2014 PESMCMS (http://www.pesmcs.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Core\Route;

use Core\Abnormal\Abnormal as Abnormal,
    Core\Func\CoreFunc as CoreFunc;

/**
 * PES路由器
 * @author LuoBoss
 * @version 1.0
 */
class Route {

    /**
     * 析构函数设置restfull规则
     */
    public function __destruct() {
        /**
         * 没有找到方法时，则通过$_SERVER变量查找
         * 确认最终的restfull指向。
         */
        if (empty($_REQUEST['method'])) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    defined('METHOD') or define('METHOD', 'POST');
                    break;
                case 'PUT':
                    defined('METHOD') or define('METHOD', 'PUT');
                    break;
                case 'DELETE':
                    defined('METHOD') or define('METHOD', 'DELETE');
                    break;
                case 'GET':
                default :
                    defined('METHOD') or define('METHOD', 'GET');
            }
            return true;
        }

        switch (strtoupper($_REQUEST['method'])) {
            case 'POST':
                defined('METHOD') or define('METHOD', 'POST');
                break;
            case 'PUT':
                defined('METHOD') or define('METHOD', 'PUT');
                break;
            case 'DELETE':
                defined('METHOD') or define('METHOD', 'DELETE');
                break;
            case 'GET':
            default :
                defined('METHOD') or define('METHOD', 'GET');
        }
    }

    /**
     * 初始化路由器规则
     */
    public function index() {
        $requestUri = $this->filterHtmlSuffix($this->changeUrl());

        //拆分数据
        $routeArray = explode('-', $requestUri);

        if (count($routeArray) < 2 && (empty($_GET['m']) || empty($_GET['a']))) {
            /**
             * 防止浏览器因为寻找ico图标
             * 造成二次访问，产生多次访问。
             */
            if ($requestUri == 'favicon.ico') {
                return FALSE;
            } else {
                defined('GROUP') or define('GROUP', CoreFunc::loadConfig('DEFAULT_GROUP'));
                defined('MODULE') or define('MODULE', 'Index');
                defined('ACTION') or define('ACTION', 'index');
            }
        } else {
            /**
             * 暂时不清楚在nginx下，会多一个S的get参数。
             * 为了让程序的正常运行，所以将该参数清空。
             */
            unset($_GET['s']);
            $this->normal();
            $this->expand();
        }
    }

    /**
     * 正常的路由加载模式
     * @throws Abnormal
     */
    private function normal() {
        //获取所有组
        $group = explode(',', CoreFunc::loadConfig('APP_GROUP_LIST'));

        if (!empty($_GET['m']) && !empty($_GET['a'])) {
            //获取组
            if (empty($_GET['g'])) {
                define('GROUP', CoreFunc::loadConfig('DEFAULT_GROUP'));
            } elseif (in_array($_GET['g'], $group)) {
                $key = array_search($_GET['g'], $group);
                define('GROUP', $group[$key]);
            }
            define('MODULE', $_GET['m']);
            define('ACTION', $_GET['a']);
            //清空GET
            unset($_GET['g'], $_GET['m'], $_GET['a']);
        }
    }

    /**
     * 扩展模式
     */
    private function expand() {
        $requestUri = $this->filterHtmlSuffix($this->changeUrl());

        //拆分数据
        $routeArray = explode('-', $requestUri);

        $routeArray[0] = $this->splitIndex($routeArray[0]);

        //拆分组
        $groupList = explode(',', CoreFunc::loadConfig('APP_GROUP_LIST'));

        //判断URL首个参数是否存在于用户组
        if (in_array($routeArray[0], $groupList)) {
            define('GROUP', $routeArray[0]);
            define('MODULE', $routeArray[1]);
            define('ACTION', $this->splitAction($routeArray[2]));
            unset($routeArray[0], $routeArray[1], $routeArray[2]);
        } else {
            define('GROUP', CoreFunc::loadConfig('DEFAULT_GROUP'));
            define('MODULE', $routeArray[0]);
            define('ACTION', $this->splitAction($routeArray[1]));
            unset($routeArray[0], $routeArray[1]);
        }
        //将剩余的非GMA转化为GET参数，以便调用
        $paramArray = array_chunk($routeArray, 2);
        foreach ($paramArray as $key => $value) {
            $_REQUEST[$value[0]] = $_GET[$value[0]] = $value[1];
        }
    }

    /**
     * 调整URL的地址，以适应路由层的后续判断
     * @return type 返回处理好的URL
     */
    private function changeUrl() {
        $list = array('/', '-');

        /* 先获取脚本的URL，然后执行一个清除index动作 */
        $removeIndex = substr(str_replace("index.php", "", substr($_SERVER['SCRIPT_NAME'], 1)), 0, -1);
        /* 首次进行匹配替换,将含有index.php的后尾符替换为/ */
        $firstMatchUrl = str_ireplace("index.php-", "index.php/", str_replace($list, "-", substr($_SERVER['REQUEST_URI'], 1)));
        /* 第二次匹配，拆分URL */
        $secondMatchUrl = explode('/', $firstMatchUrl);

        /**
         * 接下来这部分，是根据第二次匹配后的结果进行判断的。
         * 不论什么样的URL，第二次匹配的数组必然只有2个！
         */
        if (empty($secondMatchUrl[1]) && empty($removeIndex)) {
            return $secondMatchUrl[0];
        } elseif (empty($secondMatchUrl[1]) && !empty($removeIndex)) {
            $replaceSymbol = str_ireplace("/", "-", $removeIndex);
            return str_ireplace($replaceSymbol . "-", $removeIndex . "/", $secondMatchUrl[0]);
        } elseif (!empty($secondMatchUrl[1]) && empty($removeIndex)) {
            return "index.php/" . $secondMatchUrl[1];
        } else {
            return $removeIndex . "/index.php/" . $secondMatchUrl[1];
        }
    }

    /**
     * 当URL存在下级目录时，执行一个替换操作
     * @param type $splitParam 替换的参数
     * @return type 返回替换好的参数
     */
    private function splitIndex($splitParam) {
        //当URL隐藏了index
        if ((substr($_SERVER['SCRIPT_NAME'], 1) != 'index.php') && !strstr($_SERVER['REQUEST_URI'], "index.php")) {
            $splitIndex = substr(str_replace('index.php', "", $_SERVER['SCRIPT_NAME']), 1);
            $result = str_replace($splitIndex, "", $splitParam);
            //当URL没有隐藏index
        } elseif (substr($_SERVER['SCRIPT_NAME'], 1) != 'index.php' || substr($_SERVER['SCRIPT_NAME'], 1) == 'index.php') {
            $splitIndex = substr(str_replace('index.php', "", $_SERVER['SCRIPT_NAME']), 1);
            $result = str_replace(substr($_SERVER['SCRIPT_NAME'], 1) . "/", "", $splitParam);
        }
        return $result;
    }

    /**
     * 拆分URL中ACTION后面附带的各种参数
     */
    private function splitAction($param) {
        /**
         * 拆分问号
         */
        $mark = explode('?', $param);
        return $mark[0];
    }

    /**
     * 过滤后缀HTML
     * @param type $url 待过滤的URL
     */
    private function filterHtmlSuffix($url) {
        if (substr($url, '-5') == '.html') {
            return substr($url, '0', '-5');
        }
        return $url;
    }

}
