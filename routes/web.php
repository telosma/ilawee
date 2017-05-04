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
Route::group(['domain' => 'ilawee.dev'], function() {
    Route::get('/import-data', ['as' => 'import.data', 'uses' => 'Controller@importData']);
    Route::post('/signup', ['as' => 'signup', 'uses' => 'AuthUserController@postSignup']);
    Route::post('/signin', ['as' => 'signin', 'uses' => 'AuthUserController@postSignin']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthUserController@getLogout']);
    Route::get('u/activate/{code}', ['as' => 'user.activate', 'uses' => 'AuthUserController@activateUser']);
    Route::post('u/resend-confirm', ['as' => 'user.confirm', 'uses' => 'AuthUserController@sendConfirmation']);
    Route::get('auth/{provider}', ['as' => 'redirectToProvider', 'uses' => 'AuthSocialController@redirectToProvider']);
    Route::get('auth/{provider}/callback', 'AuthSocialController@handleProviderCallback');
    Route::resource('vanban', 'DocumentController');
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
    Route::get('coquanbanhanh/{orId}', ['as' => 'listLawByOrganization', 'uses' => 'SearchController@filterByOrganization']);
    Route::group(['prefix' => 'vanbanluat'], function() {
        Route::get('/loaivanban/{typeId}', ['uses' => 'SearchController@filterByType', 'as' => 'document.filter.type']);
        Route::get('/timkiem', ['uses' => 'SearchController@normalSearch', 'as' => 'document.normalSearch']);
        Route::get('/timkiemnangcao', ['uses' => 'SearchController@getAdvancedSearch', 'as' => 'document.show.advancedSearch']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('advanced-search', ['uses' => 'SearchController@ajaxGetResultSearch', 'as' => 'document.ajax.search']);
        });
    });
    Route::get('download/{key}/{id}', ['uses' => 'DocumentController@download', 'as' => 'vanban.download']);
    Route::get('/home/{tab}', function() {
        return view('user.home');
    });

});


Route::group(['domain' => 'admin.ilawee.dev', 'namespace' => 'Admin'], function() {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home']);
    Route::group(['prefix' => 'organization'], function() {
        Route::get('/', ['uses' => 'OrganizationController@index', 'as' => 'admin.organization.index']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('list', ['uses' => 'OrganizationController@ajaxList', 'as' => 'admin.organization.ajax.list']);
            Route::get('list-only', ['uses' => 'OrganizationController@ajaxListOnly', 'as' => 'admin.organization.ajax.listOnly']);
            Route::post('update', ['uses' => 'OrganizationController@ajaxUpdate', 'as' => 'admin.organization.ajax.update']);
        });
    });
});
