<?php include THEME_PATH . '/Content/Content_action_header.php' ?>
<?php include THEME_PATH . '/Content/Content_action_hidden.php' ?>
<?php include THEME_PATH . '/Content/Content_action_form.php' ?>


<script>
    $(function(){
        var user = <?= $user ?>;
        var head = '<?= $department_header ?>';
        var department_head = head.split(",");
        var select = '<option value="" disabled="disabled">请选择</option>';

        $.each(user, function(key, val){
            var selected = "";

            if(department_head){
                $.each(department_head, function(index, value){
                    if(value == val.user_id){
                        selected = 'selected="selected"';
                    }
                })
            }

            select += '<option value="'+val.user_id+'" '+selected+' >'+val.user_name+'</option>';
        })
        $('input[name=header]').after('<select name="header[]" multiple style="background:none">'+select+'</select>').remove();

    })
</script>
<?php include THEME_PATH . '/Content/Content_action_footer.php' ?>