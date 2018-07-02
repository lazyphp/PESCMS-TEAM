<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <div class="am-panel am-panel-default admin-sidebar-panel am-margin-top-0">
                <div class="am-panel-hd"><i class="<?= $title_icon; ?>"></i> <?= $title; ?></div>
            </div>
            <?php foreach ($sidebar as $sidebarName): ?>
                <?php include $sidebarTool[$sidebarName]; ?>
            <?php endforeach; ?>

        </div>
    </div>
    <!-- sidebar end -->

    <!-- content start -->
    <div class="admin-content">
        <div class="am-padding-xs">
            <?php if (empty($list)): ?>
                <div class="am-alert am-alert-secondary am-margin-top am-margin-bottom am-text-center" data-am-alert>
                    <p>本页面没有数据 :-(</p>
                </div>
            <?php else: ?>
                <table class="am-table am-table-striped am-table-hover am-text-sm am-table-centered">
                    <tr>
                        <th>任务标题</th>
                        <th>重复周期</th>
                    </tr>
                    <?php foreach ($list as $key => $value): ?>
                        <tr>
                            <td>
                                <a href="<?= $label->url('Team-Task-view', ['id' => $value['task_id']]); ?>"><?= $value['task_title']; ?></a>
                            </td>
                            <td><?= $value['task_repeat']; ?>天</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- content end -->
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>