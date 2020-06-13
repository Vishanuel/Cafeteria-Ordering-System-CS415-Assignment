<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $validate_food= Validator::make($request->all(), [
            'Food' => 'required'
        ]); 
        $validate_deliver= Validator::make($request->all(), [
            'deliverable' => 'required'
        ]);

        if ($validate_food->fails()) {
            return redirect('menu')
                        ->with('error','Food Item were not selected');
        }
        if ($validate_deliver->fails()) {
            return redirect('menu')
                        ->with('error','If menu is deliverable or not was not selected');
        }
            
        $input = $request->all();
        //dd($input);
        $usr = Auth::user()->id;    //Get the user identification
        
        $data = DB::table('Menu_Manager')
        ->where('Menu_Manager.User_ID',$usr)
        ->get();

        $check=DB::table('menu')
        ->where('Menu_Date','=',$request->input('Menu_Date'))
        ->where('Category_ID','=',$request->input('Category'))
        ->get()
        ->toArray();

       // dd($check[0]->Menu_ID);

        if(count($check)>0){
            for($i=0;$i<count($input["Food"]);$i++)
            {
                DB::table('menu_food')->updateOrInsert(
                ['Menu_Food_Item_ID' => $input["Food"][$i],
                'Menu_ID' => $check[0]->Menu_ID]);  
            }
            DB::table('menu')
            ->where('Menu_ID','=',$check[0]->Menu_ID)
            ->update(['Deliverable' => $input["deliverable"]]); 
           
            return back()->with('success', 'Existing Menu on that day was updated');
        }
        else{
         foreach($data as $user)
         {      
            $id =DB::table('menu')->insertGetId(
            ['Menu_Date' => $input["Menu_Date"],
            'Category_ID' => $input["Category"],
            'Deliverable' => $input["deliverable"],
            'Restaurant_ID' => $user->Restaurant_ID]); 

            for($i=0;$i<count($input["Food"]);$i++)
            {
                DB::table('menu_food')->insert(
                ['Menu_Food_Item_ID' => $input["Food"][$i],
                'Menu_ID' => $id]);  
            }
        }
    }
        return back()->with('success', 'New Menu is created successfully');
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
        $input = $request->all();

        //dd($input);
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
