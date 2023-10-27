<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\Persons\ClientController;
use App\Helpers\RouterApi;
use Illuminate\Support\Facades\Route;
use Laravel\Lumen\Routing\Router;

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
// $router->group();

// $router->post('/login', 'Auth\AuthController@login');
// $router->get('/login', 'Auth\AuthController@teste');

Route::group([
    'prefix' => 'auth',
], function ($router) {

    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('refresh', 'Auth\AuthController@refresh');
    Route::get('me', 'Auth\AuthController@me');
    Route::put('update', 'Auth\AuthController@update');
});
$router->group([
    'namespace' => 'Persons', 
    'prefix' => 'person'
], function ($router) {
    RouterApi::resource('client', 'ClientController');
    RouterApi::resource('users', 'UserController');
});

// rota protegita
$router->group([
    'namespace' => 'Persons', 
    'prefix' => 'person',
    'middleware' => 'jwt.auth'
], function ($router) {
    RouterApi::resource('teste', 'ClientController');
});
