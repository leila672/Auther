<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',10);
/*
|--------------------------------------------------------------------------
| Author Apis
|--------------------------------------------------------------------------
*/

/*Route::group(['prefix' => 'admin','namespace'=>'admin'],function () {
    Route::Post('login', 'AuthController@login');
});
*/



Route::post('register', 'AuthorController@register');
Route::post('Auther/login', 'AuthorController@login');


###########  posts routes #############
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('postIndex', 'PostController@index');
    Route::post('postAdd', 'PostController@add_post');
    Route::post('postUpdate', 'PostController@update_post');
    Route::get('postDelete', 'PostController@delete_post');

});


