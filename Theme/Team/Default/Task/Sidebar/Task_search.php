<form action="" class="admin-sidebar-panel" method="GET">
    <div class="am-input-group">
        <input type="hidden" name="g" value="<?= GROUP; ?>"/>
        <input type="hidden" name="m" value="<?= MODULE; ?>"/>
        <input type="hidden" name="a" value="<?= ACTION; ?>"/>
        <input type="hidden" name="status" value="<?= $_GET['status']; ?>"/>
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>"/>
        <input type="text" name="k" class="am-form-field" placeholder="查看任务" value="<?= htmlspecialchars($_GET['k']); ?>"/>
        <span class="am-input-group-btn">
        <button class="am-btn am-btn-default" type="submit"><span class="am-icon-search"></span></button>
        </span>
    </div>
</form>