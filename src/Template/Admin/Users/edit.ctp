<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __('Edit User') ?></legend>
    <?= $this->Form->control('username', ['label' => 'ログインID　']); ?>
    <?= $this->Form->control('password', ['label' => 'パスワード　']); ?>
    <?= $this->Form->control('role', [
            'options' => $user->roleLabels,
            'label' => '権限　',
        ]) ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>