<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SpecialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = Auth::user()->id;    //Get the user identification
        
            $data = DB::table('Menu_Manager')
            ->where('Menu_Manager.User_ID',$usr)
            ->leftJoin('menu', 'Menu_Manager.Restaurant_ID', '=', 'menu.Restaurant_ID')
            ->leftJoin('specials', 'menu.Menu_ID', '=', 'specials.menu_ID')
            ->whereNotNull('specials.menu_ID')
            ->select('menu.Menu_ID','menu.Menu_Date','specials.Special_ID')
            ->get();

       // dd($data);
        //dd(count($data));
        for($i=0;$i<count($data);$i++)
        {
            $val[$i] = DB::table('special_food')
            ->where('special_food.Special_ID','=',$data[$i]->Special_ID)
            ->LeftJoin('menu_food_item','special_food.Menu_Food_ID','=','menu_food_item.Menu_Food_Item_ID')
            ->LeftJoin('specials','special_food.Special_ID','=','specials.Special_ID')
            ->select('menu_food_item.Food_Name','specials.Special_Desc','specials.Special_Price')                    ->get()
            ->toArray();
        }

        return view('menu manager.display_specials', compact('data','val'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //dd($id);
        // $this->validate($request, [
        //     'Food' => 'required',
        //     ]);
          $input = $request->all();
            //dd($input);

        
                    for($i=0;$i<count($input["Food"]);$i++)
                    {
                        $id =DB::table('specials')->insertGetId(
                            ['Menu_ID' => $input["menu"],
                             'Special_Desc' =>  $input["Special_Desc"],
                             'Special_Price' =>  $input["price"][$i]]
                             ); 

                       DB::table('special_food')->insert(
                           ['Menu_Food_ID' => $input["Food"][$i],
                            'Special_ID' => $id]
                            );  
                    }
       
                    return redirect('specialmenu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          //dd($id);
         $val= DB::table('menu_food_item')
         ->get()
         ->toArray();
       //  dd($val);
 
         return view('menu manager.create_specialmenu',compact('val','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //dd($id);
        $val= DB::table('menu_food_item')
        ->get()
        ->toArray();

        $data = DB::table('specials')
            ->where('specials.Special_ID',$id)
            ->get();

            foreach($data as $menu){
                return view('menu manager.edit_specialmenu', compact('menu','val','id')); 
            }
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
        // $this->validate($request, [
        //     'Special_Desc' => 'required',
        //     'Food' => 'required',
        //     'Price' => 'required',
        //     ]);
            
        $input = $request->all();
        //dd($input);
               $menu= DB::table('specials')
                ->where('Special_ID','=', $id)
                ->get();      
                        foreach($menu as $menuid){
                        for($i=0;$i<count($input["Food"]);$i++)
                        { 
                           DB::table('specials')
                           ->where('Special_ID','=', $id)
                           ->delete();  

                           $id =DB::table('specials')->insert(
                            ['Special_ID' =>  $menuid->Special_ID,
                            'Menu_ID' =>  $menuid->Menu_ID,
                             'Special_Desc' =>  $input["Special_Desc"],
                             'Special_Price' =>  $input["price"][$i]]
                             ); 

                       DB::table('special_food')->insert(
                           ['Menu_Food_ID' => $input["Food"][$i],
                            'Special_ID' => $id]
                            );  
                        }

                       
                       return redirect('specialmenu');
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('specials')->where('Special_ID', '=', $id)->delete();

        return redirect('specialmenu');
    }
}
