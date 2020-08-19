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

    <?php if($user->role == 1 && $count == 1): ?>
    管理者権限を持つユーザーが1人しかいないため、権限は変更できません。
    <?php else: ?>
    <?= $this->Form->control('role', [
            'options' => $user->roleLabels,
            'label' => '権限　',
        ]) ?>
    <?php endif; ?>

</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>