<?php include 'header.php'; ?>
<?php include 'Topbar.php'; ?>
<div class="am-text-sm am-padding-top" id="container">
    <?php include $file; ?>
</div>
<!--请勿删除页脚这部分代码，否则会导致程序异常-->
<footer class="my-footer pescms-footer-<?= $system['notice_way'] ?>">
    <small>© Copyright 2015-<?= date('Y') ?>. Power by <a href="https://www.pescms.com" target="_blank">PESCMS TEAM</a>
    </small>
</footer>
<!--请勿删除页脚这部分代码，否则会导致程序异常-->
<?php include 'footer.php'; ?>

