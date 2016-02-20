<?php if(!in_array(ACTION, ['check', 'department']) && MODULE == 'Task'): ?>
<div class="am-btn-group am-btn-group-xs am-margin-bottom">
    <a class="am-btn am-btn-default <?= $_GET['status'] == 233 ? 'am-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => '233','id' => $_GET['id']]) ?>" class="am-link-muted"><i class="am-icon-arrows-alt"></i> 所有</a>
    <?php foreach ($statusMark as $key => $value): ?>
        <a class="am-btn am-btn-default <?= $_GET['status'] == $key ? 'am-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => $key, 'id' => $_GET['id']]) ?>"
           style="color: <?= $value['task_status_color'] ?>"><i
                class="<?= $value['task_status_icon'] ?>"></i> <?= $value['task_status_name'] ?></a>
    <?php endforeach; ?>

    <a class="am-btn am-btn-default <?= $_GET['status'] == 666 ? 'am-active' : '' ?>" href="<?= $label->url(GROUP . '-' . MODULE . '-' . ACTION, ['status' => '666', 'id' => $_GET['id']]) ?>" class="am-text-warning"><i class="am-icon-warning"></i> 逾期</a>
</div>
<?php endif;?>