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

Route::pattern('id','([0-9]+)');
Route::pattern('slug', '(.+)');

Route::group(['namespace' => 'Cnews'], function () {
    Route::get('',[
        'uses'  => 'IndexController@index',
        'as'    => 'cnews.index.index'
    ]);
    Route::get('tin-tuc/{slug}-{id}',[
        'uses'  => 'NewsController@cat',
        'as'    => 'cnews.news.cat'
    ]);
    Route::get('{slug}-{id}.html',[
        'uses'  => 'NewsController@detail',
        'as'    => 'cnews.news.detail'
    ]);
    Route::get('dang-tin',[
        'uses'  => 'NewsController@add',
        'as'    => 'cnews.news.add'
    ]);
    Route::get('tim-kiem',[
        'uses'  => 'SearchController@search',
        'as'    => 'cnews.search.search'
    ]);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('',[
        'uses'  => 'NewsController@index',
        'as'    => 'admin.news.index'
    ]);
    //route tin tức
    Route::group(['prefix' => 'news'], function(){
        Route::get('',[
            'uses'  => 'NewsController@index',
            'as'    => 'admin.news.index'
        ]);
        Route::get('create',[
            'uses'  => 'NewsController@create',
            'as'    => 'admin.news.create'
        ]);
        Route::post('create',[
            'uses'  => 'NewsController@store',
            'as'    => 'admin.news.create'
        ]);
        Route::get('edit/{id}', [
            'uses'  => 'NewsController@edit',
            'as'    => 'admin.news.edit'
        ]);
        Route::post('edit/{id}', [
            'uses'  => 'NewsController@update',
            'as'    => 'admin.news.edit'
        ]);
        Route::get('del/{id}',[
            'uses'  => 'NewsController@destroy',
            'as'    => 'admin.news.del'
        ]);
    });  

    //route danh mục
    Route::group(['prefix' => 'cat', 'middleware' => 'role:admin'], function(){
        Route::get('',[
            'uses'  => 'CatController@index',
            'as'    => 'admin.cat.index'
        ]);
        Route::get('create',[
            'uses'  => 'CatController@create',
            'as'    => 'admin.cat.create'
        ]);
        Route::post('create', [
            'uses'  => 'CatController@store',
            'as'    => 'admin.cat.create'
        ]);
        Route::get('edit/{id}', [
            'uses'  => 'CatController@edit',
            'as'    => 'admin.cat.edit'
        ]);
        Route::post('edit/{id}', [
            'uses'  => 'CatController@update',
            'as'    => 'admin.cat.edit'
        ]);
        Route::get('del/{id}',[
            'uses'  => 'CatController@destroy',
            'as'    => 'admin.cat.del'
        ]);
    });

    //route người dùng 
    Route::group(['prefix' => 'user'], function(){
        Route::get('',[
            'uses'  => 'UserController@index',
            'as'    => 'admin.user.index'
        ]);
        Route::get('create',[
            'uses'  => 'UserController@create',
            'as'    => 'admin.user.create'
        ]);
        Route::post('create', [
            'uses'  => 'UserController@store',
            'as'    => 'admin.user.create'
        ]);
        Route::get('edit/{id}', [
            'uses'  => 'UserController@edit',
            'as'    => 'admin.user.edit'
        ]);
        Route::post('edit/{id}', [
            'uses'  => 'UserController@update',
            'as'    => 'admin.user.edit'
        ]);
        Route::get('del/{id}',[
            'uses'  => 'UserController@destroy',
            'as'    => 'admin.user.del'
        ]);
    });
});

Route::group(['namespace' => 'Auth'], function(){
    Route::get('login', [
        'uses'  => 'AuthController@getLogin',
        'as'    => 'auth.login'
    ]);
    Route::post('login', [
        'uses'  => 'AuthController@postLogin',
        'as'    => 'auth.login'
    ]);

    Route::get('logout', [
        'uses'  => 'AuthController@logout',
        'as'    => 'auth.logout'
    ]);
});

Route::get('pass', function(){
    return bcrypt('123456');
});

Route::get('noaccess', function(){
    return view('noaccess');
});