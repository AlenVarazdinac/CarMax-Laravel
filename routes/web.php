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
Route::get('/', ['uses' => 'CarModelController@getCarsForHome']);

// Login
Route::get('/login', function() {
    return view('public.login');
});
Route::post('/auth', ['uses' => 'UserController@logIn']);

// Register
Route::get('/register', function() {
    return view('public.register');
});
Route::post('/registration', ['uses' => 'UserController@register']);

// Logout
Route::get('/logout', ['uses' => 'UserController@logout']);

// About
Route::get('/about', function() {
    return view('public.about');
});

// Routes that require user to be logged in
Route::group(['middleware' => 'auth'], function() {
    /* Car Make Routes */
    Route::get('/carmake', ['uses' => 'CarMakeController@listCarMake']);
    Route::get('/carmake_add', function () {
        return view('private.carmake.carmake_add');
    });
    Route::post('/carmake_adding', ['uses' => 'CarMakeController@addCarMake']);
    Route::get('/carmake_edit/{carMakeid}', ['uses' => 'CarMakeController@getCarMake']);
    Route::post('/carmake_editing/{carMakeId}', ['uses' => 'CarMakeController@editCarMake']);
    Route::get('/carmake_remove/{carMakeId}', ['uses' => 'CarMakeController@removeCarMake']);

    /* Car Model Routes */
    Route::get('/carmodel', ['uses' => 'CarModelController@listCarModel']);
    Route::get('/carmodel_add', ['uses' => 'CarModelController@getCarMakes']);
    Route::post('/carmodel_adding', ['uses' => 'CarModelController@addCarModel']);
    Route::get('/carmodel_edit/{carModelId}', ['uses' => 'CarModelController@getCarModel']);
    Route::post('/carmodel_editing/{carModelId}', ['uses' => 'CarModelController@editCarModel']);
    Route::get('/carmodel_remove/{carModelId}', ['uses' => 'CarModelController@removeCarModel']);
    Route::get('/carmodel_show/{carModelId}', ['uses' => 'CarModelController@showCarModel']);

    /* Car Feature Routes */
    Route::get('/carfeature', ['uses' => 'CarFeatureController@listCarFeatures']);
    Route::get('/carfeature_add', function () {
        return view('private.carfeature.carfeature_add');
    });
    Route::post('/carfeature_adding', ['uses' => 'CarFeatureController@addCarFeature']);
    Route::get('/carfeature_edit/{carFeatureId}', ['uses' => 'CarFeatureController@getCarFeature']);
    Route::post('/carfeature_editing/{carFeatureId}', ['uses' => 'CarFeatureController@editCarFeature']);
    Route::get('/carfeature_remove/{carFeatureId}', ['uses' => 'CarFeatureController@removeCarFeature']);
});
