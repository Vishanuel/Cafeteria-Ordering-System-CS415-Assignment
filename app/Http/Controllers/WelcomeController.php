<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $restaurants = Restaurant::all();
	  	
		$foods=DB::table('menu_food_item')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('category','menu.Category_ID','=','category.Category_ID')
		->where('menu_food_item.Quantity','>','0')
		->where('menu.Menu_Date','=',date("Y-m-d"))
		//->where('menu.Restaurant_ID','=',$id)
		->orderby('category.Category_ID')
		->get();
		
		$categories=DB::table('category')->get();
		
		//return view('restaurants.menu')->with(['foods' => $foods, 'categories' => $categories]);
        return view('welcome')->with(['restaurants' => $restaurants, 'foods' => $foods, 'categories' => $categories]);
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

		$foods=DB::table('menu_food_item')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('category','menu.Category_ID','=','category.Category_ID')
		->where('menu_food_item.Quantity','>','0')
		->where('menu.Menu_Date','=',date("Y-m-d"))
		->where('menu.Restaurant_ID','=',$id)
		->orderby('category.Category_ID')
		->get();
		
		$categories=DB::table('category')->get();
		
		return view('menu')->with(['foods' => $foods, 'categories' => $categories]);
		
		
    }
	
	public function showbreakfast($id)
    {

		$foods=DB::table('menu_food_item')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('category','menu.Category_ID','=','category.Category_ID')
		->where('menu_food_item.Quantity','>','0')
		->where('menu.Menu_Date','=',date("Y-m-d"))
		->where('menu.Restaurant_ID','=',$id)
		->where('category.Category_Name','=','Dinner')
		->orderby('category.Category_ID')
		->get();
		
		$categories=DB::table('category')->get();
		
		return view('restaurants.menu')->with(['foods' => $foods, 'categories' => $categories]);
		
		
    }
	
	public function showlunch($id)
    {

		$foods=DB::table('menu_food_item')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('category','menu.Category_ID','=','category.Category_ID')
		->where('menu_food_item.Quantity','>','0')
		->where('menu.Menu_Date','=',date("Y-m-d"))
		->where('menu.Restaurant_ID','=',$id)
		->where('category.Category_Name','=','Dinner')
		->orderby('category.Category_ID')
		->get();
		
		$categories=DB::table('category')->get();
		
		return view('restaurants.menu')->with(['foods' => $foods, 'categories' => $categories]);
		
		
    }
	
	public function showdinner($id)
    {

		$foods=DB::table('menu_food_item')
		->join('menu_food','menu_food_item.Menu_Food_Item_ID','=','menu_food.Menu_Food_Item_ID')
		->join('menu','menu_food.Menu_ID','=','menu.Menu_ID')
		->join('category','menu.Category_ID','=','category.Category_ID')
		->where('menu_food_item.Quantity','>','0')
		->where('menu.Menu_Date','=',date("Y-m-d"))
		->where('menu.Restaurant_ID','=',$id)
		->where('category.Category_Name','=','Dinner')
		->orderby('category.Category_ID')
		->get();
		
		$categories=DB::table('category')->get();
		
		return view('restaurants.menu')->with(['foods' => $foods, 'categories' => $categories]);
		
		
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
