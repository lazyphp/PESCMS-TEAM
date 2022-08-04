<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <?= $label->token() ?>
    <div class="login-input">
        <input name="account" class="" type="text" placeholder="账号"  required>
        <span>账户</span>
    </div>

    <div class="login-input">
        <input name="passwd" class="" type="password" placeholder="密码" required>
        <span>密码</span>
    </div>

    <button class="am-btn am-radius am-btn-primary am-btn-block am-btn-xs am-margin-bottom-xs">登录</button>

    <a href="<?= $label->url('Team-Login-findPassword'); ?>" class="am-text-sm">忘记密码?</a>

    <?= (new \Core\Plugin\Plugin())->event('OAuth2', NULL); ?>

</form>
