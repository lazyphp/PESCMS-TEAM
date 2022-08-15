<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <?= $label->token() ?>
    <div class="am-input-group am-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
        <input name="account" class="am-form-field" type="text" placeholder="账号" autofocus required>
    </div>

    <div class="am-input-group am-margin-bottom">
        <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
        <input name="passwd" class="am-form-field" type="password" placeholder="密码" required>
    </div>

    <button class="am-btn am-radius am-btn-primary am-btn-block am-margin-bottom">登录</button>

<!--    <button class="am-btn am-radius am-btn-primary am-btn-block">提交</button>-->
    <a href="<?= $label->url('Team-Login-findPassword'); ?>" class="am-text-sm">忘记密码?</a>
</form>