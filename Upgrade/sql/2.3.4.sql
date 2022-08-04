ALTER TABLE `pes_field`
    ADD `field_is_null` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否为空';
ALTER TABLE `pes_field`
    ADD `field_only` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否唯一';
ALTER TABLE `pes_field`
    ADD `field_action` varchar(255) NOT NULL DEFAULT '' COMMENT '字段行为';


INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 2, 'is_null', '是否为空', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 0, 7, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 2, 'only', '唯一', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 1, 12, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 2, 'action', '行为', 'checkbox', '{&quot;\\u65b0\\u589e&quot;:&quot;POST&quot;,&quot;\\u66f4\\u65b0&quot;:&quot;PUT&quot;}', '', '', 0, 13, 1, 1, 1, 0, 0, 'POST,PUT');

UPDATE `pes_field` SET `field_action` = 'POST,PUT';

ALTER TABLE `pes_model` ADD `model_page` INT NOT NULL DEFAULT '10' COMMENT '模型分页' AFTER `model_attr`;

ALTER TABLE `pes_notice` ADD `notice_task_id` INT NOT NULL COMMENT '任务ID' AFTER `notice_id`, ADD INDEX (`notice_task_id`);

DELETE FROM `pes_field` WHERE field_model_id = 14 AND field_name = 'upload_name';
UPDATE `pes_field` SET `field_list` = '1' WHERE field_model_id = 14 AND field_name = 'path';
UPDATE `pes_field` SET `field_list` = '1' WHERE field_model_id = 14 AND field_name = 'createtime';

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 14, 'path_type', '存储位置', 'radio', '{&quot;\\u672c\\u5730\\u786c\\u76d8&quot;:&quot;0&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 14, 'status', '状态', 'radio', '{&quot;\\u7981\\u7528&quot;:&quot;0&quot;,&quot;\\u542f\\u7528&quot;:&quot;1&quot;}', '', '', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_attachment` ADD `attachment_path_type` INT NOT NULL, ADD `attachment_status` INT NOT NULL;

UPDATE `pes_attachment` SET `attachment_status` = '1';

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_link`, `menu_listsort`, `menu_type`) VALUES
(NULL, '我创建的任务', 41, 'am-icon-user-md', 'Team-Task-create', 80, 0);

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_method_type`, `node_value`, `node_check_value`, `node_controller`, `node_listsort`) VALUES
(NULL, '我创建的任务', 2, 1, '', 'GET', 'Team-Task-create', 'TeamGETTaskTeam-Task-create', 7, 7);

ALTER TABLE `pes_option` CHANGE `id` `option_id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pes_option` ADD `option_node` VARCHAR(32) NOT NULL COMMENT '所属节点' AFTER `option_range`, ADD `option_type` VARCHAR(32) NOT NULL COMMENT '选项格式' AFTER `option_node`, ADD `option_form` VARCHAR(16) NOT NULL COMMENT '表单类型' AFTER `option_type`, ADD `option_form_option` VARCHAR(255) NOT NULL COMMENT '表单选项' AFTER `option_form`, ADD `option_required` INT(11) NOT NULL COMMENT '是否必填' AFTER `option_form_option`, ADD `option_explain` VARCHAR(255) NOT NULL COMMENT '选项说明' AFTER `option_required`, ADD `option_listsort` INT(11) NOT NULL COMMENT '排序值' AFTER `option_explain`;

--
-- 系统设置排序条件
--
INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_range`, `option_node`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES ('-1', 'setting_sort', '设置排序', '{"上传设置":2,"网站信息":1,"通知设置":"4"}', 'sort', '设置排序', 'array', 'text', '', '0', '', '0');
--
-- 系统设置排序条件
--

--
-- 上传设置
--
UPDATE `pes_option` SET `option_range` = 'upload', option_node = '上传设置', option_type = 'json', option_form = 'text', option_required = 1 WHERE `option_name` = 'upload_img';

UPDATE `pes_option` SET `option_range` = 'upload', option_node = '上传设置', option_type = 'json', option_form = 'text', option_required = 1 WHERE `option_name` = 'upload_file';

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_range`, `option_node`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(NULL, 'max_upload_size', '上传大小(M)', '10', 'upload', '上传设置', 'string', 'text', '', 1, '', 0);
--
-- 上传设置
--


--
-- 网站信息设置
--
UPDATE `pes_option` SET option_node = '网站信息', option_type = 'setting_version', option_form = 'setting_version' WHERE `option_name` = 'version';

DELETE FROM `pes_option` WHERE `option_name` = 'domain';

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_range`, `option_node`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(NULL, 'domain', '网站域名', '', 'system', '网站信息', 'string', 'text', '', 1, '', 1);

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_range`, `option_node`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES (NULL, 'siteTitle', '网站标题', 'PESCMS Team', 'system', '网站信息', 'string', 'text', '', '1', '', '2');
--
-- 网站信息设置
--


--
-- 发送设置相关
--

UPDATE `pes_option` SET `name` ="电子邮箱账号设置", `value`='{"account":"","passwd":"","address":"","port":""}', `option_range` = 'email', option_node = '通知设置', option_type = 'setting_option', option_form = 'setting_option', option_form_option = '{"account":"邮箱账户","passwd":"邮箱密码","address":"SMTP地址","port":"邮箱端口"}', option_required = 0, option_listsort = '1' WHERE `option_name` = 'mail';

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_range`, `option_node`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES (NULL, 'mail_test', '邮件发送测试', '', 'mail_test', '通知设置', 'send_test', 'send_test', '/?g=Team&m=Setting&a=emailTest', '0', '', '2');

UPDATE `pes_option` SET option_node = '通知设置', option_type = 'string', option_form = 'radio', option_form_option = '{"被动触发":"1","定时触发":"2","两者兼有":"3"}', option_required = 1 WHERE `option_name` = 'notice_way';
--
-- 发送设置
--

DELETE FROM `pes_option` WHERE `option_name` = 'signup';

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_link`, `menu_listsort`, `menu_type`) VALUES
(NULL, '日志快查', 19, 'am-icon-search-plus', 'Team-Log-index', 80, 0);


ALTER TABLE `pes_send` ADD `send_result` TEXT NOT NULL COMMENT '接口回调内容' AFTER `send_type`, ADD `send_status` INT NOT NULL DEFAULT '0' COMMENT '发送状态' AFTER `send_result`, ADD `send_sequence` INT NOT NULL DEFAULT '0' COMMENT '失败次数' AFTER `send_status`;
