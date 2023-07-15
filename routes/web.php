<?php

use Illuminate\Support\Facades\Auth;
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

// Laravel入門2回目　練習
// Route::get('/hello', function () {
//     return view('hello');
// });

Route::view('/hello', 'hello', ["foo" => "bar"]);

// Laravel入門2回目　課題
Route::view('/hello/message', 'message', ["comment" => "こんにちは！"]);

// Laravel入門3回目　練習
Route::get('/test', 'App\Http\Controllers\TestController@index');

// Larabel入門4回目　練習1
Route::get('test/create', 'App\Http\Controllers\TestController@create');

// Larabel入門4回目　練習2
Route::get('test/create2', 'App\Http\Controllers\TestController@create2');

// チュートリアル（9）ミドルウェア（中身を確認するにはログインするようにする）
Route::group(['middleware' => 'auth'], function(){
// チュートリアル（3）
Route::get('/folders/{id}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');

// チュートリアル（5）
Route::get('/folders/create', 'App\Http\Controllers\FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'App\Http\Controllers\FolderController@create');

// チュートリアル（6）
Route::get('/folders/{id}/tasks/create', 'App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'App\Http\Controllers\TaskController@create');

// チュートリアル（7）
Route::get('/folders/{id}/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@edit');

// チュートリアル（8）
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
}); // ミドルウェアここまで


Auth::routes();
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');