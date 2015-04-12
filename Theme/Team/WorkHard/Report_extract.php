<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong></div>
    </div>


    <div class="am-g">
        <div class="am-u-sm-12">
            <form action="" class="am-form am-form-inline">
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-calendar"></i>
                    <input type="text" class="am-form-field datetimepicker" name="begin" placeholder="日期">
                </div>

                <div class="am-form-group am-form-icon">
                    <i class="am-icon-calendar"></i>
                    <input type="text" class="am-form-field datetimepicker" name="end" placeholder="时间">
                </div>

                <div class="am-form-group am-form-icon">
                    <select name="user">
                        <option value="">全体用户</option>
                        <?php foreach ($user as $key => $value) : ?>
                            <?php if ($value['user_department_id'] == $_SESSION['team']['user_department_id']): ?>
                                <option value="<?= $value['user_id']; ?>"><?= $value['user_name']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="am-btn am-btn-default">获取</button>
            </form>
            <hr/>
            <?php foreach ($list as $date => $v) : ?>
                <h2><?= $date; ?></h2>
                <hr/>
                <?php foreach ($v as $key => $content) : ?>
                    <div class="am-g am-padding-left-lg">
                        <div class="am-u-sm-12 am-u-sm-centered">
                            <h3>
                                <?= $label->findUser('user', 'user_id', $key)['user_name']; ?>工作报表详情
                            </h3>
                        </div>
                        <!--任务内容-->
                        <div class="am-u-sm-12 am-u-sm-centered">
                            <ol class="am-list-static ">
                                <?php foreach ($content as $value) : ?>
                                    <li>
                                        <?php if (!empty($value['task_id'])): ?>
                                            报表来自任务《<a href="<?= $label->url('Team-Task-view', array('id' => $value['task_id'])); ?>"><?= $value['task_title']; ?></a>》日志 <?= $label->taskStatus($value['task_status']); ?>:
                                        <?php endif; ?>
                                        <?= htmlspecialchars_decode($value['report_content']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                            <hr/>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- content end -->