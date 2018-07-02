<div class="am-panel am-panel-default <?= MODULE == 'Index' ? '' : 'admin-sidebar-panel' ?>">
    <div class="am-panel-hd">公告栏</div>
    <ul class="am-list am-list-static">
        <?php if (!empty($bulletin)): ?>
            <?php foreach ($bulletin as $value): ?>
                <li>
                    <a href="<?= $label->url('Team-Bulletin-view', ['id' => $value['bulletin_id']]); ?>" class="am-padding-0 bulletin"><?= $value['bulletin_title']; ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>
                目前没有最新公告
            </li>
        <?php endif; ?>
    </ul>
</div>
<!--bulletin-->
<script>
    $(function () {
        $('.bulletin').on('click', function () {
            var href = $(this).attr('href');
            var progress = $.AMUI.progress;
            progress.start();
            $.get(href, function (data) {
                $('.bulletin-content').html(data)
                $('#bulletin').offCanvas('open');
                progress.done();
            });
            return false;
        });
    });
</script>
<!--bulletin-->