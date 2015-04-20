<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>登录系统 - <?= $sitetile; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico">
        <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/amazeui.min.css"/>
        <!--[if (gte IE 9)|!(IE)]><!-->
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/jquery.min.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/amazeui.min.js"></script>
        <!--<![endif]-->
        <style>
            .header {
                text-align: center;
            }
            .header h1 {
                font-size: 200%;
                color: #333;
                margin-top: 30px;
            }
            .header p {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="am-g">
                <h1><?= $sitetile; ?></h1>
                <p>一款开源的任务管理系统<br />The open source task management system</p>
            </div>
            <hr />
        </div>
        <div class="am-g">
            <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

                <form class="am-form" action="<?= $label->url('Team-Login-dologin'); ?>" method="post" data-am-validator>
                    <label for="account">帐号:</label>
                    <input type="text" name="account"  value="" required>
                    <br>
                    <label for="password">密码:</label>
                    <input type="password" name="password"  value="" required>
                    <br>
                    <br />
                    <div class="am-cf">
                        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                        <?php if ($signup == '1'): ?>
                            <a href="<?= $label->url('Team-Login-signup'); ?>" class=" am-fr am-btn am-btn-primary am-btn-sm am-fl">注 册</a>
                        <?php endif; ?>
                    </div>
                </form>
                <hr>
                <p>效率从任务管理开始</p>
            </div>
        </div>
    </body>
</html>