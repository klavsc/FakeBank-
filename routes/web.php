<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home/deposit', 'HomeController@deposit');
Route::post('/home/deposit-post', 'HomeController@depositsave');

Route::get('/home/transfer', 'HomeController@transfer');
Route::post('/home/transfer-post', 'HomeController@transfersave');
