<?php if ($_SESSION['team']['user_id'] == $task_user_id): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <?php if ($task_status == '0'): ?>
            <!--选择任务开始状态-->
            <form action="" class="am-form am-form-inline">
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-calendar"></i>
                    <input type="text" class="am-form-field datetimepicker" placeholder="日期">
                </div>
                <button type="submit" class="am-btn am-btn-primary">执行任务</button>
            </form>
            <!--选择任务开始状态-->
        <?php elseif ($task_status == '1' || $task_status == '4'): ?>
            <!--填写任务日志-->
            <form class="am-form am-form-horizontal">
                <article class="am-comment">
                    <a href="javascript:;" >
                        <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" alt="" class="am-comment-avatar am-margin-top" width="48" height="48"/>
                    </a>

                    <div class="am-comment-bd">
                        <!--编辑器的JS代码存放于Task_view.php-->
                        <script type="text/plain" id="content" style="height:240px;"></script>
                        <!--编辑器的JS代码存放于Task_view.php-->
                        <div class="gradient-bg">
                            <button type="submit" class="am-btn am-btn-primary">发表日志</button><a class="am-btn am-btn-warning">提交审核</a>
                        </div>
                    </div>
                </article>
            </form>
            <!--填写任务日志-->
        <?php endif; ?>
        <hr/>
    </div>
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
<?php endif; ?>