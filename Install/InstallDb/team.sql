-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-11-02 16:15:31
-- 服务器版本： 5.6.26
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team`
--

-- --------------------------------------------------------

--
-- 表的结构 `pes_department`
--

CREATE TABLE `pes_department` (
  `department_id` int(11) NOT NULL,
  `department_listsort` int(11) NOT NULL DEFAULT '0',
  `department_lang` tinyint(4) NOT NULL DEFAULT '0',
  `department_url` varchar(255) NOT NULL DEFAULT '',
  `department_createtime` int(11) NOT NULL DEFAULT '0',
  `department_name` varchar(255) NOT NULL DEFAULT '',
  `department_header` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部门列表';

--
-- 转存表中的数据 `pes_department`
--

INSERT INTO `pes_department` (`department_id`, `department_listsort`, `department_lang`, `department_url`, `department_createtime`, `department_name`, `department_header`) VALUES
(1, 0, 0, '/Department/view/id/1.html', 0, 'IT部', '1');

-- --------------------------------------------------------

--
-- 表的结构 `pes_dynamic`
--

CREATE TABLE `pes_dynamic` (
  `dynamic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户',
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务',
  `dynamic_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '动态类型:1 发起新的任务 2 执行了新任务 3 提交了任务 4.完成了任务',
  `dynamic_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户动态';

-- --------------------------------------------------------

--
-- 表的结构 `pes_field`
--

