<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Expand;

use Core\Db\Db as Db;

/**
 * 分页类公共模块
 * 
 */
class PageCommon {

    protected $linkStr = '', $suffix = false;

    /**
     * URL模式
     * @param type $group 组参数
     */
    protected function urlModel($group = '') {
        //这里移除GET中可能潜在影响程序正确处理的数据。
        unset($_GET['s'], $_GET['page'], $_GET[substr($_SERVER['REQUEST_URI'], 1)]);
        $db = Db::__init();
        $db->tableName('option');
        $result = $db->where('option_name = "urlModel"')->find();
        $urlModel = json_decode($result['value'], true);
        $url = '';
        if ($urlModel['index'] == '0') {
            $url .= '/index.php/';
        } else {
            $url .= '/';
        }

        /**
         * 正常模式不会生成HTML后缀
         */
        if ($urlModel['suffix'] == '1' && $urlModel['urlModel'] != '1') {
            $this->suffix = true;
        }


        switch ($urlModel['urlModel']) {
            case '2':
                $group = empty($group) ? '' : "{$group}-";
                $url .= $group . MODULE . "-" . ACTION;
                $url .= $this->urlLinkStr($_GET, '-');
                $this->linkStr = '-';
                break;
            case '3':
                $group = empty($group) ? '' : "{$group}/";
                $url .= $group . MODULE . "/" . ACTION;
                $url .= $this->urlLinkStr($_GET, '/');
                $this->linkStr = '/';
                break;
            case '1':
            default:
                $url = $urlModel['index'] == '0' ? '/index.php' : '/';
                $group = empty($group) ? '' : "g={$group}&";
                $url .= "?{$group}m=" . MODULE . "&a=" . ACTION;
                $url .= $this->urlLinkStr($_GET);
                $this->linkStr = '';
        }
        return DOCUMENT_ROOT.$url;
    }

    /**
     * URL的链接字符串格式
     * @param type $str 连接符的格式
     */
    protected function urlLinkStr($param, $str = '', $filterHtmlSuffix = false) {
        if (!empty($str)) {
            foreach ($param as $key => $value) {
                $url .= "{$str}{$key}{$str}{$value}";
            }
        } else {
            foreach ($param as $key => $value) {
                $url .= "&{$key}={$value}";
            }
        }

        if ($filterHtmlSuffix == true) {
            $url .= ".html";
        }

        return $url;
    }

}
