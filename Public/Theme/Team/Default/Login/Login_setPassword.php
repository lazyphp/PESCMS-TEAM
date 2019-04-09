<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <?= $label->token() ?>

    <h1 class="am-text-center" style="color: #fff"><?= $title; ?></h1>

    <div class="am-input-group am-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
        <input type="password" name="passwd" class="am-form-field" placeholder="登录用的密码" required="required">
    </div>

    <div class="am-input-group am-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
        <input type="password" name="repasswd" class="am-form-field" placeholder="确认密码" required="required">
    </div>

    <div class="am-input-group am-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-shield am-icon-fw"></i></span>
        <input type="text" class="am-form-field login-verify" name="verify" placeholder="验证码" maxlength="7" required style="width: 53%;margin-right: 1rem">
        <img src="<?= $label->url('Team-Login-verify', ['height' => 38]); ?>" class="refresh-verify" >
    </div>

    <button class="am-btn am-radius am-btn-primary am-btn-block">提交</button>
</form>
