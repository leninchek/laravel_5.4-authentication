<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Auth;

class RegisterController extends Controller
{
    protected $redirectPath = '/admin/login';
    
    //Formularios de Registro del Admin
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }
    //Guardado de Admin
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());
        $this->guard()->login($admin);
        
        return redirect($this->redirectPath);
    }
    
    //Validacion del Registro (Campos)
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    
    //Crear Admin luego de la validacion
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    //Obtiene el guard para autentificar al Admin
    protected function guard()
    {
       return Auth::guard('web_admin');
    }
}