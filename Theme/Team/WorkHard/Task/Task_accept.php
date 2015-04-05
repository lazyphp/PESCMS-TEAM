<?php if ($_SESSION['team']['user_department_id'] == $task_department_id && in_array($_SESSION['team']['user_id'], $checkers) && $task_accept_id == '0' && empty($task_user_id)): //只要当前用户的部门属性和任务指派部门一致，且在于审核人列表，那么他必定是部门的负责人!
    ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <form action="" class="am-form am-form-inline">
            <div class="am-form-group am-u-md-3">
                <select>
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