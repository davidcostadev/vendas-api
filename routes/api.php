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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('orders', 'Api\OrdersController@index');
Route::get('orders/{order}', 'Api\OrdersController@show')->where('order', '[0-9]+');
Route::post('orders', 'Api\OrdersController@store');
Route::put('orders/{order}', 'Api\OrdersController@update');
Route::delete('orders/{order}', 'Api\OrdersController@delete');

Route::get('statuses', 'Api\StatusesController@index');
Route::get('statuses/{status}', 'Api\StatusesController@show')->where('status', '[0-9]+');
Route::post('statuses', 'Api\StatusesController@store');
Route::put('statuses/{status}', 'Api\StatusesController@update');
Route::delete('statuses/{status}', 'Api\StatusesController@delete');

Route::get('order-histories', 'Api\OrderHistoriesController@index');
Route::get('order-histories/{order_histories}', 'Api\OrderHistoriesController@show')->where('order_histories', '[0-9]+');
Route::post('order-histories', 'Api\OrderHistoriesController@store');
Route::put('order-histories/{order_histories}', 'Api\OrderHistoriesController@update');
Route::delete('order-histories/{order_histories}', 'Api\OrderHistoriesController@delete');

Route::get('products', 'Api\ProductsController@index');
Route::get('products/{product}', 'Api\ProductsController@show')->where('product', '[0-9]+');
Route::post('products', 'Api\ProductsController@store');
Route::put('products/{product}', 'Api\ProductsController@update');
Route::delete('products/{product}', 'Api\ProductsController@delete');

Route::get('clients', 'Api\ClientsController@index');
Route::get('clients/{client}', 'Api\ClientsController@show')->where('client', '[0-9]+');
Route::post('clients', 'Api\ClientsController@store');
Route::put('clients/{client}', 'Api\ClientsController@update');
Route::delete('clients/{client}', 'Api\ClientsController@delete');