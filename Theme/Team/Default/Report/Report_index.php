<div class="am-panel am-panel-default">
    <div class="am-panel-bd">
        <form action="<?= $label->url('Team-Report-action') ?>" class="ajax-submit" method="POST">
            <script type="text/plain" id="content" style="height:150px;"></script>
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
            <button type="submit" class="am-btn am-btn-warning am-btn-xs">
                <i class="am-icon-hand-pointer-o"></i> 提交报表
            </button>
        </form>

    </div>
</div>
<ul class="am-list am-list-border am-list-striped">
    <?php foreach ($list as $key => $value): ?>
        <li><a href="<?= $label->url('Team-Report-view', ['id' => $value['report_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]); ?>"><?= date('Y-m-d', $value['report_date']); ?>报表</a></li>
    <?php endforeach; ?>
</ul>
<ul class="am-pagination am-pagination-centered am-text-xs">
    <?= $page; ?>
</ul>