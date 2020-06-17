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
Route::redirect('/','/welcome')->middleware('guest');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('usertype');
Route::resource('welcome','WelcomeController');
Route::resource('cordova','CordovaController');

Route::group(['middleware' => ['auth']], function(){
Route::resource('order','OrderController');
Route::resource('tutorial','TutorialController');
Route::resource('student_order','OrderStudentController');
Route::resource('home','HomeController');
Route::resource('student_home','HomeStudentController');
Route::resource('menu', 'MenuController');
Route::resource('menu_manager', 'MenuManagerHomeController');
Route::resource('category', 'CategoryController');
Route::resource('specialmenu', 'SpecialsController');
Route::resource('item', 'ItemController');
Route::resource('ingredient', 'IngredientController');
Route::resource('custom_meal','CustomMealController');
Route::resource('cafeteria', 'CafeteriaController');
Route::resource('deliverer', 'DelivererController');
Route::resource('register','RegisterController');
Route::resource('studentregister','RegisterStudentController');
//Route::resource('mealsub','MealSubsController');
//Route::resource('cafe_subs','Cafe_MealSubsController');
Route::resource('subs_deliv', 'SubscriptionDelivererController');
Route::resource('mealsub','MealSubsController');
Route::resource('cafe_subs','Cafe_MealSubsController');
Route::resource('subs_deliv', 'SubscriptionDelivererController');
Route::resource('student_subs_deliv', 'StudentSubscriptionDelivererController');
Route::resource('student_mealsub','StudentMealSubsController');
Route::resource('student_cafe_subs','Cafe_MealSubs_StudentController');
ROute::resource('recipe','RecipeController');

Route::match(['get', 'post'],'filter_menu', [
    'uses' => 'MenuController@filter'
]);
Route::match(['get', 'post'],'tutorial_order_create/{menuid}', [
    'uses' => 'TutorialController@create'
]);

Route::match(['get', 'post'],'tutorial_order_payment', [
    'uses' => 'TutorialController@payment'
]);

Route::match(['get', 'post'],'tutorial_order_payment_confirm', [
    'uses' => 'TutorialController@confirm'

]);

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



//Patron Meal Subs
//
Route::match(['get', 'post'],'mealsub_add', [
    'uses' => 'MealSubsController@create'
])->name('mealsub_add');

Route::match(['get', 'post'],'mealsub_cancel', [
    'uses' => 'MealSubsController@cancel'
]);

Route::match(['get', 'post'],'mealsub_edit_details/{id}', [
    'uses' => 'MealSubsController@detailshow'
]); 

Route::match(['get', 'post'],'mealsub_remove/{id}', [
    'uses' => 'MealSubsController@remove'
]);

Route::match(['get', 'post'],'mealsub_payment', [
    'uses' => 'MealSubsController@payment'
]);

//
//Cafe Staff Meal Subs
//
Route::match(['get', 'post'],'subs_delivery_request/{id}', [
    'uses' => 'Cafe_MealSubsController@delivery_request'
]);

Route::match(['get', 'post'],'subs_process_payment/{id}', [
    'uses' => 'Cafe_MealSubsController@process_payment'
]);


//
//Deliverer Meal Subs
//
Route::match(['get', 'post'],'student_subs_delivery_request/{id}', [
    'uses' => 'Cafe_MealSubs_StudentController@delivery_request'
]);


//
//Student Meal Subs
//
Route::match(['get', 'post'],'student_mealsub_add', [
    'uses' => 'StudentMealSubsController@create'
])->name('student_mealsub_add');

Route::match(['get', 'post'],'student_mealsub_cancel', [
    'uses' => 'StudentMealSubsController@cancel'
]);

Route::match(['get', 'post'],'student_mealsub_edit_details/{id}', [
    'uses' => 'StudentMealSubsController@detailshow'
]); 

Route::match(['get', 'post'],'student_mealsub_remove/{id}', [
    'uses' => 'StudentMealSubsController@remove'
]);

Route::match(['get', 'post'],'student_mealsub_payment', [
    'uses' => 'StudentMealSubsController@payment'
]);
                 

Route::resource('restaurant','RestaurantController');
Route::resource('tutorial_restaurant','TutorialRestaurantController');
});
//Route::redirect('/home', '/restaurant');


  