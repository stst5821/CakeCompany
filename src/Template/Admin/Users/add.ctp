<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('ユーザーを追加') ?></legend>
        <?= $this->Form->control('username', ['label' => 'ユーザー名']) ?>
        <?= $this->Form->control('password', ['label' => 'パスワード']) ?>
        <?= $this->Form->control('role', [
            'options' => 
            ['admin' => '管理者', 'staff' => '一般'],
            ['label' => '権限']
        ]) ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>

    <?= $this->Form->end() ?>
</div>