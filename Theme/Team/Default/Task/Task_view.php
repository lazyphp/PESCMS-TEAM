<div class="admin-content am-padding am-padding-top-0">
    <!--任务顶栏信息-->
    <?php include 'View/Task_topbar.php' ?>
    <!--任务顶栏信息-->

    <!--任务标题等信息-->
    <?php include 'View/Task_title.php' ?>
    <!--任务标题等信息-->
    <!--任务内容-->
    <?php include 'View/Task_content.php' ?>
    <!--任务内容-->

    <!--追加任务内容-->
    <?php include 'View/Task_supplement.php' ?>
    <!--追加任务内容-->

    <!--部门指派-->
    <?php include 'View/Task_department.php' ?>
    <!--部门指派-->

    <!--任务条目-->
    <?php include 'View/Task_list.php' ?>
    <!--任务条目-->

    <!--任务动态-->
    <?php include 'View/Task_dynamic.php' ?>
    <!--任务动态-->

</div>

<script>
    $(function () {

        var editor = {
            'task-edit': 'task-edit',
            'task-append-supplement': 'supplement',
            'task-taskdynamic': 'dynamic'
        }

        /**
         * 显示和隐藏编辑器
         */
        $('body').on("click", '.task-append-button', function () {
            var stop = true;
            var data = $(this).attr("data");
            if ($('.' + data).hasClass('am-hide')) {
                stop = false;
            }

            $('.' + data).removeClass('am-hide').parents('form').addClass('ajax-submit');
            if (editor[data]) {
                UE.getEditor(editor[data], {textarea: 'content'})
            }

            $('.task-append-button').each(function () {
                var otherClassName = $(this).attr('data');
                if (otherClassName != data) {
                    $('.' + otherClassName).addClass('am-hide').parents('form').removeClass('ajax-submit');
                }
            })

            if (data == 'task-edit') {
                $(".task-edit-display").addClass('am-hide');
            } else {
                $(".task-edit-display").removeClass('am-hide');
            }

            return stop;

        })
    })
</script>