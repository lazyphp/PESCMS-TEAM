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
        <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            部门名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="name" value="<?= $department_name ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            部门负责人
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <div id="department-user">
                                <?php foreach (explode(',', $department_header) as $key => $value) : ?>
                                    <?php if (!empty($value)): ?>
                                        <a href="javascript:;" data="<?= $value ?>" class="remove-department-user" ><i class="am-icon-user"></i><span> <?= $findUser[$value]; ?></span></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" class="am-input-sm" name="header" value="<?= $department_header ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填，点击移除负责人</div>
                    </div>
                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            <i class="am-icon-plus-square"></i>
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <select id="add-departmengt-user">
                                <option value="0">请添加</option>
                                <?php foreach ($user as $key => $value) : ?>
                                    <?php if ($value['user_department_id'] == $id): ?>
                                        <option value="<?= $value['user_id']; ?>"><?= $value['user_name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            排序
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="listsort" value="<?= $department_listsort ?>" >
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Team-department-index'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>