        <!--[if lt IE 9]>
        <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
        <script src="/Theme/Team/WorkHard/assets/js/polyfill/rem.min.js"></script>
        <script src="/Theme/Team/WorkHard/assets/js/polyfill/respond.min.js"></script>
        <script src="/Theme/Team/WorkHard/assets/js/amazeui.legacy.js"></script>
        <![endif]-->
    <?php if(MODULE != 'Index' && ACTION != 'index'): ?>
        <a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

        <footer>
            <hr>
            <p class="am-padding-left">© 2014 - <?= date('Y'); ?> PESCMS为本程序强力驱动</p>
        </footer>
    <?php endif; ?>
    </body>
</html>
