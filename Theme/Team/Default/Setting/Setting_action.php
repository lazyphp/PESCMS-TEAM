<div class="admin-content am-padding am-padding-top-0">

    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

<form class="am-form am-form-horizontal ajax-submit" action="<?= $url; ?>" method="post" data-am-validator>
    <input type="hidden" name="method" value="PUT"/>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">当前版本</label>
                <a class="am-btn am-btn-sm am-btn-warning" href="<?= $label->url('Team-Setting-upgrade') ?>"><i class="am-icon-refresh"></i> <?= $version['value'] ?>
                </a>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">程序域名</label>
                <input type="text" name="domain" value="<?= $domain['value'] ?>"/>

                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 域名主要用于发送邮件通知后，便于用户查看邮件时，可跳转至任务系统
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">上传图片格式</label>
                <textarea name="upload_img"><?= implode(',', $upload_img) ?></textarea>

                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 填写您要支持的图片格式，英文逗号分隔。
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">上传文件格式</label>
                <textarea name="upload_file"><?= implode(',', $upload_file) ?></textarea>

                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 填写您要支持的文件格式，英文逗号分隔。
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">邮箱账号</label>
                <input name="mail[account]" placeholder="" type="text" value="<?= $mail['account']; ?>" required="">
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">邮箱密码</label>
                <input name="mail[passwd]" placeholder="" type="password" value="<?= $mail['passwd']; ?>" required="">
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">SMTP地址</label>
                <input name="mail[address]" placeholder="" type="text" value="<?= $mail['address']; ?>" required="">
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">SMTP端口</label>
                <input name="mail[port]" placeholder="" type="text" value="<?= $mail['port']; ?>" required="">
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">邮件发送方式</label>
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
                    <i class="am-icon-lightbulb-o"></i> 详细说明参考:
                    <a href="http://www.pescms.com/d/v/10/56" target="_blank" style="color: #0e90d2">点击我</a>
                </div>
            </div>
        </div>
    </div>

    <div class="am-g am-margin-bottom">
        <div class="am-u-sm-12 am-u-sm-centered">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
        </div>
    </div>
</form>
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/spectrum.js"></script>
<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/spectrum.css"/>
<script>
    $(".custom").spectrum({
        preferredFormat: "hex",
        showInput: true
    });
</script>
