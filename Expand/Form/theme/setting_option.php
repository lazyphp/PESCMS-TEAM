<?php
$option = json_decode($field['field_option'] ?? null, true);

?>
<?php if(is_array($option)): ?>
<div class="setting-option">
    <?php foreach($option as $key => $name): ?>
    <label class="am-block am-margin-vertical-sm"><?= $name ?></label>
    <input class="form-text-input input-leng3 am-radius am-field-valid" name="<?= $field['field_name'] ?>[<?= $key ?>]" placeholder="<?= $key ?>" type="text" value="<?= $field['value'][$key] ?? '' ?>" <?= $field['field_required'] == 1 ? 'required=""' : '' ?>>
    <?php endforeach; ?>
</div>
<?php endif; ?>