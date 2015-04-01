-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-04-01 00:07:55
-- 服务器版本： 5.6.20
-- PHP Version: 5.6.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `team`
--

-- --------------------------------------------------------

--
-- 表的结构 `pes_category`
--

CREATE TABLE IF NOT EXISTS `pes_category` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_aliases` varchar(255) NOT NULL COMMENT '别名',
  `model_id` int(11) NOT NULL,
  `category_parent` int(11) NOT NULL,
  `category_child` text NOT NULL,
  `category_keyword` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `category_thumb` varchar(255) NOT NULL,
  `category_url` varchar(255) NOT NULL,
  `category_nav` tinyint(4) NOT NULL DEFAULT '1' COMMENT '导航',
  `category_html` tinyint(1) NOT NULL COMMENT '是否生成HTML',
  `category_theme` varchar(128) NOT NULL COMMENT '模板名称',
  `category_lang` varchar(50) NOT NULL COMMENT '语言',
  `category_listsort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_cookie`
--

CREATE TABLE IF NOT EXISTS `pes_cookie` (
`cookie_id` int(11) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_field`
--

CREATE TABLE IF NOT EXISTS `pes_field` (
`field_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `field_name` varchar(128) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `field_type` varchar(128) NOT NULL,
  `field_option` text NOT NULL,
  `field_default` varchar(128) NOT NULL,
  `field_required` tinyint(4) NOT NULL,
  `field_message` varchar(128) NOT NULL,
  `field_listsort` int(11) NOT NULL,
  `field_status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_field`
--

INSERT INTO `pes_field` (`field_id`, `model_id`, `field_name`, `display_name`, `field_type`, `field_option`, `field_default`, `field_required`, `field_message`, `field_listsort`, `field_status`) VALUES
(1, 6, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(2, 6, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(3, 6, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1),
(4, 7, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(5, 7, 'account', '会员帐号', 'text', '', '', 1, '', 2, 1),
(6, 7, 'password', '会员密码', 'text', '', '', 0, '', 3, 1),
(7, 7, 'mail', '邮箱地址', 'text', '', '', 1, '', 4, 1),
(8, 7, 'name', '会员名称', 'text', '', '', 1, '', 5, 1),
(9, 7, 'group_id', '用户组', 'select', '', '', 1, '', 1, 1),
(10, 6, 'name', '用户组名称', 'text', '', '', 1, '', 1, 1),
(11, 8, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(12, 8, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(13, 8, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1),
(14, 8, 'title', '项目名称', 'text', '', '', 1, '', 1, 1),
(15, 9, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(16, 9, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(17, 9, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_lang`
--

CREATE TABLE IF NOT EXISTS `pes_lang` (
  `id` int(11) NOT NULL,
  `country` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_mail_verify`
--

CREATE TABLE IF NOT EXISTS `pes_mail_verify` (
`mail_verify_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `verifytime` int(11) NOT NULL,
  `verify_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_menu`
--

CREATE TABLE IF NOT EXISTS `pes_menu` (
`menu_id` int(11) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `menu_pid` int(11) NOT NULL,
  `menu_icon` varchar(128) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `menu_listsort` tinyint(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_menu`
--

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_url`, `menu_listsort`) VALUES
(1, '基础设置', 0, 'am-icon-tachometer', '', 0),
(4, '系统信息', 1, 'am-icon-info-circle', 'Team-Index-systemInfo', 0),
(8, '后台菜单', 1, 'am-icon-align-justify', 'Team-Index-menuList', 0),
(9, '模型管理', 0, 'am-icon-sitemap', 'Team-Model-index', 0),
(10, '模型列表', 9, 'am-icon-list-alt', 'Team-Model-index', 0),
(11, '清空缓存', 1, 'am-icon-refresh', 'Team-Index-clear', 0),
(13, '内容管理', 0, 'am-icon-database', '', 0),
(15, '会员管理', 0, 'am-icon-user', '', 0),
(16, '会员列表', 15, 'am-icon-user', 'Team-User-index', 0),
(17, '权限节点', 15, 'am-icon-unlink', 'Team-User-nodeList', 0),
(18, '用户组', 15, 'am-icon-group', 'Team-User_group-index', 0),
(19, '高级设置', 0, 'am-icon-wrench', '', 0),
(20, '系统设置', 19, 'am-icon-server', 'Team-Setting-action', 0),
(38, '项目列表', 13, 'am-icon-cubes', 'Team-Project-index', 0),
(39, '任务列表', 9, 'am-icon-file', 'Team-Task-index', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pes_model`
--

CREATE TABLE IF NOT EXISTS `pes_model` (
`model_id` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `lang_key` varchar(128) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_search` tinyint(11) NOT NULL COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL COMMENT '模型属性 1:前台(含前台) 2:后台'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_model`
--

INSERT INTO `pes_model` (`model_id`, `model_name`, `lang_key`, `status`, `is_search`, `model_attr`) VALUES
(6, 'User_group', '用户组列表', 1, 0, 2),
(7, 'User', '会员列表', 1, 0, 2),
(8, 'Project', '项目列表', 1, 1, 2),
(9, 'Task', '任务列表', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_node`
--

CREATE TABLE IF NOT EXISTS `pes_node` (
`id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT '规则唯一英文标识',
  `title` varchar(128) NOT NULL COMMENT '描述名称',
  `pid` int(11) NOT NULL COMMENT '父类ID',
  `child` text NOT NULL,
  `verify` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否进行权限验证',
  `mes` varchar(128) NOT NULL COMMENT '提示信息',
  `listsort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_option`
--

CREATE TABLE IF NOT EXISTS `pes_option` (
`id` int(11) NOT NULL,
  `option_name` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `option_range` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_option`
--

INSERT INTO `pes_option` (`id`, `option_name`, `name`, `value`, `option_range`) VALUES
(1, 'siteurl', '网站链接', 'http://www.cms.com', 'setting'),
(2, 'sitetitle', '网站名称', 'PESCMS', 'setting'),
(3, 'subtitle', '副标题', '', 'setting'),
(4, 'seo_keyword', '网站关键词', 'PESCMS', 'setting'),
(5, 'seo_description', '网站描述', 'PESCMS', 'setting'),
(6, 'logo', '网站logo', '/upload/20150327/5515786073efc.png', 'setting'),
(7, 'theme', '主题', 'WorkHard', 'theme'),
(8, 'fieldType', '表单类型', '{"category":"\\u5206\\u7c7b","text":"\\u5355\\u884c\\u8f93\\u5165\\u6846","radio":"\\u5355\\u9009\\u6309\\u94ae","checkbox":"\\u590d\\u9009\\u6846","select":"\\u5355\\u9009\\u4e0b\\u62c9\\u6846","textarea":"\\u591a\\u884c\\u8f93\\u5165\\u6846","editor":"\\u7f16\\u8f91\\u5668","thumb":"\\u7565\\u7f29\\u56fe","img":"\\u4e0a\\u4f20\\u56fe\\u7ec4","file":"\\u4e0a\\u4f20\\u6587\\u4ef6","date":"\\u65e5\\u671f"}', 'Miscellaneous'),
(9, 'sitestatus', '网站状态', '1', 'setting'),
(10, 'footerCode', '页脚代码', '', 'setting'),
(11, 'closeReason', '关闭原因', 'PESCMS目前正在维护升级中...\r\n您可以访问OSCGIT获取最新的代码：http://git.oschina.net/fallBirds/PESCMS2.0', 'setting'),
(12, 'system', '系统变量', '{"copyright":"\\u7248\\u6743\\u6240\\u6709\\u00a92013-2014 PESCMS\\u5f00\\u53d1\\u56e2\\u961f"}', 'system'),
(13, 'version', '系统版本', 'PESCMS V1.20140226beta', ''),
(14, 'upload_img', '图片格式', '["jpg","jpge","bmp","gif","png"]', 'upload'),
(15, 'upload_file', '文件格式', '["zip","rar","7z","doc","docx","pdf","xls","xlsx","ppt","pptx","txt","7z"]', 'upload'),
(16, 'urlModel', 'URL格式', '{"index":"1","urlModel":"3","suffix":"1"}', 'url');

-- --------------------------------------------------------

--
-- 表的结构 `pes_project`
--

CREATE TABLE IF NOT EXISTS `pes_project` (
`project_id` int(11) NOT NULL,
  `project_listsort` int(11) NOT NULL,
  `project_status` tinyint(4) NOT NULL,
  `project_lang` tinyint(4) NOT NULL,
  `project_url` varchar(255) NOT NULL,
  `project_createtime` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_project`
--

INSERT INTO `pes_project` (`project_id`, `project_listsort`, `project_status`, `project_lang`, `project_url`, `project_createtime`, `project_title`) VALUES
(1, 0, 1, 0, '/Project/view/id/1.html', 1427813640, 'PESCMS'),
(2, 0, 1, 0, '/Project/view/id/2.html', 1427813640, 'PESCMS TEAM');

-- --------------------------------------------------------

--
-- 表的结构 `pes_task`
--

CREATE TABLE IF NOT EXISTS `pes_task` (
`task_id` int(11) NOT NULL,
  `task_listsort` int(11) NOT NULL,
  `task_status` tinyint(4) NOT NULL,
  `task_lang` tinyint(4) NOT NULL,
  `task_url` varchar(255) NOT NULL,
  `task_createtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_user`
--

CREATE TABLE IF NOT EXISTS `pes_user` (
`user_id` int(11) NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user_createtime` int(11) NOT NULL,
  `user_last_login` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_user`
--

INSERT INTO `pes_user` (`user_id`, `user_account`, `user_password`, `user_mail`, `user_name`, `user_group_id`, `user_status`, `user_createtime`, `user_last_login`) VALUES
(1, 'admin', 'f4d998866c0fc28072ac207063197805', 'dev@pescms.com', '管理员', 1, 1, 1388391307, 1388391307);

-- --------------------------------------------------------

--
-- 表的结构 `pes_user_group`
--

CREATE TABLE IF NOT EXISTS `pes_user_group` (
`user_group_id` int(11) NOT NULL,
  `user_group_listsort` int(11) NOT NULL,
  `user_group_status` tinyint(4) NOT NULL,
  `user_group_lang` tinyint(4) NOT NULL,
  `user_group_url` varchar(255) NOT NULL,
  `user_group_createtime` int(11) NOT NULL,
  `user_group_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_user_group`
--

INSERT INTO `pes_user_group` (`user_group_id`, `user_group_listsort`, `user_group_status`, `user_group_lang`, `user_group_url`, `user_group_createtime`, `user_group_name`) VALUES
(1, 0, 1, 0, '/User_group/view/id/1.html', 1417273380, '管理员'),
(2, 0, 1, 0, '/User_group/view/id/2.html', 1417273440, '普通会员'),
(3, 0, 1, 0, '/User_group/view/id/3.html', 1417273440, '验证会员');

-- --------------------------------------------------------

--
-- 表的结构 `pes_user_group1`
--

CREATE TABLE IF NOT EXISTS `pes_user_group1` (
`user_group_id` int(11) NOT NULL,
  `group_name` varchar(128) NOT NULL,
  `group_competence` text NOT NULL COMMENT '所属权限',
  `createtime` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户组';

--
-- 转存表中的数据 `pes_user_group1`
--

INSERT INTO `pes_user_group1` (`user_group_id`, `group_name`, `group_competence`, `createtime`) VALUES
(1, '管理员', '1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,2,55,56,57,58,59,60,61,62,63,64,65,66', 1387813393),
(2, '普通会员', '1,3,5,14,19,27,29,38,52,2,55,56,57,58,59,60,61', 1387813393),
(3, '邮箱认证', '', 1387813393);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pes_category`
--
ALTER TABLE `pes_category`
 ADD PRIMARY KEY (`category_id`), ADD KEY `category_parent` (`category_parent`);

--
-- Indexes for table `pes_cookie`
--
ALTER TABLE `pes_cookie`
 ADD PRIMARY KEY (`cookie_id`);

--
-- Indexes for table `pes_field`
--
ALTER TABLE `pes_field`
 ADD PRIMARY KEY (`field_id`), ADD UNIQUE KEY `modle_id` (`model_id`,`field_name`);

--
-- Indexes for table `pes_lang`
--
ALTER TABLE `pes_lang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pes_mail_verify`
--
ALTER TABLE `pes_mail_verify`
 ADD PRIMARY KEY (`mail_verify_id`);

--
-- Indexes for table `pes_menu`
--
ALTER TABLE `pes_menu`
 ADD PRIMARY KEY (`menu_id`), ADD KEY `menu_pid` (`menu_pid`);

--
-- Indexes for table `pes_model`
--
ALTER TABLE `pes_model`
 ADD PRIMARY KEY (`model_id`), ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indexes for table `pes_node`
--
ALTER TABLE `pes_node`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`,`pid`);

--
-- Indexes for table `pes_option`
--
ALTER TABLE `pes_option`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pes_project`
--
ALTER TABLE `pes_project`
 ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `pes_task`
--
ALTER TABLE `pes_task`
 ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `pes_user`
--
ALTER TABLE `pes_user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pes_user_group`
--
ALTER TABLE `pes_user_group`
 ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `pes_user_group1`
--
ALTER TABLE `pes_user_group1`
 ADD PRIMARY KEY (`user_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pes_category`
--
ALTER TABLE `pes_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_cookie`
--
ALTER TABLE `pes_cookie`
MODIFY `cookie_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_field`
--
ALTER TABLE `pes_field`
MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pes_mail_verify`
--
ALTER TABLE `pes_mail_verify`
MODIFY `mail_verify_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_menu`
--
ALTER TABLE `pes_menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `pes_model`
--
ALTER TABLE `pes_model`
MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pes_node`
--
ALTER TABLE `pes_node`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_option`
--
ALTER TABLE `pes_option`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pes_project`
--
ALTER TABLE `pes_project`
MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pes_task`
--
ALTER TABLE `pes_task`
MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_user`
--
ALTER TABLE `pes_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pes_user_group`
--
ALTER TABLE `pes_user_group`
MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pes_user_group1`
--
ALTER TABLE `pes_user_group1`
MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
