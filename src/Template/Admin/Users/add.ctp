<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('ユーザーを追加') ?></legend>
        <?= $this->Form->control('username', ['label' => 'ユーザー名']) ?>
        <?= $this->Form->control('password', ['label' => 'パスワード']) ?>
        <?= $this->Form->control('icon', ["type"=>"file",'label' => 'アイコン画像']); ?>
        <?= $this->Form->control('role', [
            'options' => $user->roleLabels,
            'label' => '権限　',
        ]) ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>

    <?= $this->Form->end() ?>
</div>