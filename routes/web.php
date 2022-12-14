<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\MusicController@index');
Route::resource('/music', 'App\Http\Controllers\MusicController');
Route::get('music/{music}/delete', 'App\Http\Controllers\MusicController@delete')->name('music.delete');
Route::get('music/{music}/state', 'App\Http\Controllers\MusicController@state')->name('music.state');
Route::post('music/search', 'App\Http\Controllers\musicController@search')->name('music.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
