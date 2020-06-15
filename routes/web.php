<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasksList/{q?}', 'TaskController@index'); // to call the route with axios
Route::post('/tasksList', 'TaskController@store'); // to call the route with axios for modification
Route::get('/tasks/edit/{id}', 'TaskController@edit'); // to call the route with axios for edition
Route::patch('/tasks/edit/{id}', 'TaskController@update');
Route::delete('/tasks/{id}', 'TaskController@destroy');
