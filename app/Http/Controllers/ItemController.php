<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = Auth::user()->id; 

        $dish = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get()
        ->toArray();


        $type = DB::table('ingredient_type')
        ->get()
        ->toArray();

        for($i=0;$i<count($dish);$i++)
        {
            $ingredient[$i]= DB::table('item_ingredient')
            ->where('item_ingredient.Item_ID',$dish[$i]->Menu_Food_Item_ID)
            ->LeftJoin('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
            ->get()
            ->toArray();

            
        }

        // for($k=0;$k<count($ingredient);$k++)
        // {
        //     for($l=0;$l<count($ingredient[$k]);$l++)
        //     {
        //          for($j=0;$j<count($type);$j++)
        //         {
        //             $choice[$k][$l]= DB::table('ingredient_type')
        //             ->where('ingredient_type.Ingredient_Type_ID',$ingredient[$k][$l]->Ingredient_Type_ID)
        //             ->get()
        //             ->toArray();
        //         }
        //     }
        // }

        // dd($choice);
       

        return view('menu manager.display_items', compact('dish','ingredient','type'));
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

        $usr = Auth::user()->id; 

        $dish = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get();

        foreach($dish as $data){}

        DB::table('menu_food_item')->insert(
            ['Food_Name' => $input["item_name"],
            'Food_Desc' => $input["item_desc"],'Price' => $input["item_price"],'Restaurant_ID' => $data->Restaurant_ID]); 
            
            return back()->with('success', 'New Menu Item Added Successfully');
            

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

        DB::table('menu_food_item')
        ->where('Menu_Food_Item_ID','=',$id)
        ->update(['Food_Name' => $input["item_name"],'Food_Desc'=>$input["item_desc"],'Price'=>$input["item_price"]]); 

        return back()->with('success', 'Menu Item Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('menu_food_item')->where('Menu_Food_Item_ID', '=', $id)->delete();

        return back()->with('success', 'Menu Item Deleted Successfully');
    }
}
