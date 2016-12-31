<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('api/auth/login', 'AuthController@postLogin');

$app->group(['middleware' => 'auth:api'], function($app)
{
    $app->get ( '/api/users/me', 'App\Http\Controllers\UserController@getMyUserInfo' );

    $app->get ( '/api/users/info/{email}', 'UserController@getUserInfo' );

    $app->get ( '/api/users', 'App\Http\Controllers\UserController@getAllUser' );

    $app->put ( '/api/users', 'App\Http\Controllers\UserController@updateUser' );

    $app->put ( '/api/users/roles', 'App\Http\Controllers\UserController@manageRoles' );	

    $app->post ( '/api/users', 'App\Http\Controllers\UserController@createUser' );

    $app->post ( '/api/task', 'App\Http\Controllers\TaskController@createTask' );

    $app->get ( '/api/task', 'App\Http\Controllers\TaskController@getTasks' );
});