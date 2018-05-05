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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->post('auth/login', ['uses' => 'AuthController@authenticate']);
$router->group(['prefix' => 'api/v1'], function ($router) {
   $router->post('/users/register', 'UsersController@register');
   $router->post('/users/login', 'AuthController@authenticate');
   $router->get('/event/all', 'EventsController@getAllEvents');
   $router->get('/event/{centerId}', 'EventsController@getCenterEvents');
});
$router->group(['middleware' => 'jwt.auth', 'prefix' => 'api/v1'], function ($router) {
    $router->post('/event/create', 'EventsController@createEvent');
    $router->post('/admin/center/create', 'CentersController@createCenter');
});
