<div>
    <h3>お問い合わせ検索</h3>
    <?= $msg ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->input('find'); ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </fieldset>
    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>customer_name</th>
                <th>mail</th>
                <th>body</th>
                <th>received</th>
                <th>modified</th>
                <th>username</th>
                <th>flag</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= h($contact->id) ?></td>
                <td><?= h($contact->customer_name) ?></td>
                <td><?= h($contact->mail) ?></td>
                <td><?= h($contact->body) ?></td>
                <td><?= h($contact->received) ?></td>
                <td><?= h($contact->modified) ?></td>
                <?php if(isset($contact->user->username)) : ?>
                <td><?= h($contact->user->username) ?></td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>
                <td><?= h($contact->flagLabel) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>