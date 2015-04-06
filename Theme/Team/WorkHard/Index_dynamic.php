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
            <ul class="am-pagination am-pagination-centered am-text-sm">
                <?= $page; ?>
            </ul>
        </div>
    </div>
</div>
<!-- content end -->