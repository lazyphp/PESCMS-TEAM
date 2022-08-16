<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <?= $label->token() ?>

    <div class="login-input">
        <input name="passwd" class="" type="password" placeholder="新密码" required>
        <span>新密码</span>
    </div>

    <div class="login-input">
        <input name="repasswd" class="" type="password" placeholder="确认密码" required>
        <span>确认密码</span>
    </div>

    <div class="login-input">
        <input name="verify" maxlength="4" class="" type="text" placeholder="验证码"  required>
        <span>验证码</span>
        <img src="<?= $label->url('Team-Login-verify', ['height' => 38]); ?>" class="refresh-verify" >
    </div>

    <button class="am-btn am-radius am-btn-primary am-btn-block am-btn-xs am-margin-bottom-xs">确认重置</button>
</form>
