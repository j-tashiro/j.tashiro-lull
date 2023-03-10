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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ページを表示させるのがget Controllerの処理がviewで終わる
// 本来の意味は「このページをくれよ」なお願い

//登録処理や更新処理をするのがpost Controllerの処理がredirectで終わる
// 本来の意味は「このデータをやるから追加しとけ」なお願い


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
//2022.12.16 ログインユーザーのフォローのつぶやきを表示
Route::get('/top','PostsController@read');

Route::get('/profile','UsersController@profile');

//2023.02.07 検索入力フォームの設置
Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

// 2022.11.02 ログアウト
Route::get('/logout','Auth\LoginController@logout');

//2022.11.12 投稿フォーム
Route::get('/post/create','PostsController@create');
Route::post('/post/create','PostsController@create');

//2023.01.16 ログインユーザーのつぶやきを編集
Route::post('/post/update', 'PostsController@update');

//2022.12.23 削除用メソッド
Route::get('/post/{id}/delete','PostsController@delete');



// 2023.03.08 フォローボタン
// ログイン状態
Route::group(['middleware' => 'auth'], function() {

// ユーザ関連
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

// フォロー/フォロー解除を追加
Route::post('users/{id}/follow', 'UsersController@follow')->name('follow');
Route::get('users/{id}/follow', 'UsersController@follow')->name('follow');
Route::delete('users/{id}/unfollow', 'UsersController@unfollow')->name('unfollow');

});