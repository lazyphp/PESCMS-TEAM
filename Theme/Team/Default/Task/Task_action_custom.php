<!--任务审核人和指派人开始-->
<div class="am-g">
    <div class="am-u-sm-6">
        <div class="am-form-group">
            <label class="am-block">任务审核人</label>

            <input type="hidden" name="checkuser" value="<?= $_SESSION['team']['user_id']; ?>"/>

            <div class="am-block am-margin-bottom-xs check-user">
                <a href="javascript:;" type="no" data="<?= $_SESSION['team']['user_id']; ?>" class="remove-check-user"><i class="am-icon-user"></i><span> <?= $_SESSION['team']['user_name']; ?>(本人)</span></a>
            </div>

            <select class="select-check-user">
                <option selected value="">添加审核人</option>
                <?php foreach ($user['list'] as $key => $value): ?>
                    <option value="<?= $key; ?>" <?= $key == $_SESSION['team']['user_id'] ? 'disabled="disabled"' : '' ?>><?= $value; ?></option>
                <?php endforeach; ?>
            </select>

            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                <i class="am-icon-lightbulb-o"></i> 指派成员中有跨部门的，当该任务被二次指派，负责人也会自动设为审核人
            </div>

        </div>
    </div>

    <div class="am-u-sm-6">
        <div class="am-form-group">
            <label class="am-block">指派成员</label>

            <input type="hidden" name="actionuser" value=""/>
            <input type="hidden" name="actiondepartment" value=""/>

            <div class="am-block am-margin-bottom-xs action-user" data="">
                &nbsp;
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <select class="department">
                        <option selected value="">选择部门</option>
                        <?php foreach ($department as $value): ?>
                            <option value="<?= $value['department_id']; ?>" data="<?= $value['department_id'] == $_SESSION['team']['user_department_id'] ? '1' : '' ?>"><?= $value['department_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="am-u-sm-6 am-hide">
                    <select class="department-user">
                        <option selected value="">选择用户</option>
                        <?php foreach ($user['department'] as $key => $value): ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>

                <i class="am-icon-lightbulb-o"></i> 跨部门指派，默认是分配给部门负责人。
            </div>
        </div>
    </div>
</div>
<!--任务审核人和指派人结束-->

<!--任务计划时间-->
<div class="am-g">
    <div class="am-u-sm-6">
        <div class="am-form-group">
            <label class="am-block">计划开始时间<i class="am-text-danger">*</i></label>
            <input name="start_time" type="text" class="datetimepicker am-text-left" readonly required/>
        </div>
    </div>

    <div class="am-u-sm-6">
        <div class="am-form-group">
            <label class="am-block">计划完成时间<i class="am-text-danger">*</i></label>
            <input name="end_time" type="text" class="datetimepicker am-text-left" readonly required/>
        </div>
    </div>
</div>
<!--任务计划时间-->

<!--任务条目-->
<div class="am-g">
    <div class="am-u-sm-12 am-u-sm-centered">
        <div class="am-form-group">
            <label class="am-block">任务条目</label>
            <textarea name="tasklist" rows="5"></textarea>

            <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                <i class="am-icon-lightbulb-o"></i> 一行一条条目填写。将任务条目明细化，有助于任务的完成和跟踪。指派给多人时，最好填写任务条目，方便对任务的进度把控。
            </div>
        </div>
    </div>
</div>
<!--任务条目-->