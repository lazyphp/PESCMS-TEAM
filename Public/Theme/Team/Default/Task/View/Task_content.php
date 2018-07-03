<?php /*任务内容*/ ?>
<article class="am-article am-margin-top-sm">
    <div class="am-article-bd task-edit-display">
        <?php if (empty($task_content)): ?>
            <p>发起者那家伙很懒，什么详细说明都没留下。或许是一个快捷创建的任务吧。</p>
        <?php else: ?>
            <?= htmlspecialchars_decode($task_content) ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($supplement)): ?>
        <div class="am-article-bd">
            <?php foreach ($supplement as $supplementContent): ?>
                <hr class="am-divider am-divider-dashed am-margin-0">
                <div class="task-date am-text-center">
                    <span class="task-date-align ">
                        <?= $label->findContent('user', 'user_id', $supplementContent['task_supplement_user_id'])['user_name']; ?> 补充于 <?= date('Y/m/d H:i', $supplementContent['task_supplement_createtime']); ?>
                        <?php if ($this->session()->get('team')['user_id'] == $supplementContent['task_supplement_user_id'] && !in_array($task_status, ['3', '10']) ): ?>
                            <a href="<?= $label->url('Team-Task_supplement-action', ['id' => $supplementContent['task_supplement_id'], 'task_id' => $task_id, 'method' => 'DELETE', 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]); ?>" class="ajax-click ajax-dialog"><i class="am-icon-recycle"></i>移除</a>
                        <?php endif; ?>
                    </span>
                </div>
                <?= htmlspecialchars_decode($supplementContent['task_supplement_content']); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</article>