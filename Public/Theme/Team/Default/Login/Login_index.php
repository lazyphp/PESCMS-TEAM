<form action="" class="ajax-submit" method="POST" data-am-validator>
    <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
    <h1 class="am-text-center" style="color: #fff">PESCMS Team</h1>
    <input name="account" class="am-form-field" type="text" placeholder="账号" required>
    <input name="passwd" class="am-form-field" type="password" placeholder="密码" required>
    <button class="am-btn am-radius am-btn-primary am-btn-block">提交</button>
    <a href="<?= $label->url('Team-Login-findPassword'); ?>" class="am-btn am-radius am-btn-warning am-btn-block am-margin-0">重置密码</a>
</form>