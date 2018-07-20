<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>

    <h1 class="am-text-center" style="color: #fff"><?= $title; ?></h1>
    <input name="passwd" class="am-form-field" type="text" placeholder="登录用的密码" required>

    <input name="repasswd" class="am-form-field am-margin-top" type="text" placeholder="确认密码" required>

    <div class="am-form-group am-margin-top">
        <input type="text" name="verify" class="am-inblock am-input am-padding-xs" placeholder="验证码" required>
        <img src="<?= $label->url('Team-Login-verify'); ?>" class="refresh-verify">
    </div>
    <button class="am-btn am-radius am-btn-primary am-btn-block">提交</button>
</form>
