<?php

$router->get('', 'PostsController@index');
$router->post('posts', 'PostsController@addPost');
$router->post('comments', 'PostsController@addComment');