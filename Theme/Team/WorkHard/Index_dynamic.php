<!-- content start -->
<div class="admin-content">
    <div class="am-cf am-padding">

    </div>

    <div class="am-g">

        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-md-4">
                            <img class="am-img-circle am-img-thumbnail" src="<?= $_SESSION['team']['user_head']; ?>" alt=""/>
                        </div>
                        <div class="am-u-md-8">
                            <p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p>
                            <form class="am-form">
                                <div class="am-form-group">
                                    <input type="file" id="user-pic">
                                    <p class="am-form-help">请选择要上传的文件...</p>
                                    <button type="button" class="am-btn am-btn-primary am-btn-xs">保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="user-info">
                        <p>等级信息</p>
                        <div class="am-progress am-progress-sm">
                            <div class="am-progress-bar" style="width: 60%"></div>
                        </div>
                        <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong> 距离下一级别：<strong>160</strong></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <?php if ($_SESSION['team']['user_group_id'] == '1'): ?>
                <div class="am-alert am-alert-warning am-text-sm" data-am-alert>
                    <button type="button" class="am-close">&times;</button>
                    <p><i class="am-icon-warning am-padding-right-xs"></i>已经发布了新版，现在更新吗？<a href="<?= $label->url('Team-Setting-upgrade'); ?>" onclick="return confirm('更新前请自行备份程序，避免数据丢失，确认更新吗？')">马上更新</a> 注：只有管理员组才看到本消息</p>
                </div>
            <?php endif; ?>

            <!--快速发表报表-->
            <form action="<?= $label->url('Team-Report-action'); ?>" method="POST">
                <article class="am-comment">
                    <a href="javascript:;" >
                        <img src="<?= $label->findUser('user', 'user_id', $_SESSION['team']['user_id'])['user_head']; ?>" alt="" class="am-comment-avatar am-margin-top" width="48" height="48"/>
                    </a>

                    <div class="am-comment-bd">
                        <script type="text/plain" id="content" style="height:100px;"></script>
                        <div class="gradient-bg">
                            <button type="submit" class="am-btn am-btn-primary" id="submit-diary">提交报表</button>
                        </div>
                    </div>
                </article>
            </form>
            <!--快速发表报表-->
            <p class="am-text-xs am-link-muted" style="margin-left: 5.3rem;">注：提交多次报表，系统将自动整合为当天的报表，请尽情提交吧。任务日志也会自动纳入当天报表的。</p>
            <hr />

            <!--用户动态-->
            <ul class="am-comments-list am-comments-list-flip">
                <?php foreach ($list as $key => $value) : ?>
                    <li class="am-comment <?= $key % '2' != 0 ? 'am-comment-flip' : ''; ?> ">
                        <a href="#link-to-user-home">
                            <img src="<?= $label->findUser('user', 'user_id', $value['user_id'])['user_head']; ?>" alt="" class="am-comment-avatar" width="48" height="48"/>
                        </a>

                        <div class="am-comment-main <?= $key % '2' != 0 ? 'am-text-right' : ''; ?> ">
                            <div class="am-padding-top-xs am-padding-bottom-xs am-padding-left-sm am-padding-right-sm  am-text-sm">
                                <a href="javascript:;" class="am-text-secondary"><?= $label->findUser('user', 'user_id', $value['user_id'])['user_name']; ?></a>
                                <?= sprintf($label->dynamicType($value['dynamic_type']), '<a href="' . $label->url('Team-Task-view', array('id' => $value['task_id'])) . '">' . $value['task_title'] . '</a>'); ?>
                                <?= $label->timing($value['dynamic_time']); ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!--用户动态-->
            <ul class="am-pagination am-pagination-centered am-text-sm">
                <?= $page; ?>
            </ul>
        </div>
    </div>
</div>
<style>
    .edui-container{
        border:none !important;
        box-shadow:none !important;
        border-top: 1px solid #d4d4d4 !important;
        border-left: 1px solid #d4d4d4 !important;
        border-right: 1px solid #d4d4d4 !important;
        /*border-bottom: 0px solid #d4d4d4 !important;*/
    }
    .gradient-bg{
        background-color: #f8f8f8;
        border: 1px solid #d4d4d4;
    }
</style>
<script>
    $(function () {
        var umcontent = UM.getEditor('content', {
            toolbar: [
                'source | undo redo | bold italic underline strikethrough | removeformat selectall cleardoc | image'
            ],
            textarea: 'content',
            imageUrl: "/index.php/?g=Team&m=Upload&a=img",
            initialFrameWidth: '100%'
        })

    })
</script>
<link href="/Expand/Form/theme/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Expand/Form/theme/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Expand/Form/theme/umeditor/lang/zh-cn/zh-cn.js"></script>
<!-- content end -->