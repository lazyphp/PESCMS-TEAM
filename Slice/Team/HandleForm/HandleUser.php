<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace Slice\Team\HandleForm;

/**
 * 处理后台 用户添加/编辑提交过来的密码表单
 */
class HandleUser extends \Core\Slice\Slice {

    public function before() {

        if (METHOD == 'POST') {
            $this->isP('password', '请填写密码');
        }

        if (empty($_POST['password'])) {
            $_POST['password'] = \Model\Content::findContent('user', $_POST['id'], 'user_id')['user_password'];
        } else {
            $_POST['password'] = (string)\Core\Func\CoreFunc::generatePwd($this->p('account').$this->p('password'));
        }


    }

    public function after() {
    }


}