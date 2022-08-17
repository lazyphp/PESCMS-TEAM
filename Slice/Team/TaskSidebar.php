<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
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