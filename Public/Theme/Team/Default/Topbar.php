<header class="am-topbar am-topbar-inverse">
    <h1 class="am-topbar-brand">
        <a href="<?= $label->url(empty(\Core\Func\CoreFunc::session()->get('team')['user_home']) ? 'Team-Index-index' : \Core\Func\CoreFunc::session()->get('team')['user_home']); ?>"><?= $system['siteTitle'] ?? 'PESCMS Team' ?></a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#doc-topbar-collapse'}">
        <span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right">
            <li class="<?= !empty($notice) ? 'am-dropdown' : ''; ?>" data-am-dropdown>
                <a href="<?= $label->url('Team-Notice-index') ?>">
                    <i class="am-icon-envelope-o am-icon-sm"></i>
                    <?php if (!empty($notice)): ?>
                        <span class="msg-tips"></span>
                    <?php endif; ?>
                </a>
                <?php if (!empty($notice)): ?>
                    <ul class="am-dropdown-content am-text-sm team-notice-background">
                        <?php foreach ($notice as $value): ?>
                            <li><a href="<?= $label->url('Team-Notice-index', ['type' => $value['notice_type'], 'read' => '0']); ?>"><?= $label->notice($value['notice_type'], $value['number']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
            <?php foreach ($menu as $topValue): ?>
                <?php if (!empty($topValue['menu_child'])): ?>
                    <li class="am-dropdown <?= $topValue == end($menu) ? 'am-dropdown-flip' : '' ?>" data-am-dropdown>
                        <a class="am-dropdown-toggle" href="javascript:;" title="<?= $topValue['menu_name'] ?>" data-am-dropdown-toggle>
                            <i class="<?= $topValue['menu_icon'] ?>"></i> <?= $topValue['menu_name'] ?>
                            <span class="am-icon-caret-down"></span>
                        </a>
                        <ul class="am-dropdown-content">
                            <?php foreach ($topValue['menu_child'] as $value): ?>
                                <li>
                                    <a href="<?= $value['menu_type'] == '0' ? $label->url($value['menu_link']) : $value['menu_link']; ?>" title="<?= $value['menu_name'] ?>"><i class="<?= $value['menu_icon'] ?>"></i> <?= $value['menu_name'] ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $topValue['menu_type'] == '0' ? $label->url($topValue['menu_link']) : $topValue['menu_link'] ?>" title="<?= $topValue['menu_name'] ?>">
                            <i class="<?= $topValue['menu_icon'] ?>"></i> <?= $topValue['menu_name'] ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</header>