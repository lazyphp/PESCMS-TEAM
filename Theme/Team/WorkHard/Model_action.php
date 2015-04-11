<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post">
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="model_id" value="<?= $modelId ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            模型名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="model_name" value="<?= $model_name ?>" <?= $method == 'POST' ? '' : 'disabled="disabled"' ?>>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            显示名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="display_name" value="<?= $lang_key; ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">允许搜索</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $is_search == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="is_search" value="1" <?= $is_search == '1' ? 'checked="checked"' : '' ?>> 是
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $is_search == '0' ? 'am-active' : '' ?>">
                                    <input type="radio" name="is_search" value="0" <?= $is_search == '0' ? 'checked="checked"' : '' ?>> 否
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">模型属性</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $model_attr == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="model_attr" value="1" <?= $model_attr == '1' ? 'checked="checked"' : '' ?>> 前台
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $model_attr == '2' ? 'am-active' : '' ?>">
                                    <input type="radio" name="model_attr" value="2" <?= $model_attr == '2' ? 'checked="checked"' : '' ?>> 后台
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">模型状态</div>
                        <div class="am-u-sm-8 am-u-md-10">
                            <div class="am-btn-group" data-am-button>
                                <label class="am-btn am-btn-default am-btn-xs <?= $status == '1' ? 'am-active' : '' ?>">
                                    <input type="radio" name="status" value="1" <?= $status == '1' ? 'checked="checked"' : '' ?>> 启用
                                </label>
                                <label class="am-btn am-btn-default am-btn-xs <?= $status == '0' ? 'am-active' : '' ?>">
                                    <input type="radio" name="status" value="0" <?= $status == '0' ? 'checked="checked"' : '' ?>> 禁用
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Model-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>
<!-- content end -->