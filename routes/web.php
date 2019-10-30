<?php 

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

Route::get('/showCustomers', 'HomeController@showCustomers')->name('showCustomers')->middleware('can:showCustomer');;
Route::get('/showProducts', 'HomeController@showProducts')->name('showProducts')->middleware('can:showProducts');
Route::get('/showOrders', 'HomeController@showOrders')->name('showOrders')->middleware('can:showOrders');

Route::any('/customerData', 'HomeController@customerData')->name('customerData');
Route::any('/productData', 'HomeController@productData')->name('productData');
Route::any('/orderData', 'HomeController@orderData')->name('orderData');

Route::get('/orderDetail/{id}', 'HomeController@orderDetail')->name('orderDetail')->middleware('can:showOrders');
