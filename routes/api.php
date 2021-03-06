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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products/pimped', 'ProductController@categoryProducts');
Route::resources([
    'posts' => 'PostController',
    'products' => 'ProductController',
    'orders' => 'OrderController',
    'orderitem' => 'OrderItemController',
]);

Route::post('/orders/add/{itemId}/{orderId}', 'OrderController@addItem');
Route::get('/orders/order/{orderId}', 'OrderController@setStatusOrdered');
Route::get('/orders/cart/{userId}', 'OrderController@getCart');

//Route::get('/posts', 'PostController@index');
//Route::get('/posts/{post}', 'PostController@show');
//Route::post('/posts', 'PostController@store');
//Route::patch('/posts/{post}', 'PostController@update');
//Route::delete('/posts/{post}', 'PostController@destroy');

