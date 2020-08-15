<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('ログアウト'), ['action' => 'logout']) ?></li>
        <li><?= $this->Html->link(__('投稿一覧に戻る'), ['action' => 'index']) ?></li>
    </ul>
</nav>

<div class="users view large-9 medium-8 columns content">
    <h3><?= h($post->id) ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('post_id') ?></th>
            <td><?= h($post->post_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('body') ?></th>
            <td><?= h($post->body) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($post->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($post->modified) ?></td>
        </tr>
    </table>
</div>