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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/messages', function (Request $request) {
    return $request->user()->messages->map(function ($message) {
    	return $message->content;
    });
})->middleware('auth:api');

Route::get('/messages/subject', function (App\MessagesSubject $model) {
    return $model->get(['id', 'subject']);
})->middleware('auth:api');

Route::post('/messages/send', 'SendingMessageController@postMessage')->middleware('auth:api');
