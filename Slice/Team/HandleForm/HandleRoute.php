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
 * 处理路由规则 添加/编辑 提交的表单内容
 */
class HandleRoute extends \Core\Slice\Slice {

    /**
     * 更新哈希值
     */
    public function before() {
        $_POST['hash'] = (string)md5($_POST['controller'] . $_POST['param']);
    }

    /**
     * 更新路由规则
     */
    public function after() {
    }


}