INSERT INTO `pes_node` (`node_name`, `node_parent`, `node_verify`, `node_msg`, `node_method_type`, `node_value`, `node_check_value`, `node_controller`, `node_listsort`) VALUES ('复制用户组', '3', '1', '', 'POST', 'copy', 'TeamPOSTUser_groupcopy', '9', '9');

INSERT INTO `pes_node` ( `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_method_type`, `node_value`, `node_check_value`, `node_controller`, `node_listsort`) VALUES
  ('删除任务', 1, 1, '', 'DELETE', 'action', 'TeamDELETETaskaction', 7, 2);