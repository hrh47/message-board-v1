<div class="comment">
	<p>
		<span class="comment-author"><?= $comment->nickname ?></span> · 
		<span class="moment-format"><?= $comment->timestamp; ?></span>
	</p>				
	<p><?= $comment->content; ?></p>
</div>