<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Install\App\Install\GET;

class Index extends Common {

    public function __init() {
        if (is_file(PES_PATH . '/Install/install.txt')) {
            $this->error('不能再次执行安装程序！');
        }
    }

    /**
     * 欢迎界面
     */
    public function index() {
        $this->assign('title', '欢迎使用PESCMS TEAM');
        $this->layout();
    }

    /**
     * 验证扩展
     */
    public function config() {
        $phpVersion = explode('.', phpversion());
        $check['version'] = $phpVersion['1'] >= 4 ? true : false;

        $check['pdo'] = in_array('pdo_mysql', get_loaded_extensions()) ? true : false;

        $check['gd'] = function_exists('gd_info') ? true : false;

        $check['curl'] = function_exists('curl_version') ? true : false;
        $this->assign($check);
        $this->assign('title', '配置信息');
        $this->layout();
    }

    /**
     * 配置选项
     */
    public function option() {
        $data['DB_TYPE'] = 'mysql';
        $data['DB_HOST'] = $this->isP('host', '请填写数据库地址!');
        $data['DB_NAME'] = $this->isP('name', '请填写数据库名称!');
        $data['DB_USER'] = $this->isP('account', '请填写数据库帐号!');
        $data['DB_PWD'] = $this->isP('passwd', '请填写数据库密码!');
        $data['DB_PORT'] = $this->isP('port', '请填写数据库端口!');
        $data['DB_PREFIX'] = 'pes_';
        $data['PRIVATE_KEY'] = substr(md5(uniqid()), '0', '10');
        $data['USER_KEY'] = substr(md5(uniqid()), '10', '10');

        //写入安装配置信息
        $installConfig = require PES_PATH . '/Install/Config/config_same.php';
        $fopen = fopen(PES_PATH . '/Install/Config/config.php', 'w+');
        if (!$fopen) {
            $this->error('文件无法打开，请检测程序安装目录是否设置足够的权限');
        }

        $str = "<?php\n return array(\n";
        foreach (array_merge($data, $installConfig) as $key => $value) {
            $str .= "'{$key}' => '{$value}',\n";
        }
        $str .= ");";
        fwrite($fopen, $str);
        fclose($fopen);

        //写入运行配置信息
        $config = require PES_PATH . '/Config/config_same.php';
        $fopen = fopen(PES_PATH . '/Config/config.php', 'w+');
        if (!$fopen) {
            $this->error('文件无法打开，请检测程序目录是否设置足够的权限');
        }

        $str = "<?php\n return array(\n";
        foreach (array_merge($data, $config) as $key => $value) {
            $str .= "'{$key}' => '{$value}',\n";
        }
        $str .= ");";
        fwrite($fopen, $str);
        fclose($fopen);

        $this->assign('title', '准备安装');

        $this->layout();
    }

    /**
     * 执行安装
     */
    public function doinstall() {
        $data['sitetitle'] = $this->isP('title', '请填写系统的标题');
        $data['account'] = $this->isP('account', '请填写管理员帐号');
        $data['passwd'] = $this->isP('passwd', '请填写管理员密码');
        $data['name'] = $this->isP('name', '请填写管理员名称');
        $data['mail'] = $this->isP('mail', '请填写管理员邮箱');
        $urlModel = $this->isP('urlModel', '请选择URL模式');
        $index = $this->isP('index', '请选择是否隐藏index.php');
        $data['urlModel'] = json_encode(array('index' => $index, 'urlModel' => $urlModel, 'suffix' => '1'));

        //纯粹为了效果
        $table = array('创建部门列表', '创建用户动态表', '创建字段列表', '创建菜单列表', '创建模型列表', '创建权限节点列表', '创建用户组权限节点', '创建系统消息列表', '创建选项列表', '创建项目列表', '创建报表列表', '创建报表内容列表', '创建任务列表', '创建任务审核列表', '创建任务日志列表', '创建任务补充说明列表', '创建更新列表', '创建用户列表', '创建用户组列表');
        $this->assign('table', json_encode($table));

        $this->assign($data);
        $this->assign('title', '执行安装');
        $this->layout();
    }

    /**
     * 导入数据库
     */
    public function import() {
        $title = $this->isP('title', '请填写系统的标题');
        $urlModel = $this->isP('urlModel', '请选择URL模式', FALSE);

        $data['user_account'] = $this->isP('account', '请填写管理员帐号');
        $data['user_password'] = \Core\Func\CoreFunc::generatePwd($data['user_account'] . $this->isP('passwd', '请填写管理员密码'), 'PRIVATE_KEY');
        $data['user_name'] = $this->isP('name', '请填写管理员名称');
        $data['user_mail'] = $this->isP('mail', '请填写管理员邮箱');

        //读取数据库文件
        $sqlFile = file_get_contents(PES_PATH . '/Install/InstallDb/team.sql');
        if (empty($sqlFile)) {
            $this->error('无法读取安装SQL文件');
        }

        //配置PDO信息
        $config = \Core\Func\CoreFunc::loadConfig();
        try {
            $db = new \PDO("mysql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_NAME']}", $config['DB_USER'], $config['DB_PWD']);
        } catch (\PDOException $e) {
            $this->error($e->getMessage());
        }
        //安装数据库文件
        $db->exec($sqlFile);

        \Core\Func\CoreFunc::$defaultPath = false;
        require PES_PATH . '/Expand/Identicon/autoload.php';
        $identicon = new \Identicon\Identicon();
        $imageDataUri = $identicon->getImageDataUri($data['user_mail']);
        $data['user_head'] = $imageDataUri;
        $data['user_department_id'] = $data['user_status'] = $data['user_group_id'] = '1';

        //写入管理员帐号
        $this->db('user')->insert($data);

        //更新系统配置
        \Model\Option::update('sitetitle', $title);
        \Model\Option::update('urlModel', $urlModel);

        //更新根目录的index.php
        $readWriteFile = file_get_contents(PES_PATH . '/Install/Write/index.php');
        $fopen = fopen(PES_PATH . '/index.php', 'w+');
        fwrite($fopen, $readWriteFile);
        fclose($fopen);

        //标记程序已安装和移除安装数据库文件
        unlink(PES_PATH . '/Install/index.php');
        unlink(PES_PATH . '/Install/InstallDb/team.sql');
        fclose(fopen(PES_PATH . '/Install/install.txt', 'w+'));
        fclose(fopen(PES_PATH . '/Install/index.html', 'w+'));

        $this->success('安装完成!');
    }

}
