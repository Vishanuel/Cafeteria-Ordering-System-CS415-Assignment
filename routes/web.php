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
Route::redirect('/','/login');
Route::get('/home', 'HomeController@index')->name('home')->middleware('usertype');
Route::resource('order','OrderController');
Route::resource('specialmenu', 'SpecialsController');
Route::resource('menu', 'MenuController');
Route::match(['get', 'post'],'order_create/{menuid}', [
    'uses' => 'OrderController@create'
]);

Route::match(['get', 'post'],'order_remove/{id}', [
    'uses' => 'OrderController@remove'
  ]); 
 

Route::match(['get', 'post'],'order_payment', [
    'uses' => 'OrderController@payment'
  ]);
 
Route::match(['get', 'post'],'order_edit_details/{id}', [
    'uses' => 'OrderController@detailshow'
  ]); 
  

Route::match(['get', 'post'],'order_payment_confirm', [
    'uses' => 'OrderController@confirm'
]);

Route::match(['get', 'post'],'order_cancel', [
    'uses' => 'OrderController@cancel'
]);

Route::match(['get', 'post'],'order_edit/{orderid}', [
    'uses' => 'OrderController@edit'
])->name('order_edit');

Route::resource('restaurant','RestaurantController');

//Route::redirect('/home', '/restaurant');
  