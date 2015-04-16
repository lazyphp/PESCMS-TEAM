<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Team\PUT;

class Node extends Content {

    public function action() {
        if ($_POST['parent'] == '0') {
            $_POST['value'] = (string) ucfirst(strtolower($_POST['value']));
        } else {
            $controller = \Model\Content::findContent('node', $_POST['parent'], 'node_id');
            $_POST['check_value'] = GROUP . $_POST['method_type'] . $controller['node_value'] . $_POST['value'];
        }
        parent::action();
    }

}
