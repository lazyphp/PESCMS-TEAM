<select class="input-leng3" name="<?= $field['field_name'] ?>" <?= $field['field_required'] == '1' ? 'required' : '' ?>>
    <option value=""><?= $GLOBALS['_LANG']['COMMON']['PLEASE_SELECT']; ?></option>
    <?= $tree ?>
</select>