CREATE TABLE `pes_field` (
  `field_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL DEFAULT '0',
  `field_name` varchar(128) NOT NULL DEFAULT '',
  `display_name` varchar(128) NOT NULL DEFAULT '',
  `field_type` varchar(128) NOT NULL DEFAULT '',
  `field_option` text NOT NULL,
  `field_default` varchar(128) NOT NULL DEFAULT '',
  `field_required` tinyint(4) NOT NULL DEFAULT '0',
  `field_message` varchar(128) NOT NULL DEFAULT '',
  `field_listsort` int(11) NOT NULL DEFAULT '0',
  `field_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字段列表';

--
-- 转存表中的数据 `pes_field`
--

INSERT INTO `pes_field` (`field_id`, `model_id`, `field_name`, `display_name`, `field_type`, `field_option`, `field_default`, `field_required`, `field_message`, `field_listsort`, `field_status`) VALUES
(1, 6, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(2, 6, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(3, 6, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1),
(4, 7, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(5, 7, 'account', '会员帐号', 'text', '', '', 1, '', 3, 1),
(6, 7, 'password', '会员密码', 'text', '', '', 0, '', 4, 1),
(7, 7, 'mail', '邮箱地址', 'text', '', '', 1, '', 5, 1),
(8, 7, 'name', '会员名称', 'text', '', '', 1, '', 6, 1),
(9, 7, 'group_id', '用户组', 'select', '', '', 1, '', 1, 1),
(10, 6, 'name', '用户组名称', 'text', '', '', 1, '', 1, 1),
(11, 8, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, 1),
(12, 8, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(14, 8, 'title', '项目名称', 'text', '', '', 1, '', 1, 1),
(15, 9, 'status', '状态', 'text', '', '', 0, '', 97, 1),
(16, 9, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(17, 9, 'createtime', '发布时间', 'date', '', '', 1, '', 99, 1),
(18, 9, 'accept_id', '属性部门', 'text', '', '', 1, '', 2, 1),
(19, 9, 'title', '任务标题', 'text', '', '', 1, '', 1, 1),
(20, 9, 'department_id', '接收部门ID', 'text', '', '', 1, '', 3, 1),
(21, 9, 'user_id', '接收用户ID', 'text', '', '', 0, '', 5, 1),
(22, 9, 'create_id', '任务发起者', 'text', '', '', 1, '', 4, 1),
(24, 9, 'content', '任务说明', 'editor', '', '', 1, '', 6, 1),
(25, 9, 'file', '任务附件', 'file', '', '', 0, '', 7, 1),
(26, 9, 'completetime', '完成时间', 'date', '', '', 0, '', 104, 1),
(27, 9, 'estimatetime', '预计时间', 'date', '', '', 0, '', 102, 1),
(28, 9, 'actiontime', '执行时间', 'date', '', '', 0, '', 103, 1),
(30, 10, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(31, 10, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1),
(32, 10, 'name', '部门名称', 'text', '', '', 1, '', 1, 1),
(33, 10, 'header', '负责人', 'text', '', '', 0, '', 2, 1),
(34, 7, 'department_id', '部门ID', 'text', '', '', 1, '', 2, 1),
(35, 9, 'priority', '优先级', 'text', '', '', 1, '', 8, 1),
(36, 9, 'expecttime', '期望完成时间', 'date', '', '', 1, '', 101, 1),
(37, 9, 'project', '任务项目', 'text', '', '', 1, '', 3, 1),
(38, 9, 'read_permission', '阅读权限', 'text', '', '', 0, '', 9, 1),
(44, 12, 'read', '是否阅读', 'text', '', '', 0, '', 0, 1),
(46, 9, 'mail', '是否发送邮件', 'select', '{"\\u5426":"0","\\u662f":"1"}', '', 1, '', 96, 1),
(47, 13, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 0, '', 100, 1),
(48, 13, 'listsort', '排序', 'text', '', '', 0, '', 98, 1),
(49, 13, 'createtime', '发布时间', 'date', '', '', 0, '', 99, 1),
(50, 13, 'title', '节点名称', 'text', '', '', 1, '', 1, 1),
(51, 13, 'parent', '父类节点', 'select', '', '', 0, '', 2, 1),
(52, 13, 'verify', '是否验证权限', 'select', '', '', 0, '', 5, 1),
(53, 13, 'msg', '验证提示信息', 'text', '', '', 0, '', 6, 1),
(54, 13, 'method_type', '操作方法', 'text', '', '', 0, '', 3, 1),
(55, 13, 'value', '节点匹配值', 'text', '', '', 0, '', 4, 1),
(56, 13, 'check_value', '节点验证名称', 'text', '', '', 0, '', 7, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_menu`
--

CREATE TABLE `pes_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(128) NOT NULL DEFAULT '',
  `menu_pid` int(11) NOT NULL DEFAULT '0',
  `menu_icon` varchar(128) NOT NULL DEFAULT '',
  `menu_url` varchar(255) NOT NULL DEFAULT '',
  `menu_listsort` tinyint(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单列表';

--
-- 转存表中的数据 `pes_menu`
--

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_url`, `menu_listsort`) VALUES
(1, '基础设置', 0, 'am-icon-tachometer', '', 0),
(4, '系统首页', 1, 'am-icon-info-circle', 'Team-Index-dynamic', 0),
(8, '后台菜单', 1, 'am-icon-align-justify', 'Team-Index-menuList', 0),
(9, '模型管理', 0, 'am-icon-sitemap', 'Team-Model-index', 0),
(10, '模型列表', 9, 'am-icon-list-alt', 'Team-Model-index', 0),
(11, '清空缓存', 1, 'am-icon-refresh', 'Team-Index-clear', 0),
(13, '内容管理', 0, 'am-icon-database', '', 0),
(15, '会员管理', 0, 'am-icon-user', '', 0),
(16, '会员列表', 15, 'am-icon-user', 'Team-User-index', 99),
(18, '用户组', 15, 'am-icon-group', 'Team-User_group-index', 97),
(19, '高级设置', 0, 'am-icon-wrench', '', 0),
(20, '系统设置', 19, 'am-icon-server', 'Team-Setting-action', 0),
(38, '项目列表', 13, 'am-icon-cubes', 'Team-Project-index', 0),
(39, '全体任务列表', 41, 'am-icon-tasks', 'Team-Task-index', 3),
(40, '部门列表', 15, 'am-icon-legal', 'Team-Department-index', 96),
(41, '个人中心', 0, 'am-icon-home', '', 0),
(42, '我的任务', 41, 'am-icon-tags', 'Team-Task-my', 99),
(44, '退出系统', 41, 'am-icon-sign-out', 'Team-Index-logout', 0),
(45, '待审核列表', 41, 'am-icon-check-square-o', 'Team-Task-check', 96),
(46, '我的报表', 41, 'am-icon-pencil-square-o', 'Team-Report-my', 98),
(47, '系统更新', 19, 'am-icon-refresh', 'Team-Setting-upgrade', 0),
(48, '提取报表', 41, 'am-icon-newspaper-o', 'Team-Report-extract', 97),
(49, '权限节点', 15, 'am-icon-unlink', 'Team-Node-index', 98),
(50, '提取全体报表', 41, 'am-icon-newspaper-o', 'Team-Report-allExtract', 98);

-- --------------------------------------------------------

--
-- 表的结构 `pes_model`
--

CREATE TABLE `pes_model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL DEFAULT '',
  `lang_key` varchar(128) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_search` tinyint(11) NOT NULL DEFAULT '0' COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模型属性 1:前台(含前台) 2:后台'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模型列表';

--
-- 转存表中的数据 `pes_model`
--

INSERT INTO `pes_model` (`model_id`, `model_name`, `lang_key`, `status`, `is_search`, `model_attr`) VALUES
(6, 'User_group', '用户组列表', 1, 0, 2),
(7, 'User', '会员列表', 1, 0, 2),
(8, 'Project', '项目列表', 1, 1, 2),
(9, 'Task', '任务列表', 1, 1, 1),
(10, 'Department', '部门列表', 1, 1, 2),
(12, 'update_list', '更新提示列表', 0, 0, 2),
(13, 'Node', '权限节点', 1, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `pes_node`
--

CREATE TABLE `pes_node` (
  `node_id` int(11) NOT NULL,
  `node_listsort` int(11) NOT NULL DEFAULT '0',
  `node_status` tinyint(4) NOT NULL DEFAULT '0',
  `node_lang` tinyint(4) NOT NULL DEFAULT '0',
  `node_url` varchar(255) NOT NULL DEFAULT '',
  `node_createtime` int(11) NOT NULL DEFAULT '0',
  `node_title` varchar(255) NOT NULL DEFAULT '',
  `node_parent` int(11) NOT NULL DEFAULT '0',
  `node_verify` int(11) NOT NULL DEFAULT '0',
  `node_msg` varchar(255) NOT NULL DEFAULT '',
  `node_method_type` varchar(255) NOT NULL DEFAULT '',
  `node_value` varchar(255) NOT NULL DEFAULT '',
  `node_check_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限节点';

--
-- 转存表中的数据 `pes_node`
--

INSERT INTO `pes_node` (`node_id`, `node_listsort`, `node_status`, `node_lang`, `node_url`, `node_createtime`, `node_title`, `node_parent`, `node_verify`, `node_msg`, `node_method_type`, `node_value`, `node_check_value`) VALUES
(1, 0, 1, 0, '/Node/view/id/1.html', 0, '用户管理', 0, 0, '', '', 'User', ''),
(2, 0, 1, 0, '/Node/view/id/2.html', 0, '用户列表', 1, 1, '', 'GET', 'index', 'TeamGETUserindex'),
(3, 0, 1, 0, '/Node/view/id/3.html', 0, '新增/编辑用户', 1, 1, '', 'GET', 'action', 'TeamGETUseraction'),
(4, 0, 1, 0, '/Node/view/id/4.html', 0, '添加用户', 1, 1, '', 'POST', 'action', 'TeamPOSTUseraction'),
(5, 0, 1, 0, '/Node/view/id/5.html', 0, '更新用户', 1, 1, '', 'PUT', 'action', 'TeamPUTUseraction'),
(6, 0, 1, 0, '/Node/view/id/6.html', 0, '删除用户', 1, 1, '', 'DELETE', 'action', 'TeamDELETEUseraction'),
(7, 0, 1, 0, '/Node/view/id/7.html', 0, '用户组管理', 0, 0, '', '', 'User_group', ''),
(8, 0, 1, 0, '/Node/view/id/8.html', 0, '部门管理', 0, 0, '', '', 'Department', ''),
(9, 0, 1, 0, '/Node/view/id/9.html', 0, '新增/编辑部门', 8, 1, '', 'GET', 'action', 'TeamGETDepartmentaction'),
(10, 0, 1, 0, '/Node/view/id/10.html', 0, '添加部门', 8, 1, '', 'POST', 'action', 'TeamPOSTDepartmentaction'),
(11, 0, 1, 0, '/Node/view/id/11.html', 0, '更新部门', 8, 1, '', 'PUT', 'action', 'TeamPUTDepartmentaction'),
(12, 0, 1, 0, '/Node/view/id/12.html', 0, '删除部门', 8, 1, '', 'DELETE', 'action', 'TeamDELETEDepartmentaction'),
(13, 0, 1, 0, '/Node/view/id/13.html', 0, '项目管理', 0, 0, '', '', 'Project', ''),
(14, 0, 1, 0, '/Node/view/id/14.html', 0, '用户组列表', 7, 1, '', 'GET', 'index', 'TeamGETUser_groupindex'),
(15, 0, 1, 0, '/Node/view/id/15.html', 0, '新增/编辑用户组', 7, 1, '', 'GET', 'action', 'TeamGETUser_groupaction'),
(16, 0, 1, 0, '/Node/view/id/16.html', 0, '部门列表', 8, 1, '', 'GET', 'index', 'TeamGETDepartmentindex'),
(17, 0, 1, 0, '/Node/view/id/17.html', 0, '添加用户组', 7, 1, '', 'POST', 'action', 'TeamPOSTUser_groupaction'),
(18, 0, 1, 0, '/Node/view/id/18.html', 0, '更新用户组', 7, 1, '', 'PUT', 'action', 'TeamPUTUser_groupaction'),
(19, 0, 1, 0, '/Node/view/id/19.html', 0, '删除用户组', 7, 1, '', 'DELETE', 'action', 'TeamDELETEUser_groupaction'),
(20, 0, 1, 0, '/Node/view/id/20.html', 0, '项目列表', 13, 1, '', 'GET', 'index', 'TeamGETProjectindex'),
(21, 0, 1, 0, '/Node/view/id/21.html', 0, '新增/编辑项目', 13, 1, '', 'GET', 'action', 'TeamGETProjectaction'),
(22, 0, 1, 0, '/Node/view/id/22.html', 0, '添加项目', 13, 1, '', 'POST', 'action', 'TeamPOSTProjectaction'),
(23, 0, 1, 0, '/Node/view/id/23.html', 0, '更新项目', 13, 1, '', 'PUT', 'action', 'TeamPUTProjectaction'),
(24, 0, 1, 0, '/Node/view/id/24.html', 0, '删除项目', 13, 1, '', 'DELETE', 'action', 'TeamDELETEProjectaction'),
(25, 0, 1, 0, '/Node/view/id/25.html', 0, '首页设置', 0, 0, '', '', 'Index', ''),
(26, 0, 1, 0, '/Node/view/id/26.html', 0, '菜单列表', 25, 1, '', 'GET', 'menuList', 'TeamGETIndexmenuList'),
(27, 0, 1, 0, '/Node/view/id/27.html', 0, '新增/编辑菜单', 25, 1, '', 'GET', 'menuAction', 'TeamGETIndexmenuAction'),
(28, 0, 1, 0, '/Node/view/id/28.html', 0, '更新菜单', 25, 1, '', 'PUT', 'menuAction', 'TeamPUTIndexmenuAction'),
(29, 0, 1, 0, '/Node/view/id/29.html', 0, '删除菜单', 25, 1, '', 'DELETE', 'menuAction', 'TeamDELETEIndexmenuAction'),
(30, 0, 1, 0, '/Node/view/id/30.html', 0, '模型管理', 0, 0, '', '', 'Model', ''),
(31, 0, 1, 0, '/Node/view/id/31.html', 0, '模型列表', 30, 1, '', 'GET', 'index', 'TeamGETModelindex'),
(32, 0, 1, 0, '/Node/view/id/32.html', 0, '新增/编辑模型', 30, 1, '', 'GET', 'action', 'TeamGETModelaction'),
(33, 0, 1, 0, '/Node/view/id/33.html', 0, '模型字段列表', 30, 1, '', 'GET', 'fieldList', 'TeamGETModelfieldList'),
(34, 0, 1, 0, '/Node/view/id/34.html', 0, '新增/编辑模型字段', 30, 1, '', 'GET', 'fieldAction', 'TeamGETModelfieldAction'),
(35, 0, 1, 0, '/Node/view/id/35.html', 0, '添加模型', 30, 1, '', 'POST', 'action', 'TeamPOSTModelaction'),
(36, 0, 1, 0, '/Node/view/id/36.html', 0, '添加模型字段', 30, 1, '', 'POST', 'fieldAction', 'TeamPOSTModelfieldAction'),
(37, 0, 1, 0, '/Node/view/id/37.html', 0, '更新模型', 30, 1, '', 'PUT', 'action', 'TeamPUTModelaction'),
(38, 0, 1, 0, '/Node/view/id/38.html', 0, '更新模型字段', 30, 1, '', 'PUT', 'fieldAction', 'TeamPUTModelfieldAction'),
(39, 0, 1, 0, '/Node/view/id/39.html', 0, '删除模型', 30, 1, '', 'DELETE', 'action', 'TeamDELETEModelaction'),
(40, 0, 1, 0, '/Node/view/id/40.html', 0, '删除模型字段', 30, 1, '', 'DELETE', 'fieldAction', 'TeamDELETEModelfieldAction'),
(41, 0, 1, 0, '/Node/view/id/41.html', 0, '节点管理', 0, 0, '', '', 'Node', ''),
(42, 0, 1, 0, '/Node/view/id/42.html', 0, '节点列表', 41, 1, '', 'GET', 'index', 'TeamGETNodeindex'),
(43, 0, 1, 0, '/Node/view/id/43.html', 0, '新增/编辑节点', 41, 1, '', 'GET', 'action', 'TeamGETNodeaction'),
(44, 0, 1, 0, '/Node/view/id/44.html', 0, '添加节点', 41, 1, '', 'POST', 'action', 'TeamPOSTNodeaction'),
(45, 0, 1, 0, '/Node/view/id/45.html', 0, '更新节点', 41, 1, '', 'PUT', 'action', 'TeamPUTNodeaction'),
(46, 0, 1, 0, '/Node/view/id/46.html', 0, '删除节点', 41, 1, '', 'DELETE', 'action', 'TeamDELETENodeaction'),
(47, 0, 1, 0, '/Node/view/id/47.html', 0, '系统设置', 0, 0, '', '', 'Setting', ''),
(48, 0, 1, 0, '/Node/view/id/48.html', 0, '查看基础设置', 47, 1, '', 'GET', 'action', 'TeamGETSettingaction'),
(49, 0, 1, 0, '/Node/view/id/49.html', 0, '查看更新', 47, 1, '', 'GET', 'upgrade', 'TeamGETSettingupgrade'),
(50, 0, 1, 0, '/Node/view/id/50.html', 0, '更新系统设置', 47, 1, '', 'PUT', 'action', 'TeamPUTSettingaction'),
(51, 0, 1, 0, '/Node/view/id/51.html', 0, '下载更新文件', 47, 1, '', 'PUT', 'downloadUpgradeFile', 'TeamPUTSettingdownloadUpgradeFile'),
(52, 0, 1, 0, '/Node/view/id/52.html', 0, '安装更新文件', 47, 1, '', 'PUT', 'installUpdateFile', 'TeamPUTSettinginstallUpdateFile'),
(53, 0, 1, 0, '/Node/view/id/53.html', 0, '安装数据库更新', 47, 1, '', 'PUT', 'installUpdateSql', 'TeamPUTSettinginstallUpdateSql'),
(54, 0, 1, 0, '/Node/view/id/54.html', 0, '报表管理', 0, 0, '', '', 'Report', ''),
(55, 0, 1, 0, '/Node/view/id/55.html', 0, '提取报表', 54, 1, '', 'GET', 'extract', 'TeamGETReportextract'),
(56, 0, 1, 0, '/Node/view/id/56.html', 0, '我的报表', 54, 0, '', 'GET', 'my', 'TeamGETReportmy'),
(57, 0, 1, 0, '/Node/view/id/57.html', 0, '查看报表', 54, 0, '', 'GET', 'view', 'TeamGETReportview'),
(58, 0, 1, 0, '/Node/view/id/58.html', 0, '访问系统', 25, 0, '', 'GET', 'index', 'TeamGETIndexindex'),
(59, 0, 1, 0, '/Node/view/id/59.html', 0, '全体动态', 25, 0, '', 'GET', 'dynamic', 'TeamGETIndexdynamic'),
(60, 0, 1, 0, '/Node/view/id/60.html', 0, '添加报表', 54, 0, '', 'POST', 'action', 'TeamPOSTReportaction'),
(61, 0, 1, 0, '/Node/view/id/61.html', 0, '任务管理', 0, 0, '', '', 'Task', ''),
(62, 0, 1, 0, '/Node/view/id/62.html', 0, '任务列表', 61, 0, '', 'GET', 'index', 'TeamGETTaskindex'),
(63, 0, 1, 0, '/Node/view/id/63.html', 0, '发表新任务', 61, 0, '', 'GET', 'action', 'TeamGETTaskaction'),
(64, 0, 1, 0, '/Node/view/id/64.html', 0, '我的任务', 61, 0, '', 'GET', 'my', 'TeamGETTaskmy'),
(65, 0, 1, 0, '/Node/view/id/65.html', 0, '待审核任务列表', 61, 0, '', 'GET', 'check', 'TeamGETTaskcheck'),
(66, 0, 1, 0, '/Node/view/id/66.html', 0, '查看任务', 61, 0, '', 'GET', 'view', 'TeamGETTaskview'),
(67, 0, 1, 0, '/Node/view/id/67.html', 0, '添加新任务', 61, 0, '', 'POST', 'action', 'TeamPOSTTaskaction'),
(68, 0, 1, 0, '/Node/view/id/68.html', 0, '任务指派', 61, 0, '', 'PUT', 'accept', 'TeamPUTTaskaccept'),
(69, 0, 1, 0, '/Node/view/id/69.html', 0, '执行任务', 61, 0, '', 'PUT', 'begin', 'TeamPUTTaskbegin'),
(70, 0, 1, 0, '/Node/view/id/70.html', 0, '提交任务日志', 61, 0, '', 'PUT', 'diary', 'TeamPUTTaskdiary'),
(71, 0, 1, 0, '/Node/view/id/71.html', 0, '更改任务状态', 61, 0, '', 'PUT', 'check', 'TeamPUTTaskcheck'),
(72, 0, 1, 0, '/Node/view/id/72.html', 0, '删除任务', 61, 1, '', 'DELETE', 'action', 'TeamDELETETaskaction'),
(73, 0, 1, 0, '/Node/view/id/73.html', 0, '设置用户组节点', 7, 1, '', 'GET', 'setNode', 'TeamGETUser_groupsetNode'),
(74, 0, 1, 0, '/Node/view/id/74.html', 0, '更新用户组节点', 7, 1, '', 'PUT', 'setNode', 'TeamPUTUser_groupsetNode'),
(75, 0, 1, 0, '/Node/view/id/75.html', 0, '设置用户组菜单', 7, 1, '', 'GET', 'setMenu', 'TeamGETUser_groupsetMenu'),
(76, 0, 1, 0, '/Node/view/id/76.html', 0, '更新用户组菜单', 7, 1, '', 'PUT', 'setMenu', 'TeamPUTUser_groupsetMenu');

-- --------------------------------------------------------

--
-- 表的结构 `pes_node_group`
--

CREATE TABLE `pes_node_group` (
  `node_group_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `node_id` int(11) NOT NULL DEFAULT '0' COMMENT '节点ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组权限节点';

--
-- 转存表中的数据 `pes_node_group`
--

INSERT INTO `pes_node_group` (`node_group_id`, `user_group_id`, `node_id`) VALUES
(79, 2, 58),
(80, 2, 59),
(81, 2, 56),
(82, 2, 57),
(83, 2, 60),
(84, 2, 62),
(85, 2, 63),
(86, 2, 64),
(87, 2, 65),
(88, 2, 66),
(89, 2, 67),
(90, 2, 68),
(91, 2, 69),
(92, 2, 70),
(93, 2, 71),
(94, 3, 58),
(95, 3, 59),
(96, 3, 55),
(97, 3, 56),
(98, 3, 57),
(99, 3, 60),
(100, 3, 62),
(101, 3, 63),
(102, 3, 64),
(103, 3, 65),
(104, 3, 66),
(105, 3, 67),
(106, 3, 68),
(107, 3, 69),
(108, 3, 70),
(109, 3, 71),
(178, 1, 2),
(179, 1, 3),
(180, 1, 4),
(181, 1, 5),
(182, 1, 6),
(183, 1, 14),
(184, 1, 15),
(185, 1, 17),
(186, 1, 18),
(187, 1, 19),
(188, 1, 73),
(189, 1, 74),
(190, 1, 75),
(191, 1, 76),
(192, 1, 9),
(193, 1, 10),
(194, 1, 11),
(195, 1, 12),
(196, 1, 16),
(197, 1, 20),
(198, 1, 21),
(199, 1, 22),
(200, 1, 23),
(201, 1, 24),
(202, 1, 26),
(203, 1, 27),
(204, 1, 28),
(205, 1, 29),
(206, 1, 58),
(207, 1, 59),
(208, 1, 31),
(209, 1, 32),
(210, 1, 33),
(211, 1, 34),
(212, 1, 35),
(213, 1, 36),
(214, 1, 37),
(215, 1, 38),
(216, 1, 39),
(217, 1, 40),
(218, 1, 42),
(219, 1, 43),
(220, 1, 44),
(221, 1, 45),
(222, 1, 46),
(223, 1, 48),
(224, 1, 49),
(225, 1, 50),
(226, 1, 51),
(227, 1, 52),
(228, 1, 53),
(229, 1, 55),
(230, 1, 56),
(231, 1, 57),
(232, 1, 60),
(233, 1, 62),
(234, 1, 63),
(235, 1, 64),
(236, 1, 65),
(237, 1, 66),
(238, 1, 67),
(239, 1, 68),
(240, 1, 69),
(241, 1, 70),
(242, 1, 71),
(243, 1, 72);

-- --------------------------------------------------------

--
-- 表的结构 `pes_notice`
--

CREATE TABLE `pes_notice` (
  `notice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `notice_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '通知类型 1:收到新任务 2.指派审核任务 3.待审核任务 4.待修改的任务 5.部门待审核指派任务 6.完成的任务',
  `notice_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读：0 未读 1 已读',
  `task_mail` tinyint(1) NOT NULL DEFAULT '0' COMMENT '本任务全程是否发送邮件 0:不 1:发',
  `mail_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮件是否已发送 0：未 1：已'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统信息消息';

-- --------------------------------------------------------

--
-- 表的结构 `pes_option`
--

CREATE TABLE `pes_option` (
  `id` int(11) NOT NULL,
  `option_name` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `option_range` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统选项';

--
-- 转存表中的数据 `pes_option`
--

INSERT INTO `pes_option` (`id`, `option_name`, `name`, `value`, `option_range`) VALUES
(1, 'sitetitle', '程序标题', '', ''),
(7, 'theme', '主题', 'WorkHard', 'theme'),
(8, 'fieldType', '表单类型', '{"category":"\\u5206\\u7c7b","text":"\\u5355\\u884c\\u8f93\\u5165\\u6846","radio":"\\u5355\\u9009\\u6309\\u94ae","checkbox":"\\u590d\\u9009\\u6846","select":"\\u5355\\u9009\\u4e0b\\u62c9\\u6846","textarea":"\\u591a\\u884c\\u8f93\\u5165\\u6846","editor":"\\u7f16\\u8f91\\u5668","thumb":"\\u7565\\u7f29\\u56fe","img":"\\u4e0a\\u4f20\\u56fe\\u7ec4","file":"\\u4e0a\\u4f20\\u6587\\u4ef6","date":"\\u65e5\\u671f"}', 'Miscellaneous'),
(13, 'version', '系统版本', '1.010', ''),
(14, 'upload_img', '图片格式', '["jpg","jpge","bmp","gif","png"]', 'upload'),
(15, 'upload_file', '文件格式', '["zip","rar","7z","doc","docx","pdf","xls","xlsx","ppt","pptx","txt"]', 'upload'),
(16, 'urlModel', 'URL格式', '{"index":"1","urlModel":"3","suffix":"1"}', 'url'),
(17, 'mail', '邮件服务信息', '{"account":"","passwd":"","address":"","port":"25","trigger":"2"}', ''),
(19, 'signup', '帐号注册', '1', ''),
(20, 'node_type', '权限验证模式', '0', '');

-- --------------------------------------------------------

--
-- 表的结构 `pes_project`
--

CREATE TABLE `pes_project` (
  `project_id` int(11) NOT NULL,
  `project_listsort` int(11) NOT NULL DEFAULT '0',
  `project_status` tinyint(4) NOT NULL DEFAULT '0',
  `project_lang` tinyint(4) NOT NULL DEFAULT '0',
  `project_url` varchar(255) NOT NULL DEFAULT '',
  `project_title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目列表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_report`
--

CREATE TABLE `pes_report` (
  `report_id` int(11) NOT NULL,
  `report_date` date NOT NULL DEFAULT '2015-01-01' COMMENT '报表日期',
  `user_id` int(255) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0' COMMENT '部门ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户报表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_report_content`
--

CREATE TABLE `pes_report_content` (
  `content_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL DEFAULT '0',
  `report_content` text NOT NULL,
  `task_id` int(11) NOT NULL DEFAULT '0',
  `task_title` varchar(255) NOT NULL DEFAULT '' COMMENT '任务标题',
  `task_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '任务状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='报表内容';

-- --------------------------------------------------------

--
-- 表的结构 `pes_task`
--

CREATE TABLE `pes_task` (
  `task_id` int(11) NOT NULL,
  `task_listsort` int(11) NOT NULL DEFAULT '0',
  `task_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: 未进行 1:进行中 2:审核 3:调整 4:完成',
  `task_lang` tinyint(4) NOT NULL DEFAULT '0',
  `task_url` varchar(255) NOT NULL DEFAULT '',
  `task_accept_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 非本部门任务，需要对应部门负责人审核任务 1:本部门任务，直接指派内部人员',
  `task_title` varchar(255) NOT NULL DEFAULT '',
  `task_department_id` varchar(255) NOT NULL DEFAULT '',
  `task_user_id` varchar(255) NOT NULL DEFAULT '',
  `task_create_id` varchar(255) NOT NULL DEFAULT '',
  `task_content` text NOT NULL,
  `task_file` text NOT NULL,
  `task_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `task_completetime` int(11) NOT NULL DEFAULT '0' COMMENT '完成时间',
  `task_estimatetime` int(11) NOT NULL DEFAULT '0' COMMENT '执行者估计时间',
  `task_actiontime` int(11) NOT NULL DEFAULT '0' COMMENT '执行时间',
  `task_priority` tinytext NOT NULL COMMENT '1:严重 2:主要 3:次要 4:普通',
  `task_expecttime` int(11) NOT NULL DEFAULT '0' COMMENT '发起者期望完成时间',
  `task_project` varchar(255) NOT NULL DEFAULT '',
  `task_read_permission` tinyint(1) NOT NULL DEFAULT '0' COMMENT '阅读权限',
  `task_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常 1:任务被删除。被删除是由于用户被删除了',
  `task_mail` tinyint(1) NOT NULL DEFAULT '0' COMMENT '本任务全程是否发送邮件 0:不 1:发'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务列表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_check`
--

CREATE TABLE `pes_task_check` (
  `check_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `check_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核人ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务审核人列表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_diary`
--

CREATE TABLE `pes_task_diary` (
  `diary_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `diary_content` text NOT NULL COMMENT '日志内容',
  `diary_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务日志';

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_supplement`
--

CREATE TABLE `pes_task_supplement` (
  `task_supplement_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `task_supplement_content` text NOT NULL COMMENT '补充说明',
  `task_supplement_file` text NOT NULL COMMENT '补充附件',
  `task_supplement_time` int(11) NOT NULL DEFAULT '0' COMMENT '补充时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务补充说明';

-- --------------------------------------------------------

--
-- 表的结构 `pes_update_list`
--

CREATE TABLE `pes_update_list` (
  `update_list_id` int(11) NOT NULL,
  `update_list_url` varchar(255) NOT NULL DEFAULT '',
  `update_list_pre_version` varchar(255) NOT NULL DEFAULT '' COMMENT '早期版本',
  `update_list_version` varchar(255) NOT NULL DEFAULT '' COMMENT '当前最新版本号',
  `update_list_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未阅读 1:已阅读',
  `update_list_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '更新类型 0:正常 1:严重',
  `update_list_content` text NOT NULL,
  `update_list_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '更新发布时间',
  `update_list_file` text NOT NULL COMMENT '更新文件地址',
  `update_list_sql` text NOT NULL COMMENT '更新数据库文件地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='获取更新信息列表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_user`
--

CREATE TABLE `pes_user` (
  `user_id` int(11) NOT NULL,
  `user_account` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_mail` varchar(255) NOT NULL DEFAULT '',
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `user_group_id` int(11) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_createtime` int(11) NOT NULL DEFAULT '0',
  `user_last_login` int(11) NOT NULL DEFAULT '0',
  `user_department_id` varchar(255) NOT NULL DEFAULT '',
  `user_head` text NOT NULL COMMENT '用户头像',
  `user_ey` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户的ey值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_user_group`
--

CREATE TABLE `pes_user_group` (
  `user_group_id` int(11) NOT NULL,
  `user_group_listsort` int(11) NOT NULL DEFAULT '0',
  `user_group_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_group_lang` tinyint(4) NOT NULL DEFAULT '0',
  `user_group_url` varchar(255) NOT NULL DEFAULT '',
  `user_group_createtime` int(11) NOT NULL DEFAULT '0',
  `user_group_name` varchar(255) NOT NULL DEFAULT '',
  `user_group_menu` text NOT NULL COMMENT '用户组菜单列表'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_user_group`
--

INSERT INTO `pes_user_group` (`user_group_id`, `user_group_listsort`, `user_group_status`, `user_group_lang`, `user_group_url`, `user_group_createtime`, `user_group_name`, `user_group_menu`) VALUES
(1, 0, 1, 0, '/User_group/view/id/1.html', 1417273380, '管理员', '1,4,8,11,9,10,13,38,15,16,17,18,40,19,20,41,42,43,45,39,44'),
(2, 0, 1, 0, '/User_group/view/id/2.html', 1417273440, '普通会员', '41,42,46,45,39,44'),
(3, 0, 1, 0, '/User_group/view/id/3.html', 1417273440, '部门责任人', '41,42,46,48,45,39,44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pes_department`
--
ALTER TABLE `pes_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `pes_dynamic`
--
ALTER TABLE `pes_dynamic`
  ADD PRIMARY KEY (`dynamic_id`);

--
-- Indexes for table `pes_field`
--
ALTER TABLE `pes_field`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `modle_id` (`model_id`,`field_name`);

--
-- Indexes for table `pes_menu`
--
ALTER TABLE `pes_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_pid` (`menu_pid`);

--
-- Indexes for table `pes_model`
--
ALTER TABLE `pes_model`
  ADD PRIMARY KEY (`model_id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indexes for table `pes_node`
--
ALTER TABLE `pes_node`
  ADD PRIMARY KEY (`node_id`),
  ADD UNIQUE KEY `node_value` (`node_value`,`node_check_value`),
  ADD KEY `node_check_value` (`node_check_value`);

--
-- Indexes for table `pes_node_group`
--
ALTER TABLE `pes_node_group`
  ADD PRIMARY KEY (`node_group_id`);

--
-- Indexes for table `pes_notice`
--
ALTER TABLE `pes_notice`
  ADD PRIMARY KEY (`notice_id`);

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
-- Indexes for table `pes_report`
--
ALTER TABLE `pes_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `pes_report_content`
--
ALTER TABLE `pes_report_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `pes_task`
--
ALTER TABLE `pes_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `pes_task_check`
--
ALTER TABLE `pes_task_check`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `pes_task_diary`
--
ALTER TABLE `pes_task_diary`
  ADD UNIQUE KEY `diary_id` (`diary_id`);

--
-- Indexes for table `pes_task_supplement`
--
ALTER TABLE `pes_task_supplement`
  ADD PRIMARY KEY (`task_supplement_id`);

--
-- Indexes for table `pes_update_list`
--
ALTER TABLE `pes_update_list`
  ADD PRIMARY KEY (`update_list_id`);

--
-- Indexes for table `pes_user`
--
ALTER TABLE `pes_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_account` (`user_account`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- Indexes for table `pes_user_group`
--
ALTER TABLE `pes_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pes_department`
--
ALTER TABLE `pes_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `pes_dynamic`
--
ALTER TABLE `pes_dynamic`
  MODIFY `dynamic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_field`
--
ALTER TABLE `pes_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- 使用表AUTO_INCREMENT `pes_menu`
--
ALTER TABLE `pes_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `pes_model`
--
ALTER TABLE `pes_model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `pes_node`
--
ALTER TABLE `pes_node`
  MODIFY `node_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- 使用表AUTO_INCREMENT `pes_node_group`
--
ALTER TABLE `pes_node_group`
  MODIFY `node_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- 使用表AUTO_INCREMENT `pes_notice`
--
ALTER TABLE `pes_notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_option`
--
ALTER TABLE `pes_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `pes_project`
--
ALTER TABLE `pes_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_report`
--
ALTER TABLE `pes_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_report_content`
--
ALTER TABLE `pes_report_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_task`
--
ALTER TABLE `pes_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_task_check`
--
ALTER TABLE `pes_task_check`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_task_diary`
--
ALTER TABLE `pes_task_diary`
  MODIFY `diary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_task_supplement`
--
ALTER TABLE `pes_task_supplement`
  MODIFY `task_supplement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_update_list`
--
ALTER TABLE `pes_update_list`
  MODIFY `update_list_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_user`
--
ALTER TABLE `pes_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `pes_user_group`
--
ALTER TABLE `pes_user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
