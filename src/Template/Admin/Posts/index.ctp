<!-- ソート用 -->

<div class="posts index large-9 medium-8 columns content">
    <h3><?= __('投稿記事 管理画面') ?></h3>
    <table border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                <th scope="col"><?= $this->Paginator->sort('userid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>

        <!-- 投稿一覧 -->

        <tbody>

            <?php foreach ($posts as $post): ?>

            <tr>
                <td><?= $this->Number->format(h($post->id)) ?></td>
                <td><?= h($post->body) ?></td>
                <td><?= h($post->user_id) ?></td>
                <td><?= h($post->created) ?></td>
                <td><?= h($post->modified) ?></td>
                <td class="actions">
                    <!-- $postには、テーブルのレコードがカラムごと入っているので、$post->カラム名というふうに書く。 -->
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $post->id]) ?>

                    <!-- adminでログインしていれば修正可能にし、staffでログインしている場合は、修正不可にする。 -->
                    <?php if (!IS_SUDO): ?>
                    修正
                    <?php else: ?>
                    <?= $this->Html->link(__('修正'), ['action' => 'edit', $post->id]) ?>
                    <?php endif ?>

                    <!-- adminでログインしていれば削除可能にし、staffでログインしている場合は、削除不可にする。 -->
                    <?php if (!IS_SUDO): ?>
                    削除
                    <?php else: ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $post->id], 
                    // 削除前の確認ダイアログを追加
                        ['confirm' => __('# {0} の投稿を削除してよろしいですか？ ', $post->id)]) ?>
                    <?php endif ?>
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