<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>后台菜单</small></div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post">
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="id" value="<?= $id ?>" />
        <input type="hidden" name="createtime" value="<?= date('Y-m-d'); ?>"/>
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">
                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            所属项目
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select name="project">
                                <option value="">请选择</option>
                                <?php foreach ($project as $key => $value) : ?>
                                    <option value="<?= $value['project_id']; ?>"><?= $value['project_title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            任务标题
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="title" value="<?= $task_title ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            所属部门
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select id="task-department-id" name="department_id" <?= $method == 'PUT' ? 'disabled="disabled"' : '' ?>>
                                <option value="-1">请选择</option>
                                <?php foreach ($department as $key => $value) : ?>
                                    <option value="<?= $key; ?>" <?= $task_department_id == $key ? 'selected="selected"' : '' ?> data="<?= $_SESSION['team']['user_department_id'] == $key ? '1' : '0'; ?>"  ><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--是否本部门 0本部 1非部门 需要审核 发通知用-->
                            <input type="hidden" name="accept_id" value="" id="task-accept-id" />
                            <!--是否本部门-->
                        </div>
                        <!--显示选择执行用户下拉框-->
                        <div class="am-u-sm-8 am-u-md-2 am-hide-lg" id="task-user-layer">
                            <select name="user_id" id="task-user-id">
                                <option value="">执行用户</option>
                                <?php foreach ($localUser as $key => $value) : ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!--显示选择执行用户下拉框结束-->

                        <div class="am-hide-sm-only am-u-md-6">*必填，非本部门任务需要对应部门负责人审核才生效。</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            任务审核人
                        </div>
                        <div class="am-u-sm-8 am-u-md-4" id="check-user">
                            <a href="javascript:;" type="no" data="<?= $_SESSION['team']['user_id']; ?>" class="remove-check-user" ><i class="am-icon-user"></i><span> <?= $_SESSION['team']['user_name']; ?>(本人)</span></a>
                        </div>
                        <!--任务审核人-->
                        <input type="hidden" name="check_user_id" value="<?= $_SESSION['team']['user_id']; ?>" />
                        <!--任务审核人-->
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>
                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            <i class="am-icon-plus-square"></i>
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select id="add-check-user">
                                <option value="0">请添加</option>
                                <?php foreach ($user as $key => $value) : ?>
                                    <option value="<?= $value['user_id']; ?>"><?= $value['user_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">任务可以添加多人审核</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            任务优先级
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select name="priority">
                                <option value="4">普通</option>
                                <option value="3">主要</option>
                                <option value="2">次要</option>
                                <option value="1">严重</option>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            任务说明
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <script type="text/plain" id="content" style="width:1000px;height:240px;"><?= htmlspecialchars_decode($task_content) ?></script>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            任务附件
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <div id="uploader">
                                <?php if (!empty($task_file)): ?>
                                    <?php foreach (explode(',', $task_file) as $key => $value) : ?>
                                        <div class="form-text" id="<?= $key . "task_file" ?>">
                                            <input type="text" class="form-text-input input-leng3" name="file[]" value="<?= $value ?>" />
                                            <a href="javascript:;" onclick="removeUploadFile('<?= $key . "task_file" ?>')" class="blue-button" style="margin-left:5px;">删除</a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div id="task_fileList" class="uploader-list"></div>

                                <div id="task_file" style="margin-top: 10px;">选择文件</div>
                            </div>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            期望完成时间
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-form-icon">
                            <i class="am-icon-calendar" style="left: 1.625em;"></i>
                            <input type="text" class="am-form-field datetimepicker" name="expecttime" readonly="readonly"/>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            阅读权限
                        </div>
                        <div class="am-u-sm-8 am-u-md-2">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs am-active">
                                    <input type="radio" name="read_permission" value="0" checked="checked" > 关闭
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs">
                                    <input type="radio" name="read_permission" value="1"> 开启
                                </label>
                            </div>
                        </div>
                        <div class="am-hide-sm-only am-u-md-8">*开启阅读权限后，任务仅发起人、审核人和执行者可以查看。</div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Team-User-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
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
    });

    $(function () {
        var umcontent = UM.getEditor('content', {
            textarea: 'content',
            imageUrl: "/index.php/?g=Team&m=Upload&a=img"
        })
    })
</script>
<link href="/Expand/Form/theme/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Expand/Form/theme/umeditor/lang/zh-cn/zh-cn.js"></script>