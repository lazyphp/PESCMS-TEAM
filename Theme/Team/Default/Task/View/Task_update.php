<form action="<?= $label->url('Team-Task-action'); ?>" class="am-form am-margin-bottom-sm" method="POST">
    <?= $label->token(); ?>
    <input type="hidden" name="method" value="PUT"/>
    <input type="hidden" name="id" value="<?= $task_id; ?>">
    <input type="hidden" name="back_url" value="<?= base64_encode($_SERVER['REQUEST_URI']); ?>">

    <div class="am-block am-hide task-edit">
        <label class="am-block ">更改任务标题:</label>
        <input type="text" name="title" class=" am-margin-bottom-sm" value="<?= $task_title; ?>">

        <label class="am-block">更改任务优先度:</label>
        <select name="priority" class="am-margin-bottom-sm">
            <?php foreach ($taskPriority as $priority): ?>
                <option value="<?= $priority['priority_id'] ?>" <?= $task_priority == $priority['priority_id'] ? 'selected="selected"' : '' ?>><?= $priority['priority_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label class="am-block ">更改任务所属项目:</label>
        <select name="project_id" class="am-margin-bottom-sm">
            <?php foreach ($project as $projectValue): ?>
                <option value="<?= $projectValue['project_id'] ?>" <?= $task_project_id == $projectValue['project_id'] ? 'selected="selected"' : '' ?>><?= $projectValue['project_title'] ?></option>
            <?php endforeach; ?>
        </select>

        <div class="am-block">
            <div class="am-inline-block">
                <div class="am-form-group">
                    <label class="am-block">计划开始时间<i class="am-text-danger">*</i></label>
                    <input name="start_time" type="text" class="datetimepicker am-text-left" value="<?= date('Y-m-d H:i', $task_start_time); ?>" readonly required/>
                </div>
            </div>

            <div class="am-inline-block">
                <div class="am-form-group">
                    <label class="am-block">计划完成时间<i class="am-text-danger">*</i></label>
                    <input name="end_time" type="text" class="datetimepicker am-text-left" value="<?= date('Y-m-d H:i', $task_end_time); ?>" readonly required/>
                </div>
            </div>
        </div>

        <div class="am-block">
            <div class="am-inline-block">
                <div class="am-form-group">
                    <label class="am-block">阅读权限<i class="am-text-danger">*</i></label>
                    <label class="form-radio-label am-radio-inline">
                        <input class="form-radio" type="radio" name="read_permission" value="0" required="" <?= $task_read_permission == '0' ? 'checked="checked"' : ''; ?>><span> 关闭</span>
                    </label>
                    <label class="form-radio-label am-radio-inline">
                        <input class="form-radio" type="radio" name="read_permission" value="1" required="" <?= $task_read_permission == '1' ? 'checked="checked"' : ''; ?>><span> 开启</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="am-block">
            <div class="am-inline-block">
                <div class="am-form-group">
                    <label class="am-block">是否发送邮件<i class="am-text-danger">*</i></label>
                    <label class="form-radio-label am-radio-inline">
                        <input class="form-radio" type="radio" name="mail" value="0" required="" <?= $task_mail == '0' ? 'checked="checked"' : ''; ?>><span> 否</span>
                    </label>
                    <label class="form-radio-label am-radio-inline">
                        <input class="form-radio" type="radio" name="mail" value="1" required="" <?= $task_mail == '1' ? 'checked="checked"' : ''; ?>><span> 是</span>
                    </label>
                </div>
            </div>
        </div>


        <div class="am-article-bd">
            <script type="text/plain" id="task-edit" style="height:250px;"><?= htmlspecialchars_decode($task_content) ?></script>
            <button type="submit" class="am-btn am-btn-danger am-btn-xs am-margin-top am-margin-bottom-xs">
                <i class="am-icon-support"></i> 更新任务
            </button>
        </div>
    </div>


</form>
