<?php $this->header(); ?>
<header class="am-topbar admin-header am-header-fixed">
    <div class="am-topbar-brand">
        <a href="/"><strong>PESCMS</strong> <small>任务系统</small></a>
    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-hide-sm-only">
                <a class="am-dropdown-toggle" id="add-new-task" data-am-dropdown-toggle href="<?= $label->url('Team-Task-action'); ?>" title="新建任务">
                    <span class="am-icon-plus am-icon-sm"></span>
                </a>
            </li>
            <li id="notice" data-am-dropdown class="<?= empty($notice) ? '' : 'am-active'; ?>">
                <a class="am-dropdown-toggle " data-am-dropdown-toggle href="javascript:;" style="color: #666;border-bottom-color:#000">
                    <span class="am-icon-envelope-o am-icon-sm"></span>
                    <?php if (!empty($notice)): ?>
                        <span class="msg-tips"></span>
                    <?php endif; ?>
                </a>
                <?php if (!empty($notice)): ?>
                    <ul class="am-dropdown-content am-active" >
                        <?php foreach ($notice as $key => $value) : ?>
                            <?= $label->noticeType($value['notice_type'], $value['total_notice']); ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
            <?php foreach ($menu as $topkey => $topValu) : ?>
                <li class="am-dropdown" data-am-dropdown>
                    <?php if ($topValu['menu_id'] == '41'): ?>
                        <a href="javascript:;" ><img src="<?= $_SESSION['team']['user_head']; ?>" alt="" class="am-comment-avatar" width="48" height="48"/></a>
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
        </ul>
    </div>
</header>

<div class="am-cf">

    <!-- content start -->
    <iframe id="iframe_default" src="/Index/dynamic.html" style="width: 100%; height: 100%;" data-id="default" frameborder="0" scrolling="auto"></iframe>
    <!-- content end -->

</div>
<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
    <hr>
    <p class="am-padding-left">© 2014 - <?= date('Y'); ?> PESCMS为本程序强力驱动</p>
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
    $("#iframe_default").height($(window).height() - 59);

    $(window).resize(function () {
        $("#iframe_default").height($(window).height() - 59);
    });

    //消息提示3秒则自动关闭
    $(function () {
        $("body").addClass("am-nbfc")
        var autoCloseNotice = setTimeout("$('#notice').dropdown('close')", 3000);
        $("#notice").on("click", function () {
            clearTimeout(autoCloseNotice);
        })
    })

</script>
<?php $this->footer(); ?>