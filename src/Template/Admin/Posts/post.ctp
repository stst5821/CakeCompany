    <!-- 最初のフォームタグを生成する。 -->
    <?= $this->Form->create($post, [
    'type' => 'post',
    'url' => ['controller' => 'Posts', 'action' => 'post'],
  ]); ?>

    <fieldset>
        <legend><?= __('新規投稿') ?></legend>
        <?php
            echo $this->Form->control('body', [
                'label' => '本文',
                'class' => 'posts_body'
                ]);
        ?>

    </fieldset>
    <?= $this->Form->hidden( 'user_id' ,['value'=> $login_user_id ]) ; ?>
    <?= $this->Form->button(__('投稿する！')) ?>
    <?= $this->Form->end() ?>
    </div>