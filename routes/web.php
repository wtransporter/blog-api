<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});


$router->group([
    'middleware' => 'auth',
    'prefix' => 'api'], function($router) {

    $router->get('/posts', 'PostsController@index');

    $router->get('/post/{postId}', 'PostsController@show');
    
    $router->put('/post', 'PostsController@update');
    
    $router->post('/posts', 'PostsController@store');

    $router->delete('/post/{postId}', 'PostsController@destroy');
    
});