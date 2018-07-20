<?php /*任务内容追加*/ ?>
<?php if ($actionAuth['check'] == true && $task_status < 3): ?>
    <form action="<?= $label->url('Team-Task_supplement-action'); ?>" method="POST" class="am-margin-bottom">
        <?= $label->token(); ?>
        <input type="hidden" name="task_id" value="<?= $task_id; ?>"/>
        <input type="hidden" name="back_url" value="<?= base64_encode($_SERVER['REQUEST_URI']); ?>">

        <div class="am-form-group am-hide task-append-supplement">
            <label class="am-block">追加说明</label>
            <script type="text/plain" id="supplement" style="height:250px;"></script>
        </div>
        <button type="submit" class="am-btn am-radius am-btn-primary am-btn-xs task-append-button" data="task-append-supplement">
            <i class="am-icon-plus"></i> 追加说明
        </button>
    </form>
<?php endif; ?>

