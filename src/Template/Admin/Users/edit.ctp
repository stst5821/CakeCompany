<?= $this->Form->create($user,['type' => 'file']) ?>
<fieldset>
    <legend><?= __('Edit User') ?></legend>
    <?= $this->Form->control('username', ['label' => 'ログインID　']); ?>
    <?= $this->Form->control('password', ['label' => 'パスワード　']); ?>
    <?php if ($user->icon): ?>
    <img src="\webroot\upload_img\<?= h($user->icon) ?>">

    <!-- すでに登録されている画像をhiddenで保持して処理する。 -->
    <?= $this->Form->input("file_before",["type"=>"hidden",
                                                "value"=>$user->icon]); ?>
    <?= $this->Form->input("delete",["type"=>"submit",
                                        "name"=>"file_delete",
                                        "value"=>"delete"]); ?>
    <?php endif; ?>
    <?= $this->Form->control('icon', ["type"=>"file",'label' => 'アイコン画像']); ?>



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