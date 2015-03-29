<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>提示信息</title>
        <style>
            body {
                font-family: Arial;
                color: #333;
                font-size: 12px;
                background: #f3f3f3;
                line-height: 1.5;
                _width: 98%;
                overflow-x: hidden;
                overflow-y: auto;
            }
            html, body, div, dl, dt, dd, ul, p, th, td, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, 
            legend {
                margin: 0;
                padding: 0;
            }
            .wrap {
                padding: 20px 20px 70px;
            }
            #error_tips{
                border:1px solid #d4d4d4;
                background:#fff;
                -webkit-box-shadow: #ccc 0 1px 5px;
                -moz-box-shadow: #ccc 0 1px 5px;
                -o-box-shadow:#ccc 0 1px 5px;
                box-shadow: #ccc 0 1px 5px;
                width:500px;
                margin:50px auto;
            }
            #error_tips h2{
                font:bold 14px/40px Arial;
                height:40px;
                padding:0 20px;
                color:#666;
            }

            #error_tips h2{
                background:#f9f9f9;
                background-repeat: no-repeat;
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), color-stop(25%, #ffffff), to(#f4f4f4));
                background-image: -webkit-linear-gradient(#ffffff, #ffffff 25%, #f4f4f4);
                background-image: -moz-linear-gradient(top, #ffffff, #ffffff 25%, #f4f4f4);
                background-image: -ms-linear-gradient(#ffffff, #ffffff 25%, #f4f4f4);
                background-image: -o-linear-gradient(#ffffff, #ffffff 25%, #f4f4f4);
                background-image: linear-gradient(#ffffff, #ffffff 25%, #f4f4f4);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f4f4f4', GradientType=0);
                border-bottom:1px solid #dfdfdf;
            }

            .error_cont{
                padding:20px 20px 30px 80px;
                background:url(/Theme/Admin/img/admin/tips/light.png) 20px 20px no-repeat;
                line-height:1.8;
            }
            .error_return{
                padding:10px 0 0 0;
            }
            .btn {
                color: #333;
                background: #e6e6e6 url(/Theme/Admin/img/content/btn.png);
                border: 1px solid #c4c4c4;
                border-radius: 2px;
                text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
                padding: 4px 10px;
                display: inline-block;
                cursor: pointer;
                font-size: 100%;
                line-height: normal;
                text-decoration: none;
                overflow: visible;
                vertical-align: middle;
                text-align: center;
                zoom: 1;
                white-space: nowrap;
                font-family: inherit;
                _position: relative;
                margin: 0;
            }
        </style>

    </head>
    <body>
        <div class="wrap">
            <div id="error_tips">
                <h2>信息提示</h2>
                <div class="error_cont">
                    <?php if ($message): ?>
                        <ul>
                            <li><?php echo($message); ?></li>
                        </ul>
                        <p class="jump">
                            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
                        </p>
                    <?php else: ?>
                        <ul>
                            <li><?php echo($error); ?></li>
                        </ul>
                        <p class="jump">
                            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
                        </p>
                    <?php endif; ?>
                    <div class="error_return">
                        <a href="<?php echo($jumpUrl); ?>" class="btn">确认</a></div>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            (function() {
                var wait = document.getElementById('wait'), href = document.getElementById('href').href;
                var interval = setInterval(function() {
                    var time = --wait.innerHTML;
                    if (time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    }
                    ;
                }, 1000);
            })();
        </script>
    </body>
</html>