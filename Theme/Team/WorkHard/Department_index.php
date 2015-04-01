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
            <form class="am-form" action="<?= $label->url('Team-' . MODULE . '-listsort'); ?>" method="POST">
                <input type="hidden" name="method" value="PUT" />
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-sort">排序</th>
                            <th class="table-id">ID</th>
                            <th class="table-title">部门名称</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $value) : ?>
                            <tr>
                                <td>
                                    <input type="text" name="id[<?= $value['department_id']; ?>]" value="<?= $value['department_listsort']; ?>" >
                                </td>
                                <td><?= $value["department_id"]; ?></td>
                                <td><?= $value["department_name"]; ?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-secondary" href="<?= $label->url('Team-department-action', array('id' => $value["department_id"])); ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <a class="am-btn am-btn-danger" href="<?= $label->url('Admin-department-action', array('id' => $value["department_id"], 'method' => 'DELETE')); ?>"><span class="am-icon-trash-o"></span> 删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="am-margin">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs">排序</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- content end -->