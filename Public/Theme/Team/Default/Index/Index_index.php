<ul class="am-avg-sm-5 am-avg-md-5 am-margin-sm am-padding-vertical-xs am-text-center admin-content-list ">
    <li>
        <a href="<?= $label->url('Team-Task-my', ['status' => '233']); ?>" class="am-link-muted"><span class="am-icon-btn am-icon-tags"></span><br/>我的任务<br/><?= $statistics['total']; ?>
        </a>
    </li>
    <li>
        <a href="<?= $label->url('Team-Task-my', ['status' => '233', 'time_type' => 1, 'begin' => date('Y-m-d'), 'end' => date('Y-m-d')]); ?>" class="am-text-primary"><span class="am-icon-btn am-icon-calendar-plus-o"></span><br/>今天任务<br/><?= $statistics['today']; ?>
        </a>
    </li>
    <li>
        <a href="<?= $label->url('Team-Task-my', ['status' => '233', 'time_type' => 1, 'begin' => date('Y-m-d', strtotime("-1 day")), 'end' => date('Y-m-d', strtotime("-1 day"))]); ?>" class="am-text-danger"><span class="am-icon-btn am-icon-calendar-times-o"></span><br/>昨天任务<br/><?= $statistics['yesterday']; ?>
        </a>
    </li>
    <li>
        <a href="<?= $label->url('Team-Task-my', ['status' => '666']); ?>" class="am-text-warning"><span class="am-icon-btn am-icon-close"></span><br/>逾期任务<br/><?= $statistics['overdue']; ?>
        </a>
    </li>
    <li>
        <a href="<?= $label->url('Team-Task-my', ['status' => '3']); ?>" class="am-text-success"><span class="am-icon-btn am-icon-check"></span><br/>完成率<br/><?= $statistics['total'] == 0 ? '-' : round($statistics['complete'] / $statistics['total'] * 100, 2); ?>%
        </a>
    </li>
</ul>

<div class="am-g am-margin-bottom-xl">

    <div class="am-u-md-9">
        <?php foreach($tasks as $name => $list): ?>
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd"><?= $name ?></div>
                <table class="am-table am-table-striped am-table-hover">
                    <?php if(!empty($list)): ?>
                        <?php foreach($list as $key => $value): ?>
                            <tr>
                                <td class="">
                                    <div class="admin-task-meta">
                                        [<?= $label->getStatusSelect($statusMark, $value); ?>]
                                        <span class="am-badge am-radius" style="background-color: <?= $taskPriority[$value['task_priority']]['priority_color'] ?>"><?= $taskPriority[$value['task_priority']]['priority_name'] ?></span>
                                        <a href="<?= $label->url('Team-Task-view', ['id' => $value['task_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>">#<?= $value['task_id'] ?> <?= $value['task_title'] ?></a> [<?= $label->findContent('project', 'project_id', $value['task_project_id'])['project_title']; ?>]

                                        <span class="am-badge am-round <?= $value['task_end_time'] < time() && $value['task_status'] < 2 ? 'am-badge-warning' : '' ?>" title="计划完成时间：<?= date('Y-m-d H:i', $value['task_end_time']) ?>"><i class="am-icon-calendar"></i> <?= date('Y.m.d', $value['task_end_time']) ?>
                                        </span>

                                        <?php if($value['task_end_time'] < time() && $value['task_status'] < 2): ?>
                                            <span class="am-badge am-round am-badge-danger"><i class="am-icon-exclamation"></i> 已逾期 <?= floor((time() - $value['task_end_time'])/ 86400) ?>天</span>
                                        <?php endif; ?>

                                    </div>
                                    <div class="admin-task-bd">

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td>暂时没有任务需要处理。</td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="am-u-md-3 am-padding-horizontal-sm">

        <?php include __DIR__.'/Index_abar.php'; ?>

        <div class="calendar am-margin-bottom"></div>
        <script>
            $(function () {
                $('.calendar').datetimepicker({
                    minView: 2,
                    language: 'zh-CN',
                    todayBtn: true
                });

                $('.calendar').datetimepicker().on('changeDate', function (ev) {
                    var date = new Date(ev.date.valueOf());
                    var Y = date.getFullYear() + '-';
                    var M = (date.getMonth() + 1) + '-';
                    var D = date.getDate();
                    var url = '/?g=Team&m=Task&a=my&status=233&time_type=1&begin=' + Y + M + D + '&end=' + Y + M + D;
                    window.location.href = url;
                });
            })
        </script>

        <?php include THEME_PATH . '/Task/Sidebar/Task_bulletin.php' ?>
    </div>


</div>