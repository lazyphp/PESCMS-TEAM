<?php

/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Team\PUT;

class Setting extends \Core\Controller\Controller {

    private $info = [];

    public function action() {
        $this->checkToken();
        $list = $this->db('option')->where('option_id > 0')->select();

        foreach ($list as $item) {
            if ($item['option_required'] == 1) {
                $value = $this->isP($item['option_name'], "{$item['name']}为必填项，请填写/选择该项内容后再次提交", false);
            } else {
                $value = $this->p($item['option_name'], false);
            }

            if (isset($item['option_type'])) {
                switch ($item['option_type']) {
                    case 'setting_option':
                        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                        break;
                    case 'json':
                        $value = json_encode(explode(',', $value));
                        break;
                    case 'setting_version':
                        continue 2;
                }
            }


            $this->db('option')->where('option_name = :option_name')->update([
                'noset' => [
                    'option_name' => $item['option_name']
                ],
                'value' => $value
            ]);

        }

        $this->success('保存设置成功!', $this->url('Team-Setting-action'));
    }

    /**
     * 自动更新
     */
    public function atUpgrade() {
        if (empty($this->session()->get('oldVersion'))) {
            $this->session()->set('oldVersion', \Core\Func\CoreFunc::$param['system']['version']);
        }

        $getPatch = json_decode((new \Expand\cURL())->init(PESCMS_URL . '/patch/5/' . \Core\Func\CoreFunc::$param['system']['version'], [], [
            CURLOPT_HTTPHEADER => [
                'X-Requested-With: XMLHttpRequest',
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
            ]
        ]), true);

        if (empty($getPatch)) {
            $this->error('连接PESCMS服务器失败!');
        }

        if ($getPatch['status'] == 200) {
            $patchSave = APP_PATH . 'Upgrade/' . pathinfo($getPatch['data']['update_patch_file'])['basename'];

            $getFile = (new \Expand\cURL())->init(PESCMS_URL . "{$getPatch['data']['update_patch_file']}");

            $download = fopen($patchSave, 'w');
            fwrite($download, $getFile);
            fclose($download);

            if (hash_file('sha256', $patchSave) !== $getPatch['data']['patch_sha256']) {
                exit('哈希值不一致');
            }

            (new \Expand\zip())->unzip($patchSave);

            $this->actionini();

            //更新完毕，删除文件
            unlink($patchSave);

            //继续跳转至自动更新方法
            $this->success("{$getPatch['data']['new_version']}升级完毕,自动更新程序正在运行,请勿关闭浏览器", $this->url(GROUP . '-Setting-atUpgrade', ['method' => 'PUT', 'complete' => 1]), '1');

        } elseif ($getPatch['status'] == 0) {
            //不是从自动更新跳转的，则提示接口信息
            if (empty($_GET['complete'])) {
                $this->assign('info', [$getPatch['msg']]);
            }
            $this->upgradeStatistics(\Core\Func\CoreFunc::$param['system']['version']);

            //获取从旧版到最新版的升级说明
            $detail = json_decode((new \Expand\cURL())->init(PESCMS_URL . '/patch/detail', ['method' => 'GET', 'version' => $this->session()->get('oldVersion'), 'project' => 5,],
                [
                    CURLOPT_HTTPHEADER => [
                        'X-Requested-With: XMLHttpRequest',
                        'Accept: application/json',
                    ]
                ]), true);

            $this->assign('detail', $detail['data']);

            $this->layout('Setting_upgrade_info');
        } else {
            $this->error('解析接口出错');
        }
    }

    /**
     * 手动更新
     */
    public function mtUpgrade() {
        $file = $_FILES['zip'];
        if (isset(pathinfo($file['name'])['extension']) && pathinfo($file['name'])['extension'] != 'zip') {
            $this->error('请导入zip的更新补丁');
        }

        //获取文件hash值
        $getPatch = json_decode((new \Expand\cURL())->init(PESCMS_URL . '/patch/5/' . \Core\Func\CoreFunc::$param['system']['version'], [], [
            CURLOPT_HTTPHEADER => [
                'X-Requested-With: XMLHttpRequest',
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
            ]
        ]), true);
        if (empty($getPatch)) {
            $this->error('连接PESCMS服务器失败!');
        }

        if ($getPatch['status'] != 200) {
            $this->error($getPatch['msg']);
        }

        if (hash_file('sha256', $file['tmp_name']) !== $getPatch['data']['patch_sha256']) {
            $this->error('非官方更新补丁!请访问<a href="https://www.pescms.com" target="_blank">PESCMS</a>获取最新的补丁', 'javascript:history.go(-1)', '10');
        }

        (new \Expand\zip())->unzip($file['tmp_name']);

        $this->actionini();

        $this->upgradeStatistics($getPatch['data']['new_version']);
        $this->layout('Setting_upgrade_info');
    }

    /**
     * 执行数据库更新
     * @return bool|string
     */
    private function actionini() {
        $version = \Core\Func\CoreFunc::$param['system']['version'];

        $ini = APP_PATH . 'Upgrade/action.ini';
        if (!file_exists($ini)) {
            return ['升级配置数据文件不存在'];
        }

        $ini_array = parse_ini_file($ini, true);


        foreach ($ini_array as $iniversion => $value) {

            if (version_compare($version, $iniversion) < 0) {

                //更新SQL信息
                if (!empty($value['sql'])) {
                    foreach ($value['sql'] as $file) {
                        $sql = file_get_contents(APP_PATH . '/Upgrade/sql/' . $file);
                        if (!empty($sql)) {
                            $this->db()->exec($sql);
                        } else {
                            //更新SQL文件失败，则记录起来
                            $this->info[] = "更新SQL文件出错: " . APP_PATH . '/Upgrade/sql/' . $file;
                        }
                    }
                }

                //移除废弃的文件(更名)
                if (!empty($value['delete'])) {
                    foreach ($value['delete'] as $file) {
                        if (rename(APP_PATH . $file, APP_PATH . $file . '_remove') != true) {
                            $this->info[] = "移除文件出错: " . APP_PATH . $file;
                        }
                    }
                }

                $this->db('option')->where('option_name = :option_name')->update([
                    'value' => $iniversion,
                    'noset' => [
                        'option_name' => 'version'
                    ]
                ]);
            }
        }
        unlink($ini);
        return true;
    }

    /**
     * 官方升级统计
     * @description 本功能仅用于官方统计程序版本的使用情况
     * @param $version
     */
    private function upgradeStatistics($version) {
        (new \Expand\cURL())->init(PESCMS_URL . '/?g=Api&m=Statistics&a=action', [
            'id'      => 1,
            'type'    => 2,
            'version' => $version
        ]);
    }

}