<?php

namespace CodeFinance\Http\Controllers\Auth;

use CodeFinance\Models\User;
use Illuminate\Http\Request;
use CodeFinance\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;


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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request) // Overwrite no método credentials
    {
        $data = $request->only($this->username(),'password'); // Recupera os campos 'email' e 'password'
        $data['role'] = User::ROLE_ADMIN;                     // Recupera o campo 'role' sendo igual a 'admin' da constante
        return $data;
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) // Overwrite no método credentials
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(env('URL_ADMIN_LOGIN')); // Chamando a variáel setada no .env
    }


}
