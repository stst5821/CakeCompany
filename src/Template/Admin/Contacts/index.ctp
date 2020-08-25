<!-- ソート用 -->

<div class="posts index large-9 medium-8 columns content">
    <h3><?= __('お問い合わせ 管理画面') ?></h3>
    <table border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name', '顧客氏名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail', 'メールアドレス') ?></th>
                <th scope="col"><?= $this->Paginator->sort('body', '問合せ内容') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received', '受信日時') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', '対応完了日時') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id', '対応者名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag', '対応ステータス') ?></th>
                <th scope="col" class="actions"><?= __('操作') ?></th>
            </tr>
        </thead>

        <!-- 投稿一覧 -->
        <tbody>

            <?php foreach ($contacts as $contact): ?>

            <!-- trのクラスをflagLabelにすることで、doneのときはbgcolorをグレーにしている。 -->
            <tr class="<?= h($contact->flagLabel) ?>">
                <td><?= h($contact->id) ?></td>
                <td><?= h($contact->customer_name) ?></td>
                <td><?= h($contact->mail) ?></td>
                <td><?= h($contact->body) ?></td>
                <td><?= h($contact->received) ?></td>
                <td><?= h($contact->modified) ?></td>

                <!-- flagをdoneに変更したスタッフ名をuserカラムに入れる。 -->
                <!-- flagがdoneなら、userカラムにusernameを表示させる。それ以外なら何も表示しない。-->
                <?php if($contact->flag == CONTENTS__FLAG__DONE) : ?>
                <td><?= h($contact->user->username) ?></td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>

                <?php if(($contact->flagLabel) == 'NotYet') : ?>
                <td>未対応</td>
                <?php else: ?>
                <td>対応済</td>
                <?php endif; ?>

                <td class="actions">
                    <!-- $postには、テーブルのレコードがカラムごと入っているので、$post->カラム名というふうに書く。 -->
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $contact->id]) ?>
                    <!-- <?= $this->Html->link(__('修正'), ['action' => 'edit', $contact->id]) ?> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- ページネーション -->

    <!-- 2ページ以上あれば、ページネーションを表示する。 -->
    <?php if($this->Paginator->total() > 1): ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p>
            <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
        </p>
    </div>

    <?php endif ?>
</div>