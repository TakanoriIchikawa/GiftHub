<?php

use Illuminate\Http\Request;

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

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ユーザー検索
Route::get('/search/users', 'Api\UserController@searchUsers')->name('search.users');

// 利用可能な付与ポイント取得
Route::get('/get/available-point', 'Api\GrantPointController@getAvailablePoint')->name('get.available.point');

// ポイントを贈る
Route::post('/give/point', 'Api\GivePointController@givePoint')->name('give.point');

// 景品のカテゴリ取得
Route::get('/get/gift/categories', 'Api\GiftCategoryController@getGiftCategories')->name('get.gift.categories');

// 景品のアイテム取得
Route::get('/get/gift/items', 'Api\GiftItemController@getGiftItems')->name('get.gift.items');
