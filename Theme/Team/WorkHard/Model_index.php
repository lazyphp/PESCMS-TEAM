<!-- content start -->
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?= $title; ?></strong> / <small>列表</small></div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="<?= $label->url('Model-action'); ?>" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-input-group am-input-group-sm">
                <input type="text" class="am-form-field">
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="button">搜索</button>
                </span>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" /></th>
                            <th class="table-id">ID</th>
                            <th class="table-title">模型表名</th>
                            <th class="table-type">模型名称</th>
                            <th class="table-set">状态</th>
                            <th class="table-set">搜索</th>
                            <th class="table-set">模型属性</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $value) : ?>
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td><?= $value['model_id']; ?></td>
                                <td><?= $value['model_name']; ?></td>
                                <td><?= $value['lang_key']; ?></td>
                                <td><?= $label->status($value['status']); ?></td>
                                <td><?= $label->isSearch($value['is_search']); ?></td>
                                <td><?= $label->modelAttr($value['model_attr']); ?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-success" href="<?= $label->url('Model-fieldList', array('id' => $value['model_id'])); ?>"><span class="am-icon-paperclip"></span> 字段管理</a>
                                            <a class="am-btn am-btn-secondary" href="<?= $label->url('Model-action', array('id' => $value['model_id'])); ?>"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                            <a class="am-btn am-btn-danger" href="<?= $label->url('Model-action', array('id' => $value['model_id'], 'method' => 'DELETE')); ?>"><span class="am-icon-trash-o"></span> 删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </form>
        </div>

    </div>
</div>
<!-- content end -->