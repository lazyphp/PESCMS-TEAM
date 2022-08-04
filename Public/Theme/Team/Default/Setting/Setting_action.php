<div class="admin-content am-padding-xs am-padding-top-0 am-padding-bottom-0">

    <form class="am-form am-form-horizontal ajax-submit" action="" method="post" data-am-validator>
        <?= $label->token() ?>
        <input type="hidden" name="method" value="PUT">

        <?php foreach ($option as $subtitle => $item): ?>
            <div class="am-panel am-panel-default">
                <header class="am-panel-hd ">
                    <h3 class="am-margin-vertical-0"><?= $subtitle ?></h3>
                </header>
                <div class="am-panel-bd">
                    <?php foreach ($item as $key => $value): ?>
                        <div class="am-g am-g-collapse">
                            <div class="am-u-sm-12 am-u-sm-centered">
                                <div class="am-form-group">
                                    <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                                    <?= $form->formList($value); ?>
                                    <?php if (!empty($value['field_explain'])): ?>
                                        <div class="am-alert am-alert-warning">
                                            <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="am-g am-g-collapse am-margin-bottom">
            <div class="am-u-sm-12 am-u-sm-centered">
                <button type="submit" class="am-btn am-btn-primary am-btn-xs am-radius" ><i class="am-icon-save"></i> 提交保存</button>
            </div>
        </div>

    </form>

    <script>
        $(function (){
            $(function () {
                $('.mail_test').on('click', function () {
                    var email = $('input[name="mail_test"]').val();
                    var url = $(this).attr('data')
                    if (email == '') {
                        return false;
                    }
                    window.open(url + '&email=' + email);
                    return false;
                })
            })
        })
    </script>

</div>