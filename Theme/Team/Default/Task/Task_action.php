<div class="admin-content am-padding am-padding-top-0 am-padding-bottom-0">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">新任务</strong>
        </div>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
<form action="<?= $label->url('Team-Task-action'); ?>" class="am-form ajax-submit am-margin-bottom" method="POST" data-am-validator>
    <?= $label->token(); ?>
    <?php include THEME_PATH . '/Task/Action/Task_action_form.php'; ?>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <button type="submit" class="am-btn am-btn-success">发布任务</button>
        </div>
    </div>
</form>