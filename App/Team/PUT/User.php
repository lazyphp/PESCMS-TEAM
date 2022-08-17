<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */


namespace App\Team\PUT;

class User extends Content {

    /**
     * 更新个人设置
     */
    public function setting() {
        $this->checkToken();
        $data['user_name'] = $this->isP('name', '请填写名称');
        $data['user_mail'] = $this->isP('mail', '请填写邮箱地址');
        $data['user_phone'] = $this->p('phone');
        $data['user_home'] = $this->p('home');
        if (!empty($_POST['password'])) {
            $data['user_password'] = \Core\Func\CoreFunc::generatePwd($this->session()->get('team')['user_account'] . $this->p('password'));
        }
        $data['noset']['user_id'] = $this->session()->get('team')['user_id'];


        $result = $this->db('user')->where('user_id = :user_id')->update($data);
        if ($result !== false) {
            $this->session()->set('team', \Model\Content::findContent('user', $_SESSION['team']['user_id'], 'user_id'));
        }

        $this->success('更新信息成功!');
    }

    /**
     * 更新头像
     */
    public function head() {
        $this->checkToken();
        $head = $this->isP('head', '请上传头像');
        \Model\Extra::checkUploadFile($head);
        $this->db('user')->where('user_id = :user_id')->update([
            'user_head' => $head,
            'noset' => [
                'user_id' => $this->session()->get('team')['user_id']
            ]
        ]);

        $newInfo = \Model\Content::findContent('user', $this->session()->get('team')['user_id'], 'user_id');

        $this->session()->set('team', $newInfo);

        $this->success('更新头像成功', $this->url('Team-User-setting'));
    }

}