<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>Upgrade</small></div>
    </div>

    <hr/>

    <div class="am-g">

        <div class="am-u-sm-12 am-u-sm-centered">
            <p>当前版本:<?= $update_list_pre_version ?></p>
            <p>最新版本:<?= $update_list_version ?></p>
            <p><button type="button" id="begin-upgrade" class="am-btn am-btn-success">进行更新</button></p>
            <hr/>
        </div>
        <div id="upgrade-content" class="am-u-sm-12 am-u-sm-centered">
            <p>更新说明:</p>
            <?= htmlspecialchars_decode($update_list_content) ?>
            <hr/>
        </div>

        <div id="upgrade-action" class="am-u-sm-12 am-u-sm-centered am-hide">
            <p>本次系统更新操作明细:</p>
            <div class="am-g am-g-fixed" id="upgrade-download-file">
                <div class="am-u-sm-6">
                    <p>开始下载文件</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%">0%</div>
                    </div>
                </div>
            </div>

            <div class="am-g am-g-fixed am-hide" id="upgrade-file">
                <div class="am-u-sm-6">
                    <p>开始更新文件</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%">0%</div>
                    </div>
                </div>
            </div>

            <div class="am-g am-g-fixed am-hide" id="upgrade-db">
                <div class="am-u-sm-6">
                    <p>开始更新数据库</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%">0%</div>
                    </div>
                </div>
            </div>

            <div class="am-g am-g-fixed am-hide" id="upgrade-end">
                <div class="am-u-sm-6">
                    <p>更新结束</p>
                </div>
            </div>

        </div>

    </div>
</div>
<script>
    $("#begin-upgrade").on("click", function() {
        $("#upgrade-content").addClass("am-hide");
        $("#upgrade-action").removeClass("am-hide");
        var endAnimation = new Array;
        endAnimation['download'] = false;
        animation('abc', "#upgrade-download-file", 'download', "<p>文件下载完毕...</p>")

        var timeId = setInterval(function() {
            if (endAnimation['download'] == true) {
                endAnimation['download'] = false;
                animation('abc', "#upgrade-file", 'db', "<p>文件更新完毕...</p>")
                $("#upgrade-file").removeClass("am-hide");
            }
        }, '500')

        var timeId = setInterval(function() {
            if (endAnimation['db'] == true) {
                endAnimation['db'] = false;
                animation('abc', "#upgrade-db", 'end', "<p>数据库更新完毕...</p>")
                $("#upgrade-db").removeClass("am-hide");
            }
        }, '500')

        var timeId = setInterval(function() {
            if (endAnimation['end'] == true) {
                endAnimation['end'] = false;
                $("#upgrade-end").removeClass("am-hide");
            }
        }, '500')

        function animation(url, dom, endKey, endString) {
            var i = 0;
            var timeId;
            $.ajax({
                url: '<?= $label->url('Team-Setting-downloadUpgradeFile', array('method' => 'PUT')) ?>',
                dataType: 'json',
                beforeSend: function() {
                    timeId = setInterval(function() {
                        i++
                        if (i <= '80') {
                            $(dom + " .am-progress-bar-secondary").css("width", i + "%").html(i + "%");
                        } else {
                            clearTimeout(timeId)
                        }
                    }, '200');
                },
                success: function(data) {
                    console.dir(data)
                    if (data.status == '0') {
                        clearTimeout(timeId);
                        $(dom + " .am-u-sm-6").append("<p>" + data.info + "，更新已停止</p>");
                    } else {
                        var endtimeId = setInterval(function() {
                            i++
                            if (i <= '100') {
                                $(dom + " .am-progress-bar-secondary").css("width", i + "%").html(i + "%");
                            } else {
                                endAnimation[endKey] = true;
                                clearTimeout(endtimeId)
                                $(dom + " .am-u-sm-6").append(endString);
                            }
                        }, '50');
                    }
                }
            })
        }

    })



</script>