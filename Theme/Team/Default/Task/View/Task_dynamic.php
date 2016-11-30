<?php /*任务动态*/ ?>
<div class="am-margin-bottom">
    <h4 class="task-active-subtitle am-inline-block">任务动态</h4>
    <hr class="am-margin-0 task-hr"/>
    <?php if (empty($dynamice)): ?>
        <p>任务执行者(们)很懒，即使到今天了也没发表过任何动态。</p>
    <?php else: ?>
        <?php foreach ($dynamice as $dynamiceDescription): ?>
            <p>
                <img
                    src="<?= $label->findContent('user', 'user_id', $dynamiceDescription['task_dynamic_user_id'])['user_head']; ?>"
                    class="am-comment-avatar" style="width: 20px;height: 20px;"/>
                <?= $label->findContent('user', 'user_id', $dynamiceDescription['task_dynamic_user_id'])['user_name'] . ':'; ?>
            </p>
            <?= htmlspecialchars_decode($dynamiceDescription['task_dynamic_content']) ?>
            <p class="am-margin-bottom-xs">
                <i class="am-icon-calendar"></i> <?= date('Y/m/d H:i', $dynamiceDescription['task_dynamic_createtime']) ?>
            </p>
            <hr class="am-margin-0 am-divider am-divider-dashed">
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($actionAuth['action'] == true && ($task_status == 1)): ?>
        <form action="<?= $label->url('Team-Task_dynamic-action'); ?>" method="POST" class="am-margin-top-sm">
            <?= $label->token(); ?>
            <input type="hidden" name="task_id" value="<?= $task_id; ?>"/>
            <input type="hidden" name="back_url" value="<?= base64_encode($_SERVER['REQUEST_URI']); ?>">

            <div class="am-form-group am-hide task-taskdynamic">
                <label class="am-block">发表动态</label>
                <script type="text/plain" id="dynamic" style="height:250px;"></script>
                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert="">
                    <i class="am-icon-lightbulb-o"></i> 您发表的动态内容，将会成为当天的任务日志。
                </div>
            </div>
            <button type="submit" class="am-btn am-btn-warning am-btn-xs task-append-button" data="task-taskdynamic">
                <i class="am-icon-hand-pointer-o"></i> 添加动态
            </button>
        </form>
    <?php endif; ?>
</div>
