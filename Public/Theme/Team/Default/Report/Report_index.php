<div class="am-padding-sm am-padding-top-0">

    <div class="am-panel am-panel-default ">
        <div class="am-panel-bd am-padding-xs">
            <h2 class="am-margin-vertical">编写今天的报表内容</h2>
            <form action="<?= $label->url('Team-Report-action') ?>" class="ajax-submit" method="POST">
                <?= $label->token(); ?>

                <script type="text/plain" id="content" style="height:250px;"></script>
                <script>
                    var ue = UE.getEditor('content', {
                        textarea: 'content'
                        , toolbars: [[
                            'fullscreen', 'source', '|', 'undo', 'redo', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'removeformat', 'formatmatch', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', 'insertcode', '|',
                            'link', 'unlink', '|',
                            'simpleupload', 'insertimage', 'attachment', 'inserttable', 'drafts'
                        ]]
                    });
                </script>
                <button type="submit" class="am-btn am-radius am-btn-warning am-btn-xs am-margin-top">
                    <i class="am-icon-hand-pointer-o"></i> 提交报表
                </button>
            </form>

        </div>
    </div>
    <?php if (!empty($list)): ?>
        <ul class="am-list am-list-border am-list-striped">
            <?php foreach ($list as $key => $value): ?>
                <li><a href="<?= $label->url('Team-Report-view', ['id' => $value['report_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]); ?>"><?= date('Y-m-d', $value['report_date']); ?>报表</a></li>
            <?php endforeach; ?>
        </ul>
        <ul class="am-pagination am-pagination-centered am-text-xs">
            <?= $page; ?>
        </ul>
    <?php endif; ?>

</div>
