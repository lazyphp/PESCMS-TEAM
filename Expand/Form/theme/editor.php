<script type="text/plain" id="<?= $field['field_name']; ?>" style="width:1000px;height:240px;"><?= htmlspecialchars_decode($field['value']) ?></script>
<script>
    var checkEditor = ['<?= implode("', '", $checkEditor) ?>'];
    var checkEditorName = ['<?= implode("', '", $checkEditorName) ?>'];
    $(function () {
        var um<?= $field['field_name']; ?> = UM.getEditor('<?= $field['field_name']; ?>', {
            textarea: '<?= $field['field_name']; ?>'
        });
    })

</script>