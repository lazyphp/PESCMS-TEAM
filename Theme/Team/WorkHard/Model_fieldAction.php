<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>后台菜单</small></div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post">
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="field_id" value="<?= $field_id ?>" />
        <input type="hidden" name="model_id" value="<?= $modelId ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            字段类型
                        </div>
                        <div class="am-u-sm-8 am-u-md-3">
                            <select name="field_type" id="menu-pid" <?= $method == 'PUT' ? 'disabled="disabled"' : '' ?>>
                                <option value="-1">请选择</option>
                                <?php foreach ($fieldTypeList as $key => $value) : ?>
                                    <option value="<?= $key; ?>" <?= $field_type == $key ? 'selected="selected"' : '' ?>><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            字段名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="field_name" value="<?= $field_name ?>" <?= $method == 'PUT' ? 'disabled="disabled"' : '' ?>>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，仅限英文下划线</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            显示名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="display_name" value="<?= $display_name ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            字段选项值
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <textarea rows="4" name="field_option" ><?= $label->fieldOption($field_option); ?></textarea>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">选填， <?= $GLOBALS['_LANG']['MODEL']['FIELD_OPTION_TIPS']; ?></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            字段默认值
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="field_default" value="<?= $field_default ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">是否必填项</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $field_required == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="field_required" value="1" <?= $field_required == '1' ? 'checked="checked"' : '' ?>> 是
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $field_required == '0' ? 'am-active' : '' ?>">
                                    <input type="radio" name="field_required" value="0" <?= $field_required == '0' ? 'checked="checked"' : '' ?>> 否
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">字段状态</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $field_status == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="field_status" value="1" <?= $field_status == '1' ? 'checked="checked"' : '' ?>> 前台
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $field_status == '0' ? 'am-active' : '' ?>">
                                    <input type="radio" name="field_status" value="2" <?= $field_status == '0' ? 'checked="checked"' : '' ?>> 后台
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            字段排序
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="field_listsort" value="<?= $field_listsort ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Model-fieldList', array('id' => $modelId)); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>
<!-- content end -->