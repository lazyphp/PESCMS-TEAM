<?php include 'header.php'; ?>
<?php include 'Topbar.php'; ?>
<div class="am-text-sm am-padding-top" id="pjax-container">
    <?php include $file; ?>
</div>
<footer class="my-footer pescms-footer-<?= $system['notice_way'] ?>">
    <small>© Copyright 2015-<?= date('Y') ?>. Power by <a href="//www.pescms.com" target="_blank">PESCMS TEAM</a>
    </small>
    </p>
</footer>
<?php include 'footer.php'; ?>
