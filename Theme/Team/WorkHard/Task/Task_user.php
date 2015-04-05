<?php if ($_SESSION['team']['user_id'] == $task_user_id): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <?php if ($task_status == '0'): ?>
            <!--选择任务开始状态-->
            <form action="<?= $label->url('Team-Task-begin'); ?>" class="am-form am-form-inline" method="POST">
                <input type="hidden" name="method" value="PUT" />
                <input type="hidden" name="task_id" value="<?= $task_id ?>" />
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-calendar"></i>
                    <input type="text" name="task_estimatetime" class="am-form-field datetimepicker" placeholder="预计完成日期">
                </div>
                <button type="submit" class="am-btn am-btn-primary">执行任务</button>
            </form>
            <!--选择任务开始状态-->
        <?php elseif ($task_status == '1' || $task_status == '3'): ?>
            <!--填写任务日志和提交审核-->
            <form action="<?= $label->url('Team-Task-diary'); ?>" class="am-form am-form-horizontal" method="POST" id="form-diary-check">
                <input type="hidden" name="method" value="PUT" />
                <input type="hidden" name="task_id" value="<?= $task_id ?>" />
                <article class="am-comment">
                    <a href="javascript:;" >
                        <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" alt="" class="am-comment-avatar am-margin-top" width="48" height="48"/>
                    </a>

                    <div class="am-comment-bd">
                        <!--编辑器的JS代码存放于Task_view.php-->
                        <script type="text/plain" id="content" style="height:240px;"></script>
                        <!--编辑器的JS代码存放于Task_view.php-->
                        <div class="gradient-bg">
                            <button type="submit" class="am-btn am-btn-primary" id="submit-diary">发表日志</button><button class="am-btn am-btn-warning" type="submit" id="submit-check" >提交审核</button>
                        </div>
                    </div>
                </article>
            </form>
            <style>
                .edui-container{
                    border:none !important;
                    box-shadow:none !important;
                    border-top: 1px solid #d4d4d4 !important;
                    border-left: 1px solid #d4d4d4 !important;
                    border-right: 1px solid #d4d4d4 !important;
                    /*border-bottom: 0px solid #d4d4d4 !important;*/
                }
                .gradient-bg{
                    background-color: #f8f8f8;
                    border: 1px solid #d4d4d4;
                }
            </style>
            <!--填写任务日志和提交审核-->
        <?php endif; ?>
        <hr/>
    </div>
    <script>
        $(function () {
            $("#submit-diary, #submit-check").on("click", function () {
                if ($(this).attr("id") == 'submit-check') {
                    $("#form-diary-check").attr("action", "<?= $label->url('Team-Task-check'); ?>");
                } else {
                    $("#form-diary-check").attr("action", "<?= $label->url('Team-Task-diary'); ?>");
                }
            })
        })
    </script>
<?php endif; ?>