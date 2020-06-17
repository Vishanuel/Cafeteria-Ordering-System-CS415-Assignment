<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;

use DB;
use Auth;

class RecipeController extends Controller
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

        //this gets the menu items of the restaurant that the menu manager and user id belongs to 
        $dish = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get()
        ->toArray();

        //get the ingredients type
        $type = DB::table('ingredient_type')
        ->get()
        ->toArray();

        //get the default ingredients of the above menu items
        for($i=0;$i<count($dish);$i++)
        {
            $ingredient[$i]= DB::table('item_ingredient')
            ->where('item_ingredient.Item_ID',$dish[$i]->Menu_Food_Item_ID)
            ->LeftJoin('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
            ->get()
            ->toArray();

            
        }
        //get all the other ingredient that are there for customization
        for($i=0;$i<count($dish);$i++)
        {
            $other_ingredient[$i]= DB::table('custom_ingredient')
            ->where('custom_ingredient.Item_ID',$dish[$i]->Menu_Food_Item_ID)
            ->LeftJoin('ingredient','custom_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
            ->get()
            ->toArray();
        }

         $all_ingredient =  DB::table('Menu_Manager')
         ->where('Menu_Manager.User_ID',$usr)
         ->leftJoin('ingredient', 'Menu_Manager.Restaurant_ID', '=', 'ingredient.Restaurant_ID')
        ->get()
        ->toArray();

        return view('menu manager.display_recipe', compact('dish','ingredient','type','other_ingredient','all_ingredient'));
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
    //     //
    //     $input = $request->all();
    //    //dd($input);

    //         DB::table('menu_food_item')
    //         ->where('Menu_Food_Item_ID','=',$request->input('menu_item'))
    //         ->update(['Menu_Food_Item_Recipe' => $request->input('item_recipe')]);

    //         DB::table('menu_food_item')
    //         ->where('Menu_Food_Item_ID','=',$id)
    //         ->update(['Menu_Food_Item_Recipe' => $request->input('item_recipe')]);
    

    //         return back()->with('success', 'Recipe Created successfully');

    
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
        
        DB::table('menu_food_item')
        ->where('Menu_Food_Item_ID','=',$id)
        ->update(['Menu_Food_Item_Recipe' => $request->input('item_recipe')]);

        return back()->with('success', 'Recipe Updated successfully');
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
