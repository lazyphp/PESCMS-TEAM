<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>核能设置</small></div>
    </div>
    <form class="am-form" action="" method="post">
        <input type="hidden" name="method" value="PUT" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            系统版本
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <?= $setting['version']['value']; ?>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            程序标题
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="sitetitle" value="<?= $setting['sitetitle']['value']; ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            开启注册
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $setting['signup']['value'] == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="signup" value="1" <?= $setting['signup']['value'] == '1' ? 'checked="checked"' : '' ?>> 开启注册
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $setting['signup']['value'] == '0' ? 'am-active' : '' ?>">
                                    <input type="radio" name="signup" value="0" <?= $setting['signup']['value'] == '0' ? 'checked="checked"' : '' ?>> 关闭注册
                                </label>
                            </div>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>


                    <h2>上传配置</h2>
                    <hr />

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            上传图片格式
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="upload_img" value="<?= implode(',', json_decode($setting['upload_img']['value'], true)); ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            上传文件格式
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="upload_file" value="<?= implode(',', json_decode($setting['upload_file']['value'], true)); ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <h2>邮件配置</h2>
                    <hr />

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            邮箱帐号
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="mail[account]" value="<?= json_decode($setting['mail']['value'], true)['account'] ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            邮箱密码
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="mail[passwd]" value="<?= json_decode($setting['mail']['value'], true)['passwd'] ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            SMTP地址
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="mail[address]" value="<?= json_decode($setting['mail']['value'], true)['address'] ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            SMTP端口
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="mail[port]" value="<?= json_decode($setting['mail']['value'], true)['port'] ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            邮件触发方式
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= json_decode($setting['mail']['value'], true)['trigger'] == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="mail[trigger]" value="1" <?= json_decode($setting['mail']['value'], true)['trigger'] == '1' ? 'checked="checked"' : '' ?>> 被动触发
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= json_decode($setting['mail']['value'], true)['trigger'] == '2' ? 'am-active' : '' ?>">
                                    <input type="radio" name="mail[trigger]" value="2" <?= json_decode($setting['mail']['value'], true)['trigger'] == '2' ? 'checked="checked"' : '' ?>> 定时器触发
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= json_decode($setting['mail']['value'], true)['trigger'] == '3' ? 'am-active' : '' ?>">
                                    <input type="radio" name="mail[trigger]" value="3" <?= json_decode($setting['mail']['value'], true)['trigger'] == '3' ? 'checked="checked"' : '' ?>> 两者兼有
                                </label>
                            </div>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*详情请参考<a href="">文档</a></div>
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