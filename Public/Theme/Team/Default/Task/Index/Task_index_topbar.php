<?php if(!in_array(ACTION, ['check', 'department']) && MODULE == 'Task'): ?>
<div class="am-btn-group am-btn-group-xs am-margin-bottom">
    <a class="am-btn am-btn-default am-radius <?= isset($_GET['status']) && $_GET['status'] == 233 ? 'task-index-status-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => '233','id' => $label->xss((int) ($_GET['id'] ?? null))]) ?>" class="am-link-muted"><i class="am-icon-arrows-alt"></i> 所有</a>
    <?php foreach ($statusMark as $key => $value): ?>
        <a class="am-btn am-btn-default am-radius <?= isset($_GET['status']) && $_GET['status'] == $key ? 'task-index-status-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => $key, 'id' => $label->xss((int) ($_GET['id'] ?? null))]) ?>"
           style="color: <?= $value['task_status_color'] ?>"><i
                class="<?= $value['task_status_icon'] ?>"></i> <?= $value['task_status_name'] ?></a>
    <?php endforeach; ?>

    <a class="am-btn am-btn-default am-radius <?= $_GET['status'] == 666 ? 'task-index-status-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => '666', 'id' => $label->xss((int) ($_GET['id'] ?? null))]) ?>" class="am-text-warning"><i class="am-icon-warning"></i> 逾期</a>
</div>
<?php endif;?>