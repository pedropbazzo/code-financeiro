<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/user', function () {
//    \Illuminate\Support\Facades\Auth::LoginUsingId(2);
//});

//Route::get('/home', 'HomeController@index');


Route::get('/user', function() {
    \Illuminate\Support\Facades\Auth::LoginUsingId(2);
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function() {
    return redirect()->route('admin.home');
});
Route::get('/app', function () {
    return view('layouts.spa');
});
//grupo de rotas de administração com middleware-> can:access-admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function() {

//    Route::get('/', 'Auth\LoginController@showLoginForm');
//    Route::post('/login', 'Auth\LoginController@login');
//    Route::post('/logout', 'Auth\LoginController@logout');

    Auth::routes();

    Route::group(['middleware' => 'can:access-admin'], function() {
        Route::get('/home', 'HomeController@index')->name('home');  // foi inserido ao adicionar o nosso auth (apenas postra se for auntenticado)
        Route::resource('banks', 'Admin\BanksController'); // Route::resouces cria as rotas todas do crud (get, update, set etc)
    });
});
