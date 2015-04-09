<div class="am-g">
    <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'])); ?>" class="am-btn am-btn-default <?= $_GET['type'] < '0' && empty($_GET['user_type']) ? 'am-active' : ''; ?> "><span class="am-icon-arrows-alt"></span> 所有</a>
                <?php if (ACTION == 'check'): ?>
                    <a href="<?= $label->url('Team-Task-' . ACTION, array('user_type' => '1')); ?>" class="am-btn am-btn-default <?= $_GET['user_type'] == '1' ? 'am-active' : ''; ?>"><span class="am-icon-fast-forward"></span> 未指派</a>
                <?php endif; ?>
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'], 'type' => '0')); ?>" class="am-btn am-btn-default <?= $_GET['type'] == '0' ? 'am-active' : ''; ?>"><span class="am-icon-eject"></span> 未进行</a>
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'], 'type' => '1')); ?>" class="am-btn am-btn-default <?= $_GET['type'] == '1' ? 'am-active' : ''; ?>"><span class="am-icon-play"></span> 进行中</a>
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'], 'type' => '2')); ?>" class="am-btn am-btn-default <?= $_GET['type'] == '2' ? 'am-active' : ''; ?>"><span class="am-icon-compress"></span> 审核</a>
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'], 'type' => '3')); ?>" class="am-btn am-btn-default <?= $_GET['type'] == '3' ? 'am-active' : ''; ?>"><span class="am-icon-pause"></span> 调整</a>
                <a href="<?= $label->url('Team-Task-' . ACTION, array('project' => $_GET['project'], 'department' => $_GET['department'], 'user' => $_GET['user'], 'type' => '4')); ?>" class="am-btn am-btn-default <?= $_GET['type'] == '4' ? 'am-active' : ''; ?>"><span class="am-icon-stop"></span> 完成</a>
            </div>
        </div>
    </div>
    <div class="am-u-sm-12 am-u-md-3">
        <form action="/" method="GET">
            <div class="am-input-group am-input-group-sm">
                <input type="hidden" name="g" value="Team" />
                <input type="hidden" name="m" value="Task" />
                <input type="hidden" name="a" value="<?= ACTION ?>" />
                <input type="hidden" name="project" value="<?= $_GET['project'] ?>" />
                <input type="hidden" name="department" value="<?= $_GET['department'] ?>" />
                <input type="hidden" name="user" value="<?= $_GET['user'] ?>" />
                <input type="hidden" name="type" value="<?= $_GET['type'] ?>" />
                <input type="text" name="search" value="<?= $_GET['search']; ?>" class="am-form-field">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="submit">搜索</button>
                </span>
            </div>
        </form>
    </div>
</div>