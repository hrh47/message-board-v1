<?php

$dotenv = \Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

return [
	'database' => [
		'connection' => $_ENV['DB_CONNECTION'],
		'name' => $_ENV['DB_NAME'],
		'username' => $_ENV['DB_USERNAME'],
		'password' => $_ENV['DB_PASSWORD'],
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	]
];