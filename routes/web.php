<?php
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
 
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


$router->group(['prefix' => 'auth'], function () use ($router) {
       // Matches "/api/register
       $router->post('register', 'AuthController@register');
       $router->post('login', 'AuthController@authenticate');
       $router->post('logout', 'AuthController@logout');
});
       $router->post('invalidate', 'AuthController@invalidate');

//Mongodb route with auth
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('api/product',  ['uses' => 'ProductController@index']);
    $router->post('api/product',  ['uses' => 'ProductController@insert']);
    $router->get('api/product/{_id}',  ['uses' => 'ProductController@show']);
    $router->patch('api/product/{_id}',  ['uses' => 'ProductController@update']);
    $router->patch('api/product/delete/{_id}',  ['uses' => 'ProductController@destroy']);
});

$router->group(['middleware' => 'auth'], function () use ($router) {
       $router->post('auth/logout', 'AuthController@logout');
});

//testunit route
    $router->get('test/product',  ['uses' => 'ProductController@index']);
    $router->post('test/product',  ['uses' => 'ProductController@insert']);
    $router->get('test/product/{_id}',  ['uses' => 'ProductController@show']);
    $router->patch('test/product/{_id}',  ['uses' => 'ProductController@update']);
    $router->patch('test/product/delete/{_id}',  ['uses' => 'ProductController@destroy']);