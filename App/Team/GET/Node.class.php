<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\GET;

class Node extends Content {

    public function index() {
        $this->assign('node', \Model\Node::nodeList());
        parent::index();
    }

    public function action() {
        $parent = \Model\Content::listContent('node', array('node_parent' => '0'), 'node_parent = :node_parent');
        $this->assign('parent', $parent);
        parent::action();
    }

}
