<div class="am-padding-xs am-padding-top-0">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

<form class="am-form am-form-horizontal ajax-submit" action="<?= $url; ?>" method="post" data-am-validator>
    <?= $label->token(); ?>
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
                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 不需要添加http://或者https://前缀。常见的邮件服务商smtp地址：<a href="https://www.pescms.com/d/v/1.0/10/56.html#%E5%B8%B8%E8%A7%81%E9%82%AE%E4%BB%B6%E6%9C%8D%E5%8A%A1%E5%95%86%E5%9C%B0%E5%9D%80" target="_blank" style="color: blue">查看</a>
                </div>
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
                <label class="am-block">邮件发送名称<i class="am-text-danger">*</i></label>
                <input name="mail[formname]" placeholder="" type="text" value="<?= empty($mail['formname']) ? 'system' : $mail['formname']; ?>" required="">
                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 用户查收邮件时看到的发送人名称，默认为system。
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">邮件发送测试</label>
                <input type="email" class="test_email am-inline" style="width: 20%">
                <a href="javascript:;" data="<?= $label->url(GROUP.'-Setting-emailTest') ?>" type="submit" class="am-inline am-btn am-btn-warning email-test" >发送测试邮件</a>
                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 请先保存邮件smtp的设置，再进行邮件发送测试。
                </div>
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
        </div>
    </div>
</div>
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/spectrum.js?v.2.1.0"></script>
<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/spectrum.css?v.2.1.0"/>
<script>
    $(".custom").spectrum({
        preferredFormat: "hex",
        showInput: true
    });
    $(function(){
        $('.email-test').on('click', function(){
            var email = $('.test_email').val();
            var url = $(this).attr('data')
            if(email == ''){
                return false;
            }
            window.open(url + '&email='+email);
            return false;
        })
    })
</script>
