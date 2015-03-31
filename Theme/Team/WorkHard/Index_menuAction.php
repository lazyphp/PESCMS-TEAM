<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>后台菜单</small></div>
    </div>
    <form class="am-form" action="<?= $url; ?>" method="post">
        <input type="hidden" name="method" value="<?= $method ?>" />
        <input type="hidden" name="menu_id" value="<?= $menu_id ?>" />
        <div class="am-tabs am-margin">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active">
                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">所属类别</div>
                        <div class="am-u-sm-8 am-u-md-3">
                            <select name="menu_pid" id="menu-pid">
                                <option value="-1">请选择</option>
                                <option value="0">顶层菜单</option>
                                <?php foreach ($topMenu as $key => $value) : ?>
                                    <option value="<?= $value['menu_id']; ?>" <?= $menu_pid == $value['menu_id'] ? 'selected="selected"' : '' ?>><?= $value['menu_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            菜单名称
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="menu_name" value="<?= $menu_name ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>

                    <div class="am-g am-margin-top" id="menu-url">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            菜单链接地址
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="menu_url" value="<?= $menu_url ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填</div>
                    </div>
                    
                    <div class="am-g am-margin-top" id="menu-url">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            菜单ICON图标
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="menu_icon" value="<?= $menu_icon ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6">*必填,查看<a href="http://amazeui.org/1.x/css/icon/" target="_blank">图标</a></div>
                    </div>

                    <div class="am-g am-margin-top">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            排序
                        </div>
                        <div class="am-u-sm-8 am-u-md-4">
                            <input type="text" class="am-input-sm" name="menu_listsort" value="<?= $menu_listsort ?>">
                        </div>
                        <div class="am-hide-sm-only am-u-md-6"></div>
                    </div>

                </div>

            </div>

        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            <a href="<?= $label->url('Index-menuList'); ?>" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
        </div>
    </form>
</div>
<!-- content end -->