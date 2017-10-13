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

Route::get('/', 'HomeController@show')->name('home');

Route::get('/cards/{id}', 'CardController@show')->name('card');

Route::get('/deckbuilder', 'DeckController@deckbuilder')->name('deckbuilder');
Route::get('/decks/{id}', 'DeckController@show')->name('deck');
Route::get('/decks/{id}/edit', 'DeckController@edit')->name('deckedit');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
