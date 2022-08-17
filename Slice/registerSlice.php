<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| 切片注册
| 程序提供五个方法声明切片绑定的请求类型: any, get, post, put, delete
| 参数一：绑定控制器路由规则。
          依次填写 组-控制器-方法。若为泛匹配，提供3个对应的占位符。
           :g-:m-:a 。如：Team-:m-:a 泛匹配组Team下任意的控制器以及方法
|         参数可以为字符串或者数组
| 参数二：
|         切片的命名空间。相对于当前Slice目录。不需要填写空间名Slice,如：\Slice\Common\Auto，则填写\Common\Auto
|         注：切片是按照由上至下的顺序进行注册。
|         参数必须为数组
| 参数三:
|         不参与绑定的路由规则。和参数一一样。可以不填写
|         参数可以为字符串或者数组
| 示例代码：
|
| InitSlice::any(['Home', 'Home-Index'], ['\Common\Authenticate']); //路由Home, Home-index 绑定 \Common\Authenticate
|
| InitSlice::any('Admin-Setting-index', ['\Common\Authenticate']); //路由Admin-Setting-index 绑定\Common\Authenticate
|
| InitSlice::any('Admin', ['\Admin\Login'], ['Admin-Login']); //路由Admin 绑定\Admin\Login 但Admin-login不会被绑定
|
|--------------------------------------------------------------------------
|
*/


use \Core\Slice\InitSlice as InitSlice;

$SLICE_ARRYR = [
    /*----------------全局设置部分----------------*/

    //全局切片
    'GLOBAL-SLICE' => [
        'any',
        ['Team-:m-:a'],
        //注册系统设置
        ['\Common\Option']
    ],


    'GLOBAL-ACCESS' => [
        'any',
        'Team-:m-:a',
        ['\Team\Login', '\Team\Menu', '\Team\Auth', '\Team\Notice'],//注册后台登录验证、权限验证、后台菜单
        ['Team-Login-:a']
    ],

    //部分操作需要超级管理员才可以进行。
    'ADMIN-LIMIT' => [
        'any',
        ['Team-Model-:a', 'Team-Field-:a', 'Team-Setting-:a', 'Team-Log-:a'],
        ['\Team\AdminLimit'],
    ],

    /*----------------Team部分----------------*/

    //注册理路由规则 添加/编辑 提交的表单内容
    'Team-Route-Action' => [
        'any',
        ['Team-Route-action'],
        ['\Team\HandleForm\HandleRoute', '\Common\UpdateRoute']
    ],

    //注册自动更新用户组、部门、项目、字段的信息
    'Team-FieldUpdate' => [
        'any',
        ['Team-User-:a', 'Team-User_group-:a', 'Team-Department-:a', 'Team-Project-:a'],
        [
            '\Team\UpdateField\UpdateUserGroupField',
            '\Team\UpdateField\UpdateUserDepartmentField',
            '\Team\UpdateField\UpdateUserProjectField'
        ]
    ],

    //注册自动更新用户组字段的信息
    'Team-Node-FieldUpdate' => [
        'any',
        ['Team-Node-:a'],
        ['\Team\UpdateField\UpdateNodeParentField']
    ],

    //注册更新任务priority字段选项值的切片
    'Team-Priority-FieldUpdate' => [
        'any',
        ['Team-Priority-:a'],
        ['\Team\UpdateField\UpdateTaskPriorityField']
    ],

    //注册自动处理后台用户提交的用户密码表单
    'Team-User-Action' => [
        'any',
        ['Team-User-action'],
        ['\Team\HandleForm\HandleUser']
    ],

    //注册处理节点管理 添加/编辑 提交的表单内容
    'Team-Node-Action' => [
        'any',
        ['Team-Node-action'],
        ['\Team\HandleForm\HandleNode']
    ],

    //注册任务状态的模板赋值
    'TaskANDUser' => [
        'get',
        ['Team-Task-:a', 'Team-User-:a', 'Team-Department-analyze', 'Team-Project-analyze', 'Team-Index-index'],
        ['\Team\TaskMark', '\Team\TaskSidebar']
    ],

    //注册处理任务条目
    'Task-List-Action' => [
        'any',
        ['Team-Task-taskListAction', 'Team-Task_list-action'],
        ['\Team\HandleForm\HandleTaskList']
    ],

    //注册处理任务补充说明
    'Task-Supplement-Action' =>[
        'any',
        ['Team-Task_supplement-action'],
        ['\Team\HandleForm\HandleTaskSupplement']
    ],

    //注册插件初始化入口
    'TEAM-APPLICATION-Init' => [
        'any',
        ['Team-Application-Init'],
        ['\Team\ApplicationInit']
    ],

    //插件全局事件
    'APPLICATION-GLOBAL-EVENT' => [
        'any',
        ['Team-:m-:a'],
        ['\Common\ApplicationGlobalEvent'],
    ],

];

//执行切片注册
foreach ($SLICE_ARRYR as $item) {
    $method = $item['0'];
    $exclude = empty($item['3']) ? [] : $item['3'];
    InitSlice::$method($item[1], $item[2], $exclude);
}