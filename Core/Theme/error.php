<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?></title>
        <style>
            body {
                font-family: Arial;
                color: #333;
                font-size: 16px;
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
            .wrap{
                width: 650px;
                margin: 0 auto;
                padding-top: 10%;
                background: url('/Theme/error.png') no-repeat 450px 95%;
            }
            .error_cont{
                margin-top: 20px;
            }
            .error_cont p{
                margin-top: 10px;
            }
            .copyright{
                margin-top: 20px;
                padding-bottom: 40px;
                color: #0066CC;
            }
            .copyright a{
                color: #0066CC;
            }
            .footer{
                clear: both;
                height: 20px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div id="error_tips">
                <h1><?php echo $title; ?></h1>
                <div class="error_cont">
                    <?php if (!empty($db->errorInfo)): ?>
                        <p><?php echo $errorSql; ?></p>
                        <p><?php echo $errorSqlString; ?></p>
                    <?php endif; ?>
                    <p><?php echo $errorMes; ?></p>
                    <p><?php echo $errorFile ?></p>
                </div>
                <div class="copyright">
                    <p>Power by <a href="http://www.pescms.com" target="brank">PESCMS</a></p>
                </div>
                <?php if (!empty($sql)): ?>
                    <p><b>Last Exec SQL:</b><br />
                        <textarea style=" width: 600px;height: 130px;"><?= $sql ?></textarea>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer"></div>
    </body>
</html>