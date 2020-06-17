<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;


class StudentMealSubsController extends Controller
{

    /*@return \Illuminate\Http\Response*/

    public function index()
    {
        
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$allmealsubs=DB::table('student_meal_subscription')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','student_meal_subscription.Menu_Food_Item_ID')
			->where('Student_ID','=',$student_id->Student_ID)
			//->where('Meal_Subscription_Status','!=','Inactive')
			//->orderBy('Cos_Order_Num','desc')
			//->groupBy('Cos_Order_Num')
			->get();
		
		return view('student.student_mealsub')->with(['allmealsubs' => $allmealsubs]);
		
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
        $payment=DB::table('student')
		->where('Student_Name','=', $name)
		->select('Student_CardRegister_Status')
        ->first();

        if(empty($mealsubs_id)){
			$mealsubs_id=DB::table('student_meal_subscription')->max('Student_MealSubs_ID');
			$mealsubs_id++;
			if(empty($mealsubs_id)){
				$mealsubs_id = 1;
			}
		}	
        
        return view('student.student_mealsub_add')->with(['restaurants'=>$restaurants, 'foods' => $foods, 'payment' => $payment, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'mealsubs_id' => $mealsubs_id]);
        //return view('patron.order')->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
    }

    public function cancel()
    {
        //
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
			
		$id_deletion=DB::table('student_meal_subscription')
		->where('Student_ID','=', $student_id->Student_ID)
		->where('Meal_Subscription_Status','=','Active')
		->select('Student_MealSubs_ID')
		->first();
				
		DB::table('student_meal_subscription')
		->where('Student_ID','=', $student_id->Student_ID)
		->where('Meal_Subscription_Status','=','Active')
		->update(['Meal_Subscription_Status'=>'Inactive']);
		
		//DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		$message = "New Subscription Registration Cancelled";
		return redirect("/student_mealsub")->with('warning',$message);
    } 

    public function store(Request $request)
    {
        $student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
        ->first();
        
        $id = DB::table('student_meal_subscription')->max('Student_MealSubs_ID');
        if (empty($id)) {
            $id = 1;
          }
          
          else{
              $id = $id + 1;
          }
        
        $food_id = substr($request->input('food_item1'), 0, strspn($request->input('food_item1'), "0123456789"));
        
        DB::table('student_meal_subscription')
			->insert([
                ['Student_ID' => $student_id->Student_ID, 'Menu_Food_Item_ID' => $food_id,
                 'Food_Item_Qty' => $request->input('quantity1'), 'Total_Price' => $request->input('tcost'),
                 'Meal_Type' => $request->input('mealtype1'), 'Day' => $request->input('day1'),
				 'Meal_Time' => $request->input('mealtime1'),  'Meal_Subscription_Start_Date' => $request->input('start_subs_date'),
				 'Meal_Subscription_End_Date' => $request->input('end_subs_date'), 'Meal_Subscription_Frequency' => $request->input('mealfreq1'),
				 'Meal_Status' => $request->input('mealstat'), 'Meal_Subscription_Status' => $request->input('mealsubstat'),
				 'Meal_Subscription_Method' => $request->input('subsmealmeth1'),
				 'Student_Meal_Subscription_Payment_Method' => $request->input('subspaymeth')
				],
        ]);	
		
		DB::statement("ALTER TABLE `student_subscription_delivery_instruction` AUTO_INCREMENT = 1;");

		$mealsubsmethod = $request->input('subsmealmeth1');
		//dd($total_cost);
		if($mealsubsmethod == "Delivery"){
			DB::table('student_subscription_delivery_instruction')
				->insert([
					['Student_MealSubs_ID' => $id,'Location_ID' => $request->input('location_id') ],
			]);	
		}
		
		$paymentmethod = $request->input('subspaymeth');
		$total_cost = $request->input('tcost');
		$mealsubs_id = $id;
		$name = Auth()->user()->name;

		$deduction=DB::table('student')
		->where('Student_Name','=', $name)
		->select('Student_CardRegister_Status')
		->first();
		
		//$message = "Subscription Created Successfully";
		//return redirect("/student_mealsub")->with('success',$message);
		
		return view('student.student_subspayment')->with(['mealmethod' => $mealsubsmethod, 'subspaymeth' => $paymentmethod,
		 'deduction' => $deduction, 'total_cost' => $total_cost, 'mealsubs_id' => $mealsubs_id]);
    }

