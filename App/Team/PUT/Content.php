<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Team\PUT;

/**
 * 公用内容更新
 */
class Content extends \Core\Controller\Controller {

    /**
     * 更新内容
     * @param type $jump 是否跳转.当继承本类时,若不跳转,提交false
     * @param type $commit 是否提交事务.默认提交.若想继承者继续在本事务中操作,请提交false
     */
    public function action($jump = TRUE, $commit = TRUE) {
        $this->checkToken();
        $this->db()->transaction();
        $updateResult = \Model\Content::updateContent();

        if (!empty($_POST['back_url'])) {
            $url = base64_decode($_POST['back_url']);
        } else {
            $url = $this->url(GROUP . '-' . MODULE . '-index');
        }

        if ($commit === TRUE) {
            $this->db()->commit();
        }

        if ($jump === TRUE) {
            $this->success('更新内容成功', $url);
        }
    }

    /**
     * 内容排序
     */
    public function listsort() {
        $this->checkToken();
        foreach ($_POST['id'] as $key => $value) {
            \Model\ModelManage::updateSortFromModel(MODULE, $key, $value);
        }

        if (!empty($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
        } else {
            $url = "";
        }
        $this->success('内容排序成功', $url);
    }

}
