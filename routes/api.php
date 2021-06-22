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

// ユーザー取得
Route::get('/find/user', 'Api\UserController@findUser')->name('find.user');

// 友達検索
Route::get('/search/friends', 'Api\FriendController@searchFriends')->name('search.friends');

// 友達追加
Route::post('/add/friend', 'Api\FriendController@addFriend')->name('add.friend');

// チャットメッセージ作成
Route::post('/send/chat/message', 'Api\ChatMessageController@sendChatMessage')->name('send.chat.message');

// チャット取得
Route::get('/get/chats', 'Api\ChatMessageController@getChats')->name('get.chats');

// チャットメッセージ取得
Route::get('/get/chat/messages', 'Api\ChatMessageController@getChatMessages')->name('get.chat.messages');

// ポイントの購入
Route::post('/charge/grant-point', 'Api\GrantPointController@chargeGrantPoint')->name('charge.grant.point');

// 利用可能な付与ポイント取得
Route::get('/get/available-point', 'Api\GrantPointController@getAvailablePoint')->name('get.available.point');

// ポイントを贈る
Route::post('/give/point', 'Api\GivePointController@givePoint')->name('give.point');

// 景品のカテゴリ取得
Route::get('/get/gift/categories', 'Api\GiftCategoryController@getGiftCategories')->name('get.gift.categories');

// 景品のアイテム取得
Route::get('/get/gift/items', 'Api\GiftItemController@getGiftItems')->name('get.gift.items');
