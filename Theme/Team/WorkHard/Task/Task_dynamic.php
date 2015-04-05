<?php if (in_array($_SESSION['team']['user_id'], $eligible)): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <article class="am-comment">
            <a href="#link-to-user-home">
                <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" alt="" class="am-comment-avatar" width="48" height="48"/>
            </a>

            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                        <a href="javascript:;" class="am-comment-author"><?= $label->findUser('user', 'user_id', $task_user_id)['user_name']; ?></a>
                        发表于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">2014-7-12 15:30</time>
                    </div>
                </header>

                <div class="am-comment-bd">
                    <p>使用 .am-comments-list 包裹多个 .am-comment 即成评论列表。</p>
                    <p>使用 .am-comments-list 包裹多个 .am-comment 即成评论列表。</p>
                    <p>使用 .am-comments-list 包裹多个 .am-comment 即成评论列表。</p>
                </div>
            </div>
        </article>
        <hr/>
    </div>
<?php endif; ?>
