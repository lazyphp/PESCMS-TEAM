-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-07-03 06:50:11
-- 服务器版本： 5.6.25-log
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `team_install`
--

-- --------------------------------------------------------

--
-- 表的结构 `pes_attachment`
--

CREATE TABLE IF NOT EXISTS `pes_attachment` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_createtime` int(11) NOT NULL DEFAULT '0',
  `attachment_name` varchar(255) NOT NULL DEFAULT '',
  `attachment_path` varchar(255) NOT NULL DEFAULT '',
  `attachment_type` int(11) NOT NULL DEFAULT '0',
  `attachment_upload_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_bulletin`
--

CREATE TABLE IF NOT EXISTS `pes_bulletin` (
  `bulletin_id` int(11) NOT NULL AUTO_INCREMENT,
  `bulletin_listsort` int(11) NOT NULL DEFAULT '0',
  `bulletin_createtime` int(11) NOT NULL DEFAULT '0',
  `bulletin_title` varchar(255) NOT NULL DEFAULT '',
  `bulletin_content` text NOT NULL,
  PRIMARY KEY (`bulletin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pes_bulletin`
--

INSERT INTO `pes_bulletin` (`bulletin_id`, `bulletin_listsort`, `bulletin_createtime`, `bulletin_title`, `bulletin_content`) VALUES
(1, 0, 1454126400, 'Hello World', '欢迎使用PESCMS TEAM');

-- --------------------------------------------------------

--
-- 表的结构 `pes_department`
--

CREATE TABLE IF NOT EXISTS `pes_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_listsort` int(11) NOT NULL DEFAULT '0',
  `department_name` varchar(255) NOT NULL DEFAULT '',
  `department_header` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='部门列表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pes_department`
--

INSERT INTO `pes_department` (`department_id`, `department_listsort`, `department_name`, `department_header`) VALUES
(1, 1, '默认部', '1');

-- --------------------------------------------------------

--
-- 表的结构 `pes_dynamic`
--

