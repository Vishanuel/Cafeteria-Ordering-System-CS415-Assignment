<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
       
        $usr = Auth::user()->id;    //Get the user identification
        
        $rest = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->leftJoin('menu_food_item', 'Menu_Manager.Restaurant_ID', '=', 'menu_food_item.Restaurant_ID')
        ->get()
        ->toArray();

        

        $cat = DB::table('category')
        ->get()
        ->toArray();

        $dish = DB::table('menu')
        ->get()
        ->toArray();

        for($j=0;$j<count($dish);$j++)
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
            ->get()
            ->toArray();
        }  

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

        return view('menu manager.display_menu', compact('val','menu','cat','rest','dish','item'));
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

        $check=DB::table('menu')
        ->where('Menu_Date','=',$request->input('Menu_Date'))
        ->get()
        ->toArray();

        if(count($check)>0){
            for($i=0;$i<count($input["Food"]);$i++)
            {
                DB::table('menu_food')->updateOrInsert(
                ['Menu_Food_Item_ID' => $input["Food"][$i],
                'Menu_ID' => $id]);  
            }
        }
        else{
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
        // $inout=$request->all();
        // dd($input);
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

        $validate_food= Validator::make($request->all(), [
            'Food' => 'required'
        ]); 
       /* $validate_deliver= Validator::make($request->all(), [
            'deliverable' => 'required'
        ]); */

        if ($validate_food->fails()) {
            return redirect('menu')
                        ->with('error','Food Item were not selected');
        }
        /*if ($validate_deliver->fails()) {
            return redirect('menu')
                        ->with('error','If menu is deliverable or not was not selected');
        }*/
           
            
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

     /*   DB::table('menu')
        ->where('Menu_ID','=',$id)
        ->update(['Menu_Date' => $input["Menu_Date"],'Deliverable' => $input["deliverable"]]); 
    */   
         DB::table('menu')
        ->where('Menu_ID','=',$id)
        ->update(['Menu_Date' => $input["Menu_Date"]]);
		
        return back()->with('success', 'Menu updated successfully');
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
    public function filter(Request $request)
    {
        $input=$request->all();
        $menu=DB::table('menu')
        ->where('Menu_Date','=',$request->input('Menu_Date'))
        ->get()
        ->toArray();

        $cat=DB::table('category')
        ->get()
        ->toArray();

        for($j=0;$j<count($cat);$j++)
        { 
        for($i=0;$i<count($menu);$i++)
        { 
            $item[$j][$i] = DB::table('menu')
            ->where('menu.Menu_ID','=',$menu[$i]->Menu_ID)
            ->where('menu.Category_ID','=',$cat[$j]->Category_ID)
            ->LeftJoin('menu_food','menu.Menu_ID','=','menu_food.Menu_ID')
            ->LeftJoin('menu_food_item','menu_food.Menu_Food_Item_ID','=','menu_food_item.Menu_Food_Item_ID')              
            ->get()
            ->toArray();
        }
    }
   // dd(count($menu));
   if(count($menu)<1){
    return redirect('menu')->with('error','There is NO MENU For that Day');
   }

        return view('menu manager.edit_menu', compact('menu','cat','item')); 
    }
}
