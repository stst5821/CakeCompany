<?php
/**
 * @var \app\View\AppView $this
 * @var \app\Model\Entity\Post[] $posts
 */
?>

<div class="content">
	<?php foreach ($posts as $post) : ?>
   		<h3><?=$post->title?></h3>
		<p><?=$post->description?></p>
		<hr>
	<?php endforeach; ?>

</div>