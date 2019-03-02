<div class="comment comment-form">
	<form method="POST">
		<input type="hidden" name="post_id" value="<?= $post->id ?>">
		<input type="text" name="nickname" placeholder="暱稱" required><br>
		<textarea name="comment" placeholder="回應" required></textarea>
		<div class="button-wrapper">
			<button class="form-button" type="submit">發佈送出</button>
		</div>
	</form>
</div>
