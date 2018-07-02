<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */


namespace Slice\Team;

/**
 * 任务列表的侧栏切片
 */
class TaskSidebar extends \Core\Slice\Slice {

    public function before() {

    }

    public function after() {
        //若需要添加更多侧栏组件，自行添加
        $taskSidebarPath = THEME_PATH . '/Task/Sidebar/';
        $this->assign('sidebarTool', [
            'search' => "{$taskSidebarPath}Task_search.php",
            'aging' => "{$taskSidebarPath}Task_aging_gap_figure.php",
            'project' => "{$taskSidebarPath}Task_project.php",
            'user' => "{$taskSidebarPath}Task_user.php",
            'bulletin' => "{$taskSidebarPath}Task_bulletin.php",
        ]);
    }


}