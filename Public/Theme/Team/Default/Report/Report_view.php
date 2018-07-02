<div class="admin-content am-padding am-padding-top-0">

    <div class="am-cf">
        <div class="am-fl am-cf">
            <?php if (!empty($_GET['back_url'])): ?>
                <a href="<?= base64_decode($_GET['back_url']) ?>" class="am-margin-right-xs am-text-danger"><i
                        class="am-icon-reply"></i>返回</a>
            <?php endif; ?>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <?php foreach ($list as $key => $value): ?>
        <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
        <article class="am-article am-margin-top-sm">
            <div class="am-article-bd">
                <?= htmlspecialchars_decode($value['report_content']); ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
