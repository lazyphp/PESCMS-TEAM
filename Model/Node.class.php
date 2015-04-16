<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 权限节点
 */
class Node extends \Core\Model\Model {

    /**
     * 节点列表
     */
    public static function nodeList() {

        $result = self::db('node AS n')->field("n.*, IF(parent.top_id IS NULL, n.node_id, parent.top_id) AS top_id, IF(parent.top_listsort IS NULL, '0', parent.top_listsort) AS top_listsort, IF(parent.top_title IS NULL, n.node_title, top_title) AS top_title")->join("(SELECT `node_id` AS top_id, `node_title` AS top_title, `node_parent` AS top_parent, `node_listsort` AS top_listsort FROM `" . self::$prefix . "node` where node_parent = 0) AS parent ON parent.top_id = n.node_parent")->where($condition)->order('top_listsort desc, n.node_listsort desc, n.node_id asc')->select();

        foreach ($result as $key => $value) {
            if ($value['node_parent'] == 0) {
                $node[$value['top_title']]['node_id'] = $value['top_id'];
                $node[$value['top_title']]['top_title'] = $value['top_title'];
            }
        }
        foreach ($result as $key => $value) {
            if (!empty($node[$value['top_title']]) && $value['node_parent'] != 0) {
                $node[$value['top_title']]['node_child'][] = $value;
            }
        }

        return $node;
    }

}
