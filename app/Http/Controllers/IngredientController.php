<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get the user ID
        $usr = Auth::user()->id; 

        $rest = DB::table('Menu_Manager')   //get the restaurant of the user
        ->where('Menu_Manager.User_ID',$usr)
        ->select('Menu_Manager.Restaurant_ID')
        ->get();
        foreach($rest as $rst){
        //dd($rst);
        }

        $type = DB::table('ingredient_type')    //get all the ingredient type
        ->get()
        ->toArray();

        $ingredients = DB::table('ingredient')     //get all the menu items of the restaurant
        ->where('ingredient.Restaurant_ID',$rst->Restaurant_ID)
        ->leftjoin('ingredient_type','ingredient.Ingredient_Type_ID','=','ingredient_type.Ingredient_Type_ID')
        ->get()
        ->toArray();
       

        return view('menu manager.display_ingredients', compact('ingredients','type'));
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
        $input = $request->all();

        //get the user ID
        $usr = Auth::user()->id; 
        
        //get the restaurant IDD
        $dish = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get();

        foreach($dish as $data){}

        $ingredient = DB::table('ingredient')->insertGetId(
            ['Ingredient_Name' => $input["ingredient_name"],'Ingredient_Price' => $input["ingredient_price"],'Ingredient_Quantity' => $input["ingredient_quantity"],'Restaurant_ID' => $data->Restaurant_ID,
            'Ingredient_Type_ID' => $input["type"]]); 
  

                return redirect('ingredient');
        //dd($input);
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
        $input = $request->all();

        DB::table('ingredient')
        ->where('Ingredient_ID','=',$id)
        ->update(['Ingredient_Name' => $input["ingredient_name"],'Ingredient_Type_ID'=>$input["type"],'Ingredient_Price' => $input["ingredient_price"],'Ingredient_Quantity' => $input["ingredient_quantity"]]); 


        return redirect('ingredient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('ingredient')->where('Ingredient_ID', '=', $id)->delete();
        return redirect('ingredient');
    }
}
