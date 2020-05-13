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
        $usr = Auth::user()->id; 

        $rest = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->select('Menu_Manager.Restaurant_ID')
        ->get();
        foreach($rest as $rst){
        //dd($rst);
        }

        $type = DB::table('ingredient_type')
        ->get()
        ->toArray();

        $menu = DB::table('menu_food_item')
        ->where('menu_food_item.Restaurant_ID',$rst->Restaurant_ID)
        ->get()
        ->toArray();

        //dd($menu);
        $ingredients= DB::table('item_ingredient')
            ->LeftJoin('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
            ->leftJoin('ingredient_type', 'ingredient.Ingredient_Type_ID', '=', 'ingredient_type.Ingredient_Type_ID')
            ->leftJoin('menu_food_item', 'item_ingredient.Item_ID', '=', 'menu_food_item.Menu_Food_Item_ID')
            ->where('menu_food_item.Restaurant_ID','=',$rst->Restaurant_ID)
            ->get()
            ->toArray();

           // dd($ingredients);

        // for($i=0;$i<count($dish);$i++)
        // {
        //     $ingredient= DB::table('item_ingredient')
        //     ->where('item_ingredient.Item_ID',$dish[$i]->Menu_Food_Item_ID)
        //     ->LeftJoin('ingredient','item_ingredient.Ingredient_ID','=','ingredient.Ingredient_ID')
        //     ->get()
        //     ->toArray();

            
        // }
        //dd($dish);
       // dd($ingredient);

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
       

        return view('menu manager.display_ingredients', compact('ingredients','menu','type'));
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

        $ingredient = DB::table('ingredient')->insertGetId(
            ['Ingredient_Name' => $input["ingredient_name"],
            'Ingredient_Type_ID' => $input["type"]]); 

            DB::table('item_ingredient')->insert(
                ['Item_ID' => $input["menu_item"],
                'Ingredient_ID' => $ingredient]);  

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
        
        $data = DB::table('item_ingredient')
        ->where('item_ingredient.Item_Ingredient_ID','=',$id)
        ->get();

        foreach($data as $value){}

        DB::table('item_ingredient')
        ->where('Item_Ingredient_ID','=',$id)
        ->update(['Item_ID' => $input["menu_item"]]); 

        DB::table('ingredient')
        ->where('Ingredient_ID','=',$value->Ingredient_ID)
        ->update(['Ingredient_Name' => $input["ingredient_name"],'Ingredient_Type_ID'=>$input["type"]]); 


        return redirect('ingredient');
        //dd($data);
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
