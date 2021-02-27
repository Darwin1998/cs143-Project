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

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', 'LoginController@index')->name('login');

    Route::post('/authenticate', 'ApplicationController@authenticate')->name('authenticate');
});


//Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout','ApplicationController@logout')->name('logout');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['middleware' => 'manager'], function(){

        Route::get('/users', 'UserController@index')->name('index');
        Route::post('/users', 'UserController@store')->name('store');
        Route::put('users/{user}','UserController@update')->name('update');

        Route::get('/inventories', 'InventoryController@index');
        Route::post('/products/{product}','InventoryController@store');

    });


    Route::group(['middleware'=>'common'], function(){



        Route::get('/transactions','TransactionController@index')->name('index');
        Route::get('/transactions/create','TransactionController@create')->name('create');
        Route::post('/transactions ', 'TransactionController@addToCart')->name("addToCart");
        Route::delete('/transactions', 'TransactionController@removefromCart')->name("removefromCart");
        Route::get('/transactions/checkout', 'TransactionController@checkout')->name("chekcout");
        Route::post('/transactions/payment ', 'TransactionController@payment')->name("payment");
        Route::get('/transactions/{transaction}/details','TransactionController@details');
        Route::put('/transactions/{transaction}/cancel','TransactionController@cancel')->name("cancel");
        Route::post('/transactions/{customer}','TransactionController@selectCustomer')->name('selectCustomer');

        Route::put('/transactions/{transaction}/complete','TransactionController@complete')->name("complete");


        Route::get('/customers','CustomerController@index')->name('index');
        Route::post('/customers', 'CustomerController@store')->name('store');
        Route::put('customers/{customer}','CustomerController@update')->name('update');
        Route::delete('customers/delete/{customer}','CustomerController@destroy')->name('delete');

        Route::get('/customers/search','CustomerController@search')->name('search');
    });




    Route::group(['middleware' => 'admin'],function(){






        Route::get('/products', 'ProductController@index');
        Route::get('/products/create','ProductController@create');
        Route::post('/products','ProductController@store');
        Route::get('/products/{product}','ProductController@show')->name('products.show');
        Route::get('/products/{product}/edit','ProductController@edit');
        Route::put('/products/{product}','ProductController@update');






    } );



});


//Route::get('session/get','SessionController@accessSessionData');
//Route::get('session/set','SessionController@storeSessionData');
//Route::get('session/remove','SessionController@deleteSessionData');

