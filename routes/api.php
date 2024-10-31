<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    Route::post('createmarketusers', 'App\Http\Controllers\UsersController@Createuser');
    $router->post('storeproduct', 'App\Http\Controllers\ProductController@storeproduct'); // Create a new products
    $router->get('getproducts', 'App\Http\Controllers\ProductController@getproducts'); // Retrieve all products
    $router->delete('product/{id}', 'App\Http\Controllers\ProductController@deleteproduct'); // Delete a products by ID
    $router->put('product/{id}', 'App\Http\Controllers\ProductController@updatetproduct'); 
    $router->get('getcategories', 'App\Http\Controllers\ProductController@getcategories');
    $router->get('getmaritalstatus', 'App\Http\Controllers\UsersController@getmaritalstatus');
    $router->get('getgenders', 'App\Http\Controllers\UsersController@getgenders');
    Route::post('login', 'App\Http\Controllers\UsersController@loginApi');

    $router->get('getebookproducts', 'App\Http\Controllers\ProductController@getebookproducts');
    $router->get('getmusicproducts', 'App\Http\Controllers\ProductController@getmusicproducts');
    $router->get('getvideoproducts', 'App\Http\Controllers\ProductController@getvideoproducts');
    $router->get('getondemanproducts', 'App\Http\Controllers\ProductController@getondemanproducts');


    