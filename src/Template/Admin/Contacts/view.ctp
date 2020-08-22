<div class="users view large-9 medium-8 columns content">
    <h3><?= h($contact->id) ?></h3>

    <?= $this->Form->create($contact) ?>

    <table class="vertical-table">
        <tr>
            <th scope=" row"><?= __('id') ?></th>
            <td><?= h($contact->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('お名前') ?></th>
            <td><?= h($contact->customer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('メールアドレス') ?></th>
            <td><?= h($contact->mail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('お問合せ内容') ?></th>
            <td><?= h($contact->body) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('受信日時') ?></th>
            <td><?= h($contact->received) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('更新日時') ?></th>
            <td><?= h($contact->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('対応者ID') ?></th>
            <td><?= h($contact->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('対応ステータス') ?></th>
            <td>
                <?= $this->Form->control('flag', [
                'options' => $contact->flagLabels,
                'label' => '',
                ]) ?>
            </td>

        </tr>
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>