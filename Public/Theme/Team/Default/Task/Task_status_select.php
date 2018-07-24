<div class="am-dropdown am-inline-block pes-dropdown" data-am-dropdown>
    <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle style="color: <?= $statusMark[$task['task_status']]['task_status_color'] ?>">
        <span class="<?= $statusMark[$task['task_status']]['task_status_icon'] ?> status-icon"></span> <?= $statusMark[$task['task_status']]['task_status_name'] ?>
        <?php if (!in_array($task['task_status'], ['3']) && ($auth['action'] === TRUE || $auth['check'] === TRUE) ): ?>
            <span class="am-icon-caret-down"></span>
        <?php endif; ?>
    </a>
    <?php if (!in_array($task['task_status'], ['3']) && ($auth['action'] === TRUE || $auth['check'] === TRUE) ): ?>
        <ul class="am-dropdown-content">
            <?php foreach ($statusMark as $status): ?>
                <?php
                //审核人员并且不属于本任务的执行者，没法将任务切换为未进行状态
                if ($auth['check'] == TRUE && $auth['action'] == FALSE && $status['task_status_type'] == '0') {
                    continue;
                }

                //不为审核人，没有任务完成和关闭功能
                if ($auth['check'] == FALSE && (in_array($status['task_status_type'], ['3', '10']))) {
                    continue;
                }


                ?>
                <?php $disabled = (($status['task_status_type'] == $task['task_status']) || ($task['task_status'] == '0' && $status['task_status_type'] > 1 && $auth['check'] == FALSE)) ? 'am-disabled' : ''; ?>
                <li class="<?= $disabled ?>" status="<?= $status['task_status_type']; ?>">
                    <a class="ajax-click ajax-dialog <?= $disabled ?>" msg="确定要更改任务的状态吗？" href="<?= $this->url('Team-Task-status', ['task_id' => $task['task_id'], 'status' => $status['task_status_type'], 'method' => 'PUT', 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]); ?>"><i class="<?= $status['task_status_icon']; ?>"></i> <?= $status['task_status_name']; ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
