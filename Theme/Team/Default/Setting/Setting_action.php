<div class="admin-content am-padding am-padding-top-0">

    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

    <form class="am-form am-form-horizontal" action="<?= $url; ?>" method="post" data-am-validator>
        <input type="hidden" name="method" value="PUT"/>
        <ul class="am-list am-list-static am-list-border am-text-sm">
            <li style="background: #F5f6FA;border-left: 4px solid #6d7781;">基础信息</li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">当前版本</label>

                    <div class="am-u-sm-9">
                        <a class="am-btn am-btn-sm am-btn-warning" href="<?= $label->url('Team-Setting-upgrade') ?>"><i class="am-icon-refresh"></i> <?= $version['value'] ?></a>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">上传图片格式</label>

                    <div class="am-u-sm-9">
                        <textarea name="upload_img"><?= implode(',', $upload_img) ?></textarea>

                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 填写您要支持的图片格式，英文逗号分隔。
                        </div>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">上传文件格式</label>

                    <div class="am-u-sm-9">
                        <textarea name="upload_file"><?= implode(',', $upload_file) ?></textarea>

                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 填写您要支持的文件格式，英文逗号分隔。
                        </div>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li style="background: #F5f6FA;border-left: 4px solid #6d7781;">邮件通知</li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">邮箱账号</label>

                    <div class="am-u-sm-9">
                        <input name="mail[account]" placeholder="" type="text" value="<?= $mail['account']; ?>"
                               required="">
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">邮箱密码</label>

                    <div class="am-u-sm-9">
                        <input name="mail[passwd]" placeholder="" type="password" value="<?= $mail['passwd']; ?>"
                               required="">
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">SMTP地址</label>

                    <div class="am-u-sm-9">
                        <input name="mail[address]" placeholder="" type="text" value="<?= $mail['address']; ?>"
                               required="">
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">SMTP端口</label>

                    <div class="am-u-sm-9">
                        <input name="mail[port]" placeholder="" type="text" value="<?= $mail['port']; ?>" required="">
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <label for="" class="am-u-sm-2 am-form-label">邮件发送方式</label>

                    <div class="am-u-sm-9">
                        <label class="am-radio-inline">
                            <input type="radio" value="1" name="notice_way"
                                   required="" <?= $notice_way['value'] == '1' ? 'checked="checked"' : '' ?>> 被动触发
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="2" name="notice_way"
                                   required="" <?= $notice_way['value'] == '2' ? 'checked="checked"' : '' ?>> 定时器触发
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="3" name="notice_way"
                                   required="" <?= $notice_way['value'] == '3' ? 'checked="checked"' : '' ?>> 两者兼有
                        </label>
                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> 详细说明参考: <a href="http://www.pescms.com/d/v/10/56" target="_blank" style="color: #0e90d2">点击我</a>
                        </div>
                    </div>
                    <div class="am-u-sm-1">
                        <span class="am-badge am-round am-badge-danger">必填</span>
                    </div>
                </div>
            </li>

            <li>
                <div class="am-g">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="submit" id="btn-submit" class="am-btn am-btn-primary am-btn-xs"
                                data-am-loading="{spinner: 'circle-o-notch', loadingText: '提交中...', resetText: '再次提交'}">
                            保存设置
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</div>
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/spectrum.js"></script>
<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/spectrum.css"/>
<script>
    $(".custom").spectrum({
        preferredFormat: "hex",
        showInput: true
    });
</script>
