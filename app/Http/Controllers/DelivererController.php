<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DelivererController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$meal_deliverer = DB::table('meal_deliverer')
		->select('Restaurant_ID','Meal_Deliverer_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$deliverer=DB::table('delivery_request')
		->join('delivery_instruction','delivery_request.D_Instruction_ID','=','delivery_instruction.D_Instruction_ID')
		->join('cos_order','cos_order.Cos_Order_Num','=','delivery_instruction.D_Instruction_ID')
		->join('ordered_food_item','cos_order.Cos_Order_Num','=','ordered_food_item.Cos_Order_Num')
		->join('menu_food_item','ordered_food_item.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('patron','cos_order.Employee_ID','=','patron.Employee_ID')
		->where('delivery_request.Meal_Deliverer_ID','=',$meal_deliverer->Meal_Deliverer_ID)
		->get()
		->unique('D_Request_ID');
		
		return view('meal deliverer.orderviewall')->with(['orderall' => $deliverer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$meal_deliverer = DB::table('meal_deliverer')
		->select('Restaurant_ID','Meal_Deliverer_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$deliverer=DB::table('delivery_request')
		->join('delivery_instruction','delivery_request.D_Instruction_ID','=','delivery_instruction.D_Instruction_ID')
		->join('cos_order','cos_order.Cos_Order_Num','=','delivery_instruction.D_Instruction_ID')
		->join('ordered_food_item','cos_order.Cos_Order_Num','=','ordered_food_item.Cos_Order_Num')
		->join('menu_food_item','ordered_food_item.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('patron','cos_order.Employee_ID','=','patron.Employee_ID')
		->where('delivery_request.Meal_Deliverer_ID','=',$meal_deliverer->Meal_Deliverer_ID)
		->get()
		->unique('D_Request_ID');
		
		return view('meal deliverer.orderdelivered')->with(['orderall' => $deliverer]);
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
		DB::table('cos_order')->where('Cos_Order_Num','=',$id)->update(['Cos_Order_Meal_Status'=>'Pending Delivery']);
		return redirect('/deliverer/create')->with('success','Undoed meal delivery');
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
		DB::table('cos_order')->where('Cos_Order_Num','=',$id)->update(['Cos_Order_Meal_Status'=>'Delivered']);
		return redirect('/deliverer')->with('success','Meal Delivered');
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
