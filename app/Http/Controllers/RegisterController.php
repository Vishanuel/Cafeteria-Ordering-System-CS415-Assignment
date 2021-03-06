<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
				
		return view('patron.register')->with(['reg_patron' => $reg_patron, 'payrollstat' => $payrollstat, 'card_payment' => $card_payment]);
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
			$payroll = $request->input('payrollmethod');
			$card = $request->input('cardmethod');
			$cardfn = $request->input('cardfn');
			
			$employee_id = DB::table('patron')
			->select('Employee_ID')
			->where('User_ID','=',Auth::user()->id)
			->first();
			
			$reg_patron=DB::table('patron')->where('Employee_ID','=',$employee_id->Employee_ID)->first();
			
			if($payroll == null){
				$payroll = 2;
			}
			
			else{
				if($reg_patron->Patron_Deduction_Status == $payroll && $reg_patron->Patron_CardRegister_Status == $card){
					return redirect('register')->with('error','Submission Error!! \n You already are deregistration/registered for payroll deduction and card deduction.');
				}
				
				DB::table('patron')->where('Employee_ID','=',$employee_id->Employee_ID)->update(['Patron_Deduction_Status' => $payroll]);
			}
			
			if($card == null){
				$card = 2;
			}
			
			else if($card == 0){
				if($reg_patron->Patron_CardRegister_Status == $card && $reg_patron->Patron_Deduction_Status == $payroll){
					return redirect('register')->with('error','Submission error!! \n You already are deregistration/registered for payroll deduction and card deduction.');
				}
				
				$cardexists=DB::table('card_payment')
				->where('Employee_ID','=', $employee_id->Employee_ID)
				->first();
				
				if(!empty($cardexists)){
					DB::table('card_payment')->where('Employee_ID','=',$employee_id->Employee_ID)->delete();
				}
			}
			
			else{
				if($reg_patron->Patron_CardRegister_Status == $card && $reg_patron->Patron_Deduction_Status == $payroll){
					return redirect('register')->with('error','Submission error!! \n You already are deregistration/registered for payroll deduction and card deduction.');
				}
				
				$cardexists=DB::table('card_payment')
				->where('Employee_ID','=', $employee_id->Employee_ID)
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
					//dd($typecard);
					
					if(empty($cardbank)){
						DB::table('card_bank')->insert(['Card_Number' => $cardnum,'Card_Type' => $typecard,'Card_Balance' => '1000']);
					}
					
					DB::table('card_payment')->insert(['Card_Number' => $cardnum, 'Card_Holder_Name' => $cardname, 'CVV' => $cardcvv, 'Expiry_Date' => $cardexpdate, 'Employee_ID' => $employee_id->Employee_ID]);
					
				}
				
				
			}
			
			DB::table('patron')->where('Employee_ID','=',$employee_id->Employee_ID)->update(['Patron_CardRegister_Status' => $card]);
			
		}
		
		catch(Exception $e){
			return redirect('register')->with('error','Operation error'.$e);
		}
		
		return redirect('register')->with('success','Operation Completed');
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
