<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>列表</small></div>
    </div>

    <!--列表工具栏-->
    <?php include 'Task_index/Task_toolbar.php'; ?>
    <!--列表工具栏-->

    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody>
                    <?php foreach ($list as $key => $value) : ?>
                        <tr>
                            <td class="table-id">#<?= $value["task_id"]; ?></td>
                            <td class="table-title">
                                <a href="<?= $label->url('Team-Project-task', array('id' => $value['task_project'])) ?>">[<?= $label->findProject('project', 'project_id', $value['task_project'])['project_title']; ?>]</a>
                                <a href="<?= $label->url('Team-Task-view', array('id' => $value['task_id'])) ?>" style="color:#333"><?= $value["task_title"]; ?></a>
                            </td>
                            <td class="table-id"><?= $label->taskPriority($value['task_priority']); ?></td>
                            <td class="table-id"><?= $label->taskStatus($value['task_status']); ?></td>
                            <td class="table-title">
                                <img src="<?= $label->findUser('user', 'user_id', $value["task_create_id"])['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;"/>
                                <a href="">&nbsp;<?= $label->findUser('user', 'user_id', $value["task_create_id"])['user_name']; ?></a>
                                <span>指派给</span>
                                <?php if (empty($value['task_user_id'])): ?>
                                    <?= $label->findDepartment('department', 'department_id', $value['task_department_id'])['department_name']; ?> 待审核
                                <?php else: ?>
                                    <img src="<?= $label->findUser('user', 'user_id', $value['task_user_id'])['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                                    <a href=""><?= $label->findUser('user', 'user_id', $value['task_user_id'])['user_name']; ?></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                创建于：<?= date('Y-m-d', $value['task_createtime']); ?>
                                期望完成时间:<?= date('Y-m-d', $value['task_expecttime']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <ul class="am-pagination am-pagination-right am-text-sm">
                <?= $page; ?>
            </ul>
        </div>
    </div>
</div>
<!-- content end -->