<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <?= $label->token() ?>

    <div class="login-input">
        <input name="mail" class="" type="email" placeholder="邮箱地址"  required>
        <span>邮箱地址</span>
    </div>

    <div class="login-input">
        <input name="verify" maxlength="4" class="" type="text" placeholder="验证码"  required>
        <span>验证码</span>
        <img src="<?= $label->url('Team-Login-verify', ['height' => 38]); ?>" class="refresh-verify" >
    </div>



    <button class="am-btn am-radius am-btn-primary am-btn-block am-btn-xs am-margin-bottom-xs">提交</button>

    <a href="<?= $label->url('Team-Login-index'); ?>" class="am-text-sm am-text-danger"><<返回登录</a>
</form>
