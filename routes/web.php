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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'admin\DashboardController@index')->name('dashboard');
Route::get('/{anypath}', 'admin\DashboardController@index')->where('path','.*');
Route::get('/{anypath}/{id}', 'admin\DashboardController@index')->where('path','.*');
