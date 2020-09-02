<div id="container">
    <div id="contents">
        <section>
            <h2>お問い合わせ</h2>

            <div class="users form large-9 medium-8 columns content">
                <?= $this->Form->create($contact) ?>

                <table class="ta1">
                    <tr>
                        <th>お名前※</th>
                        <td><?= $this->Form->control('customer_name', ['label' => '']) ?></td>
                    </tr>
                    <tr>
                        <th>メールアドレス※</th>
                        <td><?= $this->Form->control('mail', ['label' => '']) ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせ詳細※</th>
                        <td><?= $this->Form->control('body', ['label' => '']) ?></td>
                    </tr>
                </table>
                <?= $this->Form->button(__('Submit')) ?>


                <?= $this->Form->end() ?>
        </section>

    </div>
    <!--/#contents-->