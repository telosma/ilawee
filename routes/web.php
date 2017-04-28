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

Route::get('/home/{tab}', function() {
    return view('user.home');
});
Route::get('/import-data', ['as' => 'import.data', 'uses' => 'Controller@importData']);
Route::post('/signup', ['as' => 'signup', 'uses' => 'AuthUserController@postSignup']);
Route::post('/signin', ['as' => 'signin', 'uses' => 'AuthUserController@postSignin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthUserController@getLogout']);
Route::get('u/activate/{code}', ['as' => 'user.activate', 'uses' => 'AuthUserController@activateUser']);
Route::post('u/resend-confirm', ['as' => 'user.confirm', 'uses' => 'AuthUserController@sendConfirmation']);
Route::get('auth/{provider}', ['as' => 'redirectToProvider', 'uses' => 'AuthSocialController@redirectToProvider']);
Route::get('auth/{provider}/callback', 'AuthSocialController@handleProviderCallback');
Route::resource('document', 'DocumentController');
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('coquanbanhanh/{orId}', ['as' => 'listLawByOrganization', 'uses' => 'SearchController@filterByOrganization']);
Route::group(['prefix' => 'vanban'], function() {
    Route::get('/loaivanban', ['uses' => 'SearchController@filterByType', 'as' => 'document.filter.type']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home']);
});
Route::group(['prefix' => 'user'], function() {
});
Route::get('tree-view', ['uses' => 'HomeController@treeView']);
