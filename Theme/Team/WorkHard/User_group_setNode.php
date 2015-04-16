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
                            <th style="width: 120px">控制器</th>
                            <th>方法</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($node as $topkey => $topValu) : ?>
                            <tr>
                                <td>
                                    <label class="am-checkbox-inline">
                                        <input class="top-node" type="checkbox"  value="<?= $topValu['node_id']; ?>"><?= $topValu['top_title']; ?>
                                    </label>
                                </td>
                                <td>
                                    <?php if (!empty($topValu['node_child'])): ?>
                                        <?php foreach ($topValu['node_child'] as $key => $value) : ?>
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" name="node[]" value="<?= $value['node_id']; ?>"><?= $value['node_title']; ?>
                                            </label>
                                        <?php endforeach; ?>
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
        var node = eval('(<?= json_encode($groupNode) ?>)');
        $('input[name="node[]"]').each(function () {
            var length = node.length;
            for (var i = 0; i < length; i++) {
                if (node[i] == $(this).val()) {
                    $(this).attr("checked", "checked")
                }
            }
        })
        $("body").on("click", ".top-node", function () {
            var nextCheckbox = $(this).parent().parent().next("td").find("input[type=checkbox]")
            if ($(this).is(":checked") == true) {
                nextCheckbox.prop("checked", "checked")
            } else {
                nextCheckbox.removeAttr("checked")
            }
        })
    })
</script>
<!-- content end -->