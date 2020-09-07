    <table border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('img') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>

        <?php foreach($services as $service): ?>

        <tr>
            <td>
                <?= h($service->id) ?>
            </td>
            <td>
                <?= h($service->title) ?>
            </td>
            <td>
                <?= h($service->body) ?>
            </td>
            <td>
                <?= h($service->user_id) ?>
            </td>
            <td>
                <?= h($service->img) ?>
            </td>
            <td>
                <?= h($service->created) ?>
            </td>
            <td>
                <?= h($service->modified) ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('詳細'), ['action' => 'view', $service->id]); ?>
                <?= $this->Html->link(__('修正'), ['action' => 'edit', $service->id]); ?>
                <?= $this->Html->link(__('削除'), ['action' => 'delete', $service->id],
                                                    ['confirm'=> __('ID：{0} の投稿を削除してよろしいですか？ ', $service->id)]); ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>

    <div class="paginator">
        <ul class="pagination">
            <li><?= $this->Paginator->first('<< ' . __('最初のページへ')) ?></li>
            <li><?= $this->Paginator->prev('< ' . __('前へ')) ?></li>
            <li><?= $this->Paginator->numbers() ?></li>
            <li><?= $this->Paginator->next(__('次へ') . ' >') ?></li>
            <li><?= $this->Paginator->last(__('最後へ') . ' >>') ?></li>
        </ul>
        <p>
            <?= $this->Paginator->counter(['format' => __(' {{page}} ページ目(全 {{pages}}ページ)')]) ?>
        </p>
    </div>