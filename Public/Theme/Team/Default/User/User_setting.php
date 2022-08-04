<div class="admin-content am-padding am-padding-top-0 am-padding-bottom-0">
    <div class="am-cf">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">帐号设置</strong>
        </div>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
<form action="<?= $label->url('Team-User-setting'); ?>" class="am-form ajax-submit am-margin-bottom" method="POST" data-am-validator>
    <input type="hidden" name="method" value="PUT">
    <?= $label->token(); ?>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">名字</label>
                <input type="text" name="name" value="<?= $this->session()->get('team')['user_name'] ?>" required/>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">邮箱地址</label>
                <input type="text" name="mail" value="<?= $this->session()->get('team')['user_mail'] ?>" required/>

                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 填写正确的邮箱，可以实时接收系统通知。
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">电话号码</label>
                <input type="text" name="phone" value="<?= $this->session()->get('team')['user_phone'] ?>"/>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">新密码</label>
                <input type="text" name="password" value=""/>

                <div class="am-alert am-alert-secondary am-text-xs " data-am-alert>
                    <i class="am-icon-lightbulb-o"></i> 为空则不修改密码
                </div>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">个人主页</label>
                <select name="home">
                    <?php foreach (['Team-Index-index' => '仪表盘', 'Team-Task-my' => '我的任务', 'Team-Task-myCard' => '任务看板'] as $key => $value): ?>
                        <option value="<?= $key; ?>" <?= $key == $this->session()->get('team')['user_home'] ? 'selected="selected"' : ''; ?> ><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>


    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <button type="submit" class="am-btn am-radius am-btn-success">保存设置</button>
        </div>
    </div>
</form>


<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
<form action="<?= $label->url('Team-User-head'); ?>" class="am-form am-margin-bottom ajax-submit" method="POST"  data-am-validator>
    <input type="hidden" name="method" value="PUT">
    <?= $label->token(); ?>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="am-form-group">
                <label class="am-block">更换头像</label>
                <div data-am-webuploader-simple="{id:'head', name:'head', pick:{id:'#head'}, content:'<?= $this->session()->get('team')['user_head']; ?>'}"></div>
            </div>
        </div>
    </div>


    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <button type="submit" class="am-btn am-radius am-btn-primary">更新头像</button>
        </div>
    </div>
</form>
<script type='text/javascript'>
    function encodeImageFileAsURL() {

        var filesSelected = document.getElementById("inputFileToLoad").files;
        if (filesSelected.length > 0) {
            var fileToLoad = filesSelected[0];

            var fileReader = new FileReader();

            fileReader.onload = function (fileLoadedEvent) {
                var srcData = fileLoadedEvent.target.result; // <--- data: base64
                var newImage = document.createElement('img');
                newImage.src = srcData;

                $('.am-img-thumbnail').attr('src', newImage.src)

            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }
</script>
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/team.js?v.2.1.0"></script>