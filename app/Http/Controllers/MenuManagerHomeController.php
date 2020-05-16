<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class MenuManagerHomeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $usr = Auth::user()->id;    //Get the user identification
        
        $rest = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get()
        ->toArray();

        

        $cat = DB::table('category')
        ->get()
        ->toArray();

        $date = date("Y-m-d");  //this gets the current date

        $dish = DB::table('menu')
        ->get()
        ->toArray();

        for($j=0;$j<count($dish);$j++)  //this gets the menu items accorbing to breakfast, lunch and dinner
            {
                $item[$j]= DB::table('menu_food')
                ->where('menu_food.Menu_ID','=',$dish[$j]->Menu_ID)
                ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
                ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                   
                ->get()
                ->toArray();
             
            }


        for($i=0;$i<count($cat);$i++)
        {   
            $menu[$i] = DB::table('Menu_Manager')
            ->where('Menu_Manager.User_ID',$usr)
            ->leftJoin('menu', 'Menu_Manager.Restaurant_ID', '=', 'menu.Restaurant_ID')
            ->where('menu.Category_ID','=',$cat[$i]->Category_ID)
            ->where('menu.Menu_Date','=',$date)
            ->LeftJoin('menu_food','menu_food.Menu_ID','=','menu.Menu_ID')
            ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
            ->get()
            ->toArray();
        }  
//dd($menu);
        // for($i=0;$i<count($menu);$i++)
        // {
        //     for($j=0;$j<count($menu[$i]);$j++)
        //     {
        //         $val[$i][$j]= DB::table('menu_food')
        //         ->where('menu_food.Menu_ID','=',$menu[$i][$j]->Menu_ID)
        //         ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
        //         ->select('menu_food_item.Menu_Food_Item_ID','menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price','menu_food_item.Food_Pic')                   
        //         ->get()
        //         ->toArray();
             
        //     }
        // }
        //dd(hello);

        return view('menu manager.home', compact('menu','cat','rest','dish','item'));
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
