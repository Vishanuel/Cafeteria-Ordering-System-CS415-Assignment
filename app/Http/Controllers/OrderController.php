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
		DB::statement("ALTER TABLE `ordered_food_item` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `delivery_instruction` AUTO_INCREMENT = 1;");
		DB::statement("ALTER TABLE `cos_order` AUTO_INCREMENT = 1;");
		
		$foods=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu.Menu_ID','=',$menuid)
		->where('menu_food_item.Quantity','>','0')
		->get();
		
		
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
		
		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
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
			if(empty($orderid)){
				$orderid = 1;
			}
		}	
		
		return view('patron.order')->with(['specialfoods'=>$specialfoods, 'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'orderid' => $orderid, 'menuid' => $menuid]);
    
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
		DB::statement("ALTER TABLE `ordered_special` AUTO_INCREMENT = 1;");
		
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
		
		DB::table('cos_order')
			->insert([
				['Employee_ID' => $employee_id->Employee_ID, 'Cos_Meal_Date_Time' => $request->input('meal_date') , 'Cos_Order_Date_Time' => date("Y-m-d"), 'Cos_Order_Meal_Status' => 'orderingg', 'Cos_Order_Cost' => $total_cost, 'Cos_Order_Payment_Method' => 'NN'],
		]);	
	
		$mealmethod = $request->input('mealmethod');
		//dd($total_cost);
		if($mealmethod == "delivery"){
			DB::table('delivery_instruction')
				->insert([
					['Cos_Order_Num' => $id,'D_Location' => $request->input('location_id'), 'D_Time_Window' => $request->input('location_time')],
			]);	
		}
				
		
		
		$employee_id = DB::table('patron')
		->select('Employee_ID')
		->where('User_ID','=',Auth::user()->id)
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
			
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$orderid = $cos_order->Cos_Order_Num;
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->orderBy('Ordered_Food_Item_ID', 'DESC')
		->get();
		
		$food_count=DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->count();
		
		$error = "";
		$food_id = array(0=>"e");
		$special_food_id = array();
		$specialcount = 1;
		
		for($i = 1;$i<$iteration;$i++){
			$food_item = "food_item".$i;
			$food_id[$i] = substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789"));
			$food_quantity[$i] = $request->input('quantity'.$i);
			DB::table('ordered_food_item')
			->insert([
				['Cos_Order_Num' => $id, 'Menu_Food_Item_ID' => substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789")), 'Quantity' => $request->input('quantity'.$i)],
			]);	
						
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->first();
		
		if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){

			$food_selecteds = DB::table('ordered_food_item')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->orderBy('Ordered_Food_Item_ID', 'DESC')
			->get();
				
			if(!empty($request->input('specialfoodsqavailable')) || $request->input('specialfoodsqavailable') != ""){
				
			$special_id = substr($request->input('specialfoods'), 0, strspn($request->input('specialfoods'), "0123456789"));
			
			$special_selects=DB::table('ordered_special')
			->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
			->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->get();
				
			if(!empty($special_selects)){	
				foreach($special_selects as $special_select){	
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
					->first();
					
					$finalquantityspecial = $quantity->Quantity + $special_select->Quantity;
					DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
					
				}
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
						$foods[$i]["Quantity"] = $foods[$i]["Quantity"];
					}
					
				}
				$foods = json_decode(json_encode($foods));
			}
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$id)
		->first();
		
		
		
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
		
		$special_id = null;
		
		if(!empty($request->input('specialfoodsqavailable')) || $request->input('specialfoodsqavailable') != ""){
			
			$special_id = substr($request->input('specialfoods'), 0, strspn($request->input('specialfoods'), "0123456789"));	
			
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$special_id)
			->min('menu_food_item.Quantity');

			if($specialquan <= 0){
				$error = $error."Not enough food item in inventory to cater for your special meal order. Either edit your order or cancel it.\n";
				
				$cos_order=DB::table('cos_order')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('Cos_Order_Meal_Status','=','Editing')
				->first();
				
				if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
					$special_selects=DB::table('ordered_special')
						->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
						->join('special_food','special_food.Special_ID','=','specials.Special_ID')
						->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
						->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
						->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
						->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
						->get();
					
					if(!empty($special_id)){
						foreach($special_selects as $special_select){	
							$quantity = DB::table('menu_food_item')
							->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
							->first();
								
							$finalquantityspecial = $quantity->Quantity - $special_select->Quantity;
							DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
								
						}
					}
				}
				
				$cos_order=DB::table('cos_order')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('Cos_Order_Num','=',$id)
				->first();
				
				if($mealmethod == "delivery"){
					$delivery_info=DB::table('delivery_instruction')
					->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
					->first();
						
					return redirect('order_edit/'.$cos_order->Cos_Order_Num)->with('error',$error);
					
				}
				return redirect('order_edit/'.$cos_order->Cos_Order_Num)->with('error',$error);	
			}
			
			else if($specialquan - $request->input('specialfoodsquantity') < 0){
				$error = $error."Not enough food item in inventory to cater for your special meal order. Either edit your order or cancel it.\n";

				$cos_order=DB::table('cos_order')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('Cos_Order_Meal_Status','=','Editing')
				->first();
				
				if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
					$special_selects=DB::table('ordered_special')
						->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
						->join('special_food','special_food.Special_ID','=','specials.Special_ID')
						->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
						->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
						->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
						->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
						->get();
					
					if(!empty($special_id)){
						foreach($special_selects as $special_select){	
							$quantity = DB::table('menu_food_item')
							->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
							->first();
								
							$finalquantityspecial = $quantity->Quantity - $special_select->Quantity;
							DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
								
						}
					}
				}
				
				$cos_order=DB::table('cos_order')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->where('Cos_Order_Num','=',$id)
				->first();
				
				if($mealmethod == "delivery"){
					$delivery_info=DB::table('delivery_instruction')
					->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
					->first();
						
					return redirect('order_edit/'.$cos_order->Cos_Order_Num)->with('error',$error);
				}
				return redirect('order_edit/'.$cos_order->Cos_Order_Num)->with('error',$error);		
			}
			
			else{
				$special_selects=DB::table('specials')
				->join('menu','menu.Menu_ID','=','specials.Menu_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->where('specials.Special_ID','=',$special_id)
				->get();
					
				foreach($special_selects as $special_select){
								
					$special_food_quantity[$specialcount] = $request->input('specialfoodsquantity');
					$special_food_id[$specialcount] = "".$special_select->Menu_Food_Item_ID."";
					$specialcount++;
					
					
				}
				
				DB::table('ordered_special')
				->insert(['Special_ID'=>$special_id,'Cos_Order_Num'=>$orderid,'Quantity'=>$request->input('specialfoodsquantity')]);	

			}	
			$food_id = array_merge($food_id, $special_food_id);
		}
		
		//dd($special_id);
		if($special_id != null){
			$special_id = DB::table('ordered_special')->where('Special_ID','=',$special_id)->first();
		}
		
		$food_counter=count($food_id);

		for($i = 1;$i<$iteration;$i++){
			
			$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$food_item = "food_item".$i;
			$food_id1 = substr($request->input($food_item), 0, strspn($request->input($food_item), "0123456789"));
			$inputquan = $request->input('quantity'.$i);
			
			$special = preg_split("/[0-9]+/", $request->input($food_item));
			
			$quantity=DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_id1)
			->select('Quantity')
			->first();		
			
			$quan = $quantity->Quantity;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
				$count = count($foods);
				$foods = json_decode(json_encode($foods), true);
				//dd($count);
				for($l = 0;$l < $count;$l++){
					if($foods[$l]["Menu_Food_Item_ID"] == $food_id1){
						$quan = $foods[$l]["Quantity"];
						//dd($quantity);
					}
				}
				$foods = json_decode(json_encode($foods));
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$id)
			->first();
			
			
				for($j = 1;$j<$food_counter;$j++){
					
					if($j != $i){
						if($food_id1 == $food_id[$j]){
							
							$inputquan = $inputquan + $request->input('quantity'.$j);
							
							if(!empty($request->input('specialfoodsqavailable')) || $request->input('specialfoodsqavailable') != ""){
								if($j > $i){
									$inputquan = $inputquan + $request->input('specialfoodsquantity');
								}
							}
						}
					
						if(($quan - $inputquan) < 0){

							$cos_order=DB::table('cos_order')
							->where('Employee_ID','=',$employee_id->Employee_ID)
							->where('Cos_Order_Meal_Status','=','Editing')
							->first();
							
							if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
								$special_selects=DB::table('ordered_special')
									->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
									->join('special_food','special_food.Special_ID','=','specials.Special_ID')
									->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
									->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
									->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
									->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
									->get();
								
								if(!empty($special_id)){
									foreach($special_selects as $special_select){	
										$quantity = DB::table('menu_food_item')
										->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
										->first();
											
										$finalquantityspecial = $quantity->Quantity - $special_select->Quantity;
										DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
											
									}
								}
							}
							
							$cos_order=DB::table('cos_order')
							->where('Employee_ID','=',$employee_id->Employee_ID)
							->where('Cos_Order_Num','=',$id)
							->first();
							
							return redirect('order_edit/'.$cos_order->Cos_Order_Num)->with("Error","Not enough food item in inventory to cater for your order. Either edit your order or cancel it."); 
					
							
						}
					}
				}
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->first();
		
		if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
			$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
			
			if(!empty($special_id)){
				foreach($special_selects as $special_select){	
					$quantity = DB::table('menu_food_item')
					->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
					->first();
						
					$finalquantityspecial = $quantity->Quantity - $special_select->Quantity;
					DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
						
				}
			}
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		//->where('Cos_Order_Meal_Status','=','orderingg')
		->where('Cos_Order_Num','=',$id)
		->first();
		
		$deductions=DB::table('patron')
		->where('User_ID','=', Auth::user()->id)
		->select('Patron_Deduction_Status','Patron_CardRegister_Status')
		->first();
		//$deduction=$deductions->Patron_Deduction_Status;
		
		return view('patron.payment')->with(['special_id'=>$special_id,'mealmethod' => $mealmethod, 'deductions' => $deductions, 'total_cost' => $total_cost, 'orderid' => $orderid, 'menuid' => $menuid]);
    }
	
	 public function payment(Request $request)
    {
        //
		$menuid = $request->input('menuid');
		$mealmethodp = $request->input('mealmethod');
		$orderid = $request->input('orderid');
		$mealmethod = $request->input('mealmethodn');
		$deduction = $request->input('deduction');
		$special_id = $request->input('special_id');
		
		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		//dd($specialfoods);
		$counter = 0;

		
		
		$special_id = DB::table('ordered_special')->where('Cos_Order_Num','=',$orderid)->where('Special_ID','=',$special_id)->first();
		
		
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
		
		$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
		/*
		if($mealmethodp != "payroll"){
			$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$salary = $pay->Salary;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
				
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				
				$salary = $salary + $cos_order->Cos_Order_Cost;
				DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
		}
		
		else if($mealmethodp != "card"){
			$card = DB::table("card_payment")
			->select('Card_Number')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$card_balance = DB::table('card_bank')
			->select('Card_Balance')
			->where('Card_Number','=',$card->Card_Number)
			->first();
			
			$card_balance=$card->Card_Number;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
				
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "card"){
				
				$card_balance = $card_balance + $cos_order->Cos_Order_Cost;
				DB::table('card_bank')->where('Card_Number', '=',$card->Card_Number)->update(['Card_Balance' => $card_balance]);
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			
		}
		*/
		if($mealmethodp == "payroll"){

			$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$payroll = $pay->Salary;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				$pay = DB::table('payroll')
				->select('Salary')
				->where('Employee_ID','=',$employee_id->Employee_ID)
				->first();
				
				$payroll = $pay->Salary + $cos_order->Cos_Order_Cost;
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			$error = "Total cost exceeded current salary amount. Either cancel or edit the order.";
			if($payroll - $request->input("tcost") <= 0){
				$total_cost=$request->input("tcost");
				
				return view('patron.payment')->with(['special_id'=>$special_id,'orderid'=>$orderid,'menuid'=>$menuid ,'mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
			}
			
			else{
				$salary = $pay->Salary - $request->input("tcost");
			}	
		}
		
		if($mealmethodp == "card"){

			$card = DB::table("card_payment")
			->select('Card_Number')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$card_balance = DB::table('card_bank')
			->select('Card_Balance')
			->where('Card_Number','=',$card->Card_Number)
			->first();
			
			$card_balance=$card_balance->Card_Balance;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "card"){
				
				
				$card_balance = $card_balance + $cos_order->Cos_Order_Cost;
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			$error = "Insufficient funds. Either cancel or edit the order.";
			if($card_balance - $request->input("tcost") <= 0){
				$total_cost=$request->input("tcost");
				
				return view('patron.payment')->with(['special_id'=>$special_id,'orderid'=>$orderid,'menuid'=>$menuid ,'mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
			}
			
		}
		
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
		
		//dd($mealmethod);
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderview')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('patron.orderview')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
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
		$menuid= $request->input('menuid');
		$orderid = $request->input('orderid');
		
		$special_id = $request->input('special_id');
		
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
		->get();
		
		$specialfoods=DB::table('specials')
		->join('menu','menu.Menu_ID','=','specials.Menu_ID')
		->where('specials.Menu_ID','=',$menuid)
		->get();
		//dd($specialfoods);
		$counter = 0;
		$iteration=1;
		foreach($food_selecteds as $food_select){
			
			
			$food_id[$iteration]=$food_select->Menu_Food_Item_ID;
			$food_id2[$iteration]=$food_select->Menu_Food_Item_ID;
			$food_id2_quan[$iteration]=$food_select->Quantity;
			$iteration++;
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->first();
			
		if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){
			$food_selecteds = DB::table('ordered_food_item')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->get();
			
			$edit_iteration = 1;
			foreach($food_selecteds as $food_select){
				$food_id2_quan[$edit_iteration]=$food_id2_quan[$edit_iteration] - $food_select->Quantity;
				$edit_iteration++;
			}
		
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
				
		$specialfood = json_decode(json_encode($specialfoods), true);
		
		if($special_id == "null"){
			//dd("null");
			//echo "null";
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){
				$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
				
				
				if(!empty($special_selects)){
					foreach($special_selects as $special_select){	
						$quantity = DB::table('menu_food_item')
						->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
						->first();
						
						$finalquantity = $quantity->Quantity + $special_select->Quantity;
						DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
						
					}
				}
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
		}
		
		
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
		
	
		
		if($special_id != "null"){
		
			
			$specialquan=DB::table('specials')
			->join('menu','menu.Menu_ID','=','specials.Menu_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->where('specials.Menu_ID','=',$menuid)
			->where('specials.Special_ID','=',$special_id)
			->min('menu_food_item.Quantity');
			
			
			$special_selected=DB::table('ordered_special')->where('Cos_Order_Num','=',$orderid)->where('Special_ID','=',$special_id)->first();
			//dd($special_selected->Quantity);
			$selected_special_quan = $special_selected->Quantity;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){
				$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
								
				if(!empty($special_selects)){
					foreach($special_selects as $special_select){	
						$quantity = DB::table('menu_food_item')
						->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
						->first();
						
						$selected_special_quan = $selected_special_quan - $special_select->Quantity;
						//$finalquantityspecial = $quantity->Quantity + $special_select->Quantity;
						//DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantityspecial]);
					
					}
				}
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			$error="";
			if($specialquan <= 0){
				$error = $error."Not enough food item in inventory to cater for your special meal order. Either edit your order or cancel it.\n";
					
				return redirect('order_edit/'.$orderid)->with('error',$error);
			}
			
			else if($specialquan - $selected_special_quan < 0){
				$error = $error."Not enough food item in inventory to cater for your special meal order. Either edit your order or cancel it.\n";
				return redirect('order_edit/'.$orderid)->with('error',$error);	
			}
			
			else{
				$special_selects=DB::table('ordered_special')
				->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
				->join('special_food','special_food.Special_ID','=','specials.Special_ID')
				->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
				->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
				->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
				->where('ordered_special.Special_ID','=',$special_id)
				->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->get();
					
				$specialcount = 1;
				
				foreach($special_selects as $special_select){
					//$request->input('specialfoodsquantity')
					$special_food_quantity[$specialcount] = "".$selected_special_quan."";
					$special_food_id[$specialcount] = "".$special_select->Menu_Food_Item_ID."";
					$specialcount++;
					
					
				}
				
			}	
			$food_id = array_merge($food_id, $special_food_id);

		}
		
		$food_counters=count($food_id);

		for($i = 1;$i<$iteration;$i++){
			$food_id1 = $food_id2[$i];
			$inputquan = $food_id2_quan[$i];
		
			$quantity=DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_id1)
			->select('Quantity')
			->first();		
			
			
				for($j = 1;$j<($food_counters);$j++){
					
					$cos_order=DB::table('cos_order')
					->where('Employee_ID','=',$employee_id->Employee_ID)
					->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
					->first();
					
					$orderid = $cos_order->Cos_Order_Num;

					if($j != $i){
						if($food_id1 == $food_id[$j]){
							if($j < $iteration){
							$inputquan = $inputquan + $food_id2_quan[$j];
							}
							if($special_id != "null"){
								if($j > $i){
									$inputquan = $inputquan + $selected_special_quan;
								}
							}
						}
					
						if(($quantity->Quantity - $inputquan) < 0){

							$error = $error."Not enough food item in inventory to cater for your order. Either edit your order or cancel it.";
							//dd("died");
							return redirect('order_edit/'.$orderid)->with('error',$error);
							
						}
					}		
					
				}
			
		}
		
		if($special_id != "null"){
			//dd("not null");
			echo "not null";
			$special_selects=DB::table('ordered_special')
			->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
			->join('special_food','special_food.Special_ID','=','specials.Special_ID')
			->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
			->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
			->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
			->where('ordered_special.Special_ID','=',$special_id)
			->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->get();
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();

			foreach($special_selects as $special_select){	

				$finalquantity = 0;
				if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){
					$edit_special_selects=DB::table('ordered_special')
					->join('specials','ordered_special.Special_ID','=','specials.Special_ID')
					->join('special_food','special_food.Special_ID','=','specials.Special_ID')
					->join('menu_food','menu_food.Menu_Food_ID','=','special_food.Menu_Food_ID')
					->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
					->select('ordered_special.Quantity','menu_food_item.Menu_Food_Item_ID')
					->where('ordered_special.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
					->where('menu_food_item.Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
					->first();
					
					if(!empty($edit_special_selects->Quantity)){
						$finalquantity = $finalquantity + $edit_special_selects->Quantity;
					}		
				}
						
				$quantity = DB::table('menu_food_item')
				->where('Menu_Food_Item_ID','=',$special_select->Menu_Food_Item_ID)
				->first();
				
				$finalquantity = $finalquantity + $quantity->Quantity;
				$finalquantity = $finalquantity - $special_select->Quantity;
				DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$special_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
			
			
			
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
		}
		
		
		
		$food_selecteds = DB::table('ordered_food_item')
		->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
		->get();
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->first();
		
		
		foreach($food_selecteds as $food_select){
			
			$finalquantity = 0;
									
			if(!empty($cos_order) &&  $cos_order->Cos_Order_Meal_Status == "Editing"){
				$edit_food_selecteds = DB::table('ordered_food_item')
				->join("menu_food_item","menu_food_item.Menu_Food_Item_ID","=","ordered_food_item.Menu_Food_Item_ID")
				->select('ordered_food_item.Quantity')
				->where('ordered_food_item.Cos_Order_Num','=',$cos_order->Cos_Order_Num)
				->where('menu_food_item.Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
				->first();

				if(!empty($edit_food_selecteds)){
					$finalquantity = $finalquantity + $edit_food_selecteds->Quantity;
				}
			}
						
			$quantity = DB::table('menu_food_item')
			->where('Menu_Food_Item_ID','=',$food_select->Menu_Food_Item_ID)
			->first();
			
			$finalquantity = $finalquantity + $quantity->Quantity;
			$finalquantity = $finalquantity - $food_select->Quantity;

			DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=',$food_select->Menu_Food_Item_ID)->update(['Quantity' => $finalquantity]);
			
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
			
		
		if($cos_order->Cos_Order_Payment_Method != "payroll"){
			$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$salary = $pay->Salary;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
				
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				
				$salary = $salary + $cos_order->Cos_Order_Cost;
				DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
		}
		
		else if($cos_order->Cos_Order_Payment_Method != "card"){
			$card = DB::table("card_payment")
			->select('Card_Number')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$card_balance = DB::table('card_bank')
			->select('Card_Balance')
			->where('Card_Number','=',$card->Card_Number)
			->first();
			
			$card_balance=$card_balance->Card_Balance;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
				
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "card"){
				
				$card_balance = $card_balance + $cos_order->Cos_Order_Cost;
				DB::table('card_bank')->where('Card_Number', '=',$card->Card_Number)->update(['Card_Balance' => $card_balance]);
				
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			
		}
		
		//payroll deduction		
		if($cos_order->Cos_Order_Payment_Method == "payroll"){
			$pay = DB::table('payroll')
			->select('Salary')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$salary = $pay->Salary;
		
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
				
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "payroll"){
				
				$salary = $salary + $cos_order->Cos_Order_Cost;
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			$salary = $salary - $cos_order->Cos_Order_Cost;
				
			DB::table('payroll')->where('Employee_ID', '=',$employee_id->Employee_ID)->update(['Salary' => $salary]);
		
				
		}
		
		if($cos_order->Cos_Order_Payment_Method == "card"){

			$card = DB::table("card_payment")
			->select('Card_Number')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$card_balance = DB::table('card_bank')
			->select('Card_Balance')
			->where('Card_Number','=',$card->Card_Number)
			->first();
			
			$card_balance=$card_balance->Card_Balance;
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','=','Editing')
			->first();
			
			if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing" && $cos_order->Cos_Order_Payment_Method == "card"){
				$card_balance = $card_balance + $cos_order->Cos_Order_Cost;
			}
			
			$cos_order=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Num','=',$orderid)
			->first();
			
			$card_balance = $card_balance - $cos_order->Cos_Order_Cost;
			
			$error = "Insufficient funds. Either cancel or edit the order.";
			if($card_balance - $request->input("tcost") <= 0){
				$total_cost=$request->input("tcost");
				
				return view('patron.payment')->with(['special_id'=>$special_id,'orderid'=>$orderid,'menuid'=>$menuid ,'mealmethod' => $mealmethod, 'deduction' => $deduction, 'total_cost' => $total_cost, 'error' => $error]);
			}
			
			else{
				DB::table('card_bank')->where('Card_Number', '=',$card->Card_Number)->update(['Card_Balance' => $card_balance]);
				
			}
			
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Meal_Status','=','Editing')
		->first();
			
		
		if(!empty($cos_order) && $cos_order->Cos_Order_Meal_Status == "Editing"){
			$edit_id = $cos_order->Cos_Order_Num;	
			DB::table('cos_order')->where('Cos_Order_Num', '=', $edit_id)->delete();
			
			DB::table('cos_order')->where('Cos_Order_Num','=',$orderid)->update(['Cos_Order_Num' => $edit_id]);
			$orderid = $edit_id;
		}
		
		$cos_order=DB::table('cos_order')
		->where('Employee_ID','=',$employee_id->Employee_ID)
		->where('Cos_Order_Num','=',$orderid)
		->first();
		
		//change meal status to Approved
		DB::table('cos_order')->where('Cos_Order_Num', '=',$orderid)->update(['Cos_Order_Meal_Status' => 'Approved']);
			
		$restaurant_id = DB::table("menu")->select('Restaurant_ID')->where('Menu_ID','=',$menuid)->first();
		$restaurant_email = DB::table("restaurant")->select('Restaurant_Email')->where('Restaurant_ID','=',$restaurant_id->Restaurant_ID)->first(); 
		
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
 
            $message->to($restaurant_email->Restaurant_Email, 'LCNotif')
 
                    ->subject('Restaurant Order Info');
        });
		
		return redirect('order')->with('success','Order successful');
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
		
		if($mealmethod == "delivery"){
			$delivery_info=DB::table('delivery_instruction')
			->where('Cos_Order_Num','=',$cos_order->Cos_Order_Num)
			->first();
			
			return view('patron.orderfinal')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);
		
		}
		return view('patron.orderfinal')->with(['specialfoods'=>$specialfoods,'special_id'=>$special_id,'menuid' => $menuid, 'orderid' => $orderid, 'mealmethod' => $mealmethod,'foods' => $foods, 'deduction' => $deduction, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds, 'food_count' => $food_count]);
			
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
