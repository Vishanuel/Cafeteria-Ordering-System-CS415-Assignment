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
//Route::get('/home', 'HomeController@index')->name('home')->middleware('usertype');
Route::resource('order','OrderController');
Route::resource('student_order','OrderStudentController');
Route::resource('home','HomeController');
Route::resource('student_home','HomeStudentController');
Route::resource('menu', 'MenuController');
Route::resource('category', 'CategoryController');
Route::resource('specialmenu', 'SpecialsController');
Route::resource('item', 'ItemController');
Route::resource('ingredient', 'IngredientController');
Route::resource('cafeteria', 'CafeteriaController');
Route::resource('deliverer', 'DelivererController');
Route::resource('register','RegisterController');

Route::match(['get', 'post'],'student_order_create/{menuid}', [
    'uses' => 'OrderStudentController@create'
]);

Route::match(['get', 'post'],'student_order_remove/{id}', [
    'uses' => 'OrderStudentController@remove'
]); 
 

Route::match(['get', 'post'],'student_order_payment', [
    'uses' => 'OrderStudentController@payment'
]);
 
Route::match(['get', 'post'],'student_order_edit_details/{id}', [
    'uses' => 'OrderStudentController@detailshow'
]); 
  

Route::match(['get', 'post'],'student_order_payment_confirm', [
    'uses' => 'OrderStudentController@confirm'
]);

Route::match(['get', 'post'],'student_order_cancel', [
    'uses' => 'OrderStudentController@cancel'
]);

Route::match(['get', 'post'],'student_order_edit/{orderid}', [
    'uses' => 'OrderStudentController@edit'
])->name('student_order_edit');

Route::match(['get', 'post'],'student_order_edit_approved/{orderid}', [
    'uses' => 'OrderStudentController@editapproved'
])->name('student_order_edit_approved');

///

Route::match(['get', 'post'],'delivery_request/{id}', [
    'uses' => 'CafeteriaController@delivery_request'
]);

Route::match(['get', 'post'],'delete_delivery_request/{id}/{order}', [
    'uses' => 'CafeteriaController@delete_delivery_request'
]);

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

Route::match(['get', 'post'],'order_edit_approved/{orderid}', [
    'uses' => 'OrderController@editapproved'
])->name('order_edit_approved');

Route::resource('restaurant','RestaurantController');

//Route::redirect('/home', '/restaurant');
  