<div class="users form large-9 medium-8 columns content">
    <fieldset>
        <?= $this->Form->create() ?>
        <table>
            <tr>
                <td>タイトル：</td>
                <td><?= $this->Form->control('title', ['type' => 'text','label' => '']) ?></td>
            </tr>
            <tr>
                <td>本文：</td>
                <td><?= $this->Form->control('body', ['type' => 'textarea','label' => '']) ?></td>
            </tr>
            <tr>
                <td><?= $this->Form->submit(); ?></td>
            </tr>
        </table>
        <?= $this->Form->end() ?>
    </fieldset>
</div>