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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('login', [
'as' => 'login', 'uses' => 'ReynielController@page']);

$router->post('validation', [
'as' => 'validation', 'uses' => 'ReynielController@verify' ]);

$router->get('dashboard', [
'as' => 'dashboard', 'uses' => 'ReynielController@crud']);

$router->post('editUser', [
'as' => 'editUser', 'uses' => 'ReynielController@editUser']);


$router->post('deleteUser', [
'as' => 'deleteUser', 'uses' => 'ReynielController@deleteUser']);

$router->post('addUser', [
'as' => 'addUser', 'uses' => 'ReynielController@addUser']);