    public function detailshow($id)
    {
        $student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$meal_subs=DB::table('student_meal_subscription')
		->where('Student_ID','=',$student_id->Student_ID)
		->where('Student_MealSubs_ID','=',$id)
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
        $deduction=DB::table('student')
		->where('Student_Name','=', $name)
		->select('Student_CardRegister_Status')
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

		//$approved  = $cos_order->Cos_Order_Meal_Status;
		
		$food_selecteds = DB::table('student_meal_subscription')
		->where('Student_MealSubs_ID','=',$meal_subs->Student_MealSubs_ID)
		//->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();

		//$delivery_info = DB::table('subscription_delivery_instruction')
		//->where('MealSubs_ID','=',$meal_subs)
		//->get();
		
		return view('student.student_mealsub_edit_details')->with([ "meal_subs" => $meal_subs,'restaurants'=>$restaurants, 'foods' => $foods,
																'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff,
																'orderid' => $orderid]);
		
    }
	
	public function update(Request $request, $id)
    {
        //
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
        ->first(); 
		//dd($id);
		 $food_id = substr($request->input('food_item1'), 0, strspn($request->input('food_item1'), "0123456789"));
		 DB::table('student_meal_subscription')
			->where('Student_MealSubs_ID','=',$id)
			->update([
                'Student_ID' => $student_id->Student_ID, 'Menu_Food_Item_ID' => $food_id,
                 'Food_Item_Qty' => $request->input('quantity1'), 'Total_Price' => $request->input('tcost'),
                 'Meal_Type' => $request->input('mealtype1'), 'Day' => $request->input('day1'),
                 'Meal_Time' => $request->input('mealtime1'), 'Meal_Subscription_Start_Date' => $request->input('start_subs_date'),
				 'Meal_Subscription_End_Date' => $request->input('end_subs_date'), 'Meal_Subscription_Frequency' => $request->input('mealfreq1'),
				 'Meal_Status' => $request->input('mealstat'), 'Meal_Subscription_Status' => $request->input('mealsubstat'),
				 'Meal_Subscription_Method' => $request->input('mealmethod1')
        ]);	
		
		$message = "Subscription Updated Successfully";
		
		//echo $food_id;
        return redirect("/student_mealsub")->with('success',$message);
	}
	
	public function remove($id)
    {
        //
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
			
		$id_deletion=DB::table('student_meal_subscription')
		->where('Student_ID','=', $student_id->Student_ID)
		->where('Student_MealSubs_ID','=',$id)
		->first();

		if(!empty($id_deletion->Student_MealSubs_ID)){
			DB::table('student_subscription_delivery_instruction')->where('Student_MealSubs_ID', '=', $id_deletion->Student_MealSubs_ID)->delete();
			DB::table('student_meal_subscription')->where('Student_MealSubs_ID', '=', $id_deletion->Student_MealSubs_ID)->delete();
			
			
		}
		
		$message = "Subscription Cancelled Successfully";
		
		return redirect("/student_mealsub")->with('success',$message);
	} 
	
	public function payment(Request $request)
    {
		
		$name = Auth()->user()->name;
		$mealsubs_id = $request->input('mealsubs_id');
		$paymentmethod = $request->input('subspaymeth');		
		$total_cost = $request->input('total_cost');
		
		$mealsubsmethod = $request->input('mealmethod');
		
		$deduction=DB::table('student')
		->where('Student_Name','=', $name)
		->select('Student_CardRegister_Status')
		->first();
		
		//dd($specialfoods);
		$counter = 0;
		
		$student_id = DB::table('student')
			->select('Student_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
		
		if($paymentmethod == "card"){

			$card = DB::table("card_payment")
			->select('Card_Number')
			->where('Student_ID','=',$student_id->Student_ID)
			->first();
			
			$card_balance = DB::table('card_bank')
			->select('Card_Balance')
			->where('Card_Number','=',$card->Card_Number)
			->first();
			
			$card_balance=$card_balance->Card_Balance;
			
			$student_subs=DB::table('student_meal_subscription')
			->where('Student_ID','=',$student_id->Student_ID)
			->where('Student_MealSubs_ID','=',$mealsubs_id)
			->first();
			
			$error = "Insufficient funds. Either cancel or edit the order.";

			if($card_balance - $request->input("total_cost") <= 0){
				$total_cost=$request->input("total_cost");
				
				return view('student.student_subspayment')->with(['mealmethod' => $mealsubsmethod, 'subspaymeth' => $paymentmethod,
		        'deduction' => $deduction, 'total_cost' => $total_cost, 'mealsubs_id' => $mealsubs_id,  'error' => $error]);
				//return view('patron.payment')->with(['special_id'=>$special_id,'orderid'=>$orderid,'menuid'=>$menuid ,'mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
			}
			else{
				$card_balance = $card_balance - $request->input("total_cost");
			}	
			
		}

		$message = "Subscription Created Successfully";
		return redirect("/student_mealsub")->with('success',$message);
		
    }
}

	


?>