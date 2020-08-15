    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('ログアウト'), ['action' => 'logout']) ?></li>
            <li>
                <?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users','action' => 'index']) ?>
            </li>
            <li>
                <?= $this->Html->link(__('ユーザー追加'), ['controller' => 'Users','action' => 'add']) ?>
            </li>
            <li>
                <!-- お知らせを投稿する。UsersControllerに移動 -->
                <?= $this->Html->link(__('お知らせ投稿'), ['controller' => 'Posts','action' => 'post']) ?>
            </li>
        </ul>
    </nav>

    <!-- ソート用 -->

    <div class="posts index large-9 medium-8 columns content">
        <h3><?= __('投稿記事 管理画面') ?></h3>
        <table border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('post_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>

            <!-- 投稿一覧 -->

            <tbody>

                <?php foreach ($posts as $post): ?>

                <tr>
                    <td><?= $this->Number->format(h($post->post_id)) ?></td>
                    <td><?= h($post->body) ?></td>
                    <td><?= h($post->created) ?></td>
                    <td><?= h($post->modified) ?></td>
                    <td class="actions">
                        <!-- $postには、テーブルのレコードがカラムごと入っているので、$post->カラム名というふうに書く。 -->
                        <?= $this->Html->link(__('詳細'), ['action' => 'view', $post->post_id]) ?>
                        <?= $this->Html->link(__('修正'), ['action' => 'edit', $post->post_id]) ?>

                        <!-- 削除前の確認ダイアログを追加。 -->
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $post->post_id], 
                        ['confirm' => __('# {0} の投稿を削除してよろしいですか？ ', $post->post_id)]) ?>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- ページネーション -->

        <!-- 2ページ以上あれば、ページネーションを表示する。 -->
        <?php if($this->Paginator->total() > 1): ?>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p>
                <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
            </p>
        </div>

        <?php endif ?>
    </div>