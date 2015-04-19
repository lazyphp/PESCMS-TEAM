<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post" data-am-validator>
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="user_id" value="<?= $user_id ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">
                    <?php if (ACTION == 'action'): ?>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                用户组
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <select name="user_group_id" id="user-group-id" required>
                                    <option value="">请选择</option>
                                    <?php foreach ($groupList as $key => $value) : ?>
                                        <option value="<?= $value['user_group_id']; ?>" <?= $user_group_id == $value['user_group_id'] ? 'selected="selected"' : '' ?>><?= $value['user_group_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填，选择对应的用户组，赋予不同的权限</div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                所属部门
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <select name="user_department_id" id="user-group-id" required>
                                    <option value="">请选择</option>
                                    <?php foreach ($department as $key => $value) : ?>
                                        <option value="<?= $value['department_id']; ?>" <?= $user_department_id == $value['department_id'] ? 'selected="selected"' : '' ?>><?= $value['department_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                        </div>
                    <?php endif; ?>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            会员帐号
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="user_account" value="<?= $user_account ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            会员密码
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="user_password" value="" <?= $method == 'POST' ? 'required' : '' ?> >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"><?= $method == 'POST' ? '' : '为空则不修改密码' ?></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            确认密码
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="confirm_password" value="" <?= $method == 'POST' ? 'required' : '' ?> >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            邮箱地址
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="email" class="am-input-sm" name="user_mail" value="<?= $user_mail ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            姓名
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="user_name" value="<?= $user_name ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>
                    
                    <?php if (ACTION == 'action'): ?>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                状态
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <div class="am-btn-group" data-am-button>
                                    <label class="am-btn am-btn-default am-btn-xs <?= $user_status == '1' ? 'am-active' : '' ?>">
                                        <input type="radio" name="user_status" value="1" <?= $user_status == '1' ? 'checked="checked"' : '' ?> required> 是
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs <?= $user_status == '0' ? 'am-active' : '' ?>">
                                        <input type="radio" name="user_status" value="0" <?= $user_status == '0' ? 'checked="checked"' : '' ?>> 否
                                    </label>
                                </div>
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Team-User-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>