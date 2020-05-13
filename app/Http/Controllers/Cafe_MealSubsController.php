<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use Carbon\Carbon;

class Cafe_MealSubsController extends Controller
{
    public function index()
    {
        //
		$restaurant_id = DB::table('cafeteria_staff')
		->select('Restaurant_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
        
        //Get current Day
        //$now = new Carbon();
        //$dayofweek = Carbon::now()->englishDayofWeek;

		$allmealsubs=DB::table('meal_subscription')
		//->join('meal_subscription','meal_subscription.Menu_Food_Item_ID','=','menu_food_item.menu_food_item_ID')
			
		->select('*')
        //->where('menu.Restaurant_ID','=',$restaurant_id->Restaurant_ID)
        //->where('Day','==',$dayofweek)
		->where('Meal_Status','!=','Prepared')
		->where('Meal_Subscription_Status','!=','Inactive')
		->get();
		//->unique('MealSubs_ID');
		
		return view('cafeteria staff.Subsviewall')->with(['allmealsubs' => $allmealsubs]);
    }

    public function edit($id)
    {
        //

		
		$meal_subs=DB::table('meal_subscription')
		->where('MealSubs_ID','=',$id)
		->first();
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		//->where('menu.Menu_ID','=',$menuid)
		->get();
		
		
		//$deduction=DB::table('patron')
		//->where('Patron_FName','=', Auth::user()->name)
		//->select('Patron_Deduction_Status')
		//->first();
		

		//$approved = $cos_order->Cos_Order_Meal_Status;
		
		//$food_count=DB::table('ordered_food_item')
		//->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		//->count();
		
		$food_selecteds = DB::table('meal_subscription')
		->where('MealSubs_ID','=',$meal_subs->MealSubs_ID)
		//->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
        
		return view('cafeteria staff.Subsviewdetails')->with(['foods' => $foods, 'meal_subs' => $meal_subs, 'food_selecteds' => $food_selecteds]);
		
		
    }


    public function update(Request $request, $id)
    {

        $meal_status = $request->input('meal_status');
		DB::table('meal_subscription')->where('MealSubs_ID','=',$id)->update(['meal_status'=>$meal_status]);
		return redirect('/cafe_subs')->with('success', 'Meal status updated');;


    }

}

?>