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
 * 额外的模型
 * 主要存放一些冷门，定位不准确，傻傻的方法
 */
class Extra extends \Core\Model\Model {

    /**
     * 获取更新
     * @param type $version 当前版本
     * @return boolean 返回获取的版本信息
     */
    public static function getUpdate($version) {
        if (!function_exists('curl_init')) {
            return array('status' => '-1', 'mes' => '系统没有启动CURL扩展');
        }
        $url = "http://www.cms.com/Update/index/version/{$version}/program/2";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);	
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        return json_decode($tmpInfo, true);
    }

}
