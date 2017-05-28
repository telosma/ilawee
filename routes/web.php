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
Route::group(['domain' => 'ilawee.vn'], function() {
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

    Route::group(['prefix' => 'van-ban-luat'], function() {
        Route::get('/loaivanban/{typeId}', ['uses' => 'SearchController@filterByType', 'as' => 'document.filter.type']);
        Route::get('/timkiem', ['uses' => 'SearchController@normalSearch', 'as' => 'document.normalSearch']);
        Route::get('/timkiemnangcao', ['uses' => 'SearchController@getAdvancedSearch', 'as' => 'document.show.advancedSearch']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('advanced-search', ['uses' => 'SearchController@ajaxGetResultSearch', 'as' => 'document.ajax.search']);
        });
        Route::get('download/{key}/{id}', ['uses' => 'DocumentController@download', 'as' => 'vanban.download']);
        Route::get('data/{key}/{id}', ['uses' => 'DocumentController@getPdf', 'as' => 'vanban.getPdf']);
    });

    Route::get('/home/{tab}', function() {
        return view('user.home');
    });

    Route::group(['prefix' => 'cau-hoi-phap-luat'], function() {
        Route::post('/create', ['uses' => 'PostController@create', 'as' => 'post.create', 'middleware' => 'auth']);
        Route::get('/', ['uses' => 'HomeController@advisory', 'as' => 'advisory']);
        Route::get('linh-vuc/{name}', ['uses' => 'HomeController@getPostByField', 'as' => 'field.post.list']);
        Route::get('/search', ['uses' => 'PostController@search', 'as' => 'post.search']);
        Route::group(['prefix' => 'cau-hoi'], function() {
            Route::get('/{id}', ['uses' => 'PostController@show', 'as' => 'post.show']);
            Route::group(['prefix' => 'tra-loi', 'middleware' => 'role:manager'], function() {
                Route::post('/create', ['uses' => 'CommentController@store', 'as' => 'comment.create']);
                Route::delete('/delete', ['uses' => 'CommentController@destroy', 'as' => 'comment.ajax.delete']);
            });
        });
    });

    Route::get('/u/{name}/{id}/cau-hoi-phap-luat', ['uses' => 'HomeController@getPostByUser', 'as' => 'user.question']);
});


Route::group(['domain' => 'admin.ilawee.vn', 'namespace' => 'Admin'], function() { //, 'middleware' => 'role:admin'
    Route::get('login', ['uses' => 'HomeController@getLogin', 'as' => 'admin.getLogin']);
    Route::post('login', ['uses' => 'HomeController@postLogin', 'as' => 'admin.postLogin']);

    // Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home']);
        Route::get('logout', ['uses' => 'HomeController@logout', 'as' => 'admin.logout']);
        Route::group(['prefix' => 'co-quan-ban-hanh'], function() {
            Route::get('/', ['uses' => 'OrganizationController@index', 'as' => 'admin.organization.index']);
            Route::group(['prefix' => 'ajax'], function () {
                Route::get('list', ['uses' => 'OrganizationController@ajaxList', 'as' => 'admin.organization.ajax.list']);
                Route::get('list-only', ['uses' => 'OrganizationController@ajaxListOnly', 'as' => 'admin.organization.ajax.listOnly']);
                Route::post('update', ['uses' => 'OrganizationController@ajaxUpdate', 'as' => 'admin.organization.ajax.update']);
                Route::post('create', ['uses' => 'OrganizationController@ajaxCreate', 'as' => 'admin.organization.ajax.create']);
                Route::delete('delete', ['uses' => 'OrganizationController@ajaxDelete', 'as' => 'admin.organization.ajax.delete']);
            });
        });

        Route::group(['prefix' => 'nguoi-ky'], function() {
            Route::get('/', ['uses' => 'SignerController@index', 'as' => 'admin.signer.index']);
            Route::group(['prefix' => 'ajax'], function () {
                Route::get('list', ['uses' => 'SignerController@ajaxList', 'as' => 'admin.signer.ajax.list']);
                Route::get('list-only', ['uses' => 'SignerController@ajaxOrganizationListOnly', 'as' => 'admin.signer.ajax.listOnly']);
                Route::post('update', ['uses' => 'SignerController@ajaxUpdate', 'as' => 'admin.signer.ajax.update']);
                Route::post('create', ['uses' => 'SignerController@ajaxCreate', 'as' => 'admin.signer.ajax.create']);
                Route::delete('delete', ['uses' => 'SignerController@ajaxDelete', 'as' => 'admin.signer.ajax.delete']);
            });
        });

        Route::group(['prefix' => 'van-ban'], function() {
            Route::get('/', ['uses' => 'DocumentController@index', 'as' => 'admin.document.index']);
            Route::get('/{id}', ['uses' => 'DocumentController@preview', 'as' => 'admin.document.preview']);
            Route::group(['prefix' => 'ajax'], function () {
                Route::get('list', ['uses' => 'DocumentController@ajaxList', 'as' => 'admin.document.ajax.list']);
                Route::get('show', ['uses' => 'DocumentController@ajaxShow', 'as' => 'admin.document.ajax.show']);
            });
        });

        Route::group(['prefix' => 'role'], function() {
            Route::get('/', ['uses' => 'RoleController@index', 'as' => 'admin.role.index']);
            // Route::get('/{id}', ['uses' => 'DocumentController@preview', 'as' => 'admin.document.preview']);
            Route::group(['prefix' => 'ajax'], function () {
                Route::get('list', ['uses' => 'RoleController@ajaxList', 'as' => 'admin.role.ajax.list']);
                Route::post('create', ['uses' => 'RoleController@ajaxCreate', 'as' => 'admin.role.ajax.create']);
                Route::delete('delete', ['uses' => 'RoleController@ajaxDelete', 'as' => 'admin.role.ajax.delete']);
                Route::get('permisstion/list', ['uses' => 'RoleController@ajaxPermissionList', 'as' => 'admin.role.ajax.permisstion.list']);
            });
        });

        Route::get('permisstion/ajax/list', ['as' => 'admin.permisstion.ajax.list', 'uses' => 'RoleController@ajaxListPermission']);
    // });
});

Route::group(['domain' => 'manager.ilawee.vn', 'namespace' => 'Manager'], function() {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'manager.index']);
    Route::group(['prefix' => 'van-ban'], function () {
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('list', ['uses' => 'HomeController@ajaxListDoc', 'as' => 'manager.document.ajax.list']);
            Route::get('loai-van-ban/list', ['uses' => 'HomeController@ajaxListType', 'as' => 'manager.docType.ajax.list']);
            Route::post('create', ['uses' => 'DocumentController@ajaxCreate', 'as' => 'manager.document.ajax.create']);
        });
    });
    Route::group(['prefix' => 'nguoi-ky'], function () {
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('list', ['uses' => 'SignerController@ajaxListFullInfo', 'as' => 'manager.signer.ajax.listFullInfo']);
        });
    });
});

Route::get('/remarkable', function() {
    return view('remarkable');
});

Route::match(['get', 'post'], 'upload/image/ckeditor', [
    'uses' => 'UploadController@storageImageCKEditor',
    'as' => 'upload.image.CKEditor'
]);
Route::post('upload/image', ['uses' => 'UploadController@storageImage', 'as' => 'upload.image']);
