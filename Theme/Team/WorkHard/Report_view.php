<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg">报表详情</strong> / <small>View Report</small>
        </div>
    </div>

    <hr/>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <h2>
                <?= $report_date; ?>工作报表详情
            </h2>
            <hr/>
        </div>
        <!--任务内容-->
        <div class="am-u-sm-12 am-u-sm-centered">
            <?php if (!empty($list)): ?>
                <ol class="am-list-static ">
                    <?php foreach ($list as $key => $value) : ?>
                        <li>
                            <?php if (!empty($value['task_id'])): ?>
                                报表来自任务《<a href="<?= $label->url('Team-Task-view', array('id' => $value['task_id'])); ?>"><?= $value['task_title']; ?></a>》日志 <?= $label->taskStatus($value['task_status']); ?>:
                            <?php endif; ?>
                            <?= htmlspecialchars_decode($value['report_content']); ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>

            <hr/>
        </div>

    </div>
</div>