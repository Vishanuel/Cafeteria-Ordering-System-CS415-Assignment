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
		//->where('Meal_Status','!=','Prepared')
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
	
	public function delivery_request($id)
	{
		//
		$restaurant_id = DB::table('cafeteria_staff')
		->select('Restaurant_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$meal_deliverer_id = DB::table('meal_deliverer')
		->select('Meal_Deliverer_ID')
		->where('Restaurant_ID','=',$restaurant_id->Restaurant_ID)
		->first();
		
		
		
		$SD_Instruction_ID = DB::table('patron_subscription_delivery_instruction')
		->where('MealSubs_ID','=',$id)
		->first();
		

		

		DB::table('meal_subscription')->where('MealSubs_ID','=',$id)->update(['Meal_Status'=>'Pending Delivery']);
		DB::statement("ALTER TABLE `patron_subscription_delivery_request` AUTO_INCREMENT = 1;");
		DB::table('patron_subscription_delivery_request')->insert(['Patron_Subscription_Delivery_Instruction_ID'=>$SD_Instruction_ID->Patron_Subscription_Delivery_Instruction_ID]);
		return redirect('/cafe_subs')->with('success', 'Delivery request sent');
	}
	
	public function deliv_request($id)
	{
		$restaurant_id = DB::table('cafeteria_staff')
		->select('Restaurant_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$meal_deliverer_id = DB::table('meal_deliverer')
		->select('Meal_Deliverer_ID')
		->where('Restaurant_ID','=',$restaurant_id->Restaurant_ID)
		->first();
		
		$D_Instruction_ID = DB::table('delivery_instruction')->where('Cos_Order_Num','=',$id)->first();
		
		
		DB::table('cos_order')->where('Cos_Order_Num','=',$id)->update(['Cos_Order_Meal_Status'=>'Pending Delivery']);
		DB::table('delivery_request')->insert(['D_Instruction_ID' => $D_Instruction_ID->D_Instruction_ID, 'Meal_Deliverer_ID'=>$meal_deliverer_id->Meal_Deliverer_ID]);
		return redirect('/cafe_subs')->with('success', 'Delivery request sent');
	}

	public function process_payment($id){
        try{
			
			$meal_sub=DB::table('meal_subscription')
			//->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('MealSubs_ID','=',$id)
			->first();

			$employee_id=DB::table('meal_subscription')
				//->where('Employee_ID','=',$employee_id->Employee_ID)
				->select('Employee_ID')
				->where('MealSubs_ID','=',$id)
				->first();

		
			if($meal_sub->Meal_Subscription_Payment_Method == "payroll"){
				$pay = DB::table('payroll')
				->select('Salary')
				->where('Employee_ID','=',$meal_sub->Employee_ID)
				->first();
				
				$salary = $pay->Salary;
			
				$meal_sub=DB::table('meal_subscription')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				//->where('Cos_Order_Meal_Status','=','Editing')
				->first();
					
				
				if(!empty($meal_sub) && $meal_sub->Meal_Subscription_Payment_Method == "payroll"){
					
					$salary = $salary + $meal_sub->Total_Price;
				}
				
				$meal_sub=DB::table('meal_subscription')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('MealSubs_ID','=',$id)
				->first();
				
				$salary = $salary - $meal_sub->Total_Price;
					
				DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
			
					
			}
			if($meal_sub->Meal_Subscription_Payment_Method == "card"){

			    $employee_id=DB::table('meal_subscription')
				//->where('Employee_ID','=',$employee_id->Employee_ID)s				
				->where('MealSubs_ID','=',$id)
				->select('Employee_ID')
				->first();

				//$employee_id=DB::table('meal_subscription')
				//->where('Employee_ID','=',$employee_id->Employee_ID)
				//->select('Employee_ID')
				//->where('MealSubs_ID','=',$id)
				//->first();

				$card = DB::table("card_payment")
				->select('Card_Number')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->first();
				
				$card_balance = DB::table('card_bank')
				->select('Card_Balance')
				->where('Card_Number','=',$card->Card_Number)
				->first();
				
				$card_bal=$card_balance->Card_Balance;
				
				$meal_sub=DB::table('meal_subscription')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				//->where('Cos_Order_Meal_Status','=','Editing')
				->first();
				
				if(!empty($meal_sub) && $meal_sub->Meal_Subscription_Payment_Method == "card"){
					$card_bal = $card_bal + $meal_sub->Total_Price;
				}
				
				$meal_sub=DB::table('meal_subscription')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('MealSubs_ID','=',$id)
				->first();
				
				$card_bal = $card_bal - $meal_sub->Total_Price;
				
				$error = "Insufficient funds.Cannot Process Payment.";

				if(($card_bal - $meal_sub->Total_Price) <= 0){
					
					return view('cafe_subs')->with('error', $error);
				}
				else{
					DB::table('card_bank')->where('Card_Number', '=',$card->Card_Number)->update(['Card_Balance' => $card_bal]);
					
				}
			}
			DB::table('meal_subscription')->where('MealSubs_ID','=',$id)->update(['Paid'=> 1]);
			return redirect('cafe_subs')->with('success','Payment Processed!');
			
		}
		catch(exception $e){
			return redirect('cafe_subs')->with('error','Unable to Process Payment\n'.$e);
		}
		
		//DB::statement("UPDATE 'meal_subscription' SET 'Paid' = 1 WHERE 'MealSubs_ID' = ?,[$id];");


	//return redirect('/cafeteria')->with('success', 'Payment Processed!');
	}
}

?>