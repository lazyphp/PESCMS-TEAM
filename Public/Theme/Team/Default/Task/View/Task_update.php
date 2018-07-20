<div class="am-block am-hide task-edit">
    <form action="<?= $label->url('Team-Task-action'); ?>" class="am-form am-margin-bottom-sm ajax-submit" method="POST">
        <?= $label->token(); ?>
        <input type="hidden" name="method" value="PUT"/>
        <input type="hidden" name="id" value="<?= $task_id; ?>">
        <input type="hidden" name="back_url" value="<?= base64_encode($_SERVER['REQUEST_URI']); ?>">
        <?php include THEME_PATH . '/Task/Action/Task_action_form.php'; ?>

        <div class="am-article-bd">
            <script type="text/plain" id="task-edit" style="height:250px;"><?= htmlspecialchars_decode($task_content) ?></script>
            <button type="submit" class="am-btn am-radius am-btn-danger am-btn-xs am-margin-top am-margin-bottom-xs">
                <i class="am-icon-support"></i> 更新任务
            </button>
        </div>

    </form>
</div>



