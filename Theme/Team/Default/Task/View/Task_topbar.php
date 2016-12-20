<?php /*任务顶栏*/ ?>
<div class="am-margin-bottom-xs">
    <a href="<?= !empty($_GET['back_url']) ? base64_decode($_GET['back_url']) : $label->url('Team-Task-my') ?>" class="am-margin-right-xs am-text-danger"><i
            class="am-icon-reply"></i>返回</a>
    <?= $label->getStatusSelect($statusMark, ['task_id' => $task_id, 'task_status' => $task_status]); ?>

        <span class="<?= $task_end_time < time() && $task_status < 2 ? 'am-text-danger' : '' ?>"><i
                class="am-icon-calendar fixed-hidden-margin-left"></i> <?= date('Y/m/d H:i', $task_start_time) ?>
            至 <?= date('Y/m/d H:i', $task_end_time); ?></span>

<!--    <span class="am-badge" style="background-color:--><?//= $statusMark[$task_status]['task_status_color'] ?><!--"><i class="--><?//= $statusMark[$task_status]['task_status_icon'] ?><!--"></i> --><?//= $statusMark[$task_status]['task_status_name'] ?><!--</span>-->
</div>
<hr class="am-margin-0 task-hr"/>
