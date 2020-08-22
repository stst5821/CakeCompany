<!-- ソート用 -->

<div class="posts index large-9 medium-8 columns content">
    <h3><?= __('お問い合わせ 管理画面') ?></h3>
    <table border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>

        <!-- 投稿一覧 -->
        <tbody>

            <?php foreach ($contacts as $contact): ?>
            <tr class="<?= h($contact->flagLabel) ?>">
                <td><?= $this->Number->format(h($contact->id)) ?></td>
                <td><?= h($contact->customer_name) ?></td>
                <td><?= h($contact->mail) ?></td>
                <td><?= h($contact->body) ?></td>
                <td><?= h($contact->received) ?></td>
                <td><?= h($contact->modified) ?></td>
                <td><?= h($contact->user_id) ?></td>
                <td><?= h($contact->flagLabel) ?></td>
                <td class="actions">
                    <!-- $postには、テーブルのレコードがカラムごと入っているので、$post->カラム名というふうに書く。 -->
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $contact->id]) ?>
                    <!-- <?= $this->Html->link(__('修正'), ['action' => 'edit', $contact->id]) ?> -->
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $contact->id], 
                    // 削除前の確認ダイアログを追加
                        ['confirm' => __('# {0} の投稿を削除してよろしいですか？ ', $contact->id)]) ?>
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