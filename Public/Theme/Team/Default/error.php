<?php include THEME_PATH . '/header.php'; ?>
<?php include THEME_PATH . '/Topbar.php'; ?>
<div class="am-g jump-page">
    <div class="am-u-sm-12 am-u-lg-8  am-u-lg-centered">
        <div >
            <h1><?= $title; ?></h1>
            <?php if (DEBUG == false): ?>
                <p class="am-text-center">
                    <?php echo $errorMsg; ?>
                    <?php echo $errorFile ?>
                </p>
            <?php else: ?>
                <pre class="am-pre-scrollable">
                    <?php if (!empty($errorSql)): ?>
                        <?= $errorSql; ?>
                        <?= $errorSqlString; ?>
                    <?php endif; ?>
                    <span class="am-block"><?= $errorMsg; ?></span>
                    <span class="am-block"><?= $errorFile ?></span>
                    </pre>
                <?php if (!empty($sql)): ?>
                    <textarea cols="68" class="am-text-default"><?= $sql ?></textarea>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!--请勿删除页脚这部分代码，否则会导致程序异常-->
<footer class="my-footer pescms-footer-<?= $system['notice_way'] ?>">
    <small>© Copyright 2015-<?= date('Y') ?>. Power by <a href="//www.pescms.com" target="_blank">PESCMS TEAM</a>
    </small>
</footer>
<?php include THEME_PATH . '/footer.php'; ?>
<!--请勿删除页脚这部分代码，否则会导致程序异常-->
