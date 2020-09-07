    <div id="contents">

        <section>

            <h2>SERVICE</h2>

            <?php foreach($services as $service): ?>
            <tr>
                <div class="list">
                    <h4><?= h($service->title) ?></h4>
                    作成日：<?= h($service->created) ?>
                    更新日：<?= h($service->modified) ?>
                    <p><?= h($service->body) ?></p>
                </div>
            </tr>
            <?php endforeach; ?>


            <div class="paginator">
                <ul class="pagination">
                    <li><?= $this->Paginator->first('<< ' . __('最初のページへ')) ?></li>
                    <li><?= $this->Paginator->prev('< ' . __('前へ')) ?></li>
                    <li><?= $this->Paginator->numbers() ?></li>
                    <li><?= $this->Paginator->next(__('次へ') . ' >') ?></li>
                    <li><?= $this->Paginator->last(__('最後へ') . ' >>') ?></li>
                </ul>
                <p>
                    <?= $this->Paginator->counter(['format' => __(' {{page}} ページ目(全 {{pages}}ページ)')]) ?>
                </p>
            </div>

        </section>

    </div>