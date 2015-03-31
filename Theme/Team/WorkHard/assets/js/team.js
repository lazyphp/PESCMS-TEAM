$(function () {
    $(".am-dropdown-content li a").on("click", function () {
        $("#iframe_default").attr("src", $(this).attr("href"))
        return false;
    })
    $(".am-dropdown, .am-dropdown-content").on("mouseover", function () {
//        $(".am-dropdown").dropdown('close')
        $(this).siblings(".am-dropdown").each(function () {
            console.dir("1")
            $(this).dropdown('close')
        })
        $(this).dropdown('open')


    })


    $(".am-dropdown, .am-dropdown-content").on("mouseleave", function () {
        $(this).dropdown('close')
    })
})