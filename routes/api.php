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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::pattern('id','([0-9]+)');

Route::group(['namespace' => 'Api\V1'], function () {
	Route::group(['prefix' => 'cat'], function () {
		Route::get('/', 'ApiCatController@index');

		Route::post('create', 'ApiCatController@store');

		Route::get('edit/{id}', 'ApiCatController@edit');

		Route::post('edit/{id}', 'ApiCatController@update');

		Route::get('destroy/{id}', 'ApiCatController@destroy');
	});

	// Route::group(['prefix' => 'news'], function () {
	// 	Route::get('/', 'ApiNewsController@index');

	// 	Route::get('create', 'ApiNewsController@create');
	// 	Route::post('create', 'ApiNewsController@store');

	// 	Route::get('edit/{id}', 'ApiNewsController@edit');

	// 	Route::post('edit/{id}', 'ApiNewsController@update');

	// 	Route::get('destroy/{id}', 'ApiNewsController@destroy');
	// });

	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'ApiUserController@index');

		Route::post('create', 'ApiUserController@store');

		Route::get('edit/{id}', 'ApiUserController@edit');

		Route::post('edit/{id}', 'ApiUserController@update');

		Route::get('destroy/{id}', 'ApiUserController@destroy');
	});
});
// 	Route::group(['namespace' => 'Auth'], function(){
// 	Route::post('apilogin', 'ApiAuthController@login');
// 	Route::get('apilogout', 'ApiAuthController@logout');
// });

