<?php
$router->get('/',function () use ($router){
    return $router->app->version();
});
$router->group(["prefix"=>"api"],function () use ($router) {
    
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->group(['middleware' =>'auth'], function () use ($router) {
$router->get('/logout', 'AuthController@logout');
});

$router->get('/posts', 'PostController@index');
$router->get('/posts/{post}', 'PostController@show');
$router->group(['middleware' => ['auth', 'refresh_token']], function () use ($router) {
    $router->get('/user', 'AuthController@me');
    $router->put('/user/{user}', 'AuthController@update');
    $router->post('/posts', 'PostController@store');
    $router->put('/posts/{post}', 'PostController@update');
    $router->delete('/posts/{post}', 'PostController@destroy');
});
});