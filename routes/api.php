<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/submit-form', 'App\Http\Controllers\FormController@submit');

Route::post('/add/task', 'App\Http\Controllers\TaskController@addTask');

Route::get('/viewUser', 'App\Http\Controllers\FormController@showAll');

Route::get('/viewTask', 'App\Http\Controllers\TaskController@showTasks');
