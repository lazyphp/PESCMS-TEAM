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

    const EMAIL = 1;
    const URL = 2;
    const NUMBER = 3;
    const ALPHANUMERIC = 4;
    const PHONE = 5;

    /**
     * 生成唯一的ID
     */
    public static function getOnlyNumber() {
        $randStr = range('A', 'Z');
        shuffle($randStr);
        $microtime = explode(" ", microtime());
        $number = round($microtime['0'] * $microtime['1'] * rand(1, 100));

        $No = "";
        for ($i = 0; $i < rand(1, 10); $i++) {
            $No .= $randStr[$i];
        }
        return $No . $number;
    }


    /**
     * 验证输入的内容类型
     * @param $value 输入的内容
     * @param $type 验证的类型
     * @return bool 符合则返回true，反之false
     */
    public static function checkInputValueType($value, $type) {
        switch ($type) {
            case 1:
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            case 2:
                $preg = "/^1[3456789]\d{9}$/";
                if (!preg_match($preg, $value)) {
                    return false;
                }
                break;
            case 3:
                if (!is_numeric($value)) {
                    return false;
                }
                break;
            case 4:
                if(!preg_match("/^[a-z]*$/i",$value)){
                    return false;
                }
                break;
            case 5:
                return filter_var($value, FILTER_VALIDATE_URL);
            case 6:
                if(!preg_match("/^[a-z\d]*$/i",$value)){
                    return false;
                }
        }
        return true;
    }

    /**
     * 快速插入通知
     * @param string $title 标题 | 可以为空
     * @param $content 发送的内容
     * @param $type 通知类型
     * @return mixed
     */
    public static function insertSend($account, $title = '', $content, $type){
        return self::db('send')->insert([
            'send_account' => $account,
            'send_title' => $title,
            'send_content' => $content,
            'send_time' => '0',
            'send_type' => $type
        ]);
    }

    /**
     * 验证上传文件是否存在
     * @param $file
     */
    public static function checkUploadFile($file){
        if(!is_file(HTTP_PATH.$file)){
            self::error('上传的图片或者文件不存在,请重新上传!');
        }
    }

    /**
     * 移除指定目录下所有文件
     * @param string $dirName 要移除的目录
     * @param string $stopDir 停止移除的目录
     * @return array
     */
    public static function clearDirAllFile($dirName = PES_CORE.'Temp', $stopDir = PES_CORE.'Temp') {
        if ($handle = opendir("$dirName")) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dirName/$item")) {
                        self::clearDirAllFile("$dirName/$item");
                    } else {
                        if (!unlink("$dirName/$item")) {
                            return [
                                'status' => 0,
                                'msg' => "移除文件失败： $dirName/$item"
                            ];
                        }
                    }
                }
            }
            closedir($handle);
            if ($dirName == $stopDir) {
                return [
                    'status' => 200,
                    'msg' => "{$dirName}目录已清空"
                ];
            }

            if (!rmdir($dirName)) {
                return [
                    'status' => 0,
                    'msg' => "移除{$dirName}目录失败"
                ];
            }

        }
    }

}
