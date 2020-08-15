<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->control('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
    <?= $this->Html->link(__('ログイン画面へ'), ['action' => 'login']) ?>
    <br>
    <?= $this->Html->link(__('ユーザー一覧へ'), ['action' => 'index']) ?>
    <br>

    <?= $this->Form->end() ?>
</div>