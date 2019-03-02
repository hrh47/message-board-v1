<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $title ? $title . ' - 留言板' : '留言板' ?></title>
	<link type="text/css" rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<div class="container">
		<?php require('partials/post_form.php'); ?>
		
		<h1 id="post-count"><?= count($posts) . ' 則留言' ?></h1>
		<div id="post-list">
			<?php foreach ($posts as $post) : ?>
				<?php require('partials/post.php'); ?>
			<?php endforeach ?>
		</div>
	</div>
	<script type="text/javascript" src="public/js/moment-with-locales.js"></script>
	<script type="text/javascript" src="public/js/script.js"></script>
</body>
</html>