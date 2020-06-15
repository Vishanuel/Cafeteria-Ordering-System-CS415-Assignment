<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Closure;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
	protected function authenticated() {
		 //If user role is patron
		 
		 //auth()->user()->login_times;
		 
        if(Auth::check() && auth()->user()->usertype == 'Patron')
        {	
			if(auth()->user()->login_times == 0){
				auth()->user()->increment('login_times');
				return redirect('/tutorial_restaurant');
			}
			else{
				return redirect('/home');
			}
        }
		
		else if(Auth::check() && auth()->user()->usertype == 'Student')
        {
			if(auth()->user()->login_times == 0){
				auth()->user()->increment('login_times');
				return redirect('/tutorial_restaurant');
			}
			else{
				return redirect('/student_home');
			}
            
        }

        //If user role is menu manager
        else if(Auth::check() && auth()->user()->usertype === "Menu Manager")
        {
            return redirect('/menu_manager');
        }   
		
		else if(Auth::check() && auth()->user()->usertype === 'Cafeteria Staff')
        {
			//dd(5);
             return redirect('/cafeteria');
        } 
		
		else if(Auth::check() && auth()->user()->usertype === 'Meal Deliverer')
        {
             return Response::view('meal deliverer.home');
        } 
	}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
        
    }
}
