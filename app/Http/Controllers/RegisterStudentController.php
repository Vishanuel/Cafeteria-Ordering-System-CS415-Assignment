<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class RegisterStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//get student id
		$student_id = DB::table('student')
		->select('Student_ID')
		->where('User_ID','=',Auth::user()->id)
		->first();
		
		//get student info
		$reg_student=DB::table('student')->where('Student_ID','=',$student_id->Student_ID)->first();
		
		//get card info
		$card_payment = DB::table('card_payment')
		->where('Student_ID','=',$student_id->Student_ID)
		->first();
			
		return view('student.register')->with(['reg_student' => $reg_student, 'card_payment' => $card_payment]);
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
   
		try{
			//$payroll = $request->input('payrollmethod');
			$card = $request->input('cardmethod');
			$cardfn = $request->input('cardfn');
			
			$student_id = DB::table('student')
			->select('Student_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$reg_student=DB::table('student')->where('Student_ID','=',$student_id->Student_ID)->first();
		
			if($card == null){
				$card = 2;
			}
			
			else if($card == 0){
				if($reg_student->Student_CardRegister_Status == $card){
					return redirect('studentregister')->with('error','Submission error!! \n You already are deregistration/registered for card deduction.');
				}
				
				$cardexists=DB::table('card_payment')
				->where('Student_ID','=',$student_id->Student_ID)
				->first();
				
				if(!empty($cardexists)){
					DB::table('card_payment')->where('Student_ID','=',$student_id->Student_ID)->delete();
				}
			}
			
			else{
				if($reg_student->Student_CardRegister_Status == $card){
					return redirect('studentregister')->with('error','Submission error!! \n You already are deregistration/registered for card deduction.');
				}
				
				$cardexists=DB::table('card_payment')
				->where('Student_ID','=',$student_id->Student_ID)
				->first();
				
				
				$cardbank=DB::table('card_bank')
				->where('Card_Number','=',$request->input('cardnum'))
				->first();
				
				
				if(empty($cardexists)){
					
					$cardnum = $request->input('cardnum');
					$cardname = $request->input('cardname');
					$cardcvv = $request->input('cvv');
					$typecard = $request->input('typecard');
					$cardexpdate = $request->input('expdate');
					
					if(empty($cardbank)){
						DB::table('card_bank')->insert(['Card_Number' => $cardnum,'Card_Type' => $typecard,'Card_Balance' => '1000']);
					}
					
					DB::table('card_payment')->insert(['Card_Number' => $cardnum, 'Card_Holder_Name' => $cardname, 'CVV' => $cardcvv, 'Expiry_Date' => $cardexpdate, 'Student_ID' => $student_id->Student_ID]);
					
				}
				
				
			}
			
			DB::table('student')->where('Student_ID','=',$student_id->Student_ID)->update(['Student_CardRegister_Status' => $card]);
			
		}
		
		catch(Exception $e){
			return redirect('studentregister')->with('error','Operation error'.$e);
		}
		
		return redirect('studentregister')->with('success','Operation Completed');
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
