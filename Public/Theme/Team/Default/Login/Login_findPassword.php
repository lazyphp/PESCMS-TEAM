<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>

    <h1 class="am-text-center" style="color: #fff"><?= $title; ?></h1>
    <input name="mail" class="am-form-field" type="email" placeholder="邮箱地址" required>

    <div class="am-form-group am-margin-top">
        <input type="text" name="verify" class="am-inline am-input am-padding-xs am-form-field" placeholder="验证码" required style="width: 44%">
        <img src="<?= $label->url('Team-Login-verify'); ?>" class="refresh-verify">
    </div>
    <button class="am-btn am-btn-primary am-btn-block">提交</button>
    <a href="<?= $label->url('Team-Login-index'); ?>" class="am-btn am-btn-success am-btn-block">返回登录</a>
</form>
