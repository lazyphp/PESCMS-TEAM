<hr class="am-margin-0 task-hr"/>
<?php if (empty($list)): ?>
    <div class="am-margin-top-sm"><i class="am-icon-coffee"></i> 暂时没有找到符合条件的任务~</div>
<?php else: ?>
    <?php foreach ($list as $key => $value): ?>
        <!--输出任务的日期分割线-->
        <?php $timeLineField = $value['task_status'] == 3 ? 'task_complete_time' : 'task_submit_time' ?>
        <?php if (empty($date[date('Y-m-d', $value[$timeLineField])])): ?>
            <?php $date[date('Y-m-d', $value[$timeLineField])] = $value[$timeLineField] ?>
            <div class="task-date am-text-center">
                <span
                    class="task-date-align"><?= str_replace(date('Y-'), '', date('Y-m-d', $value[$timeLineField])) . '/' . $label->getWeekName($value[$timeLineField]); ?></span>
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
                    <img src="<?= $label->getImg($label->findContent('user', 'user_id', $value['task_create_id'])['user_head'], ['150', '150']); ?>"
                         class="am-comment-avatar" style="width: 20px;height: 20px;"/>
                    <?= $label->findContent('user', 'user_id', $value['task_create_id'])['user_name']; ?>
                </a>
                指派给

                <?php if ($label->getActionUser($value['task_id'])['type'] == '2'): ?>
                    <a href="<?= $label->url('Team-User-view', ['id' => $label->getActionUser($value['task_id'])['user_id']]) ?>">
                        <img src="<?= $label->getImg($label->getActionUser($value['task_id'])['user_head'], ['150', '150']); ?>"
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
                <span class="am-badge am-round <?= $value['task_end_time'] < time() && $value['task_status'] < 2 ? 'am-badge-warning' : '' ?>" title="计划完成时间：<?= date('Y-m-d H:i', $value['task_end_time']) ?>"><i
                        class="am-icon-calendar"></i> <?= date('Y.m.d', $value['task_end_time']) ?>
                </span>
                
                <?php if($value['task_end_time'] < time() && $value['task_status'] < 2): ?>
                    <span class="am-badge am-round am-badge-danger"><i class="am-icon-exclamation"></i> 已逾期 <?= floor((time() - $value['task_end_time'])/ 86400) ?>天</span>
                <?php endif; ?>
                <!--任务计划完成事件-->

                <!--任务完成时间-->
                <?php if(!empty($value['task_complete_time'])): ?>
                    <span
                        class="am-badge am-badge-success am-round"
                        title="完成时间：<?= date('Y-m-d H:i', $value['task_complete_time']) ?>"><i class="am-icon-check"></i> <?= date('Y-m-d', $value['task_complete_time']) ?>
                    </span>
                <?php endif; ?>
                <!--任务完成事件-->

                <?php if($label->checkAuth('TeamDELETETaskaction') === true): ?>
                <a class="am-text-danger ajax-click ajax-dialog"  msg="确定删除吗？将无法恢复的！" href="<?= $label->url(GROUP . '-' . MODULE . '-action', array('id' => $value["task_id"], 'method' => 'DELETE', 'back_url' => base64_encode($_SERVER['REQUEST_URI']))); ?>"><span class="am-icon-trash-o"></span></a>
                <?php endif; ?>
            </div>

        </div>
    <?php endforeach; ?>
    <ul class="am-pagination am-pagination-centered am-text-xs">
        <?= $page; ?>
    </ul>
<?php endif; ?>