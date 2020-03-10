<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//create();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=','1')
		->where('menu_food_item.Quantity','>','0')
		->get();
		
	//	$foods=DB::table('menu')
	//	->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
	//	->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
	//	->where('menu.Menu_Date','=',date("Y-m-d"))
	//    ->where('menu_food_item.Quantity','>','0')
	//	->get();
		
		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
				
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status')
		->first();
			
		return view('patron.order')->with(['foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
			
		$id_deletion=DB::table('cos_order')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','orderingg')
		->select('Cos_Order_Num')
		->first();
		
		$total_cost = $request->input('tcost');
		
		$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
		
		if(!empty($id_deletion->Cos_Order_Num)){
			DB::table('cos_order')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('ordered_food_item')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('delivery_instruction')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
		}
		
		DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		$id = DB::table('cos_order')->max('Cos_Order_Num');
			
		
		if (empty($id)) {
		  $id = 1;
		}
		
		else{
			$id = $id + 1;
		}
		
		$iteration = $request->input('iteration');
		
		$idofd = DB::table('ordered_food_item')->max('Ordered_Food_Item_ID');
		
		if (empty($idofd)) {
		  $idofd = 1;
		}
		//echo $idofd;
		$mealmethod = $request->input('mealmethod');
		//echo $mealmethod;
		if($mealmethod == "delivery"){
			DB::table('delivery_instruction')
				->insert([
					['Cos_Order_Num' => $id,'D_Location' => $request->input('location_id'), 'D_Time_Window' => $request->input('location_time')],
			]);	
		}
				
		DB::table('cos_order')
			->insert([
				['Employee_ID' => $employee_id->Employee_ID, 'Cos_Meal_Date_Time' => $request->input('meal_date') , 'Cos_Order_Date_Time' => date("Y-m-d"), 'Cos_Order_Meal_Status' => 'orderingg'],
		]);	
		
		$deductions=DB::table('patron')
		->where('User_ID','=', Auth::user()->id)
		->select('Patron_Deduction_Status')
		->first();
		$deduction=$deductions->Patron_Deduction_Status;
		
		$food_id = array();
		for($i = 1;$i<$iteration;$i++){
			$food_item = "food_item".$i;
			$food_id[$i] = substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789"));
			
			$quantity=DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_id)
			->select('Quantity')
			->first();
			
			DB::table('ordered_food_item')
			->insert([
				['Cos_Order_Num' => $id, 'Menu_Food_Item_ID' => substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789")), 'Quantity' => $request->input('quantity'.$i)],
			]);	
			
			
				
		}
		
		for($i = 1;$i<$iteration;$i++){
			$food_item = "food_item".$i;
			$food_id1 = substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789"));
			$inputquan = $request->input('quantity'.$i);
			
			for($j = 1;$j<$iteration;$j++){
				
				
				if($j != $i){
					if($food_id1 == $food_id[$j]){
						
						$inputquan = $inputquan + $request->input('quantity'.$j);
					}
				
				
					if(($quantity->Quantity - $inputquan) < 0){
						
						$employee_id = DB::table('patron')
						->select('Employee_ID')
						->where('User_ID','=',Auth::user()->id)
						->first();
						
						$foods=DB::table('menu')
						->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
						->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
						->where('menu.Menu_ID','=','1')
						->where('menu_food_item.Quantity','>','0')
						->get();
						
						//	$foods=DB::table('menu')
						//	->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
						//	->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
						//	->where('menu.Menu_Date','=',date("Y-m-d"))
						//  ->where('menu.Menu_ID','=','1')
						//  ->where('menu_food_item.Quantity','>','0')
						//	->get();
							
						$locations=DB::table('location')
						->get();
						
						$order_cutoff=DB::table('order_cutoff')
						->select('Order_Cutoff_Time')
						->first();
									
						$deduction=DB::table('patron')
						->where('Patron_FName','=', Auth::user()->name)
						->select('Patron_Deduction_Status')
						->first();
								
						$cos_order=DB::table('cos_order')
						->where('Employee_ID','=',$employee_id->Employee_ID)
						->where('Cos_Order_Meal_Status','=','orderingg')
						->select('Cos_Order_Num','Cos_Meal_Date_Time','Cos_Order_Date_Time')
						->first();
						
						$food_selecteds = DB::table('ordered_food_item')
						->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
						->orderBy('Ordered_Food_Item_ID', 'DESC')
						->get();
						
						$error = "Not enough food item in inventory to cater for your order. Either edit your order or cancel it.";
						
						if($mealmethod == "delivery"){
							$delivery_info=DB::table('delivery_instruction')
							->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
							->first();
							
							return view('patron.orderfinal')->with(['mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds, 'error' => $error]);
						
						}
						return view('patron.orderfinal')->with(['mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds, 'error' => $error]);
						
						
					}
				}		
				
			}
		}
		
		return view('patron.payment')->with(['mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost]);
    }
	
	 public function payment(Request $request)
    {
        //
		$mealmethodp = $request->input('mealmethod');
		
		$mealmethod = $request->input('mealmethodn');
		$deduction = $request->input('deduction');
		$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
		if($mealmethodp == "payroll"){
			
			
			$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			$error = "Total cost exceeded current salary amount. Either cancel or edit the order.";
			if($pay->Salary - $request->input("tcost") <= 0){
				$total_cost=$request->input("tcost");
				return view('patron.payment')->with(['mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
			}
			
			else{
				$salary = $pay->Salary - $request->input("tcost");
				
			//	DB::table('payroll')
			//		->where('Employee_ID','=' ,$employee_id->Employee_ID)
			//		->update(['Salary' => $salary]);
				
			}
			//$request->input("tcost");			
		}
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=','1')
		->where('menu_food_item.Quantity','>','0')
		->get();
		
		//	$foods=DB::table('menu')
		//	->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		//	->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		//	->where('menu.Menu_Date','=',date("Y-m-d"))
		//    ->where('menu_food_item.Quantity','>','0')
		//	->get();
			
		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
					
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status')
		->first();
				
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','orderingg')
		->select('Cos_Order_Num','Cos_Meal_Date_Time','Cos_Order_Date_Time')
		->first();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderview')->with(['mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderview')->with(['mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
				
		
		//echo $request->input("tcost");
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
