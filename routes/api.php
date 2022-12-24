<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'Api\HomeApiController@home');
Route::get('/product/detail/{slug}', 'Api\ProductApiController@detail');
Route::post('/like-product', 'Api\ProductApiController@like');
Route::post('/make-review/{slug}', 'Api\ReviewApiController@makeReview');
Route::post('/add-to-cart/{slug}', 'Api\CartApiController@addCart');
Route::get('/user_profile', 'Api\ProfileApiController@profile');
Route::post('/update-user_info/{id}', 'Api\ProfileApiController@updateInfo');
Route::get('/cart/{id}', 'Api\CartApiController@cart');
Route::post('/update-qty', 'Api\CartApiController@updateQty');
Route::post('/remove-cart', 'Api\CartApiController@removeCart');
Route::post('/update-order', 'Api\OrderApiController@updateOrder');
Route::get('/order', 'Api\OrderApiController@order');
Route::post('/change-password', 'Api\AuthApiController@changePassword');
