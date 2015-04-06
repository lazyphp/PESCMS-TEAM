<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>Upgrade</small></div>
    </div>

    <hr/>

    <div class="am-g">

        <div class="am-u-sm-12 am-u-sm-centered">
            <p>当前版本:1.025</p>
            <p>最新版本:1.300</p>
            <p><button type="button" id="begin-upgrade" class="am-btn am-btn-success">进行更新</button></p>
            <hr/>
        </div>
        <div id="upgrade-content" class="am-u-sm-12 am-u-sm-centered">
            <p>更新说明:</p>
            <p>1. 本次更新修复了很多BUG。</p>
            <p>2. 本次更新添加了很多新功能。</p>
            <p>3. 本次更新系统提供一键炒鱿鱼功能，妈妈再也不担心我不会炒鱿鱼了！</p>
            <p>4. 本次更新的内容我编不下去了，你们自己模式吧。</p>
            <hr/>
        </div>
        <div id="upgrade-action" class="am-u-sm-12 am-u-sm-centered am-hide">
            <p>本次系统更新操作明细:</p>
            <ol>
                <li class="am-u-sm-4" id="upgrade-download-file">
                    <p>开始下载文件</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%">0%</div>
                    </div>
                </li>
                <li class="am-u-sm-4 am-hide" id="upgrade-file">
                    <p>开始更新文件</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%">0%</div>
                    </div>
                </li>
                <li class="am-u-sm-4 am-hide" id="upgrade-db">
                    <p>开始更新数据库</p>
                    <div class="am-progress am-progress-striped am-active ">
                        <div class="am-progress-bar am-progress-bar-secondary" style="width: 0%">0%</div>
                    </div>
                </li>
                <li class="am-u-sm-4 am-hide" id="upgrade-end">
                    <p>更新结束</p>
                    <div class="am-progress am-progress-striped am-active ">
                    </div>
                </li>
            </ol>

        </div>

    </div>
</div>
<script>
    $("#begin-upgrade").on("click", function () {
        $("#upgrade-content").addClass("am-hide");
        $("#upgrade-action").removeClass("am-hide");
        //下载文件
        $.ajax({
            url: '<?= $label->url('Team-Setting-downloadUpgradeFile', array('method' => 'PUT')) ?>',
//            async: false,
            beforeSend: function () {
                $("#upgrade-download-file .am-progress-bar-secondary").css("width", "5%").html("5%");
            },
            success: function (data) {
                console.dir(data);
                $("#upgrade-download-file .am-progress-bar-secondary").css("width", "100%").html("100%");
            }
        })
    })
</script>