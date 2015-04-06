<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>列表</small></div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody>
                    <?php foreach ($list as $key => $value) : ?>
                        <tr>
                            <td><a href="<?= $label->url('Team-Report-view', array('id' => $value['report_id'])); ?>"><?= $value["report_date"]; ?>工作报表</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <ul class="am-pagination am-pagination-right am-text-sm">
                <?= $page; ?>
            </ul>
        </div>
    </div>
</div>
<!-- content end -->