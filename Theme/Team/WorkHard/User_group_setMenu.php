<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form" action="" method="POST">
                <input type="hidden" name="method" value="PUT" />
                <input type="hidden" name="id" value="<?= $user_group_id ?>" />
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th>页眉菜单</th>
                            <th>子级菜单</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <p>先勾选页眉菜单，才有子级菜单</p>
                            </td>
                        </tr>
                        <?php foreach ($menu as $topkey => $topValu) : ?>
                            <tr>
                                <td>
                                    <div class="am-form-group">
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="menu[]" value="<?= $topValu['menu_id']; ?>"><?= $topValu['menu_name']; ?>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($topValu['menu_child'])): ?>
                                        <div class="am-form-group">
                                            <?php foreach ($topValu['menu_child'] as $key => $value) : ?>
                                                <label class="am-checkbox-inline">
                                                    <input type="checkbox" name="menu[]" value="<?= $value['menu_id']; ?>"><?= $value['menu_name']; ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="am-margin">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs">更新</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    $(function () {
        var menu = eval('(<?= json_encode(explode(',', $user_group_menu)) ?>)');
        $('input[name="menu[]"]').each(function () {
            var length = menu.length;
            for (var i = 0; i < length; i++) {
                if (menu[i] == $(this).val()) {
                    $(this).attr("checked", "checked")
                }
            }
        })
    })
</script>
<!-- content end -->