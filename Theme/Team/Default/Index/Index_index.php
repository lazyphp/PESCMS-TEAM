<div class="admin-content">
    <div class="admin-content-body">
        <ul class="am-avg-sm-1 am-avg-md-5 am-margin am-padding am-text-center admin-content-list ">
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

        <div class="am-g">
            <div class="am-u-md-4">
                <?php include THEME_PATH . '/Task/Sidebar/Task_bulletin.php' ?>
            </div>
            <div class="am-u-md-4">
                <?php include THEME_PATH . '/Task/Sidebar/Task_aging_gap_figure.php' ?>
            </div>
            <div class="am-u-md-4">
                <div class="calendar"></div>
                <script>
                    $(function () {
                        $('.calendar').datetimepicker({
                            minView: 2
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
            </div>

        </div>

    </div>
</div>
