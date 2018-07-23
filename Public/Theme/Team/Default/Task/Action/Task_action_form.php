<?php foreach ($field as $key => $value) : ?>
    <?php if ($value['field_name'] == 'content' && ACTION == 'view') : continue; ?>
    <?php elseif ($value['field_form']): ?>
        <div class="am-g am-g-collapse">
            <div class="am-u-sm-12 am-u-sm-centered">
                <div class="am-form-group">
                    <label class="am-block"><?= $value['field_display_name'] ?><?= $value['field_required'] == '1' ? '<i class="am-text-danger">*</i>' : '' ?></label>
                    <?= $form->formList($value); ?>
                    <?php if (!empty($value['field_explain'])): ?>
                        <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                            <i class="am-icon-lightbulb-o"></i> <?= $value['field_explain'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($value['field_name'] == 'priority'): ?>
            <div class="task-action-custom">
                <?php include 'Task_action_custom.php' ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
<?php endforeach; ?>