<?php

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

use App\Task;
use Illuminate\Http\Request;

//use Illuminate\Validation\Validator;

Route::get('/', 'Todo\TasksController@index');

Route::post('/task', 'Todo\TasksController@store');

Route::delete('/task/{id}', 'Todo\TasksController@destroy');

Route::patch('/task/{id}', 'Todo\TasksController@update');

Route::patch('/task', 'Todo\TasksController@updateAll');
