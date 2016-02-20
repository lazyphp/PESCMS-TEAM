<div class="admin-content am-padding am-padding-top-0 am-padding-bottom-0">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">新任务</strong>
        </div>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
<form action="<?= $label->url('Team-Task-action'); ?>" class="am-form ajax-submit am-margin-bottom" method="POST" data-am-validator>

    <?php foreach ($field as $key => $value) : ?>
        <?php if ($value['field_form']): ?>
            <div class="am-g">
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
                <?php include 'Task_action_custom.php' ?>
            <?php endif; ?>

        <?php endif; ?>
    <?php endforeach; ?>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered"><button type="submit" class="am-btn am-btn-success">发布任务</button></div>
    </div>
</form>
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/team.js"></script>