<?php include THEME_PATH.'/header.php' ?>
<div class="am-g " style="padding-top: 200px;">
    <div class="am-u-lg-4 am-u-sm-10  am-u-lg-centered am-u-sm-centered">
        <form action="" class="ajax-submit" method="POST" data-am-validator>
            <input type="hidden" name="back_url" value="<?= $_GET['back_url']; ?>"/>
            <h1 class="am-text-center" style="color: #fff">PESCMS Team</h1>
            <input name="account" class="am-form-field" type="text" placeholder="账号" required>
            <input name="passwd" class="am-form-field" type="password" placeholder="密码" required>
            <button class="am-btn am-btn-primary am-btn-block">提交</button>
        </form>
    </div>
</div>
<style>
    html, body{
        -moz-background-size:100% 100%;
        background-size:cover;
    }
</style>
<script>
    $(function(){
        $("html, body").css('background' ,'url(<?=$bing?>)');
    })
</script>
<?php include THEME_PATH.'/footer.php' ?>
