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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/products', 'ProductController@index');
Route::get('/products/create','ProductController@create');
Route::post('/products','ProductController@store');
Route::get('/products/{product}','ProductController@show')->name('products.show');
Route::get('/products/{product}/edit','ProductController@edit');
Route::put('/products/{product}','ProductController@update');


Route::get('/inventories', 'InventoryController@index');
Route::post('/products/{product}','InventoryController@store');





Route::get('/transactions', 'TransactionOfItemController@index')->name("index");
Route::post('/transactions ', 'TransactionOfItemController@addToCart')->name("addToCart");
Route::delete('/transactions', 'TransactionOfItemController@removefromCart')->name("removefromCart");



//Route::get('session/get','SessionController@accessSessionData');
//Route::get('session/set','SessionController@storeSessionData');
//Route::get('session/remove','SessionController@deleteSessionData');

