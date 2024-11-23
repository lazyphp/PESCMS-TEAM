<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Option extends \Core\Model\Model {

    /**
     * 获取配置项
     * @param $optionName
     * @param $isJson
     * @return mixed
     */
    public static function getOptionValue($optionName, $isJson = false) {
        $content = \Model\Content::findContent('option', $optionName, 'option_name');
        if ($isJson) {
            return json_decode($content['value'], true);
        } else {
            return $content['value'];
        }

    }



}