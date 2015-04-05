<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">查看任务</strong> / <small>View Task</small></div>
    </div>

    <hr/>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <h2>
                <?= $title; ?>
            </h2>
            <p>
                <span>
                    #<?= $task_id; ?>
                    <a href="<?= $label->url('Team-Project-task', array('id' => $task_project)) ?>"><span class="am-icon-chain"></span> <?= $label->findProject('project', 'project_id', $task_project)['project_title']; ?></a>
                    <?= $label->taskPriority($task_priority); ?>
                    <?= $label->taskStatus($task_status); ?>
                    <img src="<?= $label->findUser('user', 'user_id', $task_create_id)['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                    <a href=""><?= $label->findUser('user', 'user_id', $task_create_id)['user_name']; ?></a>
                    <span>指派给</span>
                    <?php if (empty($task_user_id)): ?>
                        <?= $label->findepartment('department', 'department_id', $task_department_id)['department_name']; ?> 待审核
                    <?php else: ?>
                        <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                        <a href=""><?= $label->findUser('user', 'user_id', $task_user_id)['user_name']; ?></a>
                    <?php endif; ?>
                </span>
                <span class="am-fr">
                    创建于：<?= date('Y-m-d', $task_createtime); ?>
                    期望完成时间：<?= date('Y-m-d', $task_expecttime); ?>
                </span>
            </p>
            <hr/>
        </div>
        <!--任务内容-->
        <div class="am-u-sm-12 am-u-sm-centered">
            <?= htmlspecialchars_decode($task_content); ?>
            <hr/>
        </div>
        <!--任务内容结束-->

        <!--发起人/审核人操作-->
        <!--发起人/审核人操作-->

        <!--部门审核指派-->
        <!--部门审核指派-->

        <!--任务动态-->
        <?php include 'Task/Task_dynamic.php'; ?>
        <!--任务动态-->

        <!--执行人操作-->
        <?php include 'Task/Task_user.php'; ?>
        <!--执行人操作-->

    </div>
</div>
<!-- content end -->
<link href="/Expand/Form/theme/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Expand/Form/theme/umeditor/lang/zh-cn/zh-cn.js"></script>