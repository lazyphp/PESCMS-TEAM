<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post" data-am-validator>
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="id" value="<?= $node_id ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">
                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            父类节点
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select name="parent" id="parent" required>
                                <option value="">请选择</option>
                                <option value="0" <?= $node_parent == '0' ? 'selected="selected"' : '' ?> >控制器节点</option>
                                <?php foreach ($parent as $key => $value) : ?>
                                    <option value="<?= $value['node_id']; ?>" <?= $node_parent == $value['node_id'] ? 'selected="selected"' : '' ?>><?= $value['node_title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，请选择正确的节点类型</div>
                    </div>

                    <div class="am-g am-margin-top am-hide" id="method_type">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            操作方法
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select name="method_type" id="user-group-id" required>
                                <option value="">请选择</option>
                                <?php foreach (array('GET', 'POST', 'PUT', 'DELETE') as $key => $value) : ?>
                                    <option value="<?= $value; ?>" <?= $node_method_type == $value ? 'selected="selected"' : '' ?>><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，请选择正确的GPPD请求状态</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            节点名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="title" value="<?= $node_title ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，用于展示本节点的作用</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            节点匹配值
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="value" value="<?= $node_value ?>" required >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，若当前父类节点为控制器，请填写控制器名称。反之填写方法名。区分大小写</div>
                    </div>

                    <div class="am-g am-margin-top am-hide" id="verify">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            是否验证权限
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-form-group">
                            <label class="am-radio-inline">
                                <input type="radio" name="verify" value="1" <?= $node_verify == '1' ? 'checked="checked"' : '' ?> required>是
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" name="verify" value="0" <?= $node_verify == '0' ? 'checked="checked"' : '' ?>>否
                            </label>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，添加节点不开启验证，程序将不检查用户是否有限</div>
                    </div>

                    <div class="am-g am-margin-top am-hide " id="msg">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            验证提示信息
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="msg" value="" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*用户无权访问时，系统显示的提示信息</div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Team-Node-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>
<script>
    $(function() {
        if ($("#parent option:selected").val() > '0') {
            $("#method_type, #verify, #msg").removeClass("am-hide");
        } else {
            $("#method_type, #verify, #msg").addClass("am-hide");
        }
        $("#parent").on("change", function() {
            if ($(this).val() > '0') {
                $("#method_type, #verify, #msg").removeClass("am-hide");
            } else {
                $("#method_type, #verify, #msg").addClass("am-hide");
            }
        })
    })
</script>