<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as Request;
use Illuminate\Validation\ValidationException;

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

    use AuthenticatesUsers
    {
        login as public default_login;
        logout as public default_logout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::SUCCESSFULL_LOGIN_REDIRECT;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
     public function login (Request $request)
     {
        // Check if the email exist
        $check_if_email_exist = User::check_if_email_exist($request->email);

        if ($check_if_email_exist->count() <= 0)
        {
            return redirect()->route('login')->with('message', "Email does not exist in our records!");
        }

        // Check if the user is logged in another device
        $check_if_user_is_logged_in = User::check_if_user_is_logged_in($request->email);

        if ($check_if_user_is_logged_in[0]->logged)
        {
            return redirect()->route('login')->with('message', "Firstly logout from the other device then try again!");
        }
        // Make the login
         $response = $this->default_login($request);

         // Set the logged column in database to true
         if (Auth::user())
         {
            User::logged_field_to_true(Auth::id());
         }
            return $response;
     }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        User::logged_field_to_false(Auth::id());
        $this->default_logout($request);
        return redirect()->route('homepage')->with('message', 'Successfully logouted!');
    }
}
