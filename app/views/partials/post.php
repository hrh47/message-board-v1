<div class="post card">
	<div>
		<p>
			<span class="post-author"><?= $post->nickname; ?></span> · 
			<span class="moment-format"><?= $post->timestamp; ?></span>
		</p>
		<p><?= $post->content; ?></p>
	</div>
	<div class="comment-list">
		<?php $comments = $post->comments(); ?>

		<?php foreach ($comments as $comment) : ?>
			<?php require('comment.php'); ?>
		<?php endforeach ?>
	</div>
	<?php require('comment_form.php'); ?>

</div>