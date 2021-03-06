<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;

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

        return view('menu manager.display_items', compact('dish','ingredient','type','other_ingredient','all_ingredient'));
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

        
        //get the file uploaded
       
        $validate_deliver= Validator::make($request->all(), [
            'deliverable'  => 'required'
           ]);

        if ($validate_deliver->fails()) {
        return back()
                ->with('error','If Menu Item is deliverable or not was not selected');
        }
       
        

        //get the user ID
        $usr = Auth::user()->id; 
        
        //get the restaurant ID
        $dish = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get();
        

        foreach($dish as $data){}

        //insert the item in the menu food item table and get the id
       
           if($request->hasfile('image')) 
           { 
               $validate_file= Validator::make($request->all(), [
                   'image'  => 'image|mimes:jpg,png,gif|max:2048'
                  ]);
   
               if ($validate_file->fails()) {
               return back()
                       ->with('error','Image file uploaded should be of type .jpg .png .gif');
               }
   
               $file = $request->file('image');
               $extension = $file->getClientOriginalExtension(); // getting image extension
               $filename =time().'.'.$extension;
               $file->move('dist/img/restaurant/', $filename);

               $item = DB::table('menu_food_item')
            ->insertGetId(['Food_Name' => $input["item_name"],
            'Food_Desc' => $input["item_desc"],'Price' => $input["item_price"],'Quantity'=>$input["item_quantity"],'Restaurant_ID' => $data->Restaurant_ID,'Food_Pic' => 'dist/img/restaurant/'. $filename,'Deliverable'=>$input["deliverable"]]); 
           // dd($item);
           }
           else{
            $item = DB::table('menu_food_item')
            ->insertGetId(['Food_Name' => $input["item_name"],
                'Food_Desc' => $input["item_desc"],'Price' => $input["item_price"],'Quantity'=>$input["item_quantity"],'Restaurant_ID' => $data->Restaurant_ID,'Deliverable'=>$input["deliverable"]]); 
               // dd($item);
           }

        //if ingredient selected then insert them in item ingredients and custom ingredients table 
        if($request->input('default')){
            for($k=0;$k<count($request->input('default'));$k++){
                //dd(count($request->input('default')));
                DB::table('item_ingredient')
                ->insert(['Item_ID' => $item,
                 'Ingredient_ID' => $input["default"][$k]]); 

            }
        }
        if($request->input('other')){
            for($k=0;$k<count($request->input('other'));$k++){
                DB::table('custom_ingredient')
                ->insert(['Item_ID' => $item,
                 'Ingredient_ID' => $input["other"][$k]]); 

            }
        }
            
        return back()->with('success', 'New Menu Item is created successfully');
            

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
        //get all the request in a input variable
        $input = $request->all();
       // dd($input);
        if($request->hasfile('image')) 
        { 
            $validate_file= Validator::make($request->all(), [
                'image'  => 'image|mimes:jpg,png,gif|max:2048'
               ]);

            if ($validate_file->fails()) {
            return back()
                    ->with('error','Image file uploaded should be of type .jpg .png .gif');
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('dist/img/restaurant/', $filename);
            //update the menu food item table
        DB::table('menu_food_item')
        ->where('Menu_Food_Item_ID','=',$id)
        ->update(['Food_Pic' => 'dist/img/restaurant/'. $filename]);

        }

        $validate_deliver= Validator::make($request->all(), [
            'deliverable'  => 'required'
           ]);

        if ($validate_deliver->fails()) {
        return back()
                ->with('error','If Menu Item is deliverable or not was not selected');
        }

        //update the menu food item table
        DB::table('menu_food_item')
        ->where('Menu_Food_Item_ID','=',$id)
        ->update(['Food_Name' => $input["item_name"],'Food_Desc'=>$input["item_desc"],'Price'=>$input["item_price"],'Quantity'=>$input["item_quantity"],'Deliverable'=>$input["deliverable"]]);

        //delete all entrires of the menu item in custom and item ingredients table
        DB::table('item_ingredient')->where('Item_ID', '=', $id)->delete();
        DB::table('custom_ingredient')->where('Item_ID', '=', $id)->delete();

         //if ingredient selected then insert them in item ingredients and custom ingredients table 

         if($request->input('default')){
            for($k=0;$k<count($request->input('default'));$k++){
                DB::table('item_ingredient')
                ->insert(['Item_ID' => $id,
                 'Ingredient_ID' => $input["default"][$k]]); 

            }
        }
        if($request->input('other')){
            for($k=0;$k<count($request->input('other'));$k++){
                DB::table('custom_ingredient')
                ->insert(['Item_ID' => $id,
                 'Ingredient_ID' => $input["other"][$k]]); 

            }
        }
         


        return back()->with('success', 'Menu Item is Updated successfully');

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

        return back()->with('success', 'Menu Item is deleted successfully');
    }
}
