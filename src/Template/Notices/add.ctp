<div id="contents">

    <section>
        <!-- フォームの開始タグ -->
        <?= $this->Form->create() ?>

        <!-- 入力フィールド -->
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('created');
            echo $this->Form->input('description');
        ?>

        <!-- 送信タグ -->
        <?= $this->Form->button('Submit') ?>

        <!-- フォームの閉じタグ -->
        <?= $this->Form->end() ?>

    </section>

</div>