<?php include THEME_PATH . "/Content/Content_index_header.php"; ?>

<div class="am-g am-margin-top-sm am-margin-bottom-xs am-g-collapse">
    <div class="am-u-sm-12 am-u-md-12">
        <form class="am-form-inline">
            <input type="hidden" name="g" value="<?= GROUP; ?>"/>
            <input type="hidden" name="m" value="<?= MODULE ?>"/>
            <input type="hidden" name="a" value="<?= ACTION ?>"/>
            <div class="am-form-group">
                <input type="text" name="begin" value="<?= $label->xss($_GET['begin'], false) ?>" class="am-form-field" placeholder="开始日期" data-am-datepicker readonly>
            </div>

            <div class="am-form-group">
                <input type="text" name="end" value="<?= $label->xss($_GET['end'], false) ?>" class="am-form-field" placeholder="结束日期" data-am-datepicker readonly>
            </div>
            <button type="submit" class="am-btn am-btn-warning am-radius">分析</button>
        </form>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
<?php if (!empty($list)): ?>
    <table class="am-table am-table-bordered am-table-striped am-table-hover am-text-sm am-table-centered">
        <tr>
            <th>名称</th>
            <?php foreach ($statusMark as $key => $value): ?>
                <th><?= $value['task_status_name'] ?>任务</th>
            <?php endforeach; ?>
            <th>任务合计</th>
            <th>完成率</th>
        </tr>
        <?php foreach ($list as $key => $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <?php foreach ($statusMark as $status): ?>
                    <td><?= empty($item['task_status'][$status['task_status_type']]) ? 0 : $item['task_status'][$status['task_status_type']] ?></td>
                <?php endforeach; ?>
                <td><?= empty($item['total']) ? 0 : $item['total'] ?></td>
                <td><?= $item['total'] == 0 ? 0 : round(($item['task_status'][2]+$item['task_status'][3])/$item['total'] * 100 , 2) ?>%</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="am-text-xs">
        <p>1. 完成率计算方式不一定准确，因为执行者提交审核不表示该任务结束。而审核者没有对任务进行审核操作，会影响任务完成率。因此完成率计算方式为：<strong class="am-text-danger">完成率 = (审核+完成)/任务合计</strong></p>
        <p>2. 默认分析为一个月时间。由于PESCMS Team系统存在多个任务参照时间，本分析功能统一使用任务的发布时间作为筛选的依据。</p>
    </div>
<?php else: ?>
    <p>当前时间段内没有可用的数据分析。</p>
<?php endif; ?>

<?php include THEME_PATH . "/Content/Content_index_footer.php"; ?>
