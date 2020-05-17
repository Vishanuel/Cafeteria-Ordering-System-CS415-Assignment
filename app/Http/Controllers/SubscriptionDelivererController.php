<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

Class SubscriptionDelivererController extends Controller{


    public function index()
    {
        //
		$meal_deliverer = DB::table('meal_deliverer')
		->select('Restaurant_ID','Meal_Deliverer_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
        
        $deliverers=DB::table('subscription_delivery_request')
        ->join('subscription_delivery_instruction','subscription_delivery_instruction.Subscription_Delivery_ID','=','subscription_delivery_request.Subscription_Delivery_ID')
        ->join('meal_subscription','meal_subscription.MealSubs_ID','=','subscription_delivery_instruction.MealSubs_ID')
        ->join('location','location.Location_ID','=','subscription_delivery_instruction.Location_ID')
        ->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','meal_subscription.Menu_Food_Item_ID')
        ->get()
        ->unique('Subscription_Delivery_Request_ID');

		//$deliverers=DB::table('subscription_delivery_request')
        //->join('subscription_delivery_instruction','subscription_delivery_request.Subscription_Delivery_ID','=','subscription_delivery_instruction.Subscription_Delivery_ID')
        //->join('meal_subscription','meal_subscription.MealSubs_ID','=','subscription_delivery_instruction.MealSubs_ID')
        //->join('location','location.Location_ID','=','subscription_delivery_instruction.Location_ID')
       // ->join('menu_food_item','Menu_Food_Item_ID','=','meal_subscription.Menu_Food_Item_ID');
		//->join('cos_order','cos_order.Cos_Order_Num','=','delivery_instruction.D_Instruction_ID')
		//->join('ordered_food_item','cos_order.Cos_Order_Num','=','ordered_food_item.Cos_Order_Num')
		//->join('menu_food_item','ordered_food_item.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
		//->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		//->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		//->join('patron','cos_order.Employee_ID','=','patron.Employee_ID')
		//->where('delivery_request.Meal_Deliverer_ID','=',$meal_deliverer->Meal_Deliverer_ID)
		//->get()
		//->unique('D_Request_ID');
		
		return view('meal deliverer.subsviewall')->with(['deliverers' => $deliverers]);
    }

    public function edit($id)
    {
        //
		DB::table('meal_subscription')->where('MealSubs_ID','=',$id)->update(['Meal_Status'=>'Delivered']);
		return redirect('/subs_deliv')->with('success','Meal Delivered');
    }

}

?>