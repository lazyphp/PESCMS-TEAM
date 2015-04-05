<?php if (in_array($_SESSION['team']['user_id'], $checkers) && $task_status == '2'): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <form class="am-form" action="" method="post">
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-1 am-text-right">
                    任务状态
                </div>
                <div class="am-u-sm-8 am-u-md-4">
                    <select name="task_status" id="task-status">
                        <option value="-1">请选择</option>
                        <option value="3">任务调整</option>
                        <option value="4">任务完成</option>
                    </select>
                </div>
                <div class="am-hide-sm-only am-u-md-6"></div>
            </div>

            <div class="am-g am-margin-top am-hide" id="check-explain">
                <div class="am-u-sm-4 am-u-md-1 am-text-right">
                    任务补充
                </div>
                <div class="am-u-sm-8 am-u-md-8">
                    <!--编辑器的JS代码存放于Task_view.php-->
                    <script type="text/plain" id="content" style="height:240px;"></script>
                    <!--编辑器的JS代码存放于Task_view.php-->
                </div>
                <div class="am-hide-sm-only am-u-md-6"></div>
            </div>

            <div class="am-g am-margin-top am-hide" id="check-annex">
                <div class="am-u-sm-4 am-u-md-1 am-text-right">
                    补充附件
                </div>
                <div class="am-u-sm-8 am-u-md-4">
                    <div id="uploader">
                        <div id="task_fileList" class="uploader-list"></div>

                        <div id="task_file" style="margin-top: 10px;">选择文件</div>
                    </div>
                </div>
                <div class="am-hide-sm-only am-u-md-6"></div>
            </div>

            <div class="am-g am-margin-top am-hide" id="check-submit">
                <div class="am-u-sm-4 am-u-md-1 am-text-right">
                    &nbsp;
                </div>
                <div class="am-u-sm-8 am-u-md-5">
                    <button type="submit" class="am-btn am-btn-primary">审核任务</button>
                </div>
                <div class="am-hide-sm-only am-u-md-6"></div>
            </div>

        </form>
        <hr />
    </div>
    <script>
        jQuery(function () {

            var $ = jQuery,
                    $list = $('#task_fileList'),
                    // Web Uploader实例
                    uploader;

            // 初始化Web Uploader
            uploader = WebUploader.create({
                // 自动上传。
                auto: true,
                // swf文件路径
                swf: '../../dist/Uploader.swf',
                // 文件接收服务端。
                server: '/index.php?g=Team&m=Upload&a=file',
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#task_file',
                    multiple: false
                },
                duplicate: true
            });

            // 当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {
                var $li = $(
                        '<div id="' + file.id + '" class="file-item">' +
                        '<div class="info">' + file.name + '</div>' +
                        '</div>'
                        )
                $list.html($li).fadeOut(3000);
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                        $percent = $li.find('.progress span');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<p class="progress"><span></span></p>')
                            .appendTo($li)
                            .find('span');
                }

                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on('uploadSuccess', function (file, response) {
                if (response.status == '200') {
                    var rand = Math.round(Math.random() * 10000 * Math.random());
                    $("#task_fileList").before('<dt class="form-text" id="' + rand + 'task_file">Upload File \'' + file.name + '\' : <input type="text" class="form-text-input input-leng3" name="file[]" value="' + response.info + '" /><a href="javascript:;" onclick="removeUploadFile(\'' + rand + 'task_file\')" class="blue-button" style="margin-left:5px;" >删除</a></dt>')

                    var $li = $('#' + file.id),
                            $success = $li.find('div.success');

                    // 避免重复创建
                    if (!$success.length) {
                        $success = $('<div class="success"></div>').appendTo($li);
                    }

                    $success.text('上传成功');

                } else {
                    var $li = $('#' + file.id),
                            $error = $li.find('div.error');

                    // 避免重复创建
                    if (!$error.length) {
                        $error = $('<div class="error"></div>').appendTo($li);
                    }
                    $list.html($error.text(response.info));
                }
            });

            // 文件上传失败，现实上传出错。
            uploader.on('uploadError', function (file) {
                var $li = $('#' + file.id),
                        $error = $li.find('div.error');

                // 避免重复创建
                if (!$error.length) {
                    $error = $('<div class="error"></div>').appendTo($li);
                }
                $list.html($error.text('上传失败'));
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').remove();
            });

            $("#task-status").on("change", function () {
                var status = $(this).val();
                if (status == '3') {
                    $("#check-explain, #check-annex, #check-submit").removeClass("am-hide");
                } else if (status == '4') {
                    $("#check-explain, #check-annex").addClass("am-hide");
                    $("#check-submit").removeClass("am-hide");
                } else {
                    $("#check-explain, #check-annex, #check-submit").addClass("am-hide");
                }
            })

        });
    </script>
<?php endif; ?>
