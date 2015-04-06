<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>登录系统 - PESCMS TEAM</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="/favicon.ico">
        <link rel="stylesheet" href="/Theme/Team/WorkHard/assets/css/amazeui.min.css"/>
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
                <h1>PESCMS任务管理系统</h1>
                <p>一款企业居家旅行 炒人鱿鱼必备良器<br />Fired lazy staff prerequisite software</p>
            </div>
            <hr />
        </div>
        <div class="am-g">
            <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

                <form class="am-form" action="<?= $label->url('Team-Login-dologin'); ?>" method="post">
                    <label for="account">帐号:</label>
                    <input type="text" name="account" id="email" value="">
                    <br>
                    <label for="password">密码:</label>
                    <input type="password" name="password" id="password" value="">
                    <br>
                    <br />
                    <div class="am-cf">
                        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                        <a href="<?= $label->url('Team-Login-signup'); ?>" class=" am-fr am-btn am-btn-primary am-btn-sm am-fl">注 册</a>
                    </div>
                </form>
                <hr>
                <p>您今天炒了员工没有？</p>
            </div>
        </div>
    </body>
</html>