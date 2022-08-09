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


UPDATE `pes_option` SET `option_range` = 'upload' WHERE `option_name` = 'upload_img';
UPDATE `pes_option` SET `option_range` = 'upload_file' WHERE `option_name` = 'upload_img';

INSERT INTO `pes_option` (`id`, `option_name`, `name`, `value`, `option_range`) VALUES (NULL, 'max_upload_size', '上传大小(M)', '10', 'upload');

DELETE FROM `pes_field` WHERE field_model_id = 14 AND field_name = 'upload_name';
UPDATE `pes_field` SET `field_list` = '1' WHERE field_model_id = 14 AND field_name = 'path';
UPDATE `pes_field` SET `field_list` = '1' WHERE field_model_id = 14 AND field_name = 'createtime';

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 14, 'path_type', '存储位置', 'radio', '{&quot;\\u672c\\u5730\\u786c\\u76d8&quot;:&quot;0&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 14, 'status', '状态', 'radio', '{&quot;\\u7981\\u7528&quot;:&quot;0&quot;,&quot;\\u542f\\u7528&quot;:&quot;1&quot;}', '', '', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_attachment` ADD `attachment_path_type` INT NOT NULL, ADD `attachment_status` INT NOT NULL;

UPDATE `pes_attachment` SET `attachment_status` = '1';