-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-04-06 12:33:32
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
-- 表的结构 `pes_department`
--

CREATE TABLE IF NOT EXISTS `pes_department` (
`department_id` int(11) NOT NULL,
  `department_listsort` int(11) NOT NULL,
  `department_lang` tinyint(4) NOT NULL,
  `department_url` varchar(255) NOT NULL,
  `department_createtime` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_header` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_department`
--

INSERT INTO `pes_department` (`department_id`, `department_listsort`, `department_lang`, `department_url`, `department_createtime`, `department_name`, `department_header`) VALUES
(1, 0, 0, '/department/view/id/1.html', 0, 'IT部', '1'),
(2, 0, 0, '/Department/view/id/2.html', 0, '人事部', '3'),
(3, 0, 0, '/Department/view/id/3.html', 0, '销售部', '4');

-- --------------------------------------------------------

--
-- 表的结构 `pes_dynamic`
--

CREATE TABLE IF NOT EXISTS `pes_dynamic` (
`dynamic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '所属用户',
  `task_id` int(11) NOT NULL COMMENT '任务',
  `dynamic_type` tinyint(1) NOT NULL COMMENT '动态类型:1 发起新的任务 2 执行了新任务 3 提交了任务 4.完成了任务',
  `dynamic_time` int(11) NOT NULL COMMENT '时间'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户动态';

--
-- 转存表中的数据 `pes_dynamic`
--

INSERT INTO `pes_dynamic` (`dynamic_id`, `user_id`, `task_id`, `dynamic_type`, `dynamic_time`) VALUES
(1, 1, 27, 1, 1428285200),
(2, 1, 28, 1, 1428285215),
(3, 1, 28, 2, 1428285225),
(4, 1, 28, 3, 1428285238),
(5, 1, 28, 3, 1428285251),
(6, 1, 28, 4, 1428285284),
(7, 3, 23, 2, 1428285356),
(8, 3, 23, 3, 1428285358),
(9, 3, 23, 4, 1428285363);

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

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
(33, 10, 'header', '负责人', 'text', '', '', 1, '', 2, 1),
(34, 7, 'department_id', '部门ID', 'text', '', '', 1, '', 2, 1),
(35, 9, 'priority', '优先级', 'text', '', '', 1, '', 8, 1),
(36, 9, 'expecttime', '期望完成时间', 'date', '', '', 1, '', 101, 1),
(37, 9, 'project', '任务项目', 'text', '', '', 1, '', 3, 1),
(38, 9, 'read_permission', '阅读权限', 'text', '', '', 0, '', 9, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

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
(16, '会员列表', 15, 'am-icon-user', 'Team-User-index', 0),
(17, '权限节点', 15, 'am-icon-unlink', 'Team-User-nodeList', 0),
(18, '用户组', 15, 'am-icon-group', 'Team-User_group-index', 0),
(19, '高级设置', 0, 'am-icon-wrench', '', 0),
(20, '系统设置', 19, 'am-icon-server', 'Team-Setting-action', 0),
(38, '项目列表', 13, 'am-icon-cubes', 'Team-Project-index', 0),
(39, '全体任务列表', 41, 'am-icon-tasks', 'Team-Task-index', 3),
(40, '部门列表', 15, 'am-icon-legal', 'Team-Department-index', 0),
(41, '个人中心', 0, 'am-icon-home', '', 0),
(42, '我的任务', 41, 'am-icon-tags', 'Team-Task-my', 99),
(44, '退出系统', 41, 'am-icon-sign-out', 'Team-Index-logout', 0),
(45, '待审核列表', 41, 'am-icon-check-square-o', 'Team-Task-check', 97),
(46, '我的报表', 41, 'am-icon-pencil-square-o', 'Team-Report-my', 98);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_model`
--

INSERT INTO `pes_model` (`model_id`, `model_name`, `lang_key`, `status`, `is_search`, `model_attr`) VALUES
(6, 'User_group', '用户组列表', 1, 0, 2),
(7, 'User', '会员列表', 1, 0, 2),
(8, 'Project', '项目列表', 1, 1, 2),
(9, 'Task', '任务列表', 1, 1, 1),
(10, 'Department', '部门列表', 1, 1, 2);

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
-- 表的结构 `pes_notice`
--

CREATE TABLE IF NOT EXISTS `pes_notice` (
`notice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `task_id` int(11) NOT NULL COMMENT '任务ID',
  `notice_type` tinyint(1) NOT NULL COMMENT '通知类型 1:收到新任务 2.指派审核任务 3.待审核任务 4.待修改的任务 5.部门待审核指派任务 6.完成的任务',
  `notice_read` tinyint(1) NOT NULL COMMENT '是否已读：0 未读 1 已读'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='系统信息消息';

--
-- 转存表中的数据 `pes_notice`
--

INSERT INTO `pes_notice` (`notice_id`, `user_id`, `task_id`, `notice_type`, `notice_read`) VALUES
(1, 4, 21, 3, 0),
(2, 1, 21, 3, 1),
(3, 1, 21, 4, 1),
(4, 4, 21, 3, 0),
(5, 1, 21, 3, 1),
(6, 1, 21, 4, 1),
(7, 4, 21, 3, 0),
(8, 1, 21, 3, 1),
(9, 1, 21, 4, 1),
(10, 4, 21, 3, 0),
(11, 1, 21, 3, 1),
(12, 1, 21, 4, 1),
(13, 4, 21, 3, 0),
(14, 1, 21, 3, 1),
(15, 1, 21, 6, 1),
(16, 1, 17, 3, 1),
(17, 3, 17, 3, 1),
(18, 1, 17, 4, 1),
(19, 4, 20, 3, 0),
(20, 1, 20, 3, 1),
(21, 4, 22, 5, 0),
(22, 2, 22, 2, 1),
(23, 4, 22, 2, 0),
(24, 3, 23, 5, 1),
(25, 4, 23, 2, 0),
(26, 3, 23, 2, 1),
(27, 5, 24, 1, 0),
(28, 4, 24, 2, 0),
(29, 4, 25, 1, 1),
(30, 4, 25, 2, 0),
(31, 1, 26, 5, 1),
(32, 4, 26, 2, 0),
(33, 1, 26, 2, 1),
(34, 1, 20, 4, 1),
(35, 5, 18, 3, 0),
(36, 3, 18, 3, 1),
(37, 5, 19, 3, 0),
(38, 4, 19, 3, 0),
(39, 1, 19, 3, 1),
(40, 3, 27, 5, 1),
(41, 1, 27, 2, 1),
(42, 3, 27, 2, 1),
(43, 1, 28, 1, 1),
(44, 1, 28, 2, 1),
(45, 1, 28, 3, 1),
(46, 1, 28, 4, 1),
(47, 1, 28, 3, 1),
(48, 1, 28, 6, 1),
(49, 3, 23, 1, 0),
(50, 4, 23, 3, 0),
(51, 3, 23, 3, 0),
(52, 3, 23, 6, 0);

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
  `project_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_project`
--

INSERT INTO `pes_project` (`project_id`, `project_listsort`, `project_status`, `project_lang`, `project_url`, `project_title`) VALUES
(1, 0, 1, 0, '/Project/view/id/1.html', 'PESCMS'),
(2, 0, 1, 0, '/Project/view/id/2.html', 'PESCMS TEAM');

-- --------------------------------------------------------

--
-- 表的结构 `pes_report`
--

CREATE TABLE IF NOT EXISTS `pes_report` (
`report_id` int(11) NOT NULL,
  `report_date` varchar(10) NOT NULL COMMENT '报表日期',
  `user_id` int(255) NOT NULL,
  `department_id` int(11) NOT NULL COMMENT '部门ID'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_report`
--

INSERT INTO `pes_report` (`report_id`, `report_date`, `user_id`, `department_id`) VALUES
(1, '2015-04-06', 1, 1),
(2, '2015-04-07', 1, 1),
(3, '2015-04-08', 1, 1),
(4, '2015-04-09', 1, 1),
(5, '2015-04-10', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_report_content`
--

CREATE TABLE IF NOT EXISTS `pes_report_content` (
`content_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `report_content` text NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL COMMENT '任务标题',
  `task_status` tinyint(1) NOT NULL COMMENT '任务状态'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_report_content`
--

INSERT INTO `pes_report_content` (`content_id`, `report_id`, `report_content`, `task_id`, `task_title`, `task_status`) VALUES
(1, 1, '&lt;p&gt;sadasdasd&lt;/p&gt;', 0, '', 0),
(2, 1, '&lt;p&gt;sadasdasd&lt;/p&gt;', 0, '', 0),
(3, 1, '&lt;p&gt;&lt;span style=&quot;font-family: &amp;#39;Segoe UI&amp;#39;, &amp;#39;Lucida Grande&amp;#39;, Helvetica, Arial, &amp;#39;Microsoft YaHei&amp;#39;, FreeSans, Arimo, &amp;#39;Droid Sans&amp;#39;, &amp;#39;wenquanyi micro hei&amp;#39;, &amp;#39;Hiragino Sans GB&amp;#39;, &amp;#39;Hiragino Sans GB W3&amp;#39;, FontAwesome, sans-serif; line-height: 25.6000003814697px; white-space: normal;&quot;&gt;听说这里可以插入到报表去&lt;/span&gt;&lt;/p&gt;', 2, '完善任务系统查看页面', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_task`
--

CREATE TABLE IF NOT EXISTS `pes_task` (
`task_id` int(11) NOT NULL,
  `task_listsort` int(11) NOT NULL,
  `task_status` tinyint(4) NOT NULL COMMENT '0: 未进行 1:进行中 2:审核 3:调整 4:完成',
  `task_lang` tinyint(4) NOT NULL,
  `task_url` varchar(255) NOT NULL,
  `task_accept_id` tinyint(1) NOT NULL COMMENT '0: 非本部门任务，需要对应部门负责人审核任务 1:本部门任务，直接指派内部人员',
  `task_title` varchar(255) NOT NULL,
  `task_department_id` varchar(255) NOT NULL,
  `task_user_id` varchar(255) NOT NULL,
  `task_create_id` varchar(255) NOT NULL,
  `task_content` text NOT NULL,
  `task_file` text NOT NULL,
  `task_createtime` int(11) NOT NULL COMMENT '创建时间',
  `task_completetime` int(11) NOT NULL COMMENT '完成时间',
  `task_estimatetime` int(11) NOT NULL COMMENT '执行者估计时间',
  `task_actiontime` int(11) NOT NULL COMMENT '执行时间',
  `task_priority` tinytext NOT NULL COMMENT '1:严重 2:主要 3:次要 4:普通',
  `task_expecttime` int(11) NOT NULL COMMENT '发起者期望完成时间',
  `task_project` varchar(255) NOT NULL,
  `task_read_permission` tinyint(1) NOT NULL COMMENT '阅读权限',
  `task_delete` tinyint(1) NOT NULL COMMENT '0:正常 1:任务被删除。被删除是由于用户被删除了'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_task`
--

INSERT INTO `pes_task` (`task_id`, `task_listsort`, `task_status`, `task_lang`, `task_url`, `task_accept_id`, `task_title`, `task_department_id`, `task_user_id`, `task_create_id`, `task_content`, `task_file`, `task_createtime`, `task_completetime`, `task_estimatetime`, `task_actiontime`, `task_priority`, `task_expecttime`, `task_project`, `task_read_permission`, `task_delete`) VALUES
(1, 0, 2, 0, '/Task/view/id/1.html', 1, '完善任务发布的细节', '1', '1', '2', '&lt;p&gt;完善任务发布的细节&lt;/p&gt;', '', 1427990400, 0, 0, 0, '4', 1427990400, '2', 0, 0),
(2, 0, 1, 0, '/Task/view/id/2.html', 1, '完善任务系统查看页面', '1', '1', '2', '&lt;p&gt;123456&lt;/p&gt;', '', 1427990400, 0, 1429027200, 0, '2', 1428249600, '2', 1, 0),
(17, 0, 3, 0, '/Task/view/id/17.html', 0, '通知全体员工使用PESCMS TEAM', '2', '1', '1', '&lt;p&gt;通知全体员工使用PESCMS TEAM&lt;/p&gt;', '', 1428076800, 1428244463, 0, 0, '1', 1428336000, '2', 0, 0),
(18, 0, 2, 0, '/Task/view/id/18.html', 0, '发布放假通知', '2', '1', '5', '&lt;p&gt;发布放假通知&lt;/p&gt;', '', 1428076800, 1428255452, 0, 0, '2', 1428336000, '2', 0, 0),
(19, 0, 2, 0, '/Task/view/id/19.html', 0, '修复BUG', '3', '1', '5', '&lt;p&gt;修复BUG&lt;/p&gt;', '', 1428076800, 1428255611, 0, 0, '3', 1428249600, '1', 0, 0),
(20, 0, 3, 0, '/Task/view/id/20.html', 0, '请修复主框架的高度BUG', '1', '1', '4', '&lt;p style=&quot;line-height: 25.6000003814697px; white-space: normal;&quot;&gt;40年后，微软已经是全球最大软件开发商，拥有逾12.5万名员工，总部园区面积达到800万平方英尺(约合74万平方米)，Windows在全球PC市场的份额接近90%。微软现在是全球第三大市值公司，仅落后于埃克森美孚和苹果。&lt;/p&gt;&lt;p style=&quot;line-height: 25.6000003814697px; white-space: normal;&quot;&gt;本周六，微软将庆祝公司成立40周年。盖茨担任微软CEO长达25年时间，在2000年离职。他在周五向微软员工发送电邮，对公司未来发展提出建议：“让科技的力量惠及每一个人，让人们连接彼此，让个人计算无处不在。”&lt;/p&gt;&lt;p style=&quot;line-height: 25.6000003814697px; white-space: normal;&quot;&gt;盖茨在电邮中重申了他在40年前为微软规划的愿景——软件将驱动世界。他要求微软不要忘记改变人们生活的使命。“什么最重要，我们下一步就做什么。”他说。&lt;/p&gt;&lt;p style=&quot;line-height: 25.6000003814697px; white-space: normal;&quot;&gt;盖茨目前担任微软CEO萨蒂亚·纳德拉(Satya Nadella)的顾问，并兼任比尔与梅琳达·盖茨基金会联席主席，专注于慈善事业。过去21年，盖茨16年当选全球首富。不过盖茨承诺将其95%的财富捐献给慈善事业。目前为止，盖茨已经向他的基金会捐献了280亿美元。&lt;/p&gt;', '', 1428076800, 1428255415, 0, 0, '1', 1428336000, '2', 0, 0),
(21, 0, 4, 0, '/Task/view/id/21.html', 0, '发给IT部的任务', '1', '1', '4', '&lt;p&gt;test&lt;/p&gt;', '/upload/20150405/552138f2464e5.docx,/upload/20150405/552138f4d5cd4.docx', 1428163200, 1428242829, 1428242670, 0, '4', 1420387200, '2', 0, 0),
(22, 0, 0, 0, '/Task/view/id/22.html', 0, 'test', '3', '', '2', '&lt;p&gt;测试的&lt;/p&gt;', '', 1428163200, 0, 0, 0, '2', 1428249600, '2', 0, 0),
(23, 0, 4, 0, '/Task/view/id/23.html', 0, 'sadsadasfasf', '2', '3', '4', '&lt;p&gt;asdsadasd&lt;/p&gt;', '', 1428163200, 1428285363, 1428508800, 0, '4', 1428336000, '1', 0, 0),
(24, 0, 0, 0, '/Task/view/id/24.html', 1, 'asdsaddsgdfg', '3', '5', '4', '&lt;p&gt;gasdgsdag&lt;/p&gt;', '', 1428163200, 0, 0, 0, '4', 1431705600, '2', 0, 0),
(25, 0, 0, 0, '/Task/view/id/25.html', 1, '67657', '3', '4', '4', '&lt;p&gt;hhh&lt;/p&gt;', '', 1428163200, 0, 0, 0, '4', 1430323200, '2', 0, 0),
(26, 0, 0, 0, '/Task/view/id/26.html', 0, '给IT部', '1', '', '4', '&lt;p&gt;dd&lt;/p&gt;', '', 1428249600, 0, 0, 0, '4', 1429891200, '2', 0, 0),
(27, 0, 0, 0, '/Task/view/id/27.html', 0, '测试任务动态', '2', '', '1', '&lt;p&gt;ddddd&lt;/p&gt;', '', 1428249600, 0, 0, 0, '4', 1428336000, '2', 0, 0),
(28, 0, 4, 0, '/Task/view/id/28.html', 1, '发给自己', '1', '1', '1', '&lt;p&gt;asdsad&lt;/p&gt;', '', 1428249600, 1428285284, 1428336000, 0, '4', 1428422400, '1', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_check`
--

CREATE TABLE IF NOT EXISTS `pes_task_check` (
`check_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL COMMENT '任务ID',
  `check_user_id` int(11) NOT NULL COMMENT '审核人ID'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_task_check`
--

INSERT INTO `pes_task_check` (`check_id`, `task_id`, `check_user_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 2, 4),
(4, 17, 1),
(5, 17, 3),
(6, 18, 5),
(7, 18, 3),
(8, 19, 5),
(9, 19, 4),
(10, 20, 4),
(11, 20, 1),
(12, 21, 4),
(13, 21, 1),
(14, 22, 2),
(15, 22, 4),
(16, 23, 4),
(17, 23, 3),
(18, 24, 4),
(19, 25, 4),
(20, 1, 1),
(21, 26, 4),
(22, 26, 1),
(23, 19, 1),
(24, 27, 1),
(25, 27, 3),
(26, 28, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_diary`
--

CREATE TABLE IF NOT EXISTS `pes_task_diary` (
`diary_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL COMMENT '任务ID',
  `diary_content` text NOT NULL COMMENT '日志内容',
  `diary_time` int(11) NOT NULL COMMENT '添加时间'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='任务日志';

--
-- 转存表中的数据 `pes_task_diary`
--

INSERT INTO `pes_task_diary` (`diary_id`, `task_id`, `diary_content`, `diary_time`) VALUES
(1, 21, '&lt;p&gt;你的假期不足一天，请及时充值！&lt;/p&gt;', 1428228488),
(2, 21, '&lt;p&gt;你的假期不足一天，请及时充值！&lt;/p&gt;', 1428228498),
(3, 21, '&lt;p&gt;&lt;img src=&quot;/upload/20150405/5521279a52b29.jpg&quot; _src=&quot;/upload/20150405/5521279a52b29.jpg&quot;/&gt;&lt;/p&gt;', 1428236191),
(4, 21, '&lt;p&gt;asdsad&lt;/p&gt;', 1428240447),
(5, 20, '&lt;p&gt;sadsad&lt;/p&gt;', 1428245934),
(6, 20, '&lt;p&gt;sadsad&lt;/p&gt;', 1428245984),
(7, 20, '&lt;p&gt;sadsad&lt;/p&gt;', 1428246120),
(8, 28, '&lt;p&gt;asdsad&lt;/p&gt;', 1428285236),
(9, 2, '&lt;p&gt;听说这里可以插入到报表去&lt;/p&gt;', 1428307762),
(10, 2, '&lt;p&gt;&lt;span style=&quot;font-family: &amp;#39;Segoe UI&amp;#39;, &amp;#39;Lucida Grande&amp;#39;, Helvetica, Arial, &amp;#39;Microsoft YaHei&amp;#39;, FreeSans, Arimo, &amp;#39;Droid Sans&amp;#39;, &amp;#39;wenquanyi micro hei&amp;#39;, &amp;#39;Hiragino Sans GB&amp;#39;, &amp;#39;Hiragino Sans GB W3&amp;#39;, FontAwesome, sans-serif; line-height: 25.6000003814697px; white-space: normal;&quot;&gt;听说这里可以插入到报表去&lt;/span&gt;&lt;/p&gt;', 1428309986);

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_supplement`
--

CREATE TABLE IF NOT EXISTS `pes_task_supplement` (
`task_supplement_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL COMMENT '任务ID',
  `task_supplement_content` text NOT NULL COMMENT '补充说明',
  `task_supplement_file` text NOT NULL COMMENT '补充附件',
  `task_supplement_time` int(11) NOT NULL COMMENT '补充时间'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_task_supplement`
--

INSERT INTO `pes_task_supplement` (`task_supplement_id`, `task_id`, `task_supplement_content`, `task_supplement_file`, `task_supplement_time`) VALUES
(2, 21, '你没看文档吗？', '/upload/20150405/552138f2464e5.docx,/upload/20150405/552138f4d5cd4.docx', 1428240634),
(3, 21, '&lt;p&gt;asdsadsadsad&lt;/p&gt;', '', 1428240648),
(4, 28, '&lt;p&gt;asdasdsd&lt;/p&gt;', '', 1428285246);

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
  `user_last_login` int(11) NOT NULL,
  `user_department_id` varchar(255) NOT NULL,
  `user_head` varchar(255) NOT NULL COMMENT '用户头像'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_user`
--

INSERT INTO `pes_user` (`user_id`, `user_account`, `user_password`, `user_mail`, `user_name`, `user_group_id`, `user_status`, `user_createtime`, `user_last_login`, `user_department_id`, `user_head`) VALUES
(1, 'admin', '75e1d83ba0f896dd29337a2539facb84', 'dev4@pescms.com', '萝卜斯', 1, 1, 1388391307, 1388391307, '1', '/upload/head.jpg'),
(2, 'zhangsan', 'fa251b0c0d49590b8799af684eae070e', 'dev3@pescms.com', '张三', 2, 1, 1388391307, 1388391307, '1', 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80'),
(3, 'lisi', '022a95b734c634792db29d670776526d', 'dev2@pescms.com', '李四', 2, 1, 1388391307, 1388391307, '2', 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80'),
(4, 'wangwu', 'bd77d503960a5824815fc7a8533a31dc', 'dev1@pescms.com', '王五', 2, 1, 1388391307, 1388391307, '3', 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80'),
(5, 'zhaoliu', 'f4s072asdfdsf7805', 'dev@pescms.com', '赵六', 2, 1, 1388391307, 1388391307, '3', 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80');

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
  `user_group_name` varchar(255) NOT NULL,
  `user_group_menu` text NOT NULL COMMENT '用户组菜单列表'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_user_group`
--

INSERT INTO `pes_user_group` (`user_group_id`, `user_group_listsort`, `user_group_status`, `user_group_lang`, `user_group_url`, `user_group_createtime`, `user_group_name`, `user_group_menu`) VALUES
(1, 0, 1, 0, '/User_group/view/id/1.html', 1417273380, '管理员', '1,4,8,11,9,10,13,38,15,16,17,18,40,19,20,41,42,43,45,39,44'),
(2, 0, 1, 0, '/User_group/view/id/2.html', 1417273440, '普通会员', '41,42,43,45,39,44'),
(3, 0, 1, 0, '/User_group/view/id/3.html', 1417273440, '验证会员', '41,44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pes_cookie`
--
ALTER TABLE `pes_cookie`
 ADD PRIMARY KEY (`cookie_id`);

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
 ADD PRIMARY KEY (`field_id`), ADD UNIQUE KEY `modle_id` (`model_id`,`field_name`);

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
-- Indexes for table `pes_user`
--
ALTER TABLE `pes_user`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_account` (`user_account`), ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- Indexes for table `pes_user_group`
--
ALTER TABLE `pes_user_group`
 ADD PRIMARY KEY (`user_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pes_cookie`
--
ALTER TABLE `pes_cookie`
MODIFY `cookie_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_department`
--
ALTER TABLE `pes_department`
MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pes_dynamic`
--
ALTER TABLE `pes_dynamic`
MODIFY `dynamic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pes_field`
--
ALTER TABLE `pes_field`
MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `pes_menu`
--
ALTER TABLE `pes_menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `pes_model`
--
ALTER TABLE `pes_model`
MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pes_node`
--
ALTER TABLE `pes_node`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pes_notice`
--
ALTER TABLE `pes_notice`
MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
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
-- AUTO_INCREMENT for table `pes_report`
--
ALTER TABLE `pes_report`
MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pes_report_content`
--
ALTER TABLE `pes_report_content`
MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pes_task`
--
ALTER TABLE `pes_task`
MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `pes_task_check`
--
ALTER TABLE `pes_task_check`
MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pes_task_diary`
--
ALTER TABLE `pes_task_diary`
MODIFY `diary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pes_task_supplement`
--
ALTER TABLE `pes_task_supplement`
MODIFY `task_supplement_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pes_user`
--
ALTER TABLE `pes_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pes_user_group`
--
ALTER TABLE `pes_user_group`
MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
