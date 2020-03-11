<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$orderall=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','!=','orderingg')
			->get();
		
		return view('patron.orderviewall')->with(['orderall' => $orderall]);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menuid)
    {
        //
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		//->where('menu.Restaurant_ID','=',$id)
		//->where('menu.Menu_Date','=',date("Y-m-d"))
		->where('menu_food_item.Quantity','>','0')
		->get();
		
	//	$foods=DB::table('menu')
	//	->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
	//	->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
	//	->where('menu.Menu_Date','=',date("Y-m-d"))
	//  ->where('menu_food_item.Quantity','>','0')
	//  ->where('menu.Menu_ID','=','1')
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
		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$orderid=DB::table('cos_order')->max('Cos_Order_Num');
		
		$id_deletion=DB::table('cos_order')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','orderingg')
		->select('Cos_Order_Num')
		->first();
		
		if(!empty($id_deletion)){
			$orderid = $id_deletion->Cos_Order_Num;
			
		}
		
		if(empty($orderid)){
			$orderid = 1;
		}	
		
		return view('patron.order')->with(['foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
    
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
		$orderid = $request->input('orderid');
		$menuid = $request->input('menuid');
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
				['Employee_ID' => $employee_id->Employee_ID, 'Cos_Meal_Date_Time' => $request->input('meal_date') , 'Cos_Order_Date_Time' => date("Y-m-d"), 'Cos_Order_Meal_Status' => 'orderingg', 'Cos_Order_Cost' => $total_cost, 'Cos_Order_Payment_Method' => 'NN'],
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
						//->where('Cos_Order_Meal_Status','=','orderingg')
						->where('Cos_Order_Num','=',$orderid)
						->first();
						
						$orderid = $cos_order->Cos_Order_Num;
						
						$food_selecteds = DB::table('ordered_food_item')
						->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
						->orderBy('Ordered_Food_Item_ID', 'DESC')
						->get();
						
						$food_count=DB::table('ordered_food_item')
						->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
						->count();
						
						$error = "Not enough food item in inventory to cater for your order. Either edit your order or cancel it.";
						
						//$food_count++;
						
						if($mealmethod == "delivery"){
							$delivery_info=DB::table('delivery_instruction')
							->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
							->first();
							
							return view('patron.orderfinal')->with(['orderid'=>$orderid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds, 'error' => $error, 'food_count' => $food_count,'menuid' => $menuid]);
						
						}
						return view('patron.orderfinal')->with(['orderid'=>$orderid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds, 'error' => $error, 'food_count' => $food_count,'menuid' => $menuid]);
						
						
					}
				}		
				
			}
		}
		
		return view('patron.payment')->with(['mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'orderid' => $orderid, 'menuid' => $menuid]);
    }
	
	 public function payment(Request $request)
    {
        //
		$menuid = $request->input('menuid');
		$mealmethodp = $request->input('mealmethod');
		$orderid = $request->input('orderid');
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
				return view('patron.payment')->with(['orderid'=>$orderid,'menuid'=>$menuid ,'mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
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
		->get();
		
		//	$foods=DB::table('menu')
		//	->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		//	->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		//	->where('menu.Menu_Date','=',date("Y-m-d"))
		//  ->where('menu_food_item.Quantity','>','0')
		// 	->where('menu.Menu_ID','=','1')
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
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		DB::table('cos_order')->where('Cos_Order_Num', '=',$cos_order->Cos_Order_Num)->update(['Cos_Order_Payment_Method' => $mealmethodp]);
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderview')->with(['menuid' => $menuid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderview')->with(['menuid' => $menuid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
				
		
		//echo $request->input("tcost");
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function confirm(Request $request)
    {
        //
		$orderid = $request->input('orderid');
		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		foreach($food_selecteds as $food_select){
			$quantity = DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
			->first();
			
			$finalquantity = $quantity->Quantity - $food_select->Quantity;

			DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$food_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
			
		}
		
		$pay = DB::table('payroll')
		->select('Salary')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->first();
		
		$salary = $pay->Salary - $cos_order->Cos_Order_Cost;
		
		DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
		DB::table('cos_order')->where('Cos_Order_Num', '=',$orderid)->update(['Cos_Order_Meal_Status' => 'Approved']);
		//echo $request->input("tcost");
		
		
		$data = array();
		$mealmethodcheck=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
		if(empty($mealmethodcheck)){
			$mealmethod = "pick-up";
			$data['delivery_time'] = "Nan";
			$data['delivery_location'] = "Nan";
			
		}	
		
		else{
			$mealmethod = "delivery";
			$data['delivery_time'] = $mealmethodcheck->D_Time_Window;
			$data['delivery_location'] = $mealmethodcheck->D_Location;
		}
		
		$data['Cos_Order_Num'] = $cos_order->Cos_Order_Num;
		$data['Cos_Order_Date_Time'] = $cos_order->Cos_Order_Date_Time;
		$data['Cos_Meal_Date_Time'] = $cos_order->Cos_Meal_Date_Time;
		$data['Cos_Order_Meal_Status'] = $cos_order->Cos_Order_Meal_Status;
		$data['Cos_Order_Cost'] = $cos_order->Cos_Order_Cost;
		$data['Cos_Order_Payment_Method'] = $cos_order->Cos_Order_Payment_Method;
		$data['delivery_pickup'] = $mealmethod;
		
		
		$i = 0;
		foreach($food_selecteds as $food_select){
			$quantity = DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
			->first();
			
			$data['Food_Name'][$i] = $quantity->Food_Name;
			$data['Quantity'][$i] = $food_select->Quantity;
			$data['Price'][$i] = $food_select->Quantity * $quantity->Price;
			$i++;
		}
		
		$data['count'] = $i;
		
        Mail::send('patron.orderemail', $data, function($message) {
 
            $message->to(Auth::user()->email, 'LCNotif')
 
                    ->subject('Order Info');
        });
		
		$data['username'] = Auth::user()->name;
		Mail::send('patron.restaurantemail', $data, function($message) {
 
            $message->to(Auth::user()->email, 'LCNotif')
 
                    ->subject('Restaurant Order Info');
        });
		
		return redirect('restaurant');
    } 
	 
	
    public function show($id)
    {
        //
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$menuid=DB::table('ordered_food_item')	
		->join('menu_food','menu_food.Menu_Food_Item_ID','=','ordered_food_item.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$menuid=$menuid->Menu_ID;
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=','1')
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
				

		$approved  = $cos_order->Cos_Order_Meal_Status;
		
		$food_count=DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->count();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		$mealmethodcheck=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
		if(empty($mealmethodcheck)){
			$mealmethod = "pick-up";
			
		}	
		
		else{
			$mealmethod = "delivery";
			
		}
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderview')->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderview')->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orderid)
    {
        //
		//$orderid = $request->input('orderid');
		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$menuid=DB::table('ordered_food_item')	
		->join('menu_food','menu_food.Menu_Food_Item_ID','=','ordered_food_item.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$menuid=$menuid->Menu_ID;
		
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
				
		
		//$approved = $cos_order->Cos_Order_Meal_Status;
		if($cos_order->Cos_Order_Meal_Status == "Approved"){
			$permission = "edit";
			
			$food_selecteds = DB::table('ordered_food_item')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->orderBy('Ordered_Food_Item_ID', 'DESC')
			->get();
			
			foreach($food_selecteds as $food_select){
				$quantity = DB::table('menu_food_item')
				->where('Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
				->first();
				
				$finalquantity = $quantity->Quantity + $food_select->Quantity;

				DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$food_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
				
			}
			
			
		}
		
		$food_count=DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->count();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		$mealmethodcheck=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
		if(empty($mealmethodcheck)){
			$mealmethod = "pick-up";
			
		}	
		
		else{
			$mealmethod = "delivery";
			
		}
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderfinal')->with(['menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);
		
		}
		return view('patron.orderfinal')->with(['menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);
			
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
	public function remove($id)
    {
        //
		if(!empty($id)){
			DB::table('cos_order')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('ordered_food_item')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('delivery_instruction')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
		}
		
		return redirect('/order');
    } 
	 
	 
    public function destroy($id)
    {
        //
    }
	
	public function detailshow($id)
    {
        //
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$menuid=DB::table('ordered_food_item')	
		->join('menu_food','menu_food.Menu_Food_Item_ID','=','ordered_food_item.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$menuid=$menuid->Menu_ID;
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=','1')
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
				

		$approved  = $cos_order->Cos_Order_Meal_Status;
		
		$food_count=DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->count();
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		$mealmethodcheck=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
		if(empty($mealmethodcheck)){
			$mealmethod = "pick-up";
			
		}	
		
		else{
			$mealmethod = "delivery";
			
		}
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderviewdetails')->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderviewdetails')->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
    }
}
