<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'cors','as' => 'api.'], function() {

    Route::post('access_token', 'Api\AuthenticateController@accessToken')
        ->name('access_token');
    
    Route::post('refresh_token', 'Api\AuthenticateController@refreshToken')
        ->name('refresh_token');
    
    Route::group(['middleware' => 'auth:api'], function(){

        Route::post('logout', 'Api\AuthenticateController@logout')
            ->name('logout');

        /**
         * Aqui é necessario definir o guardião, neste caso api
         * se não for definido usa o web, faz com que use cookies em vez de localstorage
         * middleware('auth:api') adiciona o nosso midleware para uqe o nosso jwt seja ativo
         */
        Route::get('user', function () {
            $user = Auth::guard('api')->user();
            return $user;
        })->name('user');
        
        Route::resource('banks', 'Api\BanksController', ['only' => ['index']]);
        Route::resource('bank_accounts', 'Api\BankAccountsController', ['except' => ['create', 'edit']]); 
        Route::resource('categories', 'Api\CategoriesController', ['except' => ['create', 'edit']]);
        
       
    });

});