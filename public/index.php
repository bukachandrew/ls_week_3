<?php

include_once "../vendor/autoload.php";
include_once "../src/config.php";

session_start();

$route = new \Base\Route();
$route->addRoute('/', \App\Controller\Blog::class, 'list');

$route->addRoute('/login', \App\Controller\User::class, 'login');
$route->addRoute('/registration', \App\Controller\User::class, 'registration');
$route->addRoute('/logout', \App\Controller\User::class, 'logout');

$route->addRoute('/users', \App\Controller\User::class, 'usersList');
$route->addRoute('/users/edit', \App\Controller\User::class, 'userInfo');
$route->addRoute('/edit-user', \App\Controller\User::class, 'userEdit');
$route->addRoute('/delete-user', \App\Controller\User::class, 'deleteUser');



$route->addRoute('/blog', \App\Controller\Blog::class, 'list');
$route->addRoute('/add-message', \App\Controller\Blog::class, 'addMessage');
$route->addRoute('/delete-message', \App\Controller\Blog::class, 'deleteMessage');

$route->addRoute('/api-blog/user-messages', \App\Controller\Blog::class, 'userMessages');

$route->init();
