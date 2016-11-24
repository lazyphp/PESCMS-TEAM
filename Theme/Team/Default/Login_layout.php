<?php include THEME_PATH.'/header.php' ?>
<div class="am-g " style="padding-top: 200px;">
    <div class="am-u-lg-4 am-u-sm-10  am-u-lg-centered am-u-sm-centered">
        <?php include $file ?>
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
