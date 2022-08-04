<div class="admin-sidebar-panel am-panel am-panel-default">
    <div class="am-panel-hd">个人资料</div>
    <div class="am-panel-bd">
        <img src="<?= $label->getImg($user_head); ?>" class="am-img-thumbnail">
        <table class="am-table am-table-compact am-margin-0">
            <tr>
                <td class="am-text-right"><i class="am-icon-envelope"></i></td>
                <td class="am-text-left"><?= $user_mail; ?></td>
            </tr>
            <tr>
                <td class="am-text-right"><i class="am-icon-phone"></i></td>
                <td class="am-text-left"><?= $user_phone; ?></td>
            </tr>
            <tr>
                <td class="am-text-right"><i class="am-icon-legal"></i></td>
                <td class="am-text-left"><?= $label->findContent('department', 'department_id', $user_department_id)['department_name']; ?></td>
            </tr>
        </table>
    </div>
</div>