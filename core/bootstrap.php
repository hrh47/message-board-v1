<?php

use App\Core\App;
use App\Core\Database\{QueryBuilder, Connection};

App::bind('config', require 'config.php');
App::bind('database', new QueryBuilder(
	Connection::make(App::get('config')['database'])
));

function view($path, $data = [])
{
	extract($data);
	require "app/views/{$path}.view.php";
}

function redirect($path)
{
	header("Location: /{$path}");
}
