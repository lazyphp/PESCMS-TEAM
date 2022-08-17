<div class=" am-padding am-padding-top-0">

    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <div class="am-margin-bottom-xs am-g-collapse">
        <form class="am-form-inline" role="form">
            <input type="hidden" name="g" value="<?= GROUP; ?>"/>
            <input type="hidden" name="m" value="<?= MODULE ?>"/>
            <input type="hidden" name="a" value="<?= ACTION ?>"/>

            <div class="am-form-group">
                <input type="text" name="begin" class="am-form-field" value="<?= $label->xss($_GET['begin'] ?? null) ?>" data-am-datepicker placeholder="报表查询起始日期"
                       readonly required>
            </div>

            <div class="am-form-group">
                <input type="text" name="end" class="am-form-field" value="<?= $label->xss($_GET['end'] ?? null) ?>" data-am-datepicker placeholder="结束日期"
                       readonly required>
            </div>
            <div class="am-form-group">
                <select name="user" data-am-selected>
                    <option value="0">全体用户</option>
                    <?php foreach ($users as $value): ?>
                        <?php if( ( $value['user_department_id'] ?? null ) != $this->session()->get('team')['user_department_id'] && ACTION != 'allExtract'){continue;} ?>
                        <option
                            value="<?= $value['user_id'] ?>" <?= isset($_GET['user']) && $_GET['user'] == $value['user_id'] ? 'selected="selected"' : '' ?> ><?= $value['user_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="am-btn am-radius am-btn-default">获取报表</button>
            <button type="submit" name="excel" value="1" class="am-btn am-radius am-btn-success"><i class="am-icon-file-excel-o"></i> 导出表格</button>
        </form>
    </div>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

    <?php if (empty($list)): ?>
        <div class="am-alert am-alert-secondary am-margin-top am-margin-bottom am-text-center" data-am-alert>
            <p>当前范围内该用户没有提交报表</p>
        </div>
    <?php else: ?>
        <div class="am-panel-group" id="accordion">
            <?php foreach ($list as $date => $item): ?>
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd">
                        <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#<?= $date ?>'}">
                            <?= date('Y-m-d', $date); ?>
                        </h4>
                    </div>
                    <div id="<?= $date ?>" class="am-panel-collapse am-collapse">
                        <div class="am-panel-bd">
                            <?php foreach ($item as $userid => $content): ?>
                                <h4><?= $users[$userid]['user_name'] ?>的工作报告:</h4>
                                <ul class="am-list am-list-static am-list-border report-list">
                                    <?php foreach ($content as $num => $value): ?>
                                        <li><?= htmlspecialchars_decode($value['report_content']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <hr class="am-margin-0 am-padding-0"/>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
