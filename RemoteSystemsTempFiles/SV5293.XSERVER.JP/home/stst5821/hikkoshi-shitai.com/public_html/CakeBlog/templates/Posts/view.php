<?php
/**
 * @var \app\View\AppView $this
 * @var \app\Model\Entity\Post $post
 */
?>


<h1><?= h($post->title) ?></h1>
<p><?= nl2br(h($post->body)) ?></p>
