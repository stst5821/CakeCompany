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