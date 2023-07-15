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

// ★★★Laravel入門★★★
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




// ★★★★チュートリアル：ToDoApp作成★★★
// チュートリアル（9）ミドルウェア1（中身を確認するにはログインするようにする）
Route::group(['middleware' => 'auth'], function(){

  // チュートリアル（8）ホーム画面の作成
  Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

  // チュートリアル（5）フォルダ作成ページの表示とフォルダ作成
  Route::get('/folders/create', 'App\Http\Controllers\FolderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create', 'App\Http\Controllers\FolderController@create');

  // ミドルウェア2（チュートリアル（10）現在ログインしているユーザーに紐付いていないフォルダの場合403エラー）
  Route::group(['middleware' => 'can:view,folder'], function() {
    // チュートリアル（3）indexページの表示
    Route::get('/folders/{folder}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');

    // チュートリアル（6）タスク作成ページの表示とタスク作成
    Route::get('/folders/{folder}/tasks/create', 'App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', 'App\Http\Controllers\TaskController@create');

    // チュートリアル（7）タスク編集ページの表示とタスク編集
    Route::get('/folders/{folder}/tasks/{task}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', 'App\Http\Controllers\TaskController@edit');

  }); // ミドルウェア2ここまで

}); // ミドルウェア1ここまで


Auth::routes();
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');