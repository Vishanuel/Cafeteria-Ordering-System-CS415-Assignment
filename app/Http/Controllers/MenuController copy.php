<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //Get the user identification
        $usr = Auth::user()->id;    
        
         //get the menu manger
        $rest = DB::table('Menu_Manager')  
        ->where('Menu_Manager.User_ID',$usr)
        ->get();

        foreach($rest as $restaurant)
        
         //get all the category
        $cat = DB::table('category')   
        ->get()
        ->toArray();

        //  get all the menus of the restaurant for the manager
        $dish = DB::table('menu')  
        ->where('Restaurant_ID','=',$restaurant->Restaurant_ID)
        ->get()
        ->toArray();

        // group the menu by the date
        $dish_date = DB::table('menu')  
        ->groupBy('Menu_Date')
        ->where('Restaurant_ID','=',$restaurant->Restaurant_ID)
        ->get()
        ->toArray();

        //dd($dish_date[0]->Menu_Date);
        // get the menu in groups of menu date
    //    for($k=0;$k<count($dish_date);$k++){

    //        $date[$k]=DB::table('menu')  
    //        ->where('Restaurant_ID','=',$restaurant->Restaurant_ID)
    //        ->where('Menu_Date','=',$dish_date[$k]->Menu_Date)
    //        ->get()
    //        ->toArray();

    //    }
         for($k=0;$k<count($dish_date);$k++){
                for($i=0;$i<count($cat);$i++)
                { 
                $date[$k][$i]=DB::table('menu')  
                ->where('Restaurant_ID','=',$restaurant->Restaurant_ID)
                ->where('Menu_Date','=',$dish_date[$k]->Menu_Date)
                ->where('Category_ID','=',$cat[$i]->Category_ID)
                ->get()
                ->toArray();

                
     
            }
        }

        for($k=0;$k<count($dish_date);$k++){
            for($i=0;$i<count($cat);$i++)
            { 
                for($r=0;$r<count($date[$k][$i]);$r++){
                $date_item[$k][$i][$r]= DB::table('menu_food')
                ->where('menu_food.Menu_ID','=',$date[$k][$i][$r]->Menu_ID)
                ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
                ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                   
                ->get()
                ->toArray();
                }
            }
        }
       
    //dd($date_item);
        // get all the menu items of the menu above
        for($j=0;$j<count($dish);$j++)
        {
            $item[$j]= DB::table('menu_food')
            ->where('menu_food.Menu_ID','=',$dish[$j]->Menu_ID)
            ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
            ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                   
            ->get()
            ->toArray();
            
        }

        // get the menu of each category
        for($i=0;$i<count($cat);$i++)
        {   
            $menu[$i] = DB::table('Menu_Manager')
            ->where('Menu_Manager.User_ID',$usr)
            ->leftJoin('menu', 'Menu_Manager.Restaurant_ID', '=', 'menu.Restaurant_ID')
            ->where('menu.Category_ID','=',$cat[$i]->Category_ID)
            ->get()
            ->toArray();
        } 

           // get the menu items of each category menus 
        for($i=0;$i<count($menu);$i++)
        {
            for($j=0;$j<count($menu[$i]);$j++)
            {
                $val[$i][$j]= DB::table('menu_food')
                ->where('menu_food.Menu_ID','=',$menu[$i][$j]->Menu_ID)
                ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
                ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                   
                ->get()
                ->toArray();
             
            }
        }

        return view('menu manager.display_menu', compact('val','menu','cat','rest','dish','item','dish_date','date','date_item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $val= DB::table('menu_food_item')
        ->get()
        ->toArray();

        $cat=DB::table('category')
        ->get()
        ->toArray();

        return view('menu manager.create_menu',compact('val','cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
        'Menu_Date' => 'required',
        'Food' => 'required',]);

       $input = $request->all();
 
       $usr = Auth::user()->id;    //Get the user identification
        
        $data = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->get();

         foreach($data as $user)
         {      
            $id =DB::table('menu')->insertGetId(
            ['Menu_Date' => $input["Menu_Date"],
            'Restaurant_ID' => $user->Restaurant_ID]); 

            for($i=0;$i<count($input["Food"]);$i++)
            {
                DB::table('menu_food')->insert(
                ['Menu_Food_Item_ID' => $input["Food"][$i],
                'Menu_ID' => $id]);  
            }
        }
        return redirect('menu');
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
        $usr = Auth::user()->id; 

        $cat = DB::table('category')
        ->where('Category_ID','=',$id)
        ->get()
        ->toArray();

        //dd($cat);
        
        // this is for getting all the menu items that  belong to that restaurant
        $rest = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get()
        ->toArray();
        //this is for getting all the menu for the $id category
        $menu = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu', 'Menu_Manager.Restaurant_ID', '=', 'menu.Restaurant_ID')
        ->where('menu.Category_ID','=',$id)
        ->get()
        ->toArray();
        //dd(count($menu));
        // this is for getting the menu items for the above $menu
        for($i=0;$i<count($menu);$i++)
        {
            $item[$i] = DB::table('menu_food')
            ->where('menu_food.Menu_ID','=',$menu[$i]->Menu_ID)
            ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
            ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                   
            ->get()
            ->toArray();
         } 

         return view('menu manager.edit_menu', compact('rest','menu','item','cat')); 

     
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
        //$id is Menu_ID
        //$food is array of food items selected
        //Menu_Date is the date of the menu

        $this->validate($request, [
            'Menu_Date' => 'required',
            'Food' => 'required',
            ]);
            
        $input = $request->all();

        //dd($input["Food"]);

         DB::table('menu_food')
         ->where('Menu_ID','=', $id)
         ->delete(); 

         for($i=0;$i<count($input["Food"]);$i++)
        {
            DB::table('menu_food')
            ->updateOrInsert(['Menu_Food_Item_ID' => $input["Food"][$i],'Menu_ID' => $id]);  
        }

        DB::table('menu')
        ->where('Menu_ID','=',$id)
        ->update(['Menu_Date' => $input["Menu_Date"]]); 
       
                       
        return redirect('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table('menu')->where('Menu_ID', '=', $id)->delete();

        return redirect('menu');
    }
}
