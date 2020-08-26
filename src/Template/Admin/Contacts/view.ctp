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
            <th scope="row"><?= __('対応者氏名') ?></th>
            <!-- 対応者ID(user_id)が入っている場合、usernameを表示させる。 こうしないとidが入っていない時にエラーになってしまう。-->
            <?php if(isset($contact->user_id)): ?>
            <td><?= h($contact->user->username) ?></td>
            <?php else: ?>
            <td></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row"><?= __('対応ステータス') ?></th>
            <td>
                <?= $this->Form->control('flag', 
                [
                'options' => $contact->flagLabelsForJapanese,
                'label' => '',
                ]) ?>
            </td>
        </tr>
    </table>
    <!-- ログインしているユーザーのidをuser_idに入れる。 -->

    <?= $this->Form->hidden( 'user_id' ,['value'=> $login_user_id ]) ; ?>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br>
    <?= $this->Html->link(('戻る'),
        ['controller' => 'contacts','action' => 'index']) ?>
    <br>
</div>
<br>