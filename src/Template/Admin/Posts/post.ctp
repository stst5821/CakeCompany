<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('投稿一覧'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="posts form large-9 medium-8 columns content">

    <!-- 最初のフォームタグを生成する。 -->
    <?= $this->Form->create($post, [
    'type' => 'post',
    'url' => ['controller' => 'Posts', 'action' => 'post'],
  ]); ?>

    <fieldset>
        <legend><?= __('新規投稿') ?></legend>
        <?php
            echo $this->Form->control('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('投稿する！')) ?>
    <?= $this->Form->end() ?>
</div>