<?php if (in_array($_SESSION['team']['user_id'], $eligible) && !empty($diary)): ?>
    <div class="am-u-sm-12 am-u-sm-centered">
        <ul class="am-comments-list am-comments-list-flip">
            <?php foreach ($diary as $key => $value) : ?>
                <li class="am-comment">
                    <a href="#link-to-user-home">
                        <img src="<?= $label->findUser('user', 'user_id', $task_user_id)['user_head']; ?>" alt="" class="am-comment-avatar" width="48" height="48"/>
                    </a>

                    <div class="am-comment-main">
                        <header class="am-comment-hd">
                            <div class="am-comment-meta">
                                <a href="javascript:;" class="am-comment-author"><?= $label->findUser('user', 'user_id', $task_user_id)['user_name']; ?></a>
                                发表于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800"><?= date('Y-m-d', $value['diary_time']); ?></time>
                            </div>
                        </header>

                        <div class="am-comment-bd">
                            <?= htmlspecialchars_decode($value['diary_content']); ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <hr/>
    </div>
<?php endif; ?>
