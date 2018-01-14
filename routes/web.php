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

// Debug
Route::get('/test', function () {
    return view('emailconfirm');
});

// PUBLIC
Route::get('/', 'HomeController@index')->name('home');
Route::get('/cards/{id}', 'CardController@show')->name('card');
Route::get('/decks/{id}', 'DeckController@show')->name('deck');
Route::get('/users/{id}', 'UserController@show')->name('user');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Auth::routes();

// PROTECTED
Route::get('/deckbuilder',  'DeckController@deckbuilder')->name('deckbuilder')->middleware('auth');
Route::get('/decks/{id}/edit', 'DeckController@edit')->name('deckedit')->middleware('auth');
Route::delete('/decks/{id}/delete', 'DeckController@destroy')->name('deckdelete')->middleware('auth');
Route::get('/users/{id}/settings', 'UserController@settings')->name('usersettings')->middleware('auth');
Route::post('/password/edit', 'UserController@editPassword')->name('editpassword')->middleware('auth');