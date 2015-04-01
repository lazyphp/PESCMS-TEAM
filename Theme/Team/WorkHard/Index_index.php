<header class="am-topbar admin-header am-header-fixed">
    <div class="am-topbar-brand">
        <strong>PESCMS</strong> <small>任务系统</small>
    </div>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-hide-sm-only">
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="<?= $label->url('Team'); ?>" title="新建任务">
                    <span class="am-icon-plus am-icon-sm"></span>
                </a>
            </li>
            <li>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-envelope-o am-icon-sm"></span><span class="msg-tips"></span>
                </a>
            </li>
            <?php foreach ($menu as $topkey => $topValu) : ?>
                <li class="am-dropdown" data-am-dropdown>
                    <?php if ($topValu['menu_id'] == '41'): ?>
                        <a href="javascript:;" id="admin-fullscreen"><img src="http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80" alt="" class="am-comment-avatar" width="48" height="48"/></a>
                    <?php else: ?>
                        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                            <span class="<?= $topValu['menu_icon']; ?> am-icon-md"></span>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($topValu['menu_child'])): ?>
                        <ul class="am-dropdown-content" style="margin:0">
                            <?php foreach ($topValu['menu_child'] as $key => $value) : ?>
                                <li><a href="<?= $label->url($value['menu_url']); ?>"><span class="<?= $value['menu_icon']; ?>"></span> <?= $value['menu_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <!--<li class="am-hide-sm-only"></li>-->
        </ul>
    </div>
</header>

<div class="am-cf admin-main">

    <!-- content start -->
    <iframe id="iframe_default" src="/Index/systemInfo.html" style="width: 100%; height: 100%;" data-id="default" frameborder="0" scrolling="no"></iframe>
    <!-- content end -->

</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
    <hr>
    <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>
<style>
    .msg-tips{
        display: block;
        width: 10px;
        height: 10px;
        background-color: #f65645;
        border-radius: 5px;
        left: 25px;
        top: 15px;
        position: absolute;
    }
</style>
<script>
    $("#iframe_default").load(function () {
        var pageHeight = $(this).contents().find("body").height();
        $(this).height(pageHeight);
    })
</script>