CREATE TABLE IF NOT EXISTS `pes_dynamic` (
  `dynamic_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '谁触发的动态',
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务',
  `dynamic_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`dynamic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户动态' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_field`
--

CREATE TABLE IF NOT EXISTS `pes_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_model_id` int(11) NOT NULL DEFAULT '0',
  `field_name` varchar(128) NOT NULL DEFAULT '',
  `field_display_name` varchar(128) NOT NULL DEFAULT '',
  `field_type` varchar(128) NOT NULL DEFAULT '',
  `field_option` text NOT NULL,
  `field_explain` varchar(255) NOT NULL DEFAULT '',
  `field_default` varchar(128) NOT NULL DEFAULT '',
  `field_required` tinyint(4) NOT NULL DEFAULT '0',
  `field_listsort` int(11) NOT NULL DEFAULT '0',
  `field_list` tinyint(1) NOT NULL DEFAULT '0',
  `field_form` tinyint(1) NOT NULL DEFAULT '0',
  `field_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `modle_id` (`field_model_id`,`field_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='字段列表' AUTO_INCREMENT=148 ;

--
-- 转存表中的数据 `pes_field`
--

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`) VALUES
(12, 8, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1),
(14, 8, 'title', '项目名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(15, 9, 'status', '状态', 'text', '', '', '', 0, 97, 0, 1, 0),
(19, 9, 'title', '任务标题', 'text', '', '', '', 1, 2, 0, 1, 1),
(22, 9, 'create_id', '任务发起者', 'text', '', '', '', 1, 99, 0, 0, 1),
(24, 9, 'content', '任务说明', 'editor', '', '', '', 0, 6, 0, 1, 1),
(30, 10, 'listsort', '排序', 'text', '', '', '', 1, 98, 1, 1, 1),
(32, 10, 'name', '部门名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(33, 10, 'header', '负责人', 'text', '', '', '', 0, 2, 1, 1, 1),
(35, 9, 'priority', '优先级', 'select', '{"\\u8bf7\\u9009\\u62e9":"","\\u6b63\\u5e38":1,"\\u6b21\\u8981":2,"\\u4e3b\\u8981":3,"\\u4e25\\u91cd":4,"\\u7d27\\u6025":5}', '', '', 1, 3, 0, 1, 1),
(37, 9, 'project_id', '任务项目', 'select', '{"\\u8bf7\\u9009\\u62e9":"","\\u4e0d\\u6307\\u5b9a\\u4efb\\u52a1":1}', '', '', 1, 1, 0, 1, 1),
(38, 9, 'read_permission', '阅读权限', 'radio', '{&quot;\\u5173\\u95ed&quot;:&quot;0&quot;,&quot;\\u5f00\\u542f&quot;:&quot;1&quot;}', '', '0', 1, 9, 0, 1, 1),
(46, 9, 'mail', '是否发送邮件', 'radio', '{"\\u5426":"0","\\u662f":"1"}', '', '0', 1, 96, 0, 1, 1),
(57, 1, 'name', '模型名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(58, 1, 'title', '显示名称', 'text', '', '', '', 1, 2, 1, 1, 1),
(59, 1, 'search', '允许搜索', 'radio', '{"\\u5173\\u95ed":"0","\\u5f00\\u542f":"1"}', '', '', 1, 3, 1, 1, 1),
(60, 1, 'attr', '模型属性', 'radio', '{"\\u524d\\u53f0":"1","\\u540e\\u53f0":"2"}', '', '', 1, 4, 1, 1, 1),
(61, 1, 'status', '模型状态', 'radio', '{"\\u542f\\u7528":"1","\\u7981\\u7528":"0"}', '', '', 1, 5, 1, 1, 1),
(62, 2, 'model_id', '模型ID', 'text', '', '', '', 1, 0, 0, 0, 1),
(63, 2, 'type', '字段类型', 'select', '{"\\u5206\\u7c7b":"category","\\u5355\\u884c\\u8f93\\u5165\\u6846":"text","\\u5355\\u9009\\u6309\\u94ae":"radio","\\u590d\\u9009\\u6846":"checkbox","\\u5355\\u9009\\u4e0b\\u62c9\\u6846":"select","\\u591a\\u884c\\u8f93\\u5165\\u6846":"textarea","\\u7f16\\u8f91\\u5668":"editor","\\u7565\\u7f29\\u56fe":"thumb","\\u4e0a\\u4f20\\u56fe\\u7ec4":"img","\\u4e0a\\u4f20\\u6587\\u4ef6":"file","\\u65e5\\u671f":"date","\\u989c\\u8272":"color","\\u56fe\\u6807":"icon"}', '', '', 1, 1, 1, 1, 1),
(64, 2, 'name', '字段名称', 'text', '', '', '', 1, 2, 1, 1, 1),
(65, 2, 'display_name', '显示名称', 'text', '', '', '', 1, 3, 1, 1, 1),
(66, 2, 'option', '选项值', 'textarea', '', '选填， 选填， 此处若没有特殊说明，必须 名称|值 填写、且一行一个选项值，否则将导致数据异常!  注意:目前选项适用于单选，复选，下拉菜单。其余功能填写也不会产生任何实际效果。', '', 0, 4, 0, 1, 1),
(67, 2, 'explain', '字段说明', 'textarea', '', '', '', 0, 5, 0, 1, 1),
(68, 2, 'default', '默认值', 'text', '', '', '', 0, 6, 0, 1, 1),
(69, 2, 'required', '是否必填', 'radio', '{"\\u662f":"1","\\u5426":"0"}', '', '', 1, 7, 1, 1, 1),
(70, 2, 'list', '显示列表', 'radio', '{"\\u663e\\u793a":"1","\\u9690\\u85cf":"0"}', '', '', 1, 8, 1, 1, 1),
(71, 2, 'form', '显示表单', 'radio', '{"\\u663e\\u793a":"1","\\u9690\\u85cf":"0"}', '', '', 1, 9, 1, 1, 1),
(72, 2, 'status', '字段状态', 'radio', '{"\\u542f\\u7528":"1","\\u7981\\u7528":"0"}', '', '', 1, 11, 1, 1, 1),
(73, 2, 'listsort', '排序', 'text', '', '', '', 0, 99, 0, 1, 1),
(74, 3, 'name', '菜单名称', 'text', '', '', '', 0, 2, 1, 1, 1),
(75, 3, 'pid', '菜单层级', 'select', '', '', '', 1, 1, 1, 1, 1),
(76, 3, 'icon', '菜单图标', 'text', '', '', '', 1, 5, 1, 1, 1),
(77, 3, 'link', '菜单地址', 'text', '{&quot;\\u82e5\\u9009\\u62e9\\u7ad9\\u5185\\u94fe\\u63a5\\uff0c\\u8bf7\\u4ee5\\u7ec4-\\u63a7\\u5236\\u5668-\\u65b9\\u6cd5\\u5f62\\u5f0f\\u586b\\u5199\\u3002&quot;:&quot;&quot;}', '', '', 0, 4, 1, 1, 1),
(78, 3, 'listsort', '排序', 'text', '', '', '', 0, 6, 1, 1, 1),
(79, 6, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '', '1', 1, 100, 1, 1, 1),
(80, 6, 'createtime', '发布时间', 'date', '', '', '', 0, 99, 0, 0, 0),
(81, 7, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '', '1', 1, 100, 1, 1, 1),
(82, 7, 'account', '会员帐号', 'text', '', '', '', 1, 3, 1, 1, 1),
(83, 7, 'password', '会员密码', 'text', '', '新增用户时,密码为必填.编辑用户时为空则表示不修改密码', '', 0, 4, 0, 1, 1),
(84, 7, 'mail', '邮箱地址', 'text', '', '', '', 1, 5, 1, 1, 1),
(85, 7, 'name', '会员名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(86, 7, 'group_id', '用户组', 'select', '{"\\u7ba1\\u7406\\u5458":1,"\\u666e\\u901a\\u4f1a\\u5458":2,"\\u90e8\\u95e8\\u8d23\\u4efb\\u4eba":3}', '', '', 1, 1, 1, 1, 1),
(87, 6, 'name', '用户组名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(88, 13, 'name', '节点名称', 'text', '', '', '', 1, 3, 0, 1, 1),
(89, 13, 'parent', '所属菜单', 'select', '{"\\u8bf7\\u9009\\u62e9":"","\\u9876\\u5c42\\u83dc\\u5355":"0","\\u4efb\\u52a1\\u7ba1\\u7406":61,"\\u62a5\\u8868\\u7ba1\\u7406":54,"\\u7cfb\\u7edf\\u8bbe\\u7f6e":47,"\\u8282\\u70b9\\u7ba1\\u7406":41,"\\u6a21\\u578b\\u7ba1\\u7406":30,"\\u9879\\u76ee\\u7ba1\\u7406":13,"\\u90e8\\u95e8\\u7ba1\\u7406":8,"\\u7528\\u6237\\u7ec4\\u7ba1\\u7406":7,"\\u7528\\u6237\\u7ba1\\u7406":1}', '本选项仅用于布置当前权限节点显示于何方。', '', 1, 1, 0, 1, 1),
(90, 13, 'verify', '是否验证', 'radio', '{&quot;\\u4e0d\\u9a8c\\u8bc1&quot;:&quot;0&quot;,&quot;\\u9a8c\\u8bc1&quot;:&quot;1&quot;}', '', '', 0, 4, 0, 1, 1),
(91, 13, 'msg', '提示信息', 'text', '', '', '', 0, 5, 0, 1, 1),
(92, 13, 'method_type', '请求方法', 'select', '{&quot;GET&quot;:&quot;GET&quot;,&quot;POST&quot;:&quot;POST&quot;,&quot;PUT&quot;:&quot;PUT&quot;,&quot;DELETE&quot;:&quot;DELETE&quot;}', '', '', 0, 6, 0, 1, 1),
(93, 13, 'value', '节点匹配值', 'text', '', '若选择父类节点为控制器，请填写控制器名称。反之填写方法名。区分大小写', '', 0, 7, 0, 1, 1),
(94, 13, 'check_value', '验证值', 'text', '', '', '', 0, 8, 0, 0, 1),
(95, 4, 'controller', '路由控制器', 'text', '', '控制器填写以‘-’为分隔符，分别以：组-控制器名称-方法 形式填写。若是默认组的控制器，那么可以忽略填写组参数。', '', 1, 2, 1, 1, 1),
(96, 4, 'param', '显式参数', 'text', '', '若URL存在GET参数，填写上该参数，以半角逗号隔开。如有三个参数a，b，c。那么填写为：a,b,c', '', 0, 3, 1, 1, 1),
(97, 4, 'rule', '路由规则', 'text', '', '若链接中存在显式参数，那么用左右大括号包围着。如参数number，那么路由规则这样写：route/{number}。同时规则开头不要添加任何字符，且分隔符只能为''/''', '', 1, 4, 1, 1, 1),
(98, 4, 'title', '路由名称', 'text', '', '建议填写，以免路由规则过多时，自己也不清楚谁是他的爹。', '', 0, 1, 1, 1, 1),
(99, 4, 'hash', '路由哈希值', 'text', '', '', '', 1, 99, 0, 0, 1),
(100, 4, 'listsort', '排序', 'text', '', '', '', 0, 100, 1, 1, 1),
(101, 4, 'status', '启用状态', 'radio', '{&quot;\\u542f\\u7528&quot;:&quot;1&quot;,&quot;\\u7981\\u7528&quot;:&quot;0&quot;}', '', '', 1, 7, 1, 1, 1),
(102, 13, 'controller', '父类节点', 'select', '{"\\u8bf7\\u9009\\u62e9":"","\\u9876\\u5c42\\u8282\\u70b9":"0","\\u975e\\u6743\\u9650\\u8282\\u70b9":"-1","\\u66f4\\u65b0\\u7528\\u6237\\u7ec4\\u83dc\\u5355":76,"\\u8bbe\\u7f6e\\u7528\\u6237\\u7ec4\\u83dc\\u5355":75,"\\u66f4\\u65b0\\u7528\\u6237\\u7ec4\\u8282\\u70b9":74,"\\u8bbe\\u7f6e\\u7528\\u6237\\u7ec4\\u8282\\u70b9":73,"\\u5220\\u9664\\u4efb\\u52a1":72,"\\u66f4\\u6539\\u4efb\\u52a1\\u72b6\\u6001":71,"\\u63d0\\u4ea4\\u4efb\\u52a1\\u65e5\\u5fd7":70,"\\u6267\\u884c\\u4efb\\u52a1":69,"\\u4efb\\u52a1\\u6307\\u6d3e":68,"\\u6dfb\\u52a0\\u65b0\\u4efb\\u52a1":67,"\\u67e5\\u770b\\u4efb\\u52a1":66,"\\u5f85\\u5ba1\\u6838\\u4efb\\u52a1\\u5217\\u8868":65,"\\u6211\\u7684\\u4efb\\u52a1":64,"\\u53d1\\u8868\\u65b0\\u4efb\\u52a1":63,"\\u4efb\\u52a1\\u5217\\u8868":62,"\\u4efb\\u52a1\\u7ba1\\u7406":61,"\\u6dfb\\u52a0\\u62a5\\u8868":60,"\\u67e5\\u770b\\u62a5\\u8868":57,"\\u6211\\u7684\\u62a5\\u8868":56,"\\u63d0\\u53d6\\u62a5\\u8868":55,"\\u62a5\\u8868\\u7ba1\\u7406":54,"\\u5b89\\u88c5\\u6570\\u636e\\u5e93\\u66f4\\u65b0":53,"\\u5b89\\u88c5\\u66f4\\u65b0\\u6587\\u4ef6":52,"\\u4e0b\\u8f7d\\u66f4\\u65b0\\u6587\\u4ef6":51,"\\u66f4\\u65b0\\u7cfb\\u7edf\\u8bbe\\u7f6e":50,"\\u67e5\\u770b\\u66f4\\u65b0":49,"\\u67e5\\u770b\\u57fa\\u7840\\u8bbe\\u7f6e":48,"\\u7cfb\\u7edf\\u8bbe\\u7f6e":47,"\\u5220\\u9664\\u8282\\u70b9":46,"\\u66f4\\u65b0\\u8282\\u70b9":45,"\\u6dfb\\u52a0\\u8282\\u70b9":44,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u8282\\u70b9":43,"\\u8282\\u70b9\\u5217\\u8868":42,"\\u8282\\u70b9\\u7ba1\\u7406":41,"\\u5220\\u9664\\u6a21\\u578b\\u5b57\\u6bb5":40,"\\u5220\\u9664\\u6a21\\u578b":39,"\\u66f4\\u65b0\\u6a21\\u578b\\u5b57\\u6bb5":38,"\\u66f4\\u65b0\\u6a21\\u578b":37,"\\u6dfb\\u52a0\\u6a21\\u578b\\u5b57\\u6bb5":36,"\\u6dfb\\u52a0\\u6a21\\u578b":35,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u6a21\\u578b\\u5b57\\u6bb5":34,"\\u6a21\\u578b\\u5b57\\u6bb5\\u5217\\u8868":33,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u6a21\\u578b":32,"\\u6a21\\u578b\\u5217\\u8868":31,"\\u6a21\\u578b\\u7ba1\\u7406":30,"\\u5220\\u9664\\u9879\\u76ee":24,"\\u66f4\\u65b0\\u9879\\u76ee":23,"\\u6dfb\\u52a0\\u9879\\u76ee":22,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u9879\\u76ee":21,"\\u9879\\u76ee\\u5217\\u8868":20,"\\u5220\\u9664\\u7528\\u6237\\u7ec4":19,"\\u66f4\\u65b0\\u7528\\u6237\\u7ec4":18,"\\u6dfb\\u52a0\\u7528\\u6237\\u7ec4":17,"\\u90e8\\u95e8\\u5217\\u8868":16,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u7528\\u6237\\u7ec4":15,"\\u7528\\u6237\\u7ec4\\u5217\\u8868":14,"\\u9879\\u76ee\\u7ba1\\u7406":13,"\\u5220\\u9664\\u90e8\\u95e8":12,"\\u66f4\\u65b0\\u90e8\\u95e8":11,"\\u6dfb\\u52a0\\u90e8\\u95e8":10,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u90e8\\u95e8":9,"\\u90e8\\u95e8\\u7ba1\\u7406":8,"\\u7528\\u6237\\u7ec4\\u7ba1\\u7406":7,"\\u5220\\u9664\\u7528\\u6237":6,"\\u66f4\\u65b0\\u7528\\u6237":5,"\\u6dfb\\u52a0\\u7528\\u6237":4,"\\u65b0\\u589e\\/\\u7f16\\u8f91\\u7528\\u6237":3,"\\u7528\\u6237\\u5217\\u8868":2,"\\u7528\\u6237\\u7ba1\\u7406":1}', '', '', 1, 2, 1, 1, 1),
(103, 13, 'listsort', '排序', 'text', '', '', '', 0, 99, 1, 1, 1),
(104, 3, 'type', '链接类型', 'radio', '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u8fde\\u63a5&quot;:&quot;1&quot;}', '', '', 1, 3, 1, 1, 1),
(105, 7, 'department_id', '所属部门', 'select', '{"\\u8bf7\\u9009\\u62e9":"","\\u9ed8\\u8ba4\\u90e8":1}', '', '', 1, 1, 1, 1, 1),
(106, 9, 'start_time', '开始时间', 'date', '', '', '', 1, 4, 0, 0, 1),
(107, 9, 'end_time', '结束时间', 'date', '', '', '', 1, 4, 0, 0, 1),
(108, 9, 'submit_time', '任务提交时间', 'date', '', '', '', 0, 4, 0, 0, 1),
(109, 9, 'multiplayer', '多人指派', 'text', '', '', '', 0, 99, 0, 0, 1),
(112, 14, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 0, 0, 1),
(113, 14, 'name', '附件名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(114, 14, 'path', '附件所在路径', 'text', '', '', '', 1, 3, 0, 1, 1),
(115, 14, 'type', '附件类型', 'radio', '{&quot;\\u56fe\\u7247&quot;:&quot;1&quot;,&quot;\\u6587\\u4ef6&quot;:&quot;2&quot;}', '', '', 1, 4, 1, 1, 1),
(116, 14, 'upload_name', '上传名称', 'text', '', '', '', 1, 2, 1, 1, 1),
(119, 15, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 0, 0, 1),
(120, 15, 'task_id', '所属任务', 'text', '', '', '', 1, 1, 0, 0, 1),
(121, 15, 'user_id', '所属用户', 'text', '', '', '', 1, 2, 0, 0, 1),
(122, 15, 'content', '动态内容', 'text', '', '', '', 1, 3, 0, 0, 1),
(123, 17, 'content', '补充内容', 'editor', '', '', '', 1, 6, 0, 1, 1),
(124, 17, 'createtime', '补充时间', 'date', '', '', '', 0, 6, 0, 0, 1),
(125, 17, 'task_id', '任务ID', 'text', '', '', '', 1, 6, 0, 0, 1),
(126, 17, 'user_id', '发起者', 'text', '', '', '', 1, 6, 0, 0, 1),
(130, 18, 'name', '状态名称', 'text', '', '', '', 1, 2, 1, 1, 1),
(131, 18, 'icon', '状态图标', 'icon', '', '', '', 1, 3, 1, 1, 1),
(132, 18, 'color', '状态颜色', 'color', '', '', '', 1, 4, 1, 1, 1),
(133, 18, 'type', '状态类型', 'select', '{&quot;\\u672a\\u6267\\u884c\\u7684\\u4efb\\u52a1&quot;:&quot;0&quot;,&quot;\\u6267\\u884c\\u4e2d\\u7684\\u4efb\\u52a1&quot;:&quot;1&quot;,&quot;\\u5ba1\\u6838\\u4e2d\\u7684\\u4efb\\u52a1&quot;:&quot;2&quot;,&quot;\\u5b8c\\u6210\\u7684\\u4efb\\u52a1&quot;:&quot;3&quot;,&quot;\\u5173\\u95ed\\u7684\\u4efb\\u52a1&quot;:&quot;10&quot;}', '自定义设置状态信息，请依据本选项选择类型。', '', 1, 1, 1, 1, 1),
(134, 8, 'content', '项目描述', 'editor', '', '', '', 0, 2, 0, 1, 1),
(135, 7, 'phone', '联系电话', 'text', '', '', '', 0, 6, 1, 1, 1),
(137, 20, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1),
(138, 20, 'createtime', '创建时间', 'date', '', '', '', 1, 99, 1, 1, 1),
(139, 20, 'title', '标题', 'text', '', '', '', 1, 1, 1, 1, 1),
(140, 20, 'content', '内容', 'editor', '', '', '', 0, 2, 0, 1, 1),
(144, 21, 'listsort', '排序', 'text', '', '', '', 0, 99, 1, 1, 1),
(145, 21, 'name', '优先度名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(146, 21, 'color', '标记颜色', 'color', '', '', '', 1, 2, 1, 1, 1),
(147, 9, 'repeat', '任务重复天数', 'text', '', '1.重复天数大于0才会触发重复属性。\r\n2.任务重复将在任务状态为完成或关闭时触发。\r\n3.系统发布的重复任务结束时间将以任务生成时间+重复天数为截止。\r\n4.输入1即表示重复任务的完成周期在1天，如此类推。', '', 0, 7, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_findpassword`
--

CREATE TABLE IF NOT EXISTS `pes_findpassword` (
  `findpassword_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `findpassword_mark` varchar(255) NOT NULL DEFAULT '' COMMENT '标记',
  `findpassword_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`findpassword_id`),
  UNIQUE KEY `findpassword_mark` (`findpassword_mark`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='查找密码' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_menu`
--

CREATE TABLE IF NOT EXISTS `pes_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(128) NOT NULL DEFAULT '',
  `menu_pid` int(11) NOT NULL DEFAULT '0',
  `menu_icon` varchar(128) NOT NULL DEFAULT '',
  `menu_link` varchar(255) NOT NULL DEFAULT '',
  `menu_listsort` tinyint(100) NOT NULL DEFAULT '0',
  `menu_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `menu_pid` (`menu_pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单列表' AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `pes_menu`
--

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_link`, `menu_listsort`, `menu_type`) VALUES
(8, '后台菜单', 19, 'am-icon-align-justify', 'Team-Menu-index', 5, 0),
(9, '内容管理', 0, 'am-icon-database', '', 4, 0),
(16, '会员列表', 55, 'am-icon-user', 'Team-User-index', 1, 0),
(18, '用户组', 55, 'am-icon-group', 'Team-User_group-index', 2, 0),
(19, '高级设置', 0, 'am-icon-wrench', '', 5, 0),
(20, '系统设置', 19, 'am-icon-server', 'Team-Setting-action', 9, 0),
(38, '项目列表', 13, 'am-icon-cubes', 'Team-Project-index', 0, 0),
(39, '任务列表', 41, 'am-icon-tasks', 'Team-Task-index', 40, 0),
(40, '部门列表', 55, 'am-icon-legal', 'Team-Department-index', 3, 0),
(41, '个人中心', 0, 'am-icon-home', '', 2, 0),
(42, '我的任务', 41, 'am-icon-tags', 'Team-Task-my', 20, 0),
(46, '我的报表', 41, 'am-icon-pencil-square-o', 'Team-Report-my', 50, 0),
(48, '提取报表', 9, 'am-icon-newspaper-o', 'Team-Report-extract', 4, 0),
(49, '权限节点', 55, 'am-icon-unlink', 'Team-Node-index', 4, 0),
(50, '提取全体报表', 9, 'am-icon-newspaper-o', 'Team-Report-allExtract', 3, 0),
(51, '新任务', 0, 'am-icon-plus', 'Team-Task-action', 1, 0),
(54, '项目列表', 19, 'am-icon-cubes', 'Team-Project-index', 6, 0),
(55, '用户中心', 0, 'am-icon-street-view', '', 3, 0),
(56, '附件管理', 19, 'am-icon-arrow-circle-down', 'Team-Attachment-index', 3, 0),
(58, '任务状态', 9, 'am-icon-anchor', 'Team-Task_status-index', 1, 0),
(59, '任务看板', 41, 'am-icon-book', 'Team-Task-myCard', 30, 0),
(60, '审核列表', 41, 'am-icon-check-square', 'Team-Task-check', 60, 0),
(61, '部门指派', 41, 'am-icon-deviantart', 'Team-Task-department', 70, 0),
(62, '账号设置', 41, 'am-icon-drupal', 'Team-User-setting', 99, 0),
(63, '公告栏', 9, 'am-icon-building', 'Team-Bulletin-index', 0, 0),
(64, '退出登录', 41, 'am-icon-sign-out', 'Team-Index-logout', 127, 0),
(65, '任务优先度', 9, 'am-icon-sort-alpha-asc', 'Team-Priority-index', 2, 0),
(66, '仪表盘', 41, 'am-icon-tachometer', 'Team-Index-index', 10, 0),
(67, '任务重复管理', 41, 'am-icon-repeat', 'Team-Task-repeat', 71, 0),
(68, '软件协议', 19, 'am-icon-paste', 'https://www.pescms.com/Page/Authorization.html', 98, 1),
(69, '帮助文档', 19, 'am-icon-header', 'https://www.pescms.com/d/index/20.html', 99, 1),
(70, '官方社区', 19, 'am-icon-forumbee', 'https://forum.pescms.com/list/20.html', 100, 1),
(71, '应用商店', 19, 'am-icon-cogs', 'Team-Application-index', 95, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pes_model`
--

CREATE TABLE IF NOT EXISTS `pes_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL DEFAULT '',
  `model_title` varchar(128) NOT NULL DEFAULT '',
  `model_status` tinyint(4) NOT NULL DEFAULT '0',
  `model_search` tinyint(11) NOT NULL DEFAULT '0' COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模型属性 1:前台(含前台) 2:后台',
  PRIMARY KEY (`model_id`),
  UNIQUE KEY `model_name` (`model_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='模型列表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `pes_model`
--

INSERT INTO `pes_model` (`model_id`, `model_name`, `model_title`, `model_status`, `model_search`, `model_attr`) VALUES
(1, 'Model', '模型管理', 1, 1, 2),
(2, 'Field', '字段管理', 1, 1, 2),
(3, 'Menu', '菜单模型', 1, 1, 2),
(4, 'Route', '路由规则', 1, 1, 2),
(6, 'User_group', '用户组列表', 1, 0, 2),
(7, 'User', '用户列表', 1, 0, 2),
(8, 'Project', '项目列表', 1, 1, 2),
(9, 'Task', '任务列表', 1, 1, 1),
(10, 'Department', '部门列表', 1, 1, 2),
(13, 'Node', '节点列表', 1, 1, 2),
(14, 'Attachment', '附件管理', 1, 1, 2),
(15, 'Task_dynamic', '任务动态', 1, 1, 2),
(16, 'Task_list', '任务条目', 1, 1, 2),
(17, 'task_supplement', '任务补充', 1, 1, 2),
(18, 'task_status', '任务状态', 1, 0, 2),
(19, 'Notice', '消息通知', 1, 1, 1),
(20, 'bulletin', '公告栏', 1, 0, 1),
(21, 'priority', '任务优先度', 1, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `pes_node`
--

CREATE TABLE IF NOT EXISTS `pes_node` (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(255) NOT NULL DEFAULT '',
  `node_parent` int(11) NOT NULL DEFAULT '0',
  `node_verify` int(11) NOT NULL DEFAULT '0',
  `node_msg` varchar(255) NOT NULL DEFAULT '',
  `node_method_type` varchar(255) NOT NULL DEFAULT '',
  `node_value` varchar(255) NOT NULL DEFAULT '',
  `node_check_value` varchar(255) NOT NULL DEFAULT '',
  `node_controller` int(11) NOT NULL DEFAULT '0',
  `node_listsort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`node_id`),
  UNIQUE KEY `node_value` (`node_value`,`node_check_value`),
  KEY `node_check_value` (`node_check_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限节点' AUTO_INCREMENT=107 ;

--
-- 转存表中的数据 `pes_node`
--

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_method_type`, `node_value`, `node_check_value`, `node_controller`, `node_listsort`) VALUES
(1, '新任务', 0, 0, '', 'GET', 'newtask', '', -1, 1),
(2, '个人中心', 0, 0, '', 'GET', 'Center', '', -1, 2),
(3, '用户中心', 0, 0, '', 'GET', 'Usercenter', '', -1, 3),
(4, '内容管理', 0, 0, '', 'GET', 'Contentmanage', '', -1, 4),
(5, '高级设置', 0, 0, '', 'GET', 'Advancedsettings', '', -1, 5),
(6, '控制器层', 0, 0, '', 'GET', 'Hidecontroller', '', -1, 99),
(7, '任务模型', 6, 0, '', 'GET', 'Task', '', 0, 1),
(8, '用户模型', 6, 0, '', 'GET', 'User', '', 0, 2),
(9, '用户组模型', 6, 0, '', 'GET', 'User_group', '', 0, 3),
(10, '部门模型', 6, 0, '', 'GET', 'Department', '', 0, 4),
(11, '节点模型', 6, 0, '', 'GET', 'Node', '', 0, 5),
(12, '公告模型', 6, 0, '', 'GET', 'Bulletin', '', 0, 6),
(13, '任务状态模型', 6, 0, '', 'GET', 'Task_status', '', 0, 7),
(14, '附件模型', 6, 0, '', 'GET', 'Attachment', '', 0, 8),
(15, '提取报表模型', 6, 0, '', 'GET', 'Report', '', 0, 9),
(16, '项目模型', 6, 0, '', 'GET', 'Project', '', 0, 10),
(17, '系统设置模型', 6, 0, '', 'GET', 'Setting', '', 0, 11),
(18, '菜单管理模型', 6, 0, '', 'GET', 'Menu', '', 0, 12),
(19, '路由规则模型', 6, 0, '', 'GET', 'Route', '', 0, 13),
(20, '模型管理', 6, 0, '', 'GET', 'Model', '', 0, 14),
(21, '字段模型', 6, 0, '', 'GET', 'Field', '', 0, 15),
(22, '发布新任务', 1, 1, '', 'GET', 'action', 'TeamGETTaskaction', 7, 1),
(23, '我的任务', 2, 1, '', 'GET', 'my', 'TeamGETTaskmy', 7, 1),
(24, '任务看板', 2, 1, '', 'GET', 'myCard', 'TeamGETTaskmyCard', 7, 2),
(25, '任务列表', 2, 1, '', 'GET', 'index', 'TeamGETTaskindex', 7, 3),
(26, '我的报表', 2, 0, '', 'GET', 'my', 'TeamGETReportmy', 15, 4),
(27, '审核列表', 2, 0, '', 'GET', 'check', 'TeamGETTaskcheck', 7, 6),
(28, '部门指派', 2, 1, '', 'GET', 'department', 'TeamGETTaskdepartment', 7, 5),
(29, '用户列表', 3, 1, '', 'GET', 'index', 'TeamGETUserindex', 8, 1),
(30, '新增/编辑用户', 3, 1, '', 'GET', 'action', 'TeamGETUseraction', 8, 2),
(32, '添加用户', 3, 1, '', 'POST', 'action', 'TeamPOSTUseraction', 8, 3),
(33, '更新用户', 3, 1, '', 'PUT', 'action', 'TeamPUTUseraction', 8, 4),
(34, '删除用户', 3, 1, '', 'DELETE', 'action', 'TeamDELETEUseraction', 8, 5),
(35, '用户组列表', 3, 1, '', 'GET', 'index', 'TeamGETUser_groupindex', 9, 6),
(36, '新增/编辑用户组', 3, 1, '', 'GET', 'action', 'TeamGETUser_groupaction', 9, 7),
(37, '提交新增用户组', 3, 1, '', 'POST', 'action', 'TeamPOSTUser_groupaction', 9, 8),
(38, '提交编辑用户组', 3, 1, '', 'PUT', 'action', 'TeamPUTUser_groupaction', 9, 9),
(39, '提交删除用户组', 3, 1, '', 'DELETE', 'action', 'TeamDELETEUser_groupaction', 9, 10),
(40, '查看用户组菜单', 3, 1, '', 'GET', 'setMenu', 'TeamGETUser_groupsetMenu', 9, 11),
(41, '更新用户组菜单', 3, 1, '', 'PUT', 'setMenu', 'TeamPUTUser_groupsetMenu', 9, 12),
(42, '查看用户组权限', 3, 1, '', 'GET', 'setAuth', 'TeamGETUser_groupsetAuth', 9, 13),
(43, '更新用户组权限', 3, 1, '', 'PUT', 'setAuth', 'TeamPUTUser_groupsetAuth', 9, 14),
(44, '节点列表', 3, 1, '', 'GET', 'index', 'TeamGETNodeindex', 11, 20),
(45, '新增/编辑节点', 3, 1, '', 'GET', 'action', 'TeamGETNodeaction', 11, 22),
(46, '提交新增节点', 3, 1, '', 'POST', 'action', 'TeamPOSTNodeaction', 11, 23),
(47, '提交更新节点', 3, 1, '', 'PUT', 'action', 'TeamPUTNodeaction', 11, 24),
(48, '提交删除节点', 3, 1, '', 'DELETE', 'action', 'TeamDELETENodeaction', 11, 25),
(49, '部门列表', 3, 1, '', 'GET', 'index', 'TeamGETDepartmentindex', 10, 15),
(50, '新增/编辑部门', 3, 1, '', 'GET', 'action', 'TeamGETDepartmentaction', 10, 16),
(51, '提交新增部门', 3, 1, '', 'POST', 'action', 'TeamPOSTDepartmentaction', 10, 17),
(52, '提交编辑部门', 3, 1, '', 'PUT', 'action', 'TeamPUTDepartmentaction', 10, 18),
(53, '提交删除部门', 3, 1, '', 'DELETE', 'action', 'TeamDELETEDepartmentaction', 10, 19),
(54, '公告列表', 4, 1, '', 'GET', 'index', 'TeamGETBulletinindex', 12, 1),
(55, '新增/编辑公告', 4, 1, '', 'GET', 'action', 'TeamGETBulletinaction', 12, 2),
(56, '添加公告', 4, 1, '', 'POST', 'action', 'TeamPOSTBulletinaction', 12, 3),
(57, '更新公告', 4, 1, '', 'PUT', 'action', 'TeamPUTBulletinaction', 12, 4),
(58, '删除公告', 4, 1, '', 'DELETE', 'action', 'TeamDELETEBulletinaction', 12, 5),
(59, '任务状态列表', 4, 1, '', 'GET', 'index', 'TeamGETTask_statusindex', 13, 6),
(60, '新增/编辑任务状态', 4, 1, '', 'GET', 'action', 'TeamGETTask_statusaction', 13, 7),
(61, '提交新增任务状态', 4, 1, '', 'POST', 'action', 'TeamPOSTTask_statusaction', 13, 8),
(62, '提交编辑任务状态', 4, 1, '', 'PUT', 'action', 'TeamPUTTask_statusaction', 13, 9),
(63, '提交删除任务状态', 4, 1, '', 'DELETE', 'action', 'TeamDELETETask_statusaction', 13, 10),
(69, '附件列表', 4, 1, '', 'GET', 'index', 'TeamGETAttachmentindex', 14, 11),
(70, '新增/编辑附件', 4, 1, '', 'GET', 'action', 'TeamGETAttachmentaction', 14, 12),
(71, '提交新增附件', 4, 1, '', 'POST', 'action', 'TeamPOSTAttachmentaction', 14, 13),
(72, '提交编辑附件', 4, 1, '', 'PUT', 'action', 'TeamPUTAttachmentaction', 14, 14),
(73, '提交删除附件', 4, 1, '', 'DELETE', 'action', 'TeamDELETEAttachmentaction', 14, 15),
(74, '提取全体报表', 4, 1, '', 'GET', 'allExtract', 'TeamGETReportallExtract', 15, 16),
(75, '提取报表', 4, 1, '', 'GET', 'extract', 'TeamGETReportextract', 15, 17),
(76, '项目列表', 4, 1, '', 'GET', 'index', 'TeamGETProjectindex', 16, 18),
(77, '新增/编辑项目', 4, 1, '', 'GET', 'action', 'TeamGETProjectaction', 16, 19),
(78, '提交新增项目', 4, 1, '', 'POST', 'action', 'TeamPOSTProjectaction', 16, 20),
(79, '提交编辑项目', 4, 1, '', 'PUT', 'action', 'TeamPUTProjectaction', 16, 21),
(80, '提交删除项目', 4, 1, '', 'DELETE', 'action', 'TeamDELETEProjectaction', 16, 22),
(81, '系统设置', 5, 1, '', 'GET', 'action', 'TeamGETSettingaction', 17, 1),
(82, '更新系统设置', 5, 1, '', 'PUT', 'action', 'TeamPUTSettingaction', 17, 2),
(83, '系统更新', 5, 1, '', 'GET', 'upgrade', 'TeamGETSettingupgrade', 17, 3),
(84, '系统手动更新', 5, 1, '', 'PUT', 'mtUpgrade', 'TeamPUTSettingmtUpgrade', 17, 4),
(85, '菜单列表', 5, 1, '', 'GET', 'index', 'TeamGETMenuindex', 18, 5),
(86, '新增/编辑菜单', 5, 1, '', 'GET', 'action', 'TeamGETMenuaction', 18, 6),
(87, '提交新增菜单', 5, 1, '', 'POST', 'action', 'TeamPOSTMenuaction', 18, 7),
(88, '提交编辑菜单', 5, 1, '', 'PUT', 'action', 'TeamPUTMenuaction', 18, 8),
(89, '提交删除菜单', 5, 1, '', 'DELETE', 'action', 'TeamDELETEMenuaction', 18, 9),
(90, '隐藏操作', 0, 0, '', 'GET', 'Hideoperating', '', -1, 98),
(91, '模型列表', 90, 1, '', 'GET', 'index', 'TeamGETModelindex', 20, 1),
(92, '新增/编辑模型', 90, 1, '', 'GET', 'action', 'TeamGETModelaction', 20, 2),
(93, '新增模型', 90, 1, '', 'POST', 'action', 'TeamPOSTModelaction', 20, 3),
(94, '更新模型', 90, 1, '', 'PUT', 'action', 'TeamPUTModelaction', 20, 4),
(95, '删除模型', 90, 1, '', 'DELETE', 'action', 'TeamDELETEModelaction', 20, 5),
(96, '字段列表', 90, 1, '', 'GET', 'index', 'TeamGETFieldindex', 21, 6),
(97, '新增/编辑字段', 90, 1, '', 'GET', 'action', 'TeamGETFieldaction', 21, 7),
(98, '新增字段', 90, 1, '', 'POST', 'action', 'TeamPOSTFieldaction', 21, 8),
(99, '更新字段', 90, 1, '', 'PUT', 'action', 'TeamPUTFieldaction', 21, 9),
(100, '删除字段', 90, 1, '', 'DELETE', 'action', 'TeamDELETEFieldaction', 21, 10),
(101, '任务优先度模型', 6, 0, '', 'GET', 'Priority', '', 0, 16),
(102, '任务优先度列表', 4, 1, '', 'GET', 'index', 'TeamGETPriorityindex', 101, 23),
(103, '新增/编辑任务优先度', 4, 1, '', 'GET', 'action', 'TeamGETPriorityaction', 101, 24),
(104, '新增任务优先度', 4, 1, '', 'POST', 'action', 'TeamPOSTPriorityaction', 101, 25),
(105, '更新任务优先度', 4, 1, '', 'PUT', 'action', 'TeamPUTPriorityaction', 101, 26),
(106, '删除任务优先度', 4, 1, '', 'DELETE', 'action', 'TeamDELETEPriorityaction', 101, 27);

-- --------------------------------------------------------

--
-- 表的结构 `pes_node_group`
--

CREATE TABLE IF NOT EXISTS `pes_node_group` (
  `node_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `node_id` int(11) NOT NULL DEFAULT '0' COMMENT '节点ID',
  PRIMARY KEY (`node_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户组权限节点' AUTO_INCREMENT=158 ;

--
-- 转存表中的数据 `pes_node_group`
--

INSERT INTO `pes_node_group` (`node_group_id`, `user_group_id`, `node_id`) VALUES
(1, 2, 1),
(2, 2, 22),
(3, 2, 2),
(4, 2, 23),
(5, 2, 24),
(6, 2, 25),
(7, 2, 26),
(8, 3, 1),
(9, 3, 22),
(10, 3, 2),
(11, 3, 23),
(12, 3, 24),
(13, 3, 25),
(14, 3, 26),
(15, 3, 28),
(16, 3, 27),
(17, 3, 4),
(18, 3, 75),
(86, 1, 1),
(87, 1, 22),
(88, 1, 2),
(89, 1, 23),
(90, 1, 24),
(91, 1, 25),
(92, 1, 26),
(93, 1, 28),
(94, 1, 27),
(95, 1, 3),
(96, 1, 29),
(97, 1, 30),
(98, 1, 32),
(99, 1, 33),
(100, 1, 34),
(101, 1, 35),
(102, 1, 36),
(103, 1, 37),
(104, 1, 38),
(105, 1, 39),
(106, 1, 40),
(107, 1, 41),
(108, 1, 42),
(109, 1, 43),
(110, 1, 49),
(111, 1, 50),
(112, 1, 51),
(113, 1, 52),
(114, 1, 53),
(115, 1, 44),
(116, 1, 45),
(117, 1, 46),
(118, 1, 47),
(119, 1, 48),
(120, 1, 4),
(121, 1, 54),
(122, 1, 55),
(123, 1, 56),
(124, 1, 57),
(125, 1, 58),
(126, 1, 59),
(127, 1, 60),
(128, 1, 61),
(129, 1, 62),
(130, 1, 63),
(131, 1, 69),
(132, 1, 70),
(133, 1, 71),
(134, 1, 72),
(135, 1, 73),
(136, 1, 74),
(137, 1, 75),
(138, 1, 76),
(139, 1, 77),
(140, 1, 78),
(141, 1, 79),
(142, 1, 80),
(143, 1, 102),
(144, 1, 103),
(145, 1, 104),
(146, 1, 105),
(147, 1, 106),
(148, 1, 5),
(149, 1, 81),
(150, 1, 82),
(151, 1, 83),
(152, 1, 84),
(153, 1, 85),
(154, 1, 86),
(155, 1, 87),
(156, 1, 88),
(157, 1, 89);

-- --------------------------------------------------------

--
-- 表的结构 `pes_notice`
--

CREATE TABLE IF NOT EXISTS `pes_notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '接收的用户ID',
  `notice_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1.新任务 2.新审核任务 3.新待审核任务 4.新待指派任务 5.任务内容修改/补充',
  `notice_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读：0 未读 1 已读',
  `notice_title` varchar(255) NOT NULL DEFAULT '' COMMENT '消息标题',
  `notice_content` text NOT NULL COMMENT '消息内容',
  `notice_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统信息消息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_option`
--

CREATE TABLE IF NOT EXISTS `pes_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `option_range` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统选项' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `pes_option`
--

INSERT INTO `pes_option` (`id`, `option_name`, `name`, `value`, `option_range`) VALUES
(13, 'version', '系统版本', '', 'system'),
(14, 'upload_img', '图片格式', '[".jpg",".jpge",".bmp",".gif",".png"]', 'upload'),
(15, 'upload_file', '文件格式', '[".zip",".rar",".7z",".doc",".docx",".pdf",".xls",".xlsx",".ppt",".pptx",".txt"]', 'upload'),
(17, 'mail', '邮件服务信息', '{"account":"","passwd":"","address":"","port":""}', ''),
(19, 'signup', '帐号注册', '1', 'system'),
(22, 'notice_way', '消息推送方式', '2', 'system');

-- --------------------------------------------------------

--
-- 表的结构 `pes_priority`
--

CREATE TABLE IF NOT EXISTS `pes_priority` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_listsort` int(11) NOT NULL DEFAULT '0',
  `priority_name` varchar(255) NOT NULL DEFAULT '',
  `priority_color` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pes_priority`
--

INSERT INTO `pes_priority` (`priority_id`, `priority_listsort`, `priority_name`, `priority_color`) VALUES
(1, 1, '正常', '#999999'),
(2, 2, '次要', '#3bb4f2'),
(3, 3, '主要', '#0e90d2'),
(4, 4, '严重', '#f37b1d'),
(5, 5, '紧急', '#dd514c');

-- --------------------------------------------------------

--
-- 表的结构 `pes_project`
--

CREATE TABLE IF NOT EXISTS `pes_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_listsort` int(11) NOT NULL DEFAULT '0',
  `project_title` varchar(255) NOT NULL DEFAULT '',
  `project_content` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='项目列表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pes_project`
--

INSERT INTO `pes_project` (`project_id`, `project_listsort`, `project_title`, `project_content`) VALUES
(1, 1, '不指定任务', '&lt;p&gt;一些不知名的任务都会存放于本项目之中。&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `pes_report`
--

CREATE TABLE IF NOT EXISTS `pes_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_date` int(11) NOT NULL DEFAULT '0' COMMENT '报表日期',
  `user_id` int(255) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0' COMMENT '部门ID',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户报表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_report_content`
--

CREATE TABLE IF NOT EXISTS `pes_report_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL DEFAULT '0',
  `report_content` text NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='报表内容' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_route`
--

CREATE TABLE IF NOT EXISTS `pes_route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_controller` varchar(255) NOT NULL DEFAULT '',
  `route_param` varchar(255) NOT NULL DEFAULT '',
  `route_rule` varchar(255) NOT NULL DEFAULT '',
  `route_title` varchar(255) NOT NULL DEFAULT '',
  `route_hash` varchar(255) NOT NULL DEFAULT '',
  `route_listsort` int(11) NOT NULL DEFAULT '0',
  `route_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='路由表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_send`
--

CREATE TABLE IF NOT EXISTS `pes_send` (
  `send_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_account` varchar(255) NOT NULL DEFAULT '',
  `send_title` varchar(255) NOT NULL DEFAULT '' COMMENT '待发送标题',
  `send_content` text NOT NULL COMMENT '待发送的内容',
  `send_time` int(11) NOT NULL DEFAULT '0' COMMENT '发送时间',
  `send_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:邮箱 2:手机 ..',
  PRIMARY KEY (`send_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='待发送列表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_task`
--

CREATE TABLE IF NOT EXISTS `pes_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: 待办 1:执行中 2:审核 3:完成 10:关闭',
  `task_title` varchar(255) NOT NULL DEFAULT '' COMMENT '任务标题',
  `task_create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建者ID',
  `task_multiplayer` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:单人任务 1：多人任务',
  `task_content` text NOT NULL COMMENT '任务文本内容',
  `task_priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '任务优先度',
  `task_project_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应项目的ID',
  `task_read_permission` tinyint(1) NOT NULL DEFAULT '0' COMMENT '阅读权限',
  `task_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常 1:任务被删除。被删除是由于用户被删除了',
  `task_mail` tinyint(1) NOT NULL DEFAULT '0' COMMENT '本任务全程是否发送邮件 0:不 1:发',
  `task_submit_time` int(11) NOT NULL DEFAULT '0' COMMENT '任务提交时间',
  `task_complete_time` int(11) NOT NULL DEFAULT '0' COMMENT '完成时间',
  `task_start_time` int(11) NOT NULL DEFAULT '0' COMMENT '任务计划开始时间',
  `task_end_time` int(11) NOT NULL DEFAULT '0' COMMENT '任务计划结束时间',
  `task_repeat` varchar(8) NOT NULL DEFAULT '' COMMENT '任务重复天数',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务列表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_dynamic`
--

CREATE TABLE IF NOT EXISTS `pes_task_dynamic` (
  `task_dynamic_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_dynamic_createtime` int(11) NOT NULL DEFAULT '0',
  `task_dynamic_task_id` varchar(255) NOT NULL DEFAULT '',
  `task_dynamic_user_id` varchar(255) NOT NULL DEFAULT '',
  `task_dynamic_content` text NOT NULL,
  PRIMARY KEY (`task_dynamic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务动态' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_list`
--

CREATE TABLE IF NOT EXISTS `pes_task_list` (
  `task_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务id',
  `task_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '执行条目的人',
  `task_list_content` text NOT NULL COMMENT '条目内容',
  `task_list_time` int(11) NOT NULL DEFAULT '0' COMMENT '条目完成时间',
  PRIMARY KEY (`task_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务明细条目' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_status`
--

CREATE TABLE IF NOT EXISTS `pes_task_status` (
  `task_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_status_name` varchar(255) NOT NULL DEFAULT '',
  `task_status_icon` varchar(32) NOT NULL DEFAULT '',
  `task_status_color` varchar(8) NOT NULL DEFAULT '',
  `task_status_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pes_task_status`
--

INSERT INTO `pes_task_status` (`task_status_id`, `task_status_name`, `task_status_icon`, `task_status_color`, `task_status_type`) VALUES
(1, '待办', 'am-icon-eject', '#000000', 0),
(2, '进行', 'am-icon-play', '#666666', 1),
(3, '审核', 'am-icon-compress', '#3bb4f2', 2),
(4, '完成', 'am-icon-check', '#5eb95e', 3),
(5, '关闭', 'am-icon-close', '#dd514c', 10);

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_supplement`
--

CREATE TABLE IF NOT EXISTS `pes_task_supplement` (
  `task_supplement_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_supplement_task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `task_supplement_content` text NOT NULL COMMENT '补充说明',
  `task_supplement_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '补充时间',
  `task_supplement_user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_supplement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务补充说明' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_task_user`
--

CREATE TABLE IF NOT EXISTS `pes_task_user` (
  `task_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT '0' COMMENT '任务ID',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `task_user_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '任务类型 1:审核者 2:执行者 3:部门',
  PRIMARY KEY (`task_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务审核人/执行人列表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_user`
--

CREATE TABLE IF NOT EXISTS `pes_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_ey` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户的ey值',
  `user_phone` varchar(255) NOT NULL DEFAULT '',
  `user_home` varchar(255) NOT NULL DEFAULT '',
  `user_openid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_account` (`user_account`),
  UNIQUE KEY `user_mail` (`user_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pes_user_group`
--

CREATE TABLE IF NOT EXISTS `pes_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_group_createtime` int(11) NOT NULL DEFAULT '0',
  `user_group_name` varchar(255) NOT NULL DEFAULT '',
  `user_group_menu` text NOT NULL COMMENT '用户组菜单列表',
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pes_user_group`
--

INSERT INTO `pes_user_group` (`user_group_id`, `user_group_status`, `user_group_createtime`, `user_group_name`, `user_group_menu`) VALUES
(1, 1, 1417273380, '管理员', '51,41,66,42,59,39,46,60,61,67,62,64,55,16,18,40,49,9,63,58,65,50,48,19,56,8,54,20,68,69,70'),
(2, 1, 1417273440, '普通会员', '51,41,66,42,59,39,46,67,62,64'),
(3, 1, 1417273440, '部门责任人', '51,41,66,42,59,39,46,60,61,67,62,64,9,65,48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
