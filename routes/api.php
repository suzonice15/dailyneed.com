<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('category','CategoryController');
Route::apiResource('product','ProductController');
Route::get('/search/category/{field}/{query}','CategoryController@search');


Route::get('/search/product/{field}/{query}','ProductController@search');
Route::get('/FirstCategoryList','ProductController@FirstCategoryList');
Route::get('/folderCheck','ProductController@folderCheck');
Route::get('/SecondCategoryList/{id}','ProductController@SecondCategoryList');


Route::get('allCategoryList','CategoryController@allCategoryList');

