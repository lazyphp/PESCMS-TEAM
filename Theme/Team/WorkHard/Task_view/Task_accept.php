<?php
/**
 * 1.先判断是否当前帐号的部门。
 * 2.判断当前帐号是否部门负责人。
 * 3.判断执行者ID为空，或者执行者ID为当前帐号。
 * 依据上述三点，对于跨部门的任务，部门负责人可以进行指派。
 * 而同部门的人员指派，若接收任务的为负责人，那么他有权再进行指派细分。
 */
if ($_SESSION['team']['user_department_id'] == $task_department_id && in_array($_SESSION['team']['user_id'], explode(',', $label->findDepartment('department', 'department_id', $task_department_id)['department_header'])) && (empty($task_user_id) || $task_user_id == $_SESSION['team']['user_id']) && $task_status == '0' ):
    ?>
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
        <hr />
    </div>
<?php endif; ?>