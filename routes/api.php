<?php

use Illuminate\Http\Request;

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
Route::get('products','ProductController@index');
Route::post('products','ProductController@store');
Route::get('products/filter','ProductController@filter');
Route::delete('products/destroy/{id}','ProductController@destroy');
Route::get('categorys','CategoryController@index');
Route::post('categorys','CategoryController@store');
Route::delete('categorys/destroy/{id}','CategoryController@destroy');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
