<hr class="am-margin-0 task-hr"/>
<?php if (empty($list)): ?>
    <div class="am-margin-top-sm"><i class="am-icon-coffee"></i> 暂时没有找到符合条件的任务~</div>
<?php else: ?>
    <?php foreach ($list as $key => $value): ?>
        <!--输出任务的日期分割线-->
        <?php if (empty($date[date('Y-m-d', $value['task_submit_time'])])): ?>
            <?php $date[date('Y-m-d', $value['task_submit_time'])] = $value['task_submit_time'] ?>
            <div class="task-date am-text-center">
                <span
                    class="task-date-align"><?= str_replace(date('Y-'), '', date('Y-m-d', $value['task_submit_time'])) . '/' . $label->getWeekName($value['task_submit_time']); ?></span>
            </div>
        <?php endif; ?>
        <!--输出任务的日期分割线-->

        <div class="task-list">
            <!--任务标题-->
            <div class="am-margin-bottom-sm">
                <?= $label->getStatusSelect($statusMark, $value); ?>
                <a class="am-link-muted" href="<?= $label->url('Team-Task-view', ['id' => $value['task_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]); ?>"
                   style=";<?= in_array($value['task_status'], ['3', '10']) ? 'text-decoration: line-through;' : '' ?>"> <?= $value['task_title'] ?>
                </a>
                [<a href="<?= $label->url('Team-Task-project', ['id' => $value['task_project_id']]); ?>"
                    class="am-link-muted"><i><?= $label->findContent('project', 'project_id', $value['task_project_id'])['project_title']; ?></i></a>]
            </div>
            <!--任务标题-->

            <div class="am-margin-bottom-xs">#<?= $value['task_id'] ?>
                <a href="<?= $label->url('Team-User-view', ['id' => $value['task_create_id']]) ?>">
                    <img src="<?= $label->getImg($label->findContent('user', 'user_id', $value['task_create_id'])['user_head'], ['50', '50']); ?>"
                         class="am-comment-avatar" style="width: 20px;height: 20px;"/>
                    <?= $label->findContent('user', 'user_id', $value['task_create_id'])['user_name']; ?>
                </a>
                指派给

                <?php if ($label->getActionUser($value['task_id'])['type'] == '2'): ?>
                    <a href="<?= $label->url('Team-User-view', ['id' => $label->getActionUser($value['task_id'])['user_id']]) ?>">
                        <img src="<?= $label->getImg($label->getActionUser($value['task_id'])['user_head'], ['50', '50']); ?>"
                             class="am-comment-avatar" style="width: 20px;height: 20px;"/><?= $label->getActionUser($value['task_id'])['name']; ?>
                    </a>
                <?php else: ?>
                    <i class="am-icon-legal"></i><?= $label->getActionUser($value['task_id'])['name']; ?>
                <?php endif; ?>
                <?= $value['task_multiplayer'] == '1' ? '等多人' : '' ?>

                <!--任务优先度-->
                <span class="am-badge am-radius" style="background-color: <?= $taskPriority[$value['task_priority']]['priority_color'] ?>"><?= $taskPriority[$value['task_priority']]['priority_name'] ?></span>
                <!--任务优先度-->
                
                <!--任务计划完成时间-->
                <span
                    class="am-badge am-round <?= $value['task_end_time'] < time() && $value['task_status'] < 2 ? 'am-badge-warning' : '' ?>"
                    title="计划完成时间：<?= date('m-d H:i', $value['task_end_time']) ?>"><i
                        class="am-icon-calendar"></i> <?= date('m.d', $value['task_end_time']) ?></span>
                <!--任务计划完成事件-->
            </div>

        </div>
    <?php endforeach; ?>
    <ul class="am-pagination am-pagination-centered am-text-xs">
        <?= $page; ?>
    </ul>
<?php endif; ?>