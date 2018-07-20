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
            <?php include 'Index/Task_index_topbar.php' ?>
            <?php include THEME_PATH . '/Task/Index/Task_index_list.php'; ?>
        </div>
    </div>
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>