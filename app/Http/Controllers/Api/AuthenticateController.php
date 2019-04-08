<?php

namespace CodeFinance\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeFinance\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CodeFinance\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Lang;

class AuthenticateController extends Controller {

    use AuthenticatesUsers;
    
    // metodo resposnsavel por criar o token

    /**
     * Se a classe está usando o traço de ThrottlesLogins, podemos acelerar automaticamente,
     * as tentativas de login para este aplicativo. Nós vamos chave isso pelo nome de usuário e
     * o endereço IP do cliente que faz essas solicitações nesse aplicativo.
     */
    public function accessToken(Request $request) {
        $this->validateLogin($request);
        
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);
        
        /**
         * Se o token for válido a $token fica já com o token, se não foi valido $token = null e não entra no if 
         * Auth::guard('api') -> chama o drive de autenticação do ./config->auth.php
         */
        if ($token = Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }
  
        /**
         * Se a tentativa de login não for bem sucedida, incrementaremos o número de tentativas
         * para entrar e redirecionar o usuário de volta para o formulário de login. Claro, quando isso
         * o usuário ultrapassa o número máximo de tentativas que será bloqueado.
         */
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Refresh token da aplicação
     */
    public function refreshToken(Request $request) {
        $token = Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }

    /**
     * Envia o token como resposta
     */
    protected function sendLoginResponse(Request $request, $token) {
        $this->clearLoginAttempts($request);
        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * Bloquea o token
     */
    protected function sendLockoutResponse(Request $request) {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);
        return response()->json([
            'message' => $message
        ], 403);
    }

    /**
     * Válida se o login falhou
     * Se código 400 as credenciais estao invalidas, então vamos tentar realizar um refresh  401 -> token expirado
     */
    protected function sendFailedLoginResponse(Request $request) {
        return response()->json([
            'message' => Lang::get('auth.failed')
        ], 400);  // 
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return Response
     */
    public function logout(Request $request) {
        Auth::guard('api')->logout();
        return response()->json([], 204);
    }
}