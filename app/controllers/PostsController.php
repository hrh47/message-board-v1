<?php

namespace App\Controllers;

use App\Core\App;

class PostsController
{
	public function index()
	{
		$title = '首頁';
		$posts = App::get('database')->table('posts')
			->select()
			->orderBy('timestamp', 'desc')
			->getAll('App\\Models\\Post');

		return view('index', compact('title', 'posts'));
	}

	public function addPost()
	{
		try {
			$id = App::get('database')->table('posts')
			->insert([
				'nickname' => $_POST['nickname'],
				'content' => $_POST['post']
			]);
			$post = App::get('database')->table('posts')
				->select()
				->where('id', '=', $id)
				->getAll('App\\Models\\Post')[0];
			require('app/views/partials/post.php');
		} catch (\Exception $e) {
			http_response_code(500);
		}
	}

	public function addComment()
	{
		try {
			$id = App::get('database')->table('comments')
			->insert([
				'nickname' => $_POST['nickname'],
				'content' => $_POST['comment'],
				'post_id' => $_POST['post_id']
			]);
			$comment = App::get('database')->table('comments')
				->select()
				->where('id', '=', $id)
				->getAll()[0];
			require('app/views/partials/comment.php');
		} catch (\Exception $e) {
			http_response_code(500);
		}
		
	}
}