<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use App\Console\Commands\FireEvent;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
         
           
    }


 
    protected function validateLogin(Request $request){
        // Get the user details from database and check if user is exist and active.
        $user = User::where('email',$request->email)->first();
        if( $user && !$user->status){
            throw ValidationException::withMessages([$this->username() => __('User has been desactivated.')]);
        }
        $request->session()->put('user', $user);
        // Then, validate input
        return $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        
    }

    public function getLoggedUser(){
        print_r(session()->all());
    }
}
