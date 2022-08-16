<?php include THEME_PATH.'/header.php' ?>
<div class="login-body">

    <h1><?= $title ?? $system['siteTitle'] ?></h1>

    <div class="login-panel">
        <?php include $file?>
    </div>
    <div class="login-site-title am-vertical-align">
        <div class="am-vertical-align-middle am-text-xl">
        <?= $system['siteTitle'] ?>
        </div>
    </div>
</div>
<?php include THEME_PATH.'/footer.php' ?>
