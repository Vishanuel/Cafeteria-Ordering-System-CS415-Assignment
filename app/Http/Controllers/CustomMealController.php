<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class CustomMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //dd($id);
        $type= DB::table('ingredient_type')
        ->get()
        ->toArray();

        for($i=0;$i<count($type);$i++)
        {
            $ingredients[$i]= DB::table('ingredient')
            ->where('Ingredient_Type_ID','=',$type[$i]->Ingredient_Type_ID)
            ->get()
            ->toArray();
        }
        dd($ingredients);
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
       // dd($id);
        $items=DB::table('menu')
		->join('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('menu_food_item','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->where('menu_food_item.Quantity','>','0')
		->get()
		->toArray();

		for($i=0;$i<count($items);$i++)
		{
			$ingredients[$i] = DB::table('item_ingredient')
			->where('item_ingredient.Item_ID','=',$items[$i]->Menu_Food_Item_ID)
            ->leftjoin('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
            ->where('ingredient.Restaurant_ID','=',$id)
            ->where('ingredient.Ingredient_Quantity','>',0)
			->get()
			->toArray();
        }
        
        $type= DB::table('ingredient_type')
        ->get()
        ->toArray();

        // for($i=0;$i<count($type);$i++)
        // {
        //     $ingredients[$i]= DB::table('ingredient')
        //     ->where('Ingredient_Type_ID','=',$type[$i]->Ingredient_Type_ID)
        //     ->where('Restaurant_ID','=',$id)
        //     ->where('Ingredient_Quantity','>',0)
        //     ->get()
        //     ->toArray();
        // }
        //dd($ingredients);
        return view('patron.custommeal',compact('ingredients','type','items'));
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
