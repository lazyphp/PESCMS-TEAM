<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PESCMS,PESCMS TEAM,开源的任务管理软件,团队任务管理,团队执行情况,协同办公软件,GPL任务管理软件">
    <meta name="keywords" content="PESCMS TEAM是一款以GPLv2协议进行开源的团队任务管理系统">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= !empty($title) ? "{$title} - " : '' ?><?= $system['siteTitle'] ?? 'PESCMS Team' ?></title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- Tile icon for Win8 (144x144 + tile color) -->

    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/amazeui.min.css?v=<?=$resources?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/admin.css?v=<?=$resources?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/app.css?v=<?=$resources?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/ui-dialog.css?v=<?=$resources?>">
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/amazeui.datetimepicker.css?v=<?=$resources?>">

    <script>
        var PESCMS_URL = 'https://www.pescms.com';
        var PESCMS_PATH = '<?= DOCUMENT_ROOT; ?>';
    </script>

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.min.js?v=<?=$resources?>"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js?v=<?=$resources?>"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.ie8polyfill.min.js?v=<?=$resources?>"></script>
    <![endif]-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/dialog-plus-min.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/amazeui.datetimepicker.min.js?v=<?=$resources?>"></script>

    <!--加载百度编辑器-->
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.config.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/ueditor.all.js?v=<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/ueditor/lang/zh-cn/zh-cn.js?v=<?=$resources?>"></script>
    <!--加载百度编辑器-->

    <!--百度上传控件-->
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/webuploader.css?=v<?=$resources?>"/>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/webuploader.js?=v<?=$resources?>"></script>
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/AMUIwebuploader.js?=v<?=$resources?>"></script>
    <script>
        $(function(){
            $.webuploaderConfig({
                server:'<?=$label->url(GROUP.'-Upload-ueditor', ['method' => 'POST', 'action' => 'uploadimage'])?>'
            });
        })
    </script>
    <!--百度上传控件-->

    <!--拾色器-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/spectrum.js?v=<?=$resources?>"></script>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/spectrum.css?v=<?=$resources?>"/>
    <!--拾色器-->

    <!--图片放大器-->
    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.fancybox.min.js?v=<?=$resources?>"></script>
    <link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/jquery.fancybox.min.css?v=<?=$resources?>"/>
    <!--图片放大器-->

    <script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/app.js?v=<?=$resources?>"></script>
</head>
<body>