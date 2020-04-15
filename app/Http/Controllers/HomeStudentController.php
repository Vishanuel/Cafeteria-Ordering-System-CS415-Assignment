<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeStudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		$orderall=DB::table('cos_order')
			->where('Student_ID','=',$student_id->Student_ID)
			->where('Cos_Order_Meal_Status','!=','orderingg')
			->get();
		
		return view('student.home')->with(['orderall' => $orderall]);
		
		
		
      //  return view('patron.home');
    }
}
