<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Mail;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		function time_to_decimal($time) {
			$timeArr = explode(':', $time);
			$decTime = ($timeArr[0]*3600) + ($timeArr[1]*60) + ($timeArr[2]);
		 
			return $decTime;
		}
		echo time_to_decimal(date("H:i:s"))."\n";
		echo time_to_decimal(date("h:i:s"))."\n";
		echo date("H:i:s");
		
		
		//
		echo time_to_decimal(date("H:i:s"))."\n";
		
		if(time_to_decimal(date("H:i:s")) >= time_to_decimal("05:00:00") && time_to_decimal(date("H:i:s")) <= time_to_decimal("18:20:00")){
			echo "stupid";
		}
        /*
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$orderall=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','!=','orderingg')
			->get();
		
		return view('patron.orderviewall')->with(['orderall' => $orderall]);
		*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menuid)
    {
        //
		//DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		//DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get();
		
		$items=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get()
		->toArray();

		for($i=0;$i<count($items);$i++)
		{
			$ingredients[$i] =DB::table('item_ingredient')
			->where('item_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}
		for($i=0;$i<count($items);$i++)
		{
			$cus_ingredients[$i] =DB::table('custom_ingredient')
			->where('custom_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','custom_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}

		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		//dd($specialfoods);
		$counter = 0;

		
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		foreach($specialfoods as $sfood){
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$sfood->Special_ID)
			->min('menu_food_item.Quantity');
			

			if($specialquan <= 0){
				unset($specialfood[$counter]);
			}
			else{			
				$specialfood[$counter] = array_merge($specialfood[$counter], ["Quantity" => $specialquan]);
			}

			$counter++;
			
		}
		$specialfoods = json_decode(json_encode($specialfood));

		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
				
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
		->first();
		
		
		/*$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::id())
		->first();
			
		$id_deletion=DB::table('cos_order')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','orderingg')
		->select('Cos_Order_Num')
		->first();
		
		if(!empty($id_deletion)){
			$orderid = $id_deletion->Cos_Order_Num;
			
		}
		
		if(empty($orderid)){
			$orderid=DB::table('cos_order')->max('Cos_Order_Num');
			$orderid++;
			if(empty($orderid)){*/
				$orderid = 1;/*
			}
		}	
		*/
		//return view('patron.order')->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
		return view('patron.tutorial.order',compact('items','ingredients','cus_ingredients'))->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		$special_id = 1;
		$mealmethod = "payroll";
		$deductions = NULL;
		$orderid = 20;
		$menuid = 1;
		$total_cost = 20;
		return view('patron.tutorial.payment')->with(['special_id'=>$special_id,'mealmethod' => $mealmethod, 'deductions' => $deductions, 'total_cost' => $total_cost, 'orderid' => $orderid, 'menuid' => $menuid]);
    }
	
	 public function payment(Request $request)
    {
		$menuid = 1;
        $foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get();
		
		$items=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get()
		->toArray();

		for($i=0;$i<count($items);$i++)
		{
			$ingredients[$i] =DB::table('item_ingredient')
			->where('item_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}
		for($i=0;$i<count($items);$i++)
		{
			$cus_ingredients[$i] =DB::table('custom_ingredient')
			->where('custom_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','custom_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}

		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		//dd($specialfoods);
		$counter = 0;

		
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		foreach($specialfoods as $sfood){
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$sfood->Special_ID)
			->min('menu_food_item.Quantity');
			

			if($specialquan <= 0){
				unset($specialfood[$counter]);
			}
			else{			
				$specialfood[$counter] = array_merge($specialfood[$counter], ["Quantity" => $specialquan]);
			}

			$counter++;
			
		}
		$specialfoods = json_decode(json_encode($specialfood));

		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
				
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
		->first();
		
		
		
		$orderid = 1;
		
		
		return view('patron.tutorial.orderview',compact('items','ingredients','cus_ingredients'))->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
		//return view('patron.tutorial.orderview',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);


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
		try{
			if(auth()->user()->usertype == 'Patron'){
				return redirect('home')->with('success','Tutorial Complete');
			}
			else{
				return redirect('student_home')->with('success','Tutorial Complete');
			}
		}
		
		catch(exception $e){
			return redirect('restaurant')->with('error','Order unsuccessful\n'.$e);
			
		}
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
		->where('menu.Menu_ID','=',$menuid)
		->get();
		
		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
					
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
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
		
		$special_id=DB::table('ordered_special')
		->where('Cos_Order_Num','=',$id)
		->first();
		
		if(empty($special_id)){
			$special_id = null;
		}
			
		
		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		//dd($specialfoods);
		$counter = 0;
		
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		foreach($specialfoods as $sfood){
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$sfood->Special_ID)
			->min('menu_food_item.Quantity');
			

			if($specialquan <= 0){
				unset($specialfood[$counter]);
			}
			else{			
				$specialfood[$counter] = array_merge($specialfood[$counter], ["Quantity" => $specialquan]);
			}

			$counter++;
			
		}
		$specialfoods = json_decode(json_encode($specialfood));
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderview')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderview')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orderid)
    {
		
		$menuid=DB::table('ordered_food_item')	
		->join('menu_food','menu_food.Menu_Food_Item_ID','=','ordered_food_item.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$menuid=$menuid->Menu_ID;

		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
        ->where('Cos_Order_Num', '=', $orderid)
        ->orWhere('Cos_Order_Meal_Status', '=', 'Editing')
		->first();
		
		$special_id=DB::table('ordered_special')
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get();
		
		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
					
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
		->first();
				
		if($cos_order->Cos_Order_Meal_Status == "Editing" || $cos_order->Cos_Order_Meal_Status == "Approved"){
			$permission = "edit";
			
			$food_selecteds = DB::table('ordered_food_item')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->get();
			
			DB::table('cos_order')->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)->update(['Cos_Order_Meal_Status'=>'Editing']);
				
			if(!empty($special_id)){

				$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				//->where('ordered_special.Special_ID','=',$special_id->Special_ID)
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
					
				foreach($special_selects as $special_select){	
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
					->first();
					
					$finalquantityspecial = $quantity->Quantity + $special_select->Quantity;
					DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
					
				}
			}
			
			
			foreach($food_selecteds as $food_select){
				$count = count($foods);
				$foods = json_decode(json_encode($foods), true);

				for($i = 0;$i < $count;$i++){
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$foods[$i]["Menu_Food_Item_ID"])
					->first();
					
					$foods[$i]["Quantity"] = $quantity->Quantity;	
				//	dd($foods[$i]["Quantity"]."  ".$foods[$i]["Menu_Food_Item_ID"]);
				}
				$foods = json_decode(json_encode($foods));
			}
			
			
			foreach($food_selecteds as $food_select){
				
				$count = count($foods);
				$foods = json_decode(json_encode($foods), true);

				for($i = 0;$i < $count;$i++){
					if($foods[$i]["Menu_Food_Item_ID"] == $food_select->Menu_Food_Item_ID){
						$foods[$i]["Quantity"] = $foods[$i]["Quantity"] + $food_select->Quantity;  
					}
					
					else{
						//$foods[$i]["Quantity"] = $foods[$i]["Quantity"];
					}
					
				}
				$foods = json_decode(json_encode($foods));
			}

		}
		
		
		
		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		$counter = 0;
		
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		foreach($specialfoods as $sfood){
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$sfood->Special_ID)
			->min('menu_food_item.Quantity');
			
			
			$count = count($foods);
			$foods = json_decode(json_encode($foods), true);

			for($i = 0;$i < $count;$i++){
				for($j = 0;$j < $count;$j++){
					if($foods[$i]["Quantity"] < $foods[$j]["Quantity"]){
						$lowerquan = $foods[$i]["Quantity"];
						if($lowerquan > $specialquan ){
							$specialquan = $lowerquan;
						}
					}	
				}
			}
			
			$foods = json_decode(json_encode($foods));
			
			if($specialquan <= 0){
				unset($specialfood[$counter]);
			}
			else{			
				$specialfood[$counter] = array_merge($specialfood[$counter], ["Quantity" => $specialquan]);
			}

			$counter++;
			
		}
		$specialfoods = json_decode(json_encode($specialfood));
		
		if($cos_order->Cos_Order_Meal_Status == "Approved" || $cos_order->Cos_Order_Meal_Status == "Editing"){
			if(!empty($special_id)){
				$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
			
			
				foreach($special_selects as $special_select){	
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
					->first();
						
					$finalquantityspecial = $quantity->Quantity - $special_select->Quantity;
					DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
						
				}
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
		
		if(empty($special_id)){
			$special_id = null;
		}	
		$items=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->get()
		->toArray();

		for($i=0;$i<count($items);$i++)
		{
			$ingredients[$i] =DB::table('item_ingredient')
			->where('item_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}
		for($i=0;$i<count($items);$i++)
		{
			$cus_ingredients[$i] =DB::table('custom_ingredient')
			->where('custom_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
			->join('ingredient','custom_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
			->get()
			->toArray();
		}


		$ordered_item = DB::table('ordered_food_item') //get all the ordered items of the patron
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get()
		->toArray();

		for($j=0;$j<count($ordered_item);$j++)	//get the corresponding ordered ingredients of ordered item
		{
			$ordered_ingredient[$j] = DB::table('ordered_ingredient') //get all the ordered ingredients of the item
			->where('Ordered_Food_Item_ID','=',$ordered_item[$j]->Ordered_Food_Item_ID)
			->orderBy('Ordered_Food_Item_ID', 'DESC')
			->get()
			->toArray();
		}
		//dd($food_count);
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderfinal',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);


		}
		return view('patron.orderfinal',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);	
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
		$cos_order=DB::table('cos_order')
		->where('Cos_Order_Num','=',$id)
		->first();
		
		
		
		if(!empty($id)){
		
			if($cos_order->Cos_Order_Meal_Status == "Approved" || $cos_order->Cos_Order_Meal_Status == "Prepared" || $cos_order->Cos_Order_Meal_Status == "Pending Delivery" || $cos_order->Cos_Order_Meal_Status == "Delivered"){
				
				if($cos_order->Cos_Order_Meal_Status != "Prepared"){
					if($cos_order->Cos_Order_Payment_Method == "payroll"){
						$employee_id = DB::table('patron')
						->select('Employee_ID')
						->where('User_ID','=',Auth::user()->id)
						->first();
						
						$pay = DB::table('payroll')
						->select('Salary')
						->where('Employee_ID','=',$employee_id->Employee_ID)
						->first();
							
						$salary = $pay->Salary + $cos_order->Cos_Order_Cost;
							
						DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
												
					}
				}

				$special_id=DB::table('ordered_special')
				->where('Cos_Order_Num','=',$id)
				->first();
				
				
				if(!empty($special_id)){
				
					$special_selects=DB::table('ordered_special')
					->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
					->join('special_food','special_food.Special_ID','=','specials.Special_ID')
					->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
					->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
					->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
					->where('ordered_special.Special_ID','=',$special_id->Special_ID)
					->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
					->get();
					
					
					
				//dd($special_selects);	
					
					foreach($special_selects as $special_select){	
						$quantity = DB::table('menu_food_item')
						->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
						->first();
						//dd($special_select->Quantity);
						$finalquantity = $quantity->Quantity + $special_select->Quantity;
						DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
						
					}
				}
				
				$food_selecteds = DB::table('ordered_food_item')
				->where('Cos_Order_Num','=',$id)
				->orderBy('Ordered_Food_Item_ID', 'DESC')
				->get();
				
				foreach($food_selecteds as $selected_id){
					$selected_ingredient = DB::table('ordered_ingredient')
					->where('Ordered_Food_Item_ID','=',$selected_id->Ordered_Food_Item_ID)
					->get();
				}
				
				foreach($food_selecteds as $food_select){
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
					->first();
					
					$finalquantity = $quantity->Quantity + $food_select->Quantity;

					DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$food_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
					
				}
			}
			
			DB::table('cos_order')->where('Cos_Order_Num', '=', $id)->update(["Cos_Order_Meal_Status" => "Cancelled"]);
			//DB::table('cos_order')->where('Cos_Order_Num', '=', $id)->delete();
			//DB::table('ordered_food_item')->where('Cos_Order_Num', '=', $id)->delete();
			//DB::table('delivery_instruction')->where('Cos_Order_Num', '=', $id)->delete();
		}
		
		$message = "Your order has been cancelled.";
		
		if($cos_order->Cos_Order_Meal_Status == "Prepared" && $cos_order->Cos_Order_Payment_Method != "payroll"){
				$message = $message."\nHowever, you will be charged by the restaurant for the prepared meal.";
		}
		
		if($cos_order->Cos_Order_Meal_Status == "Prepared" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				$message = $message."\nHowever, your payroll deduction has not been refunded.";
		}
		
		if($cos_order->Cos_Order_Meal_Status == "Approved" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				$message = $message."\nYour payroll deduction has been refunded.";
		}
		
		return redirect('/order')->with('success',$message);
   } 
	 
	 
	public function cancel()
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
				
		DB::table('cos_order')
		->where('Employee_ID','=', $employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->update(['Cos_Order_Meal_Status'=>'Approved']);
		
				
		if(!empty($id_deletion->Cos_Order_Num)){
			DB::table('cos_order')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('ordered_food_item')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
			DB::table('delivery_instruction')->where('Cos_Order_Num', '=', $id_deletion->Cos_Order_Num)->delete();
		}
		
		DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		return redirect("/restaurant");
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
		->where('menu.Menu_ID','=',$menuid)
		->get();
		
		$locations=DB::table('location')
		->get();
		
		$order_cutoff=DB::table('order_cutoff')
		->select('Order_Cutoff_Time')
		->first();
		
		$deduction=DB::table('patron')
		->where('Patron_FName','=', Auth::user()->name)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
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
		
		$special_id=DB::table('ordered_special')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->first();
		
		if(empty($special_id)){
			$special_id = null;
		}	
			
			
		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		$counter = 0;
		
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		foreach($specialfoods as $sfood){
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$sfood->Special_ID)
			->min('menu_food_item.Quantity');
			

			if($specialquan <= 0){
				unset($specialfood[$counter]);
			}
			else{			
				$specialfood[$counter] = array_merge($specialfood[$counter], ["Quantity" => $specialquan]);
			}

			$counter++;
			
		}
		$specialfoods = json_decode(json_encode($specialfood));
			
			
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
			
			return view('patron.orderviewdetails')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderviewdetails')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
    }
}
