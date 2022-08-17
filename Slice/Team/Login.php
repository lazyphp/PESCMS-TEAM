<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace Slice\Team;

/**
 * 登录验证切片
 * Class Login
 */
class Login extends \Core\Slice\Slice{

    public function before() {
        if(empty($this->session()->get('team')['user_id'])){
            $url = empty($_SERVER['REQUEST_URI']) ? '' : base64_encode($_SERVER['REQUEST_URI']);
            $this->jump($this->url('Team-Login-index', ['back_url' => $url]));
        }
    }

    public function after() {
    }


}