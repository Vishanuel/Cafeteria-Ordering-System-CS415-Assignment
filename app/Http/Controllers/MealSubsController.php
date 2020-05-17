<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;


class MealSubsController extends Controller
{

    /*@return \Illuminate\Http\Response*/

    public function index()
    {
        
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$allmealsubs=DB::table('meal_subscription')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','meal_subscription.Menu_Food_Item_ID')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			//->where('Meal_Subscription_Status','!=','Inactive')
			//->orderBy('Cos_Order_Num','desc')
			//->groupBy('Cos_Order_Num')
			->get();
		
		return view('patron.patronmealsub')->with(['allmealsubs' => $allmealsubs]);
		
    }




//
//Show form for new subscription
//
    public function create()
    {   
        //
        //allow user to select restaurant
        //
        $restaurants=DB::table('restaurant')        
        ->get();
        //
        //Allow user to select food
        //
        $foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
        ->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
        //->where('menu.Menu_ID','=',$menuid)		
		->where('menu_food_item.Quantity','>','0')
        ->get();

        $order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();

        $locations=DB::table('location')
		->get();
        
        $name = Auth()->user()->name;
        $deduction=DB::table('patron')
		->where('Patron_FName','=', $name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
        ->first();

        if(empty($orderid)){
			$orderid=DB::table('cos_order')->max('Cos_Order_Num');
			$orderid++;
			if(empty($orderid)){
				$orderid = 1;
			}
		}	
        
        return view('patron.patronmealsub_add')->with(['restaurants'=>$restaurants, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid]);
        //return view('patron.order')->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
    }

    public function cancel()
    {
        //
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
			
		$id_deletion=DB::table('meal_subscription')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Meal_Subscription_Status','=','Active')
		->select('MealSubs_ID')
		->first();
				
		DB::table('meal_subscription')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Meal_Subscription_Status','=','Active')
		->update(['Meal_Subscription_Status'=>'Inactive']);
		
		//DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		return redirect("/mealsub");
    } 

    public function store(Request $request)
    {
        $employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
        ->first();
        
        $id = DB::table('meal_subscription')->max('MealSubs_ID');
        if (empty($id)) {
            $id = 1;
          }
          
          else{
              $id = $id + 1;
          }
        
        $food_id = substr($request->input('food_item1'), 0, strspn($request->input('food_item1'), "0123456789"));
        
        DB::table('meal_subscription')
			->insert([
                ['Employee_ID' => $employee_id->Employee_ID, 'Menu_Food_Item_ID' => $food_id,
                 'Food_Item_Qty' => $request->input('quantity1'), 'Total_Price' => $request->input('tcost'),
                 'Meal_Type' => $request->input('mealtype1'), 'Day' => $request->input('day1'),
				 'Meal_Time' => $request->input('mealtime1'),  'Meal_Subscription_Start_Date' => $request->input('start_subs_date'),
				 'Meal_Subscription_End_Date' => $request->input('end_subs_date'), 'Meal_Subscription_Frequency' => $request->input('mealfreq1'),
				 'Meal_Status' => $request->input('mealstat'), 'Meal_Subscription_Status' => $request->input('mealsubstat'),
				 'Meal_Subscription_Method' => $request->input('subsmealmeth1')
				],
        ]);	
		
		DB::statement("ALTER TABLE `subscription_delivery_instruction` AUTO_INCREMENT = 1;");

		$mealsubsmethod = $request->input('subsmealmeth1');
		//dd($total_cost);
		if($mealsubsmethod == "Delivery"){
			DB::table('subscription_delivery_instruction')
				->insert([
					['MealSubs_ID' => $id,'Location_ID' => $request->input('location_id') ],
			]);	
		}

        return redirect("/mealsub");
    }

    public function detailshow($id)
    {
        $employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$meal_subs=DB::table('meal_subscription')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('MealSubs_ID','=',$id)
		->first();
		
		 $restaurants=DB::table('restaurant')        
        ->get();
        //
        //Allow user to select food
        //
        $foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
        ->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
        //->where('menu.Menu_ID','=',$menuid)		
		->where('menu_food_item.Quantity','>','0')
        ->get();

        $order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();

        $locations=DB::table('location')
		->get();
        
        $name = Auth()->user()->name;
        $deduction=DB::table('patron')
		->where('Patron_FName','=', $name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
        ->first();

        if(empty($orderid)){
			$orderid=DB::table('cos_order')->max('Cos_Order_Num');
			$orderid++;
			if(empty($orderid)){
				$orderid = 1;
			}
		}	
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
        ->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
        //->where('menu.Menu_ID','=',$menuid)		
		->where('menu_food_item.Quantity','>','0')
        ->get();
		
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
		->first();	

		//$approved  = $cos_order->Cos_Order_Meal_Status;
		
		$food_selecteds = DB::table('meal_subscription')
		->where('MealSubs_ID','=',$meal_subs->MealSubs_ID)
		//->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();

		//$delivery_info = DB::table('subscription_delivery_instruction')
		//->where('MealSubs_ID','=',$meal_subs)
		//->get();
		
		return view('patron.patronmealsub_editdetails')->with([ "meal_subs" => $meal_subs,'restaurants'=>$restaurants, 'foods' => $foods,
																'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff,
																'orderid' => $orderid]);
		
    }
	
	public function update(Request $request, $id)
    {
        //
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
        ->first(); 
		//dd($id);
		 $food_id = substr($request->input('food_item1'), 0, strspn($request->input('food_item1'), "0123456789"));
		 DB::table('meal_subscription')
			->where('MealSubs_ID','=',$id)
			->update([
                'Employee_ID' => $employee_id->Employee_ID, 'Menu_Food_Item_ID' => $food_id,
                 'Food_Item_Qty' => $request->input('quantity1'), 'Total_Price' => $request->input('tcost'),
                 'Meal_Type' => $request->input('mealtype1'), 'Day' => $request->input('day1'),
                 'Meal_Time' => $request->input('mealtime1'), 'Meal_Subscription_Start_Date' => $request->input('start_subs_date'),
				 'Meal_Subscription_End_Date' => $request->input('end_subs_date'), 'Meal_Subscription_Frequency' => $request->input('mealfreq1'),
				 'Meal_Status' => $request->input('mealstat'), 'Meal_Subscription_Status' => $request->input('mealsubstat'),
				 'Meal_Subscription_Method' => $request->input('mealmethod1')
        ]);	
        
		
		//echo $food_id;
        return redirect("/mealsub");
    }
}

	


?>