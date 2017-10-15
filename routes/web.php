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

// PUBLIC
Route::get('/', 'HomeController@index')->name('home');
Route::get('/cards/{id}', 'CardController@show')->name('card');
Route::get('/decks/{id}', 'DeckController@show')->name('deck');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Auth::routes();

// PROTECTED
Route::get('/deckbuilder',  'DeckController@deckbuilder')->name('deckbuilder')->middleware('auth');
Route::get('/decks/{id}/edit', 'DeckController@edit')->name('deckedit')->middleware('auth');
