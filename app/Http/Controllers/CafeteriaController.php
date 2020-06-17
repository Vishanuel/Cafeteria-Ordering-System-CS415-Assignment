<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CafeteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$restaurant_id = DB::table('cafeteria_staff')
		->select('Restaurant_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$orderall=DB::table('cos_order')
		->leftJoin('delivery_instruction','cos_order.Cos_Order_Num','=','delivery_instruction.Cos_Order_Num')
		->join('ordered_food_item','cos_order.Cos_Order_Num','=','ordered_food_item.Cos_Order_Num')
		->join('menu_food_item','ordered_food_item.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('patron','cos_order.Employee_ID','=','patron.Employee_ID')	
		->select('*')
		->where('menu.Restaurant_ID','=',$restaurant_id->Restaurant_ID)
		->where('Cos_Order_Meal_Status','!=','orderingg')
		->where('Cos_Order_Meal_Status','!=','Editing')
		//->where('Cos_Order_Meal_Status','!=','Cancelled')
		->get()
		->unique('Cos_Order_Num');
		
		return view('cafeteria staff.orderviewall')->with(['orderall' => $orderall]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
		$cos_order=DB::table('cos_order')
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
					
		//$deduction=DB::table('patron')
		//->where('Patron_FName','=', Auth::user()->name)
		//->select('Patron_Deduction_Status')
		//->first();
		
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
		
		$approved = $cos_order->Cos_Order_Meal_Status;
		
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
			
			return view('cafeteria staff.orderviewdetailsprint',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('cafeteria staff.orderviewdetailsprint',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
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

		
		$cos_order=DB::table('cos_order')
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
					
		//$deduction=DB::table('patron')
		//->where('Patron_FName','=', Auth::user()->name)
		//->select('Patron_Deduction_Status')
		//->first();
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

		$approved = $cos_order->Cos_Order_Meal_Status;
		
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
			
			return view('cafeteria staff.orderviewdetails',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'delivery_info' => $delivery_info, 'food_selecteds' => $food_selecteds]);
		
		}
		return view('cafeteria staff.orderviewdetails',compact('items','ingredients','cus_ingredients','ordered_item','ordered_ingredient'))->with(['approved'=>$approved,'menuid' => $menuid,'mealmethod' => $mealmethod,'foods' => $foods, 'locations' => $locations, 'order_cutoff' => $order_cutoff, 'cos_order' => $cos_order, 'food_selecteds' => $food_selecteds]);
		
		
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
		$meal_status = $request->input('meal_status');
		DB::table('cos_order')->where('Cos_Order_Num','=',$id)->update(['Cos_Order_Meal_Status'=>$meal_status]);
		return redirect('/cafeteria')->with('success', 'Meal status updated');;
		
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
		
		$D_Instruction_ID = DB::table('delivery_instruction')->where('Cos_Order_Num','=',$id)->first();
		
		
		DB::table('cos_order')->where('Cos_Order_Num','=',$id)->update(['Cos_Order_Meal_Status'=>'Pending Delivery']);
		DB::table('delivery_request')->insert(['D_Instruction_ID' => $D_Instruction_ID->D_Instruction_ID, 'Meal_Deliverer_ID'=>$meal_deliverer_id->Meal_Deliverer_ID]);
		return redirect('/cafeteria')->with('success', 'Delivery request sent');
	}
	
	public function delete_delivery_request($id,$order)
	{
		//
		DB::table('cos_order')->where('Cos_Order_Num','=',$order)->update(['Cos_Order_Meal_Status'=>'Prepared']);
		DB::table('delivery_request')->where('D_Instruction_ID','=',$id)->delete();
		
		return redirect('/cafeteria')->with('success', 'Delivery request deleted');
	}
	 
    public function destroy($id)
    {
        //
    }
}
