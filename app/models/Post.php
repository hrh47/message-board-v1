<?php

namespace App\Models;

use App\Core\App;

class Post
{
	public $id;
	public $nickname;
	public $content;
	public $timestamp;

	public function comments()
	{
		return App::get('database')->table('comments')
			->select()
			->where('post_id', '=', $this->id)
			->orderBy('timestamp', 'asc')
			->getAll();
	}
}