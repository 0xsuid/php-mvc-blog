<?php

use Harsh\Blog\Controller\NotFoundController;
use Harsh\Blog\Controller\UserController;
use Harsh\Blog\Controller\PostController;
use Harsh\Blog\Controller\ImpressumController;
use Harsh\Blog\Helper\Router;

$router = new Router();

$router->get('/', [PostController::class, 'index']);

$router->get('/register', [UserController::class , 'register']);
$router->post('/register', [UserController::class , 'register']);
$router->get('/login',  [UserController::class , 'login']);
$router->post('/login', [UserController::class , 'login']);
$router->get('/logout', [UserController::class , 'logout']);

$router->get('/createPost', [PostController::class , 'createPost']);
$router->post('/createPost', [PostController::class , 'createPost']);
$router->get('/post', [PostController::class , 'single']);

$router->get('/impressum', [ImpressumController::class , 'index']);

$router->addNotFoundController([NotFoundController::class , 'index']);

$router->get('/cat', function () {
    echo 'meoWW';
});

$router->execute();