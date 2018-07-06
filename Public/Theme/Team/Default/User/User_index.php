<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_tool.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_list.php"; ?>

<script>
    $(function(){
        $('.am-btn-group>a.am-btn-default').after('<a href="<?= $label->url(GROUP.'-User-analyze') ?>" class="am-btn am-btn-success"><span class="am-icon-bar-chart"></span> 数据分析</a>')
    })
</script>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
