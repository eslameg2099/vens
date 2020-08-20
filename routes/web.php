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

Route::get('/', 'HomeController@index');
Route::get('about', 'help@about')->name('about');
Route::get('contact', 'help@conect')->name('contact');
Route::get('venues/{slug}/{id}', 'VenueController@show')->name('venues.show');
Route::get('event-type/{slug}', 'EventTypeController@index')->name('event_type');
Route::get('location/{slug}', 'LocationController@index')->name('location');
Route::get('search', 'SearchController@index')->name('search');


Auth::routes(['register' => false]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    Route::resource('roles', 'RolesController');

    Route::resource('users', 'UsersController');

    Route::resource('event-types', 'EventTypesController');

    Route::resource('locations', 'LocationsController');


    Route::resource('venues', 'VenuesController');






    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
