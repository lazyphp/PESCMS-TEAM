<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $sitetile; ?></title>
        <meta name="keywords" content="user">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="<?= DOCUMENT_ROOT ?>/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="PESCMS TEAM" />
        <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/amazeui.min.css"/>
        <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/admin.css">
        <link rel="stylesheet" type="text/css" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/webuploader.css" />
        <link rel="stylesheet" type="text/css" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/jquery.datetimepicker.css" />
        <!--[if (gte IE 9)|!(IE)]><!-->
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/jquery.min.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/amazeui.min.js"></script>
        <!--<![endif]-->
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/app.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/team.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/webuploader.js"></script>
        <script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/jquery.datetimepicker.js"></script>
    </head>
    <body <?= MODULE == 'Index' && ACTION == 'index' ? 'class="am-with-fixed-header"' : '' ?>>
        <!--[if lte IE 9]>
        <p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
          以获得更好的体验！</p>
        <![endif]-->