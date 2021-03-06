<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
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
		if(Auth::user()->usertype == "Patron"){
			$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$orderall=DB::table('cos_order')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->where('Cos_Order_Meal_Status','!=','orderingg')
			->get();
			
			$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$reg_patron=DB::table('patron')->where('Employee_ID','=',$employee_id->Employee_ID)->first();
			
			$payrollinfo = DB::table('payroll')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			$card_payment = DB::table('card_payment')
			->where('Employee_ID','=',$employee_id->Employee_ID)
			->first();
			
			if(empty($payrollinfo)){
				$payrollstat = 0;
			}
			
			else{
				$payrollstat = 1;
			}
					
			//return view('patron.register')->with(['reg_patron' => $reg_patron, 'payrollstat' => $payrollstat, 'card_payment' => $card_payment]);
			return view('patron.home')->with(['orderall' => $orderall,'reg_patron' => $reg_patron, 'payrollstat' => $payrollstat, 'card_payment' => $card_payment]);
		}
		/*
		if(Auth::user()->usertype == "Student"){
			$student_id = DB::table('student')
			->select('Student_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$orderall=DB::table('cos_order')
				->where('Student_ID','=',$student_id->Student_ID)
				->where('Cos_Order_Meal_Status','!=','orderingg')
				->get();
			
			return view('student.home')->with(['orderall' => $orderall]);
		}
		*/
      //  return view('patron.home');
    }
}
