<?php


Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//// Registration Routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Route group
$router->group(['middleware' => 'auth'], function() {
    Route::post('/roles/sync/{id}', ['as' => 'roles.sync', 'uses' => 'User\RoleController@sync']);
    Route::resource('roles', 'User\RoleController');
    Route::resource('users', 'User\UserController');
    Route::resource('permissions', 'User\PermissionController');

    //Building
    Route::resource('buildings', 'BuildingsController');
    Route::get('buildings/{building_name}/{street}', ['as' => 'showBuilding', 'uses' => 'BuildingsController@show']);

    //Pictures
    Route::post('buildings/{building_name}/{street}/photos', ['as' => 'addPicture', 'uses' => 'PictureController@store'] );
    Route::delete('picture/{id}', ['as' => 'removePicture', 'uses' => 'PictureController@destroy']);

    //Files
    Route::post('buildings/{building_name}/{street}/file', ['as' => 'addFile', 'uses' => 'PlanController@store'] );
    Route::get('download/{id}', ['as'=> 'get.file', 'uses' => 'PlanController@downloadFile']);

    //Floors
    Route::resource('floor', 'FloorsController');




});

//move these to secure area later

