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

Route::get('/home', function() {
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
Route::get('/', function() {
    return view('user.index');
})->name('home');
Route::get('/detail', function() {
    return view('user.detail');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home']);
});
Route::group(['prefix' => 'user'], function() {
});
