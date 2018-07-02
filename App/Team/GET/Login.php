<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */

namespace App\Team\GET;

class Login extends \Core\Controller\Controller {

    public function __init() {
        parent::__init();
        $this->bing();
    }

    /**
     * 登录页
     */
    public function index() {
        $this->assign('title', '登录账号');
        $this->layout('', 'Login_layout');
    }

    /**
     * 获取必应背景图
     */
    private function bing() {
        $cache = new \Expand\FileCache('86400');
        $bingCache = $cache->loadCache('bing');
        if ($bingCache === false) {
            $url = 'http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN';
            $res = file_get_contents($url);
            $bing = json_decode($res, true);
            if (!empty($bing['images'])) {
                $img = [];
                foreach ($bing['images'] as $key => $value) {
                    $img = \Model\Extra::checkInputValueType($value['url'], 2) === false? "https://www.bing.com{$value['url']}" : $value['url'];
                }
            }
            $bingCache = $cache->creatCache('bing', json_encode($img));
        }

        $this->assign('bing', json_decode($bingCache, true));
    }

    /**
     * 退出账号
     */
    public function logout() {
        session_destroy();
        $this->jump($this->url('Ticket-Login-index'));
    }

    /**
     * 查找密码
     */
    public function findPassword() {
        $this->assign('title', '找回密码');
        $this->layout('', 'Login_layout');
    }

    /**
     * 重置密码
     */
    public function setPassword() {
        $mark = $this->isG('mark', '请提交正确的MARK');
        $checkMark = $this->db('findpassword')->where('findpassword_createtime >= :time AND findpassword_mark = :findpassword_mark ')->find([
            'time' => time() - 86400,
            'findpassword_mark' => $mark
        ]);
        if (empty($checkMark)) {
            $this->error('MARK不存在', '/');
        }

        $this->assign('title', '重置密码');
        $this->layout('', 'Login_layout');
    }

    public function verify() {
        $verify = new \Expand\Verify();
        $verify->createVerify('4');
    }

}