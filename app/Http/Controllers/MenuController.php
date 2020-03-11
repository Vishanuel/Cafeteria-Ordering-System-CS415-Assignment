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
        //
        $usr = Auth::user()->id;    //Get the user identification
        
            $data = DB::table('Menu_Manager')
            ->where('Menu_Manager.User_ID',$usr)
            ->leftJoin('menu', 'Menu_Manager.Restaurant_ID', '=', 'menu.Restaurant_ID')
            ->get()
            ->toArray();


        for($i=0;$i<count($data);$i++)
        {
            $val[$i] = DB::table('menu_food')
            ->where('menu_food.Menu_ID','=',$data[$i]->Menu_ID)
            ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')
            ->select('menu_food_item.Food_Name','menu_food_item.Food_Desc','menu_food_item.Price')                    ->get()
            ->toArray();
        }
        //dd(count($val[0]));
        //echo count($data);
        // dd($val[0][0]);

        return view('menu manager.display_menu', compact('data','val'));
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
    
        return view('menu manager.create_menu',compact('val'));

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $this->validate($request, [
    //     'Menu_Date' => 'required',
    //      ]);
       $input = $request->all();

       $usr = Auth::user()->id;    //Get the user identification
        
            $data = DB::table('Menu_Manager')
            ->where('Menu_Manager.User_ID',$usr)
            ->get();

           // dd(count($input["Food"]));

         foreach($data as $user){
                    
            $id =DB::table('menu')->insertGetId(
                ['Menu_Date' => $input["Menu_Date"],
                 'Restaurant_ID' => $user->Restaurant_ID]
                 ); 

                 for($i=0;$i<count($input["Food"]);$i++)
                 {
                    DB::table('menu_food')->insert(
                        ['Menu_Food_Item_ID' => $input["Food"][$i],
                         'Menu_ID' => $id]
                         );  
                 }

                }
    

       
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
    public function edit()
    {
        return view('menu manager.edit_menu');
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
