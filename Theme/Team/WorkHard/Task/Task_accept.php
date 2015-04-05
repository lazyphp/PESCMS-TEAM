<?php if ($_SESSION['team']['user_department_id'] == $task_department_id && in_array($_SESSION['team']['user_id'], explode(',', $label->findDepartment('department', 'department_id', $task_department_id)['department_header'])) && $task_accept_id == '0' && empty($task_user_id)): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <form action="<?= $label->url('Team-Task-accept'); ?>" class="am-form am-form-inline" method="POST">
            <input type="hidden" name="method" value="PUT" />
            <input type="hidden" name="task_id" value="<?= $task_id ?>" />
            <div class="am-form-group am-u-md-3">
                <select name="task_user_id">
                    <option value="">请选择执行任务的人</option>
                    <?php foreach ($user as $key => $value) : ?>
                        <?php if ($value['user_department_id'] == $task_department_id): ?>
                            <option value="<?= $value['user_id']; ?>"><?= $value['user_name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="am-btn am-btn-primary">指派任务</button>
        </form>
    </div>
<?php endif; ?>