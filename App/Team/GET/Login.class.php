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

class Login extends \Core\Controller\Controller{

    /**
     * 登录页
     */
    public function index(){
        $this->bing();
        $this->display();
    }

    /**
     * 获取必应背景图
     */
    private function bing(){
        $cache = new \Expand\FileCache('86400');
        $bingCache = $cache->loadCache('bing');
        if($bingCache === false){
            $url = 'http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN';
            $res= file_get_contents($url);
            $bing = json_decode($res, true);
            if(!empty($bing['images'])){
                $img = [];
                foreach($bing['images'] as $key => $value){
                    $img = $value['url'];
                }
            }
            $bingCache = $cache->creatCache('bing', json_encode($img));
        }

        $this->assign('bing', json_decode($bingCache, true));
    }

    /**
     * 退出账号
     */
    public function logout(){
        session_destroy();
        $this->success('您已安全退出', $this->url('Ticket-Login-index'));
    }

}