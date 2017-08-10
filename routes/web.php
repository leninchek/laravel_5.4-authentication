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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de Administrador
Route::group(['middleware' => 'admin_guest'], function() {
    //Registro y Login
    Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\RegisterController@register');
    Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('admin/login', 'AdminAuth\LoginController@login');
    //Reiniciar contraseña
    Route::get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
    Route::post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'admin_auth'], function(){
    Route::post('admin/logout', 'AdminAuth\LoginController@logout');    
    Route::get('admin/home', function(){
        return view('admin.home');
    });
});