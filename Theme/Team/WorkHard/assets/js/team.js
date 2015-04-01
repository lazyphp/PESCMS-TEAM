$(function () {
    /**
     * 设置主框架的跳转链接
     */
    $(".am-dropdown-content li a").on("click", function () {
        $("#iframe_default").attr("src", $(this).attr("href"))
        if ($(this).find("span").attr("class") != 'am-icon-sign-out') {
            return false;
        }
    })

    /**
     * 鼠标移动显示菜单
     */
    $(".am-dropdown, .am-dropdown-content").on("mouseover", function () {
        $(this).siblings(".am-dropdown").each(function () {
            console.dir("1")
            $(this).dropdown('close')
        })
        $(this).dropdown('open')


    })

    $(".am-dropdown, .am-dropdown-content").on("mouseleave", function () {
        $(this).dropdown('close')
    })
    /* 鼠标移动显示菜单结束 */

    /**
     * 添加部门负责人
     */
    $("#add-departmengt-user").on("change", function () {
        var user_id = $(this).val();
        var user_name = $("#add-departmengt-user option:selected").text();
        var added = false;
        if (user_id == '0') {
            return false;
        }
        //遍历是否已经添加用户了
        $(".remove-department-user").each(function (index) {
            if ($(this).attr("data") == user_id) {
                added = true;
            }
        })

        if (added == true) {
            return false;
        } else {
            $("#department-user").append(' <a href="javascript:;" data="' + user_id + '" class="remove-department-user" ><i class="am-icon-user"></i><span> ' + user_name + '</span></a>');
        }

        setDepartmentUser();
    })

    /**
     * 移除部门负责人
     */
    $("#department-user").on("click", ".remove-department-user", function () {
        $(this).remove();
        setDepartmentUser();
    })

    /**
     * 设置部门负责人
     * @returns {undefined}
     */
    function setDepartmentUser() {
        var user_department_user = new Array;
        $(".remove-department-user").each(function (index) {
            user_department_user[index] = $(this).attr("data");
        })

        $("input[name=header]").val(user_department_user.join(","));

    }

    /**
     * 任务选择指派部门
     */
    $("#task-department-id").on("change", function () {
        var local = $("#task-department-id option:selected").attr("data");
        if (local == '1') {
            $(this).parent().removeClass().addClass("am-u-sm-8 am-u-md-2");
            $("#task-user-layer").removeClass("am-hide-lg");
        } else {
            $(this).parent().removeClass().addClass("am-u-sm-8 am-u-md-4");
            $("#task-user-layer").addClass("am-hide-lg");
            $("#task-user-id").val("");
        }
        $("#task-accept-id").val(local);
    })

})