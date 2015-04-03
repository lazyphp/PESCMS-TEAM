<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>列表</small></div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="<?= $label->url('Team-' . MODULE . '-action'); ?>" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-input-group am-input-group-sm">
                <input type="text" class="am-form-field">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="button">搜索</button>
                </span>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody>
                    <?php foreach ($list as $key => $value) : ?>
                        <tr>
                            <td class="table-id">#<?= $value["task_id"]; ?></td>
                            <td class="table-title am-text-center">
                                <a href="<?= $label->url('Team-Project-task', array('id' => $value['project_id'])) ?>">[项目]</a>
                                <a href="<?= $label->url('Team-Task-view', array('id' => $value['task_id'])) ?>" style="color:#333"><?= $value["task_title"]; ?></a>
                            </td>
                            <td class="table-id"><?= $label->taskPriority($value['task_priority']); ?></td>
                            <td class="table-title">
                                <img src="<?= $label->findUser($value["task_create_id"])['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;"/>
                                <a href="">&nbsp;<?= $label->findUser($value["task_create_id"])['user_name']; ?></a>
                                <span>指派给</span>
                                <img src="<?= $_SESSION['team']['user_head']; ?>" class="am-comment-avatar" style="width: 20px;height: 20px;float: none"/>
                                <a href=""><?= $_SESSION['team']['user_name']; ?></a>
                            </td>
                            <td>
                                创建于：<?= date('Y-m-d', $value['task_createtime']); ?>
                                期望完成时间:<?= date('Y-m-d', $value['task_expecttime']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- content end -->