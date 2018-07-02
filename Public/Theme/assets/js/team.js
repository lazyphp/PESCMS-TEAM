/**
 * 发布任务常用的JS操作
 */
$(function () {

    /**
     * 在编辑模式下，先匹配获取执行人得ID
     */
    $('.remove-action-user, .remove-action-user, .remove-action-department').each(function () {
        var id = $(this).attr('data');

        if ($(this).hasClass('remove-check-user')) {
            var dom = '.select-check-user';
        } else if ($(this).hasClass('remove-action-user')) {
            var dom = '.department-user';
        } else if ($(this).hasClass('remove-action-department')) {
            var dom = '.department';
        }

        $(dom + ' option').each(function () {
            if ($(this).val() == id) {
                $(this).remove();
            }
        })
    });

    /**
     * 添加任务审核人
     */
    $("body").on("change", '.select-check-user', function () {
        if ($(this).val() == "") {
            return true;
        }

        var user_id = $(this).val();
        var user_name = $(".select-check-user option:selected").text();

        $(".check-user").append(' <a href="javascript:;" data="' + user_id + '" class="remove-check-user" ><i class="am-icon-user"></i><span> ' + user_name + '</span></a>');

        $('.select-check-user option:selected').remove();
        setCheckUser('remove-check-user', 'checkuser');
    })

    /**
     * 指派部门
     */
    $("body").on("change", '.department', function () {

        if ($(this).val() == "") {
            return true;
        }

        var local = $(".department option:selected").attr("data");

        if (local == '1') {
            $(this).parent().removeClass().addClass("am-u-sm-6");
            $(".department-user").parent().removeClass("am-hide");
        } else {
            var department_id = $(this).val();
            var department_name = $(".department option:selected").text();
            $(".action-user").append(' <a href="javascript:;" data="' + department_id + '" class="remove-action-department" ><i class="am-icon-legal"></i><span> ' + department_name + '</span></a>');

            $(this).parent().removeClass().addClass("am-u-sm-12");
            $(".department-user").parent().addClass("am-hide");
            $('.department option:selected').remove();
            setCheckUser('remove-action-department', 'actiondepartment');
        }
        $("#task-accept-id").val(local);
    })

    /**
     * 指派个人
     */
    $("body").on("change", '.department-user', function () {
        if ($(this).val() == "") {
            return true;
        }

        var user_id = $(this).val();
        var user_name = $(".department-user option:selected").text();

        $(".action-user").append(' <a href="javascript:;" data="' + user_id + '" class="remove-action-user" ><i class="am-icon-user"></i><span> ' + user_name + '</span></a>');

        $('.department-user option:selected').remove();
        setCheckUser('remove-action-user', 'actionuser');
    })

    /**
     * 移除任务审核人, 执行人
     */
    $("body").on("click", ".remove-check-user, .remove-action-user, .remove-action-department", function () {
        var className = $(this).attr("class");
        var selectName = '';
        var remove = '';
        var inputName = '';
        switch (className) {
            case 'remove-check-user':
                selectName = 'select-check-user';
                remove = 'remove-check-user';
                inputName = 'checkuser';
                break;
            case 'remove-action-user':
                selectName = 'department-user';
                remove = 'remove-action-user';
                inputName = 'actionuser';
                break;
            case 'remove-action-department':
                selectName = 'department';
                remove = 'remove-action-department';
                inputName = 'actiondepartment';
                break;
        }

        if ($(this).attr("type") != 'no') {
            $('.' + selectName).append('<option value="' + $(this).attr("data") + '">' + $(this).text() + '</option>')
            $(this).remove();
        }
        setCheckUser(remove, inputName);
    })


    /**
     * 设置隐藏域的内容值
     */
    function setCheckUser(traversalName, inputName) {
        var task_check_user = new Array;
        $("." + traversalName).each(function (index) {
            task_check_user[index] = $(this).attr("data");
        })

        $("input[name=" + inputName + "]").val(task_check_user.join(","));
    }

})