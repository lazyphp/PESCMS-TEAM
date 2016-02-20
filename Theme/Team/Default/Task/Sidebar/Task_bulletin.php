<div class="admin-sidebar-panel am-panel am-panel-default">
    <div class="am-panel-hd">公告栏</div>
    <ul class="am-list am-list-static">
        <?php foreach ($bulletin as $value): ?>
            <li>
                <a href="<?= $label->url('Team-Bulletin-view', ['id' => $value['bulletin_id']]); ?>" class="am-padding-0 bulletin"><?= $value['bulletin_title']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>