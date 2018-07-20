<?php if ($actionAuth['department'] === true): ?>
    <div class="am-margin-bottom">
        <h4 class="task-active-subtitle am-inline-block">指派部门成员</h4>
        <hr class="am-margin-0 task-hr"/>
        <form action="<?= $label->url('Team-Task-department'); ?>" class="am-form" method="POST">
            <?= $label->token(); ?>
            <input type="hidden" name="method" value="PUT"/>
            <input type="hidden" name="task_id" value="<?= $task_id ?>"/>
            <input type="hidden" name="back_url" value="<?= base64_encode($_SERVER['REQUEST_URI']); ?>">

            <div class="am-margin-bottom"></div>
            <div class="am-form-group department-user am-hide">
                <select name="user[]" multiple style="background:none">
                    <?php foreach ($user['department'] as $key => $value): ?>
                        <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="am-btn am-radius am-btn-success am-btn-xs task-append-button" data="department-user">
                <i class="am-icon-plus"></i> 进行指派
            </button>
        </form>
    </div>
<?php endif; ?>