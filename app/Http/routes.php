<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', 'StoreController@index');
*/
Route::resource('/', 'StoreController');


//Route::get('/', 'PagesController@home');

Route::get('/contact', 'AboutController@contact');
Route::post('/sendmail', 'AboutController@send');
//auth routes
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
////reg routes
//
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::auth();
Route::resource('auth', 'Auth\AuthController');
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');


Route::get('/home', 'StoreController@home');
Route::resource('store', 'StoreController');
Route::get('/store/{id}/manageredit/',['as' => 'store.managerEdit', 'uses' => 'StoreController@managerEdit']);
Route::get('/photos/{id}/pickimage/',['as' => 'photos.pickMainImage', 'uses' => 'PhotosController@pickMainImage']);
Route::patch('/store/{id}/managerupdate/',['as' => 'store.managerUpdate', 'uses' => 'StoreController@managerUpdate']);
Route::patch('/photos/{id}/pickimageupdate/',['as' => 'photos.pickMainImageUpdate', 'uses' => 'PhotosController@pickMainImageUpdate']);
Route::get('/{region_slug}/{city_slug}', 'StoreController@showByCity');
Route::get('api', 'StoreController@api');

Route::get('/{region_slug}/{city_slug}/{store_name_slug}', 'StoreController@show');
Route::get('/adminviewusers', 'StoreController@adminViewUsers');

// photos
Route::post('{store_name_slug}/photos', ['as' => 'store_photo_path', 'uses' => 'StoreController@addPhoto']);
Route::delete('photos/{id}/name/{store_name_slug}', 'StoreController@deletePhoto');

Route::post('/search', 'StoreController@searchStore');
Route::post('/rate', 'RatingController@store');
Route::post('/comment', 'CommentController@store');

Route::post('/favorite/{store}', 'StoreController@favoritePost');
Route::post('/unfavorite/{store}', 'StoreController@unFavoritePost');

Route::get('/favorite-stores', 'UsersController@FavoriteStores')->middleware('auth');

Route::get('/my-ratings', 'UsersController@myRates')->middleware('auth');