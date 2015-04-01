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
                <thead>
                    <tr>
                        <th class="table-id">ID</th>
                        <th class="table-title">帐号名称</th>
                        <th class="table-title">邮箱地址</th>
                        <th class="table-type">姓名</th>
                        <th class="table-set">所属部门</th>
                        <th class="table-set">用户组</th>
                        <th class="table-set">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value) : ?>
                        <tr>
                            <td><?= $value["user_id"]; ?></td>
                            <td><?= $value["user_account"]; ?></td>
                            <td><?= $value["user_mail"]; ?></td>
                            <td><?= $value["user_name"]; ?></td>
                            <td><?= $label->findGroup($value["user_department_id"]); ?></td>
                            <td><?= $label->findGroup($value["user_group_id"]); ?></td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-secondary" href="<?= $label->url('Team-User-action', array('id' => $value["user_id"])); ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                        <a class="am-btn am-btn-danger" href="<?= $label->url('Admin-User-action', array('id' => $value["user_id"], 'method' => 'DELETE')); ?>"><span class="am-icon-trash-o"></span> 删除</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- content end -->