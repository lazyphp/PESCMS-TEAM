<?php include THEME_PATH.'/header.php'; ?>
<?php include THEME_PATH.'/Topbar.php'; ?>
<div class="am-text-sm" id="pjax-container">
    <div class="am-g task-card am-padding-bottom ">
        <?php foreach ($list as $statusid => $status): ?>
            <?php
            if ($statusid == '10') {
                continue;
            }
            ?>
            <div class="am-u-md-3">
                <div class="task-card-box">
                    <div class="task-card-head" style="background-color: <?= $status['task_status_color'] ?>;">
                        目前<?= $status['task_status_name'] ?>
                    </div>
                    <div class="task-box-list-box">
                        <div class="task-car-list-box-fit <?= $statusid == '3' ? '' : 'move-task-card' ?>" status="<?= $statusid; ?>" status-icon="<?= $status['task_status_icon']; ?>" status-color="<?= $status['task_status_color']; ?>">
                            <div class="task-card-list am-hide"></div>
                            <?php $card = 0 ?>
                            <?php if (!empty($status['task'])): ?>
                                <?php foreach ($status['task'] as $key => $value): ?>
                                    <div class="empty-div" status="<?= $statusid; ?>" taskid="<?= $value['task_id']; ?>" expired="<?= $value['task_end_time'] < time() && $value['task_status'] < 2 ? '1' : '0' ?>">
                                        <div class="task-card-list <?= $value['task_end_time'] < time() && $value['task_status'] < 2 ? 'task-card-warning' : '' ?>">
                                            <div>
                                                <?= $label->getStatusSelect($statusMark, ['task_id' => $value['task_id'], 'task_status' => $value['task_status']]); ?>
                                                <!--任务标题-->
                                                <a href="<?= $label->url('Team-Task-view', ['id' => $value['task_id'], 'back_url' => base64_encode($_SERVER['REQUEST_URI'])]) ?>" style="<?= $statusid == '3' ? 'text-decoration: line-through;' : '' ?>"><?= $value['task_title'] ?></a>
                                                <!--任务标题-->
                                                <!--所属项目-->
                                                [<a href="<?= $label->url('Team-Task-project', ['id' => $value['task_project_id']]); ?>"
                                                    class="am-link-muted"><i><?= $label->findContent('project', 'project_id', $value['task_project_id'])['project_title']; ?></i></a>]
                                                <!--所属项目-->
                                            </div>
                                            <div>
                                                <!--任务优先度-->
                                                <span class="am-badge am-radius" style="background-color: <?= $taskPriority[$value['task_priority']]['priority_color'] ?>"><?= $taskPriority[$value['task_priority']]['priority_name'] ?></span>
                                                <!--任务优先度-->
                                                <!--任务时间-->
                                                <span class="am-badge am-round " title="计划完成时间：<?= date('Y-m-d H:i', $value['task_end_time']); ?>"><i
                                                        class="am-icon-calendar"></i> <?= date('m.d', $value['task_end_time']); ?></span>
                                                <!--任务时间-->

                                                <?php if($value['task_end_time'] < time() && $value['task_status'] < 2): ?>
                                                    <span class="am-badge am-round am-badge-secondary"><i class="am-icon-exclamation"></i> 已逾期 <?= floor((time() - $value['task_end_time'])/ 86400) ?>天</span>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php $card++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script type="text/javascript" src="/Theme/assets/js/jquery.dragsort-0.5.2.min.js?v.2.1.0"></script>
    <script type="text/javascript">
        $(".move-task-card").dragsort({
            dragSelector: "div",
            dragEnd: saveChange,
            dragBetween: true,
            placeHolderTemplate: "<div class='task-card-list'></div>"
        });

        function saveChange() {
            $(".empty-div").each(function () {
                var DOM = $(this);
                //获取当前任务卡得父类的信息
                var parent_status = $(this).parents('.task-car-list-box-fit').attr('status');
                var parent_icon = $(this).parents('.task-car-list-box-fit').attr('status-icon');
                var parent_color = $(this).parents('.task-car-list-box-fit').attr('status-color');

                var taskstatus = $(this).attr("status");
                var taskid = $(this).attr("taskid");
                var expired = $(this).attr("expired");
                if (taskstatus != parent_status) {
                    $.ajaxsubmit({
                        'url': '/?g=Team&m=Task&a=status&method=PUT&status=' + parent_status + '&task_id=' + taskid,
                        'dialog': false
                    }, function (data) {
                        //更新成功，则标记为当前的状态
                        if (data.status == '200') {
                            if(parent_status < '2' && expired == '1' ){
                                DOM.find('.task-card-list').addClass('task-card-warning');
                            }else{
                                DOM.find('.task-card-list').removeClass('task-card-warning');
                            }
                            DOM.attr("status", parent_status);
                            DOM.find('.am-dropdown-toggle').attr("style", 'color:' + parent_color);
                            DOM.find('.status-icon').attr("class", parent_icon + ' status-icon');

                            //状态切换按钮重新check am-disabled
                            DOM.find('.am-dropdown-content li').each(function () {
                                $(this).removeClass('am-disabled');
                                if ($(this).attr('status') == parent_status) {
                                    $(this).addClass('am-disabled').find('a').addClass('am-disabled');
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
</div>
<?php include THEME_PATH.'/footer.php'; ?>