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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::post('messages', 'ChatsController@sendMessage');

Route::get('/users', 'UserController@index')->middleware('auth')->name('users.index');
Route::get('/chat', 'ChatsController@index');
Route::get('/chat/{id}', 'ChatsController@show')->name('private-chat-user-detail');

Route::get('messages/{id}', 'ChatsController@getMessageFromUser')->name('get-messages-from-user');

Route::get('/groups', 'GroupController@index')->middleware('auth')->name('groups.index');
Route::get('/groups/create', 'GroupController@create')->middleware('auth')->name('groups.create');
Route::post('/groups/store', 'GroupController@store')->middleware('auth')->name('groups.store');
Route::get('/groups/{id}', 'GroupController@show')->middleware('auth')->name('groups.show');

Route::get('/messages-group/{id}', 'ChatGroupController@getMessage')->name('get-messages-from-group');

Route::post('/messages-group', 'ChatGroupController@sendMessage');