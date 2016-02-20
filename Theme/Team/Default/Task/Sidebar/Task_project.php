<div class="admin-sidebar-panel am-panel am-panel-default">
    <div class="am-panel-hd"><?= $project_title; ?></div>
    <div class="am-panel-bd">
        <?= empty($project_content) ? '当前项目并没有描述;' : htmlspecialchars_decode($project_content); ?>
    </div>
</div>