<div>
    <h3>お問い合わせ検索</h3>
    <?= $msg ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->input('find',['label' => '検索文字']); ?>
        <?= $this->Form->control('flag', [
                'options' => ['' => '',CONTENTS__FLAG__NOT_YET => '未対応', CONTENTS__FLAG__DONE => '対応済'],
                'label' => '対応ステータス',
                ]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </fieldset>

    <table border="1">
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <!-- IDをクリックすると、そのIDのView画面に飛ぶ。 -->
                <td><?= $this->Html->link(h($contact->id),['controller' => 'contacts','action' => 'view',h($contact->id)]) ?>
                </td>
                <td><?= h($contact->customer_name) ?></td>
                <td><?= h($contact->mail) ?></td>
                <td><?= h($contact->body) ?></td>
                <td><?= h($contact->received) ?></td>
                <td><?= h($contact->modified) ?></td>

                <!-- 対応ステータスを対応済に変えるまで、usernameは入らないためそのまま表示させるとエラーになる。
                そのため、if(isset)で値が入っていれば表示するようにしている。 -->
                <?php if(isset($contact->user->username)) : ?>
                <td><?= h($contact->user->username) ?></td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>

                <!-- そのままだと対応ステータスに「Done」「NotYet」と表示されてしまうので、if文で未対応と対応済と表示するようにしている。 -->
                <?php if(($contact->flagLabel) == 'NotYet') : ?>
                <td>未対応</td>
                <?php else: ?>
                <td>対応済</td>
                <?php endif; ?>
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