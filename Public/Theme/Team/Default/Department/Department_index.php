<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<?php include THEME_PATH . "/Content/Content_index_tool.php"; ?>

<?php if (empty($list)): ?>
    <div class="am-alert am-alert-secondary am-margin-top am-margin-bottom am-text-center" data-am-alert>
        <p>本页面没有数据 :-(</p>
    </div>
<?php else: ?>
    <form class="am-form ajax-submit" action="<?= $label->url(GROUP . '-' . MODULE . '-listsort'); ?>" method="POST">
        <input type="hidden" name="method" value="PUT"/>
        <table class="am-table am-table-bordered am-table-striped am-table-hover am-text-sm">
            <tr>
                <?php if ($listsort): ?>
                    <th class="table-sort">排序</th>
                <?php endif; ?>
                <th class="table-set">ID</th>
                <?php foreach ($field as $value) : ?>
                    <?php if ($value['field_name'] == 'status'): ?>
                        <?php $class = 'table-set'; ?>
                    <?php else: ?>
                        <?php $class = 'table-title'; ?>
                    <?php endif; ?>
                    <th class="<?= $class ?>"><?= $value['field_display_name']; ?></th>
                <?php endforeach; ?>
                <th class="table-set">操作</th>
            </tr>
            <?php foreach ($list as $key => $value) : ?>
                <tr>
                    <?php if ($listsort): ?>
                        <td>
                            <input type="text" class="am-input-sm" name="id[<?= $value["{$fieldPrefix}id"]; ?>]"
                                   value="<?= $value["{$fieldPrefix}listsort"]; ?>">
                        </td>
                    <?php endif; ?>
                    <td class="am-text-middle"><?= $value["{$fieldPrefix}id"]; ?></td>
                    <td class="am-text-middle"><?= $value['department_name'] ?></td>
                    <td class="am-text-middle">
                        <?php if (!empty($value['department_header'])): ?>
                            <?php foreach (explode(',', $value['department_header']) as $user_id): ?>
                                <a href="<?= $label->url('Team-User-view', ['id' => $user_id]) ?>"><?= $label->findContent('user', 'user_id', $user_id)['user_name']; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>


                    <td class="am-text-middle">
                        <?php /* 若要实现自定义的操作按钮，请更改本变量 */ ?>
                        <?php $operate = empty($operate) ? '/Content/Content_index_operate.php' : $operate; ?>
                        <?php include THEME_PATH . $operate; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <ul class="am-pagination am-pagination-right am-text-sm">
            <?= $page; ?>
        </ul>
        <?php if ($listsort): ?>
            <div class="am-margin">
                <button type="submit" class="am-btn am-radius am-btn-primary am-btn-xs">排序</button>
            </div>
        <?php endif; ?>
    </form>
<?php endif; ?>

<script>
    $(function(){
        $('.am-btn-group>a.am-btn-default').after('<a href="<?= $label->url(GROUP.'-Department-analyze', ['back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>" class="am-btn am-btn-success"><span class="am-icon-bar-chart"></span> 部门数据分析</a>')
    })
</script>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
