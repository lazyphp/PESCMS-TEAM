<div id="bulletin" class="am-offcanvas" >
    <div class="am-offcanvas-bar am-padding-0">
        <div class="am-offcanvas-content bulletin-content am-padding-0">
        </div>
    </div>
</div>
<?php if(!empty(\Core\Func\CoreFunc::session()->get('team')) && \Core\Func\CoreFunc::session()->get('team')['user_id'] == 1 ): ?>
<script>
    $(function(){
        var version  = '<?= $system['version'] ?>';
        var timestamp = Date.parse( new Date());

        //获取本地存储
        var important = parseInt(localStorage.getItem('important'));
        var close_important = parseInt(localStorage.getItem('close_important'));
        var record_version = localStorage.getItem('version');
        var check_time = localStorage.getItem('check_time');

        //检查是否需要弹窗重要更新提示框
        if(important == 1 && close_important != 1 && record_version == version ){
            var alter_str = '<div class="am-alert am-alert-warning am-margin-0 am-text-sm" data-am-alert><button type="button" class="am-close close-important">&times;</button>' +
                '当前系统有一个重要更新发布，点击 <a href="<?= $label->url(GROUP.'-Setting-upgrade') ?>" style="color:blue">这里</a> 查看' +
                '</div>';
            $('header').before(alter_str);
        }

        /**
         * 判断本地存储的版本号与程序版本号是否一致
         * 判断上次检查更新时间记录是否大于1天
         */
        if(record_version != version && check_time<= timestamp){
            $.getJSON(PESCMS_URL+'/patch/2/<?= $system['version'] ?>', function(data){
                if(data.status == 200){
                    if(data.data.important == 1){
                        localStorage.setItem('important', '1')
                    }
                    localStorage.setItem('version', version);
                    localStorage.removeItem('close_important')
                }
            }).complete(function(){
                localStorage.setItem('check_time', timestamp + 86400000);
            })
        }

        $('body').on('click', '.close-important', function(){
            localStorage.setItem('close_important', '1')
        })

    })
</script>
<?php endif; ?>

<script>
    $(function (){
        /**
         * PESCMS软件存活统计
         * 本请求只记录软件使用者存活情况，不会将您的服务器信息发给PESCMS，请放心使用。
         * 本请求只会在每个月的第一次访问时记录，且仅记录当前使用者的浏览器信息发给PESCMS服务器。
         */

        var survivalDate = localStorage.getItem('survivalDate');

        var recordSurvival = function (){
            //这是基于前端ajax跨域请求，因此并不会将软件部署的服务器信息发给PESCMS。
            $.post(PESCMS_URL + '/?g=Api&m=Statistics&a=survival&method=POST', {id: '2'}, function () {
            }, 'JSON')
        }

        var month = new Date().getMonth() + 1;
        if(survivalDate == null) {
            localStorage.setItem('survivalDate', month);
        } else {
            if(survivalDate != month){
                localStorage.setItem('survivalDate', month);
                recordSurvival();
            }
        }
    })
</script>

<?php $label->footerEvent() ?>
</body>
